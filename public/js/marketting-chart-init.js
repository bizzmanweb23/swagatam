$(document).ready(function(){

 Chart.defaults.global.defaultFontFamily='"Lato", sans-serif';
 Chart.defaults.global.defaultFontColor="#454545";
 Chart.defaults.global.defaultFontStyle="700";
// Chart.defaults.global.defaultFontSize="13";
 
//Total Leads vs Total Conversion (YTD) chart
var ctx = document.getElementById("leadsVsConversionChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    datasets: [{
			data: [28, 9, 12, 18, 13],
			backgroundColor: '#b63048',
			borderWidth: 0

		}, {
			data: [22, 7, 9, 12, 11],
			backgroundColor: '#455560',
			borderWidth: 0

			// Changes this dataset to become a line

		}],
        labels: ["Jan", "Feb", "Mar", "Apr", "May"]
    },
    options: {
        maintainAspectRatio: false,
		legend: {
            display: false
        },
		scales: {
            yAxes:[{
            }],
            xAxes: [{
                categoryPercentage: 0.5,
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }]
        }
    }
});


//Lead trend chart
var ctx2 = document.getElementById("leadsTrendChart").getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
		datasets: [{
			data: [50, 70, 110, 60, 100, 51, 90],
			fill: false,
			borderWidth: 3,
			borderColor:"#455560",
            pointStrokeColor: "#455560",
            lineTension: 0,
            pointBackgroundColor: "#455560",
            pointBorderColor: "#455560",
            pointHoverBackgroundColor: "#455560",
            pointHoverBorderColor: "#455560"

		}],
    labels: ["03 May", "04 May", "05 May", "06 May", "07 May", "08 May", "09 May"]
  },
    options: {
        maintainAspectRatio: false,
		legend: {
		display: false
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
            data: [840, 505, 200],
            backgroundColor: [
                "#455560",
                "#576670",
                "#6a7780"
            ],
            hoverBackgroundColor: [
                "#455560",
                "#576670",
                "#6a7780"
            ]
        }],
        labels: [
          "Total Leads",
          "Total Conversion",
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
              top: 0,
              bottom: 0
          },
          
      },
        topWidth: 80,   
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
  
var ctx3 = document.getElementById("leadFunnelChart").getContext("2d");
window.myDoughnut = new Chart(ctx3, config);

//Lost Opportunities By Last 12 Months chart
var ctx4 = document.getElementById("lostOpportunitiesChart").getContext('2d');
var myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
    datasets: [{
      label: "No. of Lost Opportunities",
			data: [10, 17, 13, 21, 16, 14, 22, 11, 18, 13, 22, 18],
			backgroundColor: '#455560',
			borderWidth: 0

		}],
    labels: ["June", "July", "Aug", "Sept", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May"]
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
      title: {
        display: false,
        text: 'Ammount ($)',
        position: 'left',
        fontStyle: 'normal',
        fontFamily: 'Roboto, sans-serif'
      },
	    scales: {
			xAxes: [{
            categoryPercentage: 0.6,
            barPercentage: 0.6,
            gridLines: {
              //color: "rgba(0, 0, 0, 0)",
            },
            
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
		}
    }
});

   
	

});





/**************************Document.ready end**************************/

















