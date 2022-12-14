$(document).ready(function(){

 Chart.defaults.global.defaultFontFamily='"Lato", sans-serif';
 Chart.defaults.global.defaultFontColor="#454545";
 Chart.defaults.global.defaultFontStyle="700";
// Chart.defaults.global.defaultFontSize="13";
 
//Conversion Graph
var ctx = document.getElementById("csmConversionGraphChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    datasets: [{
      label: "Conversion Graph",
			data: [12, 7, 9, 8, 5, 9, 6],
			backgroundColor: '#b63048',
			borderWidth: 0

		}],
    labels: ["16 Apr", "17 Apr", "18 Apr", "19 Apr", "20 Apr", "21 Apr", "22 Apr"]
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
        display: false
      },
	    scales: {
			xAxes: [{
            categoryPercentage: 0.5,
            barPercentage: 0.5,
            gridLines: {
              color: "rgba(0, 0, 0, 0)",
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


//Lead trend chart
var ctx2 = document.getElementById("csmLeadsVsConversionChart").getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
		datasets: [{
			data: [12, 2, 13, 11, 4, 15, 9],
			fill: false,
			borderWidth: 1,
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
/*if($(window).width()>= 767){
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
            data: [90, 35, 55],
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
  
var ctx3 = document.getElementById("csmLeadsFunnelChart").getContext("2d");
window.myDoughnut = new Chart(ctx3, config);*/


//Market Penetration in Gallon Chart
var ctx4 = document.getElementById("csmMarketPenetrationGallonChart").getContext('2d');
var myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
    datasets: [{
            label: "Total Tails",
			data: [13000, 9000, 9000, 1000, 9000, 9000, 9500, 11000, 9000, 5000, 11000, 6000],
			backgroundColor: '#b63048',
			borderWidth: 0

		}, {
            label: "Tails at FBO",
			data: [5000, 4000, 6000, 8500, 5000, 6500, 5000, 6000, 7000, 2000, 6000, 5000],
			backgroundColor: '#455560',
			borderWidth: 0

			// Changes this dataset to become a line

		}],
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"]
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
            yAxes:[{
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
            }],
            xAxes: [{
                categoryPercentage: 0.6,
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }]
        }
    }
});

//Market Penetration in %
var ctx5 = document.getElementById('csmMarketPenetrationChart').getContext('2d');
var myChart5 = new Chart(ctx5, {
    type: 'bar',
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
                var fontSize = 12;
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
                ctx.fillText(dataString + '%', position.x, position.y - (fontSize / 2) - padding);
            });
            }
        });
        }
    }],
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
        datasets: [{
            label: 'Tails at FBO',
            backgroundColor: "#b63048",
            data: [10, 15, 10, 5, 20, 20, 18, 20, 3, 4, 15, 20]
        }, {
            label: 'Total Tails',
            backgroundColor: "#455560",
            data: [90, 85, 90, 95, 80, 80, 82, 80, 97, 96, 85, 80]
        }]
    },
    options: {
        maintainAspectRatio: false,
        title: {
            display: false,
        },
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                boxWidth: 15,
                padding: 10
            }
            
        },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
                categoryPercentage: 0.7,
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});


//TFBO Sales in Gallon per Year
var ctx6 = document.getElementById("csmTFBOSalesChart").getContext('2d');
var myChart6 = new Chart(ctx6, {
    type: 'bar',
    data: {
    datasets: [{
            label: "2017",
			data: [8000, 19000, 7000, 10500, 8000, 17500, 12000, 7000, 15000, 11000, 11000, 7000],
			backgroundColor: '#b63048',
			borderWidth: 0

		}, {
            label: "2018",
			data: [9500, 23500, 4000, 11500, 10000, 21000, 19000, 13000, 17000, 13000, 9000, 9500],
			backgroundColor: '#455560',
			borderWidth: 0

			// Changes this dataset to become a line

		}],
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"]
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
            yAxes:[{
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


   
	

});





/**************************Document.ready end**************************/

















