let ws;

//function that takes in the user state visibility (online of Offline) and handle the packets to send over the WS
function sendStateOverWS(state) {
  if (state === "Offline") {
    ws.send(
      JSON.stringify({
        type: "status",
        status: "offline",
        userId: userId,
        latitude: null,
        longitude: null,
      })
    );
  } else if (state === "Online") {
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
}

//function to update the menu for selecting the state visibility
function updateMenu() {
  let status = checkStateCookie();
  $(".menu-item").removeClass("disabled");
  $(".menu-item .tick").remove();
  if (status === "Online") {
    $("#Online").addClass("disabled");
    $("#Online h4").append("<span class='tick'>✔</span>");
  } else if (status === "Offline") {
    $("#Offline").addClass("disabled");
    $("#Offline h4").append("<span class='tick'>✔</span>");
  }
}

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
  if (e === 1 || e === 2 || e === 3) {
    //PERMISSION_DENIED || POSITION_UNAVAILABLE || TIEMOUT
    alert("position not avaible");
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

    if (checkStateCookie() === null) {
      //COOKIE UNSET
      setStateCookie("Online");
      sendStateOverWS("Online");
    } else if (checkStateCookie() === "Offline") {
      //USER STATE VISIBILITY IS OFFLINE
      sendStateOverWS("Offline");
    } else {
      //USER STATE VISIBUILITY IS ONLINE
      sendStateOverWS("Online");
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
        sendStateOverWS("Offline");
      } catch (error) {
        console.error("Error sending data over WebSocket:", error);
      } finally {
        ws.close();
      }
    }
  });
}

$("#btn-state-menu").click(function () {
  $("#sub-menu").toggle();
});

$(".menu-item").click(function () {
  if (!$(this).hasClass("disabled")) {
    let newStatus = $(this).attr("id");
    setStateCookie(newStatus);
    updateMenu();
    sendStateOverWS(newStatus);
  }
});

updateMenu();

connect();
