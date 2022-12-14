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
			borderColor:"#b63048",
            pointStrokeColor: "#b63048",
            lineTension: 0,
            pointBackgroundColor: "#b63048",
            pointBorderColor: "#b63048",
            pointHoverBackgroundColor: "#b63048",
            pointHoverBorderColor: "#b63048"

        },
        {
            label: "ECP",
			data: [0, 11, 4, 9, 17, 11, 18],
			fill: false,
			borderWidth: 1,
			borderColor:"#455560",
            pointStrokeColor: "#455560",
            lineTension: 0,
            pointBackgroundColor: "#455560",
            pointBorderColor: "#455560",
            pointHoverBackgroundColor: "#455560",
            pointHoverBorderColor: "#455560"

		},
        {
            label: "DAB",
			data: [12, 2, 13, 11, 4, 15, 9],
			fill: false,
			borderWidth: 1,
			borderColor:"#d8d6b2",
            pointStrokeColor: "#d8d6b2",
            lineTension: 0,
            pointBackgroundColor: "#d8d6b2",
            pointBorderColor: "#d8d6b2",
            pointHoverBackgroundColor: "#d8d6b2",
            pointHoverBorderColor: "#d8d6b2"

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

 
//Top 5 Market Penetration in % by FBO Locations
var ctx3 = document.getElementById("executiveMarketPenetrationlChart").getContext('2d');
var myChart3 = new Chart(ctx3, {
    type: 'horizontalBar',
    data: {
    datasets: [{
      label: "Opportunity % in Gallon",
			data: [25, 21, 18, 15, 10],
			backgroundColor: '#455560',
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
                    beginAtZero: true
                }
            }],
            yAxes: [{
                categoryPercentage: 0.7,
                barPercentage: 0.7,
                ticks: {
                    beginAtZero: true
                }
            }]
		}
    }
});

//Top 5 TFBO Sales in Gallon by FBO Locations
var ctx4 = document.getElementById("executiveTFBOSalesChart").getContext('2d');
var myChart4 = new Chart(ctx4, {
    type: 'horizontalBar',
    data: {
    datasets: [{
      label: "FBO Sales in Gallon",
			data: [160000, 120000, 80000, 40000, 20000],
			backgroundColor: '#455560',
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

//Top 15 Lost Opportunities  by Locations
var ctx5 = document.getElementById("executivelostOpportunitiesChart").getContext('2d');
var myChart5 = new Chart(ctx5, {
    type: 'bar',
    data: {
    datasets: [{
      label: "No. of Lost Opportunities",
			data: [16, 12, 17, 24, 31, 15, 11, 22, 18, 9, 23, 14, 17, 27, 19],
			backgroundColor: '#455560',
			borderWidth: 0

		}],
    labels: ["DAB", "TPA", "FOK", "PMP", "OCF", "FRG", "NEW", "ORL", "IPS", "MLB", "TIX", "PIE", "FLL", "LAL", "ECP"]
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


//Market Penetration  by Month in Gallon
var ctx6 = document.getElementById("executiveMarketPenetrationGallonChart").getContext('2d');
var myChart6 = new Chart(ctx6, {
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

//Market Penetration by Month in % by no. of Tails
var ctx5 = document.getElementById('executivecsmMarketPenetrationChart').getContext('2d');
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


//Conversion Graph (All Locations)
var ctx6 = document.getElementById("executiveConversionGraphChart").getContext('2d');
var myChart6 = new Chart(ctx6, {
    type: 'bar',
    data: {
    datasets: [{
      label: "Conversion",
			data: [152, 141, 149, 140, 148, 145, 150],
			backgroundColor: '#b63048',
			borderWidth: 0

		}],
    labels: ["03 May", "04 May", "05 May", "06 May", "07 May", "08 May", "09 May"]
  },
    options: {
        maintainAspectRatio: false,
		legend: {
            display: false,
            position: 'bottom',
            labels: {
                boxWidth: 15,
                padding: 15
            }
      },
      title: {
        display: true,
        text: 'Last 7 days',
        position: 'bottom',
        fontColor: '#b63048',
        padding: 10
      },
	    scales: {
			xAxes: [{
                categoryPercentage: 0.5,
                barPercentage: 0.5,
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
                }
            }]
		}
    }
});



//TFBO Sales in Gallon by Months (All Location)
var ctx8 = document.getElementById("executivecsTFBOSalesChart").getContext('2d');
var myChart8 = new Chart(ctx8, {
    type: 'bar',
    data: {
    datasets: [{
            label: "2017",
			data: [80000, 190000, 70000, 105000, 80000, 175000, 120000, 70000, 150000, 110000, 110000, 70000],
			backgroundColor: '#b63048',
			borderWidth: 0

		}, {
            label: "2018",
			data: [95000, 235000, 40000, 115000, 100000, 210000, 190000, 130000, 170000, 130000, 90000, 95000],
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
            xAxes: [{
                categoryPercentage: 0.6,
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }]
        }
    }
});


//Top 10  Conversion by Locations
var ctx7 = document.getElementById("executiveConversionLocationsChart").getContext('2d');
var myChart7 = new Chart(ctx7, {
    type: 'bar',
    data: {
    datasets: [{
      label: "Conversion by Locations",
			data: [28, 18, 23, 11, 18, 9, 15, 9, 17, 25],
			backgroundColor: '#455560',
			borderWidth: 0

		}],
    labels: ["DAB", "ECP", "NEW", "PIE", "PMP", "TIX", "SPG", "MLB", "ISM", "TIX"]
  },
    options: {
        maintainAspectRatio: false,
		legend: {
            display: false,
            position: 'bottom',
            labels: {
                boxWidth: 15,
                padding: 15
            }
      },
      title: {
        display: false,
        text: 'Last 7 days',
        position: 'bottom',
        fontColor: '#324d5c',
        padding: 10
      },
	    scales: {
			xAxes: [{
                categoryPercentage: 0.6,
                barPercentage: 0.6,
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
                }
            }]
		}
    }
});


   
	

});





/**************************Document.ready end**************************/

















