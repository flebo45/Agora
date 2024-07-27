function toogleDataSeries(e) {
  if (typeof e.dataSeries.visible === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}

$("#btn-analytics").click(function () {
  if ($("#chart").is(":hidden")) {
    $.ajax({
      url: "https://localhost/Agora/Moderator/ajaxDataRequest",
      type: "GET",
      dataType: "json",
      success: function (data) {
        var dataPointsPosts = new Map();
        var dataPointsComments = new Map();
        var dataPointsUsers = new Map();

        if (data.posts.length !== 0) {
          dataPointsPosts = data.posts.map((item) => {
            const [year, month, day] = item[0].split(":").map(Number); // Split the date string
            const y = item[1]; // Get the y value
            return {
              x: new Date(year, month - 1, day), // Create a new Date object
              y: y, // Set the y value
            };
          });
        }

        if (data.comments.length !== 0) {
          dataPointsComments = data.comments.map((item) => {
            const [year, month, day] = item[0].split(":").map(Number); // Split the date string
            const y = item[1]; // Get the y value
            return {
              x: new Date(year, month - 1, day), // Create a new Date object
              y: y, // Set the y value
            };
          });
        }

        if (data.users.length !== 0) {
          dataPointsUsers = data.users.map((item) => ({
            y: item[0],
            label: `${item[1]} years old`,
          }));
        }

        var options = {
          animationEnabled: true,
          theme: "light2",
          title: {
            text: "Number of Posts and Comments",
          },
          axisX: {
            valueFormatString: "DD MMM",
          },
          axisY: {
            title: "Number",
            minimum: 0,
          },
          toolTip: {
            shared: true,
          },
          legend: {
            cursor: "pointer",
            verticalAlign: "bottom",
            horizontalAlign: "left",
            dockInsidePlotArea: true,
            itemclick: toogleDataSeries,
          },
          data: [
            {
              type: "line",
              showInLegend: true,
              name: "Posts",
              markerType: "square",
              xValueFormatString: "DD MMM, YYYY",
              color: "#F08080",
              yValueFormatString: "#",
              dataPoints: dataPointsPosts,
            },
            {
              type: "line",
              showInLegend: true,
              name: "Comments",
              lineDashType: "dash",
              yValueFormatString: "#",
              dataPoints: dataPointsComments,
            },
          ],
        };

        var optionsPie = {
          title: {
            text: "Age of Users",
          },
          subtitles: [
            {
              text: "",
            },
          ],
          theme: "light2",
          animationEnabled: true,
          data: [
            {
              type: "pie",
              startAngle: 40,
              toolTipContent: "<b>{label}</b>: {y}",
              showInLegend: "true",
              legendText: "{label}",
              indexLabelFontSize: 16,
              indexLabel: "{label} - {y}",
              dataPoints: dataPointsUsers,
            },
          ],
        };

        $("#chartContainerPie").CanvasJSChart(optionsPie);
        $("#chartContainer").CanvasJSChart(options);
        $("#chart").show();
      },
      error: function (request) {
        console.log(JSON.stringify(request));
      },
    });
  } else {
    $("#chart").hide();
  }
});
