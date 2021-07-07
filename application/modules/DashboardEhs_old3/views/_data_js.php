<script type="text/javascript">

  $(document).ready(function() {
    calibration('periode');
    pm('periode');
    capa_qa('periode');
    capa_ehs('periode');
    cons_car('periode');
    cons_water('periode');
    cons_elect('periode');
    changePeriodeProd('periode');
  });

  // CHART MACHINE AVAILABILITY --ir 
  var maChart = AmCharts.makeChart("machineAvalaibility", {
    "type": "gauge",
    "theme": "none",
    "axes": [{
      "axisThickness": 1,
      "axisAlpha": 0.2,
      "tickAlpha": 0.2,
      "valueInterval": 5,
      "bands": [
        {
          "color": "#cc4748",
          "endValue": 35,
          "startValue": 0
        }, {
          "color": "#fdd400",
          "endValue": 65,
          "startValue": 35
        }, {
          "color": "#84b761",
          "endValue": 100,
          "innerRadius": "95%",
          "startValue": 65
        }
      ],
      "bottomText": "0 %",
      "bottomTextYOffset": -20,
      "endValue": 100
    }],
    "arrows": [{}],
    "export": {
      "enabled": true
    }
  });

  function changePeriodeProd(checkBy) {
    if(checkBy === "date"){
      dateStart   = $('#dateStart').val();
      dateFinish  = $('#dateFinish').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd').val();
    machine = $('#id_machine').val();
    // PRODUCTION CARD --ir 
    $.ajax({
      type: "POST",
    	url: '<?php echo base_url().'DashboardEhs/getTotProdCard/'; ?>',
    	data: {periode:periode, checkBy:checkBy},
    	dataType: "JSON",
    	success: function(data) {
        // alert(data.week);
        $('#tt_prd').html(data.tt_prd + " (" + data.percentageTarget + "%)");
        $('#target').html(" (Target Production : "+ data.target +")");
        $('#note').html(data.note);
        percentageFGood = data.percentageFGood;
        if(percentageFGood < 98) {
          document.getElementById("fGood").className = "ik ik-thumbs-down";
        } 
        else document.getElementById("fGood").className = "ik ik-thumbs-up"; 
        $('#p_good').html(data.p_good);
        $('#p_reject').html(data.p_reject);
        $('#percentageFGood').html("Finish Good (" + data.percentageFGood + "% From Total Production)");
        $('#percentageFGoodNG').html("Reject (" + data.percentageFGoodNG + "% From Total Production)");
        $('#run_hour').html(data.run_hour);
      },	
      error: function() {
        alert('Load Tanggal Monitoring Part Gagal!');
      }
    });

    if(machine !== '') {
      changeMachine('periode');
      atPie('periode');
    }
  }

  function changeDateProd() {
    changePeriodeProd('date');
    if(machine !== '') {
      changeMachine('date');
      atPie('date');
    }
  }

  //  ONCHANGE MACHINE DROPDOWN --ir
  function changeMachine(checkBy) {
    machine = $('#id_machine').val();
    if(checkBy === "date"){
      dateStart   = $('#dateStart').val();
      dateFinish  = $('#dateFinish').val();
      periode     = dateStart+"."+dateFinish;
    }else {
      checkBy = "periode";
      periode = $('#periodeProd').val();
    }
    chart   = "ma";
  
    // LOAD DATA MACHINE AVAILABILITY BASED ON MACHINE --ir 
	  $.ajax({
      type: "POST",
	  	url: '<?php echo base_url().'DashboardEhs/getMaValue/'; ?>',
      data: {machine:machine, periode:periode, chart:chart, checkBy:checkBy},
	  	dataType: "json",
	  	success: function(data) {
        maValue(0);
        maValue(data);
        // atPie(checkBy);
      },	
      error: function() {
        alert('Load Machine Availability Value Failed!');
        maValue(0);
      }
    });
      line_chart();
      atPie(checkBy);
  }

  // SET MACHINE AVAILABILITY VALUES --ir
  function maValue(value) {
    if (maChart) {
      if (maChart.arrows) {
        if (maChart.arrows[0]) {
          if (maChart.arrows[0].setValue) {
            maChart.arrows[0].setValue(value);
            maChart.axes[0].setBottomText(value + " %");
          }
        }
      }
    }
  }

  function atPie(checkBy){
    machine = $('#id_machine').val();
    if(checkBy === "date"){
      dateStart   = $('#dateStart').val();
      dateFinish  = $('#dateFinish').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd').val();
    chart   = "atPie";

    if(periode){
      $.ajax({
        type: "POST",
        url: '<?php echo base_url().'DashboardEhs/getMaValue/'; ?>',
        data: {machine:machine, periode:periode, chart:chart, checkBy:checkBy},
        dataType: "json",
        success: function(data) {
          if(data.respone == 'sukses'){
            atPie2(data.pot,data.pdt,data.udt,data.it,data.ut)
          }},    
        error: function() {
        }
      });
    }
  }

  function atPie2(){
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart3',
      data: {
        columns: [
          ['Very Low', 50],
          ['Low', 30],
          ['Moderate', 5],
          ['High', 0],
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
        pattern: ['#DA4167', '#907AD6', '#4F518C', '#2C2A4A', '#7FDEFF']
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
  }
  
  function line_chart(){
    var id_machine = $('#id_machine').val()
    var periode = $('#periodeProd').val();
    var oee = new Array();
    if(id_machine){
      $.ajax({
        type: "POST",
        url: '<?php echo base_url().'DashboardEhs/g_oee/'; ?>',
        data: {id_machine:id_machine,periode:periode},
        dataType: "json",
        success: function(data) {
          if(data.respone == 'sukses'){
            oee = data.oee;
            if(periode=='year'){
              line_chart2_year(oee);
              $('#h3_oee').html('OEE FY'+data.tahun);
            }else{
              line_chart2_month(oee);
              $('#h3_oee').html('OEE FY'+data.month);
            }
            
          }
        },    
        error: function() {
        }
      });
    }
  }

   function line_chart2_month(oee){
    var chart = AmCharts.makeChart("line_chart", {
      type: "serial",
      theme: "light",
      dataDateFormat: "YYYY-MM-DD",
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
          "id": "g2",
          "valueAxis": "v2",
          "bullet": "round",
          "bulletBorderAlpha": 1,
          "bulletColor": "#FFFFFF",
          "bulletSize": 8,
          "hideBulletsCount": 50,
          "lineThickness": 3,
          "lineColor": "#e95753",
          "title": "Overall OEE",
          "useLineColorForBulletBorder": true,
          "valueField": "market2",
          "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }
      ],
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
      "dataProvider": generate_data_month(oee),
    });
  }

  function generate_data_month(oee) {
    var guides = [];
    $.each( oee, function( key, value ) {
      // alert(value.bln)
      guides.push( {
        "date": value.date,
        "market2": value.overall_oee
      } );
    })
    return guides;
  }

  function line_chart2_year(oee){
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
          "id": "g2",
          "valueAxis": "v2",
          "bullet": "round",
          "bulletBorderAlpha": 1,
          "bulletColor": "#FFFFFF",
          "bulletSize": 8,
          "hideBulletsCount": 50,
          "lineThickness": 3,
          "lineColor": "#e95753",
          "title": "Overall OEE",
          "useLineColorForBulletBorder": true,
          "valueField": "market2",
          "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }
      ],
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
        "market2": value.overall_oee
      } );
    })
    return guides;
  }

  function changePeriodeProd2() {
    calibration('periode');
    pm('periode');
    capa_qa('periode');
    capa_ehs('periode');
    cons_car('periode');
    cons_water('periode');
    cons_elect('periode');
  }

  function changeDateProd2() {
    calibration('date');
    pm('date');
    capa_qa('date');
    capa_ehs('date');
    cons_car('date');
    cons_water('date');
    cons_elect('date');
  }

  function calibration(checkBy){
    if(checkBy === "date"){
      dateStart   = $('#dateStart2').val();
      dateFinish  = $('#dateFinish2').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd2').val();
    var type = 'CAL'
    if(type){
      $.ajax({
        type: "POST",
        url: '<?php echo base_url().'DashboardEhs/pm_cal/'; ?>',
        data: {type:type, periode:periode, checkBy:checkBy},
        dataType: "json",
        success: function(data) {
          if(data.respone == 'sukses'){
              calibration2(data.act,data.tgt)
          }
        },    
        error: function() {
        }
      });
    }
  }

  function calibration2(act,tgt){
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart',
      data: {
        columns: [
          ['Target', tgt],
          ['Actual', act],
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
        pattern: ['rgba(88,216,163,1)', 'rgba(4,189,254,0.6)', 'rgba(237,28,36,0.6)']
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
  }

  function pm(checkBy){
    if(checkBy === "date"){
      dateStart   = $('#dateStart2').val();
      dateFinish  = $('#dateFinish2').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd2').val();
    var type = 'PM'
    if(type){
      $.ajax({
        type: "POST",
        url: '<?php echo base_url().'DashboardEhs/pm_cal/'; ?>',
        data: {type:type, periode:periode, checkBy:checkBy},
        dataType: "json",
        success: function(data) {
          if(data.respone == 'sukses'){
            pm2(data.act,data.tgt)
          }
        },    
        error: function() {
        }
      });
    }
  }

  function pm2(act,tgt){
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart2',
      data: {
        columns: [
          ['Target', tgt],
          ['Actual', act],
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
        pattern: ['rgba(88,216,163,1)', 'rgba(4,189,254,0.6)', 'rgba(237,28,36,0.6)']
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
  }

  function capa_qa(checkBy){
    if(checkBy === "date"){
      dateStart   = $('#dateStart2').val();
      dateFinish  = $('#dateFinish2').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd2').val();
    var type = 'CAPA_QA'
    if(type){
      $.ajax({
        type: "POST",
        url: '<?php echo base_url().'DashboardEhs/capa/'; ?>',
        data: {type:type, periode:periode, checkBy:checkBy},
        dataType: "json",
        success: function(data) {
          if(data.respone == 'sukses'){
            capa_qa2(data.total,data.low,data.medium,data.moderate,data.high,data.veryhigh)
          }
        },    
        error: function() {
        }
      });
    }
  }

  function capa_qa2(total,low,medium,moderate,high,veryhigh){
    var chart = AmCharts.makeChart("capa_qa_chart", {
      "theme": "none",
      "type": "serial",
      "startDuration": 2,
      "dataProvider": [{
        "country": "Total Capa",
        "visits": total,
        "color": "#41658A"
      }, {
        "country": "Low",
        "visits": low,
        "color": "#FE5F00"
      },{
        "country": "Medium",
        "visits": medium,
        "color": "#FE5F00"
      },{
        "country": "Moderate",
        "visits": moderate,
        "color": "#FE5F00"
      }, {
        "country": "High",
        "visits": high,
        "color": "#783F8E"
      }, {
        "country": "Very High",
        "visits": veryhigh,
        "color": "#783F8E"
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
  }

  function capa_ehs(checkBy){
    if(checkBy === "date"){
      dateStart   = $('#dateStart2').val();
      dateFinish  = $('#dateFinish2').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd2').val();
    var type = 'CAPA_EHS'
    if(type){
      $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/capa/'; ?>',
      data: {type:type, periode:periode, checkBy:checkBy},
      dataType: "json",
      success: function(data) {
        if(data.respone == 'sukses'){
          capa_ehs2(data.total,data.low,data.medium,data.moderate,data.high,data.veryhigh)
        }
      },    
      error: function() {
      }
      });
    }
  }

  function capa_ehs2(total,low,medium,moderate,high,veryhigh){
    var chart = AmCharts.makeChart("capa_ehs_chart", {
      "theme": "none",
      "type": "serial",
      "startDuration": 2,
      "dataProvider": [{
        "country": "Total Capa",
        "visits": total,
        "color": "#41658A"
      }, {
        "country": "Low",
        "visits": low,
        "color": "#FE5F00"
      },{
        "country": "Medium",
        "visits": medium,
        "color": "#FE5F00"
      },{
        "country": "Moderate",
        "visits": moderate,
        "color": "#FE5F00"
      }, {
        "country": "High",
        "visits": high,
        "color": "#783F8E"
      }, {
        "country": "Very High",
        "visits": veryhigh,
        "color": "#783F8E"
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
  }

  function cons_car(checkBy){
    if(checkBy === "date"){
      dateStart   = $('#dateStart2').val();
      dateFinish  = $('#dateFinish2').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd2').val();
    var type = 'CONS_CAR'
    if(type){
      $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/consumption/'; ?>',
      data: {type:type, periode:periode, checkBy:checkBy},
      dataType: "json",
      success: function(data) {
        if(data.respone == 'sukses'){
          cons_car2(data.trg,data.act)
        }},    
        error: function() {
        }
      });
    }
  }

  function cons_car2(trg,act){
    var chart = AmCharts.makeChart("cons_car_chart", {
      "theme": "none",
      "type": "serial",
      "startDuration": 2,
      "dataProvider": [{
        "country": "Target",
        "visits": trg,
        "color": "#3F6C51"
      }, {
        "country": "Actual",
        "visits": act,
        "color": "#F7B801"
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
  }

  function cons_water(checkBy){
    if(checkBy === "date"){
      dateStart   = $('#dateStart2').val();
      dateFinish  = $('#dateFinish2').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd2').val();
    var type = 'CONS_WATER'
    if(type){
      $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/consumption/'; ?>',
      data: {type:type, periode:periode, checkBy:checkBy},
      dataType: "json",
      success: function(data) {
        if(data.respone == 'sukses'){
          cons_water2(data.trg,data.act)
        }},    
        error: function() {
        }
      });
    }
  }

  function cons_water2(tgt,act){
    var chart = AmCharts.makeChart("cons_water_chart", {
      "theme": "none",
      "type": "serial",
      "startDuration": 2,
      "dataProvider": [{
        "country": "Target",
        "visits": tgt,
        "color": "#3F6C51"
      }, {
        "country": "Actual",
        "visits": act,
        "color": "#F7B801"
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
  }

  function cons_elect(checkBy){
    if(checkBy === "date"){
      dateStart   = $('#dateStart2').val();
      dateFinish  = $('#dateFinish2').val();
      periode     = dateStart+"."+dateFinish;
    }else periode = $('#periodeProd2').val();
    var type = 'CONS_ELECTRICITY'
    if(type){
      $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/consumption/'; ?>',
      data: {type:type, periode:periode, checkBy:checkBy},
      dataType: "json",
      success: function(data) {
        if(data.respone == 'sukses'){
         cons_elect2(data.trg,data.act)
        }},    
        error: function() {
        }
      });
    }
  }

  function cons_elect2(trg,act){
    var chart = AmCharts.makeChart("cons_elect_chart", {
      "theme": "none",
      "type": "serial",
      "startDuration": 2,
      "dataProvider": [{
        "country": "Target",
        "visits": trg,
        "color": "#3F6C51"
      }, {
        "country": "Actual",
        "visits": act,
        "color": "#F7B801"
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
  }

  function cari_budget(){
    var tahun = $('#tahun_budget').val();
    var compare = $('#compare').val();
    if (tahun == '' || compare == ''){
      alert('Tahun dan Compare tidak boleh kosong !!!')
    }else{
      chart_capex(tahun,compare)
      chart_opex(tahun,compare)
    }
  }

  function chart_capex(tahun,compare){
    var type = 'CAPEX';
    $.ajax({
    type: "POST",
    url: '<?php echo base_url().'DashboardEhs/chart_budget'; ?>',
    data: {tahun:tahun,compare:compare,type:type},
    dataType: "json",
    success: function(data) {
      if(data.respone == 'sukses'){
       chart_capex2(data.act,data.tgt)
      }},    
      error: function() {
      }
    });
  }

  function chart_capex2(act,tgt){
    // var c3DonutChart = c3.generate({
    //   bindto: '#capex-donut-chart',
    //   data: {
    //     columns: [
    //       ['Budget', tgt],
    //       ['Actual', act],
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
    //     pattern: ['rgba(208,58,58,1)', 'rgba(254,108,4,0.7)', 'rgba(237,28,36,0.6)']
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

    var c3PieChart = c3.generate({
      bindto: '#capex_chart',
      data: {
        // iris data from R
        columns: [
          ['Budget', tgt],
          ['Actual', act],
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
        pattern: ['#353b8e','#960808', '#A7B3FD']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      }
    });

  }

  function chart_opex(tahun,compare){
    var type = 'OPEX';
    $.ajax({
    type: "POST",
    url: '<?php echo base_url().'DashboardEhs/chart_budget'; ?>',
    data: {tahun:tahun,compare:compare,type:type},
    dataType: "json",
    success: function(data) {
      if(data.respone == 'sukses'){
       chart_opex2(data.act,data.tgt)
      }},    
      error: function() {
      }
    });
  }

  function chart_opex2(act,tgt){
    // var c3DonutChart = c3.generate({
    //   bindto: '#opex-donut-chart',
    //   data: {
    //     columns: [
    //       ['Budget', tgt],
    //       ['Actual', act],
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
    //     pattern: ['rgba(208,58,58,1)', 'rgba(254,108,4,0.7)', 'rgba(237,28,36,0.6)']
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

    var c3PieChart = c3.generate({
      bindto: '#opex_chart',
      data: {
        // iris data from R
        columns: [
          ['Budget', tgt],
          ['Actual', act],
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
        pattern: ['#353b8e','#960808', '#A7B3FD']
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 30,
        left: 0,
      }
    });
  }

</script>