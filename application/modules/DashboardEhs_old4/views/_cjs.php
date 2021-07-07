<script type="text/javascript">
(function($) {
    'use strict';
    var c3LineChart = c3.generate({
      bindto: '#c3-line-chart',
      data: {
        columns: [
          ['data1', 30, 200, 100, 400, 150, 250],
          ['data2', 50, 20, 10, 40, 15, 25]
        ]
      },
      color: {
        pattern: ['rgba(88,216,163,1)', 'rgba(237,28,36,0.6)', 'rgba(4,189,254,0.6)']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      }
    });
  
    setTimeout(function() {
      c3LineChart.load({
        columns: [
          ['data1', 230, 190, 300, 500, 300, 400]
        ]
      });
    }, 1000);
  
    setTimeout(function() {
      c3LineChart.load({
        columns: [
          ['data3', 130, 150, 200, 300, 200, 100]
        ]
      });
    }, 1500);
  
    setTimeout(function() {
      c3LineChart.unload({
        ids: 'data1'
      });
    }, 2000);
  
    var c3SplineChart = c3.generate({
      bindto: '#c3-spline-chart',
      data: {
        columns: [
          ['data1', 30, 200, 100, 400, 150, 250],
          ['data2', 130, 100, 140, 200, 150, 50]
        ],
        type: 'spline'
      },
      color: {
        pattern: ['rgba(88,216,163,1)', 'rgba(237,28,36,0.6)', 'rgba(4,189,254,0.6)']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      }
    });
    var c3BarChart = c3.generate({
      bindto: '#c3-bar-chart',
      data: {
        columns: [
          ['data1', 30, 200, 100, 400, 150, 250],
          ['data2', 130, 100, 140, 200, 150, 50]
        ],
        type: 'bar'
      },
      color: {
        pattern: ['rgba(88,216,163,1)', 'rgba(4,189,254,0.6)', 'rgba(237,28,36,0.6)']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      },
      bar: {
        width: {
          ratio: 0.7 // this makes bar width 50% of length between ticks
        }
      }
    });
  
    setTimeout(function() {
      c3BarChart.load({
        columns: [
          ['data3', 130, -150, 200, 300, -200, 100]
        ]
      });
    }, 1000);
  
    var c3StepChart = c3.generate({
      bindto: '#c3-step-chart',
      data: {
        columns: [
          ['data1', 300, 350, 300, 0, 0, 100],
          ['data2', 130, 100, 140, 200, 150, 50]
        ],
        types: {
          data1: 'step',
          data2: 'area-step'
        }
      },
      color: {
        pattern: ['rgba(88,216,163,1)', 'rgba(4,189,254,0.6)', 'rgba(237,28,36,0.6)']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      }
    });
    var c3PieChart = c3.generate({
      bindto: '#c3-pie-chart',
      data: {
        // iris data from R
        columns: [
          ['data1', 30],
          ['data2', 120],
        ],
        type: 'pie',
        onclick: function(d, i) {
          console.log("onclick", d, i);
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      },
      color: {
        pattern: ['#6153F9', '#8E97FC', '#A7B3FD']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      }
    });
  
    setTimeout(function() {
      c3PieChart.load({
        columns: [
          ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
          ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
          ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
        ]
      });
    }, 1500);
  
    // setTimeout(function() {
    //   c3PieChart.unload({
    //     ids: 'Target'
    //   });
    //   c3PieChart.unload({
    //     ids: 'Actual'
    //   });
    // }, 2500);

    // Visitor Chart
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart_v',
      data: {
        columns: [
          ['Very Low', 15],
          ['Low', 5],
          ['Moderate', 1],
          ['High', 0.5],
          ['Very High', 0],
        ],
        type: 'donut',
        onclick: function(d, i) {
          console.log("onclick", d, i);
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      },
      color: {
        pattern: ['#08a045', '#0077b6', '#ffd500', '#e85d04', '#d00000']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      },
      donut: {
        title: "100%"
      }
    });

    // Judgement Chart
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart_contractor',
      data: {
        columns: [
          ['Very Low', 15],
          ['Low', 5],
          ['Moderate', 1],
          ['High', 0.5],
          ['Very High', 0],
        ],
        type: 'donut',
        onclick: function(d, i) {
          console.log("onclick", d, i);
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      },
      color: {
        pattern: ['#08a045', '#0077b6', '#ffd500', '#e85d04', '#d00000']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      },
      donut: {
        title: "100%"
      }
    });

    // Employee Chart
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart_emp',
      data: {
        columns: [
          ['Very Low', 15],
          ['Low', 5],
          ['Moderate', 1],
          ['High', 0.5],
          ['Very High', 0],
        ],
        type: 'donut',
        onclick: function(d, i) {
          console.log("onclick", d, i);
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      },
      color: {
        pattern: ['#08a045', '#0077b6', '#ffd500', '#e85d04', '#d00000']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      },
      donut: {
        title: "100%"
      }
    });

    // Outsourcing Chart
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart_out',
      data: {
        columns: [
          ['Very Low', 15],
          ['Low', 5],
          ['Moderate', 1],
          ['High', 0.5],
          ['Very High', 0],
        ],
        type: 'donut',
        onclick: function(d, i) {
          console.log("onclick", d, i);
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      },
      color: {
        pattern: ['#08a045', '#0077b6', '#ffd500', '#e85d04', '#d00000']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      },
      donut: {
        title: "100%"
      }
    });

    // Judgement Line Chart
    var chart = AmCharts.makeChart("judgement", {
        "theme": "none",
        "type": "serial",
        "startDuration": 2,
            "dataProvider": [{
                "country": "Very Low",
                "visits": 15,
                "color": "#08a045"
            }, {
                "country": "Low",
                "visits": 5,
                "color": "#0077b6"
            }, {
                "country": "Moderate",
                "visits": 1,
                "color": "#ffd500"
            }, {
                "country": "High",
                "visits": 0.5,
                "color": "#e85d04"
            }, {
                "country": "Very High",
                "visits": 0,
                "color": "#d00000"
            }],
            "valueAxes": [{
                "position": "left"
            }],
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 1,
                "lineAlpha": 0.1,
                "type": "column",
                "valueField": "visits"
            }],
            "depth3D": 40,
            "angle": 40,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 40
            },
            "export": {
                "enabled": true
            }

    });
    
    // var c3DonutChart = c3.generate({
    //   bindto: '#c3-donut-chart2',
    //   data: {
    //     columns: [
    //       ['Target', 59],
    //       ['Actual', 59],
    //     ],
    //     type: 'donut',
    //     onclick: function(d, i) {
    //       console.log("onclick", d, i);
    //     },
    //     onmouseover: function(d, i) {
    //       console.log("onmouseover", d, i);
    //     },
    //     onmouseout: function(d, i) {
    //       console.log("onmouseout", d, i);
    //     }
    //   },
    //   color: {
    //     pattern: ['rgba(88,216,163,1)', 'rgba(4,189,254,0.6)', 'rgba(237,28,36,0.6)']
    //   },
    //   padding: {
    //     top: 0,
    //     right: 0,
    //     bottom: 30,
    //     left: 0,
    //   },
    //   donut: {
    //     title: "100%"
    //   }
    // });
  
    // setTimeout(function() {
    //   c3DonutChart.load({
    //     columns: [
    //       ["setosa", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
    //       ["versicolor", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
    //       ["virginica", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
    //     ]
    //   });
    // }, 1500);
  
    // setTimeout(function() {
    //   c3DonutChart.unload({
    //     ids: 'data1'
    //   });
    //   c3DonutChart.unload({
    //     ids: 'data2'
    //   });
    // }, 2500);
  
  
  })(jQuery);
  </script>
  