$(document).ready(function(){

 Chart.defaults.global.defaultFontFamily='"Lato", sans-serif';
 Chart.defaults.global.defaultFontColor="#454545";
 Chart.defaults.global.defaultFontStyle="700";
// Chart.defaults.global.defaultFontSize="13";

//Lead trend chart
var ctx = document.getElementById("executiveLeadTrendChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
		datasets: [{
            label: "FLL",
			data: [0, 14, 0, 2, 9, 1, 4],
			fill: false,
			borderWidth: 1,
			borderColor:"#f83069",
            pointStrokeColor: "#f83069",
            lineTension: 0,
            pointBackgroundColor: "#f83069",
            pointBorderColor: "#f83069",
            pointHoverBackgroundColor: "#f83069",
            pointHoverBorderColor: "#f83069"

        },
        {
            label: "ECP",
			data: [0, 11, 4, 9, 17, 11, 18],
			fill: false,
			borderWidth: 1,
			borderColor:"#059917",
            pointStrokeColor: "#059917",
            lineTension: 0,
            pointBackgroundColor: "#059917",
            pointBorderColor: "#059917",
            pointHoverBackgroundColor: "#059917",
            pointHoverBorderColor: "#059917"

		},
        {
            label: "DAB",
			data: [12, 2, 13, 11, 4, 15, 9],
			fill: false,
			borderWidth: 1,
			borderColor:"#a889e9",
            pointStrokeColor: "#a889e9",
            lineTension: 0,
            pointBackgroundColor: "#a889e9",
            pointBorderColor: "#a889e9",
            pointHoverBackgroundColor: "#a889e9",
            pointHoverBorderColor: "#a889e9"

		}],
    labels: ["03 May", "04 May", "05 May", "06 May", "07 May", "08 May", "09 May"]
  },
    options: {
        maintainAspectRatio: false,
            legend: {
            display: true,
            position: 'bottom',
            labels: {
                boxWidth: 15,
                padding: 10
            }
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 10,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                },
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                 }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                gridLines: {
                    color: "rgba(0, 0, 0, 0.07)",
                    }
            }]
        }
    }
});


//Lead Funnel Chart
if($(window).width()>= 767){
    var padRig = 40;
}
var config = {
    type: 'funnel',
    plugins: [{
        afterDatasetsDraw: function(chartInstance, easing) {
        // To only draw at the end of animation, check for easing === 1
        var ctx = chartInstance.chart.ctx;
        chartInstance.data.datasets.forEach(function(dataset, i) {
            var meta = chartInstance.getDatasetMeta(i);
            if (!meta.hidden) {
            meta.data.forEach(function(element, index) {
                // Draw the text in black, with the specified font
                ctx.fillStyle = 'white';
                var fontSize = 13;
                var fontStyle = '700';
                var fontFamily = '"Lato", sans-serif';
                ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
                // Just naively convert to string for now
                var dataString = dataset.data[index].toString();
                // Make sure alignment settings are correct
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                var padding = 0;
                var position = element.tooltipPosition();
                ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
            });
            }
        });
        }
    }],
    data: {
        datasets: [{
            data: [840, 305, 535],
            backgroundColor: [
                "#d71d4e",
                "#ea3467",
                "#fd5b89"
            ],
            hoverBackgroundColor: [
                "#d71d4e",
                "#ea3467",
                "#fd5b89"
            ]
        }],
        labels: [
          "Total Tails Landed",
          "Tails Landed at Our FBO",
          "New Leads"
        ]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        sort: 'desc',
        legend: {
          display: true,
          position: 'right',
          
          labels: {
            fullWidth: true,
            boxWidth: 15,
            padding: 15
          }
  
        },
        layout: {
          padding: {
              left: 15,
              right: padRig,
              top: 10,
              bottom: 0
          },
          
      },
          topWidth: 80, // the top width of funnel
          bottomWidth: 350,
        title: {
            display: false,
            text: 'Sales Funnel chart'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    }
  };
  
var ctx2 = document.getElementById("executiveLeadsFunnelChart").getContext("2d");
window.myDoughnut = new Chart(ctx2, config);


//Top 5 TFBO Sales in Gallon by FBO Locations
var ctx4 = document.getElementById("executiveTFBOSalesChart").getContext('2d');
var myChart4 = new Chart(ctx4, {
    type: 'horizontalBar',
    data: {
    datasets: [{
      label: "FBO Sales in Gallon",
			data: [160000, 120000, 80000, 40000, 20000],
			backgroundColor: '#ed4b4f',
			borderWidth: 0

		}],
    labels: ["DAB", "ECP", "NEW", "PIE", "PMP"]
  },
    options: {
        maintainAspectRatio: false,
		legend: {
            display: true,
            position: 'bottom',
            labels: {
                boxWidth: 15,
                padding: 15
            }
      },
      title: {
        display: false
      },
	    scales: {
			xAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize: 100000,
                    callback: function(value) {
                        var ranges = [
                        { divider: 1e6, suffix: 'M' },
                        { divider: 1e3, suffix: 'k' }
                        ];
                        function formatNumber(n) {
                        for (var i = 0; i < ranges.length; i++) {
                            if (n >= ranges[i].divider) {
                                return (n / ranges[i].divider).toString() + ranges[i].suffix;
                            }
                        }
                        return n;
                        }
                        return formatNumber(value);
                    }
                }
            }],
            yAxes: [{
                categoryPercentage: 0.7,
                barPercentage: 0.7,
                ticks: {
                    beginAtZero: true,
                    stepSize: 10000,
                    callback: function(value) {
                        var ranges = [
                        { divider: 1e6, suffix: 'M' },
                        { divider: 1e3, suffix: 'k' }
                        ];
                        function formatNumber(n) {
                        for (var i = 0; i < ranges.length; i++) {
                            if (n >= ranges[i].divider) {
                                return (n / ranges[i].divider).toString() + ranges[i].suffix;
                            }
                        }
                        return n;
                        }
                        return formatNumber(value);
                    }
                }
            }]
		}
    }
});

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
       
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }


});





/**************************Document.ready end**************************/

















