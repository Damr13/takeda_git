<script type="text/javascript">

    function line_chart(){
        var id_machine = $('#id_machine').val()
        var oee = new Array();
        if(id_machine){
            $.ajax({
              type: "POST",
                url: '<?php echo base_url().'Main/g_oee/'; ?>',
                  data: {id_machine:id_machine},
                    dataType: "json",
                    success: function(data) {
                        if(data.respone == 'sukses'){
                            oee = data.oee;
                            line_chart2(oee);
                        }
                  },    
                  error: function() {
                  }
            });
        }
        
    }

    function line_chart2(oee){

        var chart = AmCharts.makeChart("line_chart", {
            type: "serial",
            theme: "light",
            dataDateFormat: "YYYY-MM",
            precision: 2,
            valueAxes: [{
                "id": "v1",
                "position": "left",
                "autoGridCount": false,
                "labelFunction": function(value) {
                    return "$" + Math.round(value) + "M";
                }
            }, {
                "id": "v2",
                "gridAlpha": 0,
                "autoGridCount": true
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
                "title": "Overall OEE",
                "useLineColorForBulletBorder": true,
                "valueField": "market1",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
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
                "title": "Overall OEE YTD",
                "useLineColorForBulletBorder": true,
                "valueField": "market2",
                "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
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
            "dataProvider": generate_data(oee),
                
        });
    }

    function generate_data(oee) {
      var guides = [];
      $.each( oee, function( key, value ) {
        // alert(value.bln)
        guides.push( {
            "date": value.bln,
            "market1": value.overall_oee,
            "market2": value.overall_oee
        } );
      })
      return guides;
    }
</script>