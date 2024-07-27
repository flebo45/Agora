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

// Function to get the current position using Promises
function getCurrentPosition() {
  return new Promise((resolve, reject) => {
    navigator.geolocation.getCurrentPosition(resolve, reject);
  });
}

//function to connect to the websocket, and handle the logic for sending the info to the server
function connect() {
  const wsUrl = `ws://localhost:8080`;

  //instance of the WS
  ws = new WebSocket(wsUrl);

  //when the client connect to the ws
  ws.onopen = async function () {
    console.log("Connected to WebSocket server");

    // Check the state cookie
    const state = checkStateCookie();

    let status;

    //check the state cookie
    if (state === null) {
      //COOKIE IS NOT SETTED
      setStateCookie("Online");
      status = "online";
    } else if (state === "Offline") {
      //USER STATE VISIBILITY IS OFFLINE
      status = "offline";
    } else {
      //USER STATE VISIBUILITY IS ONLINE
      status = "online";
    }

    // Use Promises to ensure order
    try {
      const position = await getCurrentPosition();
      const { latitude, longitude } = position.coords;

      // Send the user's status first
      ws.send(
        JSON.stringify({
          type: "status",
          status: status,
          userId: userId,
          latitude: latitude,
          longitude: longitude,
        })
      );
      ws.send(
        JSON.stringify({
          type: "total",
        })
      );
    } catch (error) {
      errorHandler(error);
    }
  };

  ws.onmessage = function (event) {
    const data = JSON.parse(event.data);

    if (data.type === "total") {
      //console.log(data.number);
      $("#online-count").text(data.number);
      //array with all the ids of online users
      let onlineIds = idArray.filter((number) =>
        Object.keys(data.idArr).includes(String(number))
      );
      $(".user-div").each(function () {
        // Get the ID of the current user-div
        let id = $(this).attr("id");
        if (onlineIds.includes(parseInt(id))) {
          $(this)
            .find("#user-status")
            .html('<i class="fa fa-circle online"></i>Online')
            .removeClass("offline")
            .addClass("online");
        } else {
          // If offline, change the user-status to "Offline" with a red circle
          $(this)
            .find("#user-status")
            .html('<i class="fa fa-circle offline"></i>Offline')
            .removeClass("online")
            .addClass("offline");
        }
      });
    }
  };

  ws.onclose = function () {
    console.log("Disconnected from WebSocket server");
    // Optionally attempt to reconnect here
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

connect();
