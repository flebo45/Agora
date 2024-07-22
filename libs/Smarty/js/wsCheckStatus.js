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
  if (e === 1) {
    //PERMISSION_DENIED
    alert(
      "If you do not allow access to the location you will not be able to view the location of other users"
    );
    ws.send(
      JSON.stringify({
        type: "status",
        status: "online",
        userId: userId,
        latitude: null,
        longitude: null,
      })
    );
  } else if (e === 2 || e === 3) {
    //POSITION_UNAVAILABLE || TIEMOUT
    alert(
      "Position unavaible: you will not able to view the location of other users"
    );
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
}

//function that takes the user position (latitude and longitude) and return the address object (OPEN STREET MAP)
function getAddress(latitude, longitude) {
  let url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`;

  return fetch(url)
    .then((response) => response.json())
    .then((data) => data.address)
    .catch((error) => {
      console.log("Error: ", error);
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
    if (checkStateCookie() === null) {
      //COOKIE IS NOT SETTED
      setStateCookie("Online");
      navigator.geolocation.getCurrentPosition(function (position) {
        const { latitude, longitude } = position.coords;
        ws.send(
          JSON.stringify({
            type: "status",
            status: "online",
            userId: userId,
            latitude: latitude,
            longitude: longitude,
          })
        );
      }, errorHandler);
    } else if (checkStateCookie() === "Offline") {
      //USER STATE VISIBILITY IS OFFLINE
      navigator.geolocation.getCurrentPosition(function (position) {
        const { latitude, longitude } = position.coords;
        ws.send(
          JSON.stringify({
            type: "status",
            status: "offline",
            userId: userId,
            latitude: latitude,
            longitude: longitude,
          })
        );
      }, errorHandler);
    } else {
      //USER STATE VISIBUILITY IS ONLINE
      navigator.geolocation.getCurrentPosition(function (position) {
        const { latitude, longitude } = position.coords;
        ws.send(
          JSON.stringify({
            type: "status",
            status: "online",
            userId: userId,
            latitude: latitude,
            longitude: longitude,
          })
        );
      }, errorHandler);
    }

    //send a packet for checking if the visited user is online or offline
    ws.send(JSON.stringify({ type: "check", userId: visitedUserId }));
  };

  //handle the message from the server
  ws.onmessage = function (event) {
    const data = JSON.parse(event.data);
    let element = document.getElementById("user-status");

    //if the packet is of type == "status", check the user status and update the html for showing it
    if (data.type === "status") {
      if (data.userId === visitedUserId) {
        if (data.status === "online") {
          element.innerText = "Online";
          element.classList.add("online");
          element.classList.remove("offline");
          $("#err-map").hide();
          $("#map").show();

          //take in the position of the user create the map (OPEN STREET MAP)
          getAddress(data.latitude, data.longitude).then((address) => {
            let map = L.map("map").setView([data.latitude, data.longitude], 13);

            // Add the OpenStreetMap tiles
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
              attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            // Add a marker to the map onto the user current location
            const marker = L.marker([data.latitude, data.longitude])
              .addTo(map)
              .bindPopup(
                address
                  ? `City: ${
                      address.town || address.city || address.village
                    }.<br> State: ${address.state}, ${address.county}`
                  : "Address Not Found."
              )
              .openPopup();
          });
        } else {
          element.classList.remove("online");
          element.innerText = "Offline";
          element.classList.add("offline");
          $("#err-map").show();
          $("#map").hide();
        }
      }
      //if the packet is of type == "check", handle the response from the server when the client ask if the visited user is online or offline when he loads the page
    } else if (data.type === "check") {
      let element = document.getElementById("user-status");
      if (data.status === "online") {
        element.innerText = "Online";
        element.classList.add("online");
        element.classList.remove("offline");
        $("#err-map").hide();
        $("#map").show();

        getAddress(data.latitude, data.longitude).then((address) => {
          let map = L.map("map").setView([data.latitude, data.longitude], 13);

          // Add the OpenStreetMap tiles
          L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
              '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
          }).addTo(map);

          // Add a marker to the map
          const marker = L.marker([data.latitude, data.longitude])
            .addTo(map)
            .bindPopup(
              address
                ? `City: ${
                    address.town || address.city || address.village
                  }.<br> State: ${address.state}, ${address.county}`
                : "Address Not Found."
            )
            .openPopup();
        });
      } else {
        element.innerText = "Offline";
        element.classList.remove("online");
        element.classList.add("offline");
        $("#err-map").show();
        $("#map").hide();
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
