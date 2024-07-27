let ws;

//function to set a cookie for the state visibility (online or offline)
function setStateCookie(param) {
  const d = new Date();
  d.setTime(d.getTime() + 30 * 24 * 60 * 60 * 1000); //30days exptime
  let expires = "expires=" + d.toUTCString();
  document.cookie = "state=" + param + ";" + expires;
}

//function to check the state cookie, if the coockie is set return the value of the cookie, if not return null
function checkStateCookie() {
  let ca = document.cookie.split(";");
  let name = "state=";
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return null;
}

//error handler for the navigator.geolocation.getCurrentPosition, that handle all the problems related to get the user position
function errorHandler(e) {
  const errorMessage =
    e === 1
      ? "If you do not allow access to the location you will not be able to view the location of other users"
      : "Position unavailable: you will not be able to view the location of other users";
  alert(errorMessage);

  ws.send(
    JSON.stringify({
      type: "status",
      status: "online",
      userId: userId,
      latitude: null,
      longitude: null,
    })
  );
}

//function that takes the user position (latitude and longitude) and return the address object (OPEN STREET MAP)
function getAddress(latitude, longitude) {
  let url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`;

  return $.ajax({
    url: url,
    dataType: "json",
  })
    .then((data) => data.address)
    .catch((error) => {
      console.error("Error: ", error);
      return null;
    });
}

//function to connect to the websocket, and handle the logic for sending the info to the server
function connect() {
  const wsUrl = `ws://localhost:8080`;

  //instance of the WS
  ws = new WebSocket(wsUrl);

  //when the client connect to the ws
  ws.onopen = function () {
    console.log("Connected to WebSocket server");
    const state = checkStateCookie();
    const stateToSend = state === "Offline" ? "offline" : "online";
    if (state === null) setStateCookie("Online");

    // Use navigator.geolocation with jQuery promise
    navigator.geolocation.getCurrentPosition(function (position) {
      const { latitude, longitude } = position.coords;
      ws.send(
        JSON.stringify({
          type: "status",
          status: stateToSend,
          userId: userId,
          latitude: latitude,
          longitude: longitude,
        })
      );
    }, errorHandler);

    //send a packet for checking if the visited user is online or offline
    ws.send(JSON.stringify({ type: "check", userId: visitedUserId }));
  };

  //handle the message from the server
  ws.onmessage = function (event) {
    const data = JSON.parse(event.data);
    const $element = $("#user-status");

    const updateMap = (latitude, longitude, address) => {
      const map = L.map("map").setView([latitude, longitude], 13);

      // Add the OpenStreetMap tiles
      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
          '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      }).addTo(map);

      // Add a marker to the map onto the user's current location
      const marker = L.marker([latitude, longitude])
        .addTo(map)
        .bindPopup(
          address
            ? `City: ${
                address.town || address.city || address.village
              }.<br> State: ${address.state}, ${address.county}`
            : "Address Not Found."
        )
        .openPopup();
    };

    // If the packet is of type == "status", check the user status and update the HTML for showing it
    if (data.type === "status" && data.userId === visitedUserId) {
      const isOnline = data.status === "online";
      $element
        .text(isOnline ? "Online" : "Offline")
        .toggleClass("online", isOnline)
        .toggleClass("offline", !isOnline);
      $("#err-map").toggle(!isOnline);
      $("#map").toggle(isOnline);

      if (isOnline) {
        getAddress(data.latitude, data.longitude).then((address) => {
          updateMap(data.latitude, data.longitude, address);
        });
      }
    }

    // If the packet is of type == "check", handle the response from the server when the client asks if the visited user is online or offline when he loads the page
    else if (data.type === "check") {
      const isOnline = data.status === "online";
      $element
        .text(isOnline ? "Online" : "Offline")
        .toggleClass("online", isOnline)
        .toggleClass("offline", !isOnline);
      $("#err-map").toggle(!isOnline);
      $("#map").toggle(isOnline);

      if (isOnline) {
        getAddress(data.latitude, data.longitude).then((address) => {
          updateMap(data.latitude, data.longitude, address);
        });
      }
    }
  };

  ws.onclose = function () {
    console.log("Disconnected from WebSocket server");
  };

  ws.onerror = function (error) {
    console.error("WebSocket error:", error);
  };

  // Handle page unload to send 'offline' status and close WebSocket
  window.addEventListener("beforeunload", function (event) {
    if (ws && ws.readyState === WebSocket.OPEN) {
      try {
        ws.send(
          JSON.stringify({
            type: "status",
            status: "offline",
            userId: userId,
            latitude: null,
            longitude: null,
          })
        );
      } catch (error) {
        console.error("Error sending data over WebSocket:", error);
      } finally {
        ws.close();
      }
    }
  });
}

$("#btnMap").click(function () {
  $("#map-overlay").toggle();
});

connect();
