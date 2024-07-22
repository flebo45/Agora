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

//function to connect to the websocket, and handle the logic for sending the info to the server
function connect() {
  const wsUrl = `ws://localhost:8080`;

  //instance of the WS
  ws = new WebSocket(wsUrl);

  //when the client connect to the ws
  ws.onopen = function () {
    console.log("Connected to WebSocket server");

    //check the state cookie
    if (checkStateCookie() === null) {
      //COOKIE IS NOT SETTED
      setStateCookie("Online");

      //take user position and send it over the ws
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
  };

  ws.onmessage = function (event) {};

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
