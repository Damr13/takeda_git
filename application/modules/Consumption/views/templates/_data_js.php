<script type="text/javascript">

    function line_chart2(grp,unit){
        var chart = AmCharts.makeChart("line_chart", {
            "type": "serial",
            "theme": "light",
            "dataDateFormat": "YYYY-MM",
            "precision": 0,
            "valueAxes": [{
                "id": "v1",
                "position": "left",
                "autoGridCount": false,
                "labelFunction": function(value) {
                    return "$" + Math.round(value) + "M";
                }
            }, {
                "id": "v2",
                "gridAlpha": 0,
                "autoGridCount": false
            }],
            "graphs": [{
                "id": "g1",
                "valueAxis": "v2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 8,
                "hideBulletsCount": 50,
                "lineThickness": 3,
                "lineColor": "#2ed8b6",
                "title": "Target",
                "useLineColorForBulletBorder": true,
                "valueField": "market1",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]"+unit+"</b>"
            }, {
                "id": "g2",
                "valueAxis": "v2",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 8,
                "hideBulletsCount": 50,
                "lineThickness": 3,
                "lineColor": "#e95753",
                "title": "Actual",
                "useLineColorForBulletBorder": true,
                "valueField": "market2",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]"+unit+"</b>"
            }],
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha": 0,
                "valueLineAlpha": 0.2
            },
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "legend": {
                "useGraphSettings": true,
                "position": "top"
            },
            "balloon": {
                "borderThickness": 1,
                "shadowAlpha": 0
            },
            "dataProvider": generate_data(grp)
        });
    }

    function generate_data(grp) {
      var guides = [];
      $.each( grp, function( key, value ) {
        // alert(value.th_bl)
        guides.push( {
            "date": value.date,
            "market1": value.target,
            "market2": value.actual
        } );
      })
      return guides;
    }



    

</script>