<script type="text/javascript">

  $(document).ready(function() {
    judgement();
    setPie('Tamu')
    setPie('Contractor')
    setPie('Karyawan')
    setPie('Outsourcing')
    // setPie('contractor')
    // setPie('employee')
    // setPie('outsourcing')
    // calibration('periode');
    // pm('periode');
    // capa_qa('periode');
    // capa_ehs('periode');
    // cons_car('periode');
    // cons_water('periode');
    // cons_elect('periode');
    // changePeriodeProd('periode');
  });
  
  function judgement(){
    dateStart   = $('#dateStart2').val();
    dateFinish  = $('#dateFinish2').val();
    chart   = "atPie";

    $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/getJudgementValue/'; ?>',
      data: {dateStart:dateStart, dateFinish:dateFinish},
      dataType: "json",
      success: function(data) {
        if(data.respone == 'sukses'){
          veryHigh = data.judgementVal[0]['very_high']
          high = data.judgementVal[0]['high']
          moderate = data.judgementVal[0]['moderate']
          low = data.judgementVal[0]['low']
          veryLow = data.judgementVal[0]['very_low']

          judgement2(veryHigh,high,moderate,low,veryLow)
        }
      },error: function() {
      }
    });
  }
    
  function judgement2(veryHigh,high,moderate,low,veryLow){
    var chart = AmCharts.makeChart("judgement", {
      "theme": "none",
      "type": "serial",
      "startDuration": 2,
          "dataProvider": [{
              "status": "Very Low",
              "value": veryLow,
              "color": "#08a045"
          }, {
              "status": "Low",
              "value": low,
              "color": "#0077b6"
          }, {
              "status": "Moderate",
              "value": moderate,
              "color": "#ffd500"
          }, {
              "status": "High",
              "value": high,
              "color": "#e85d04"
          }, {
              "status": "Very High",
              "value": veryHigh,
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
              "valueField": "value"
          }],
          "depth3D": 40,
          "angle": 40,
          "chartCursor": {
              "categoryBalloonEnabled": false,
              "cursorAlpha": 0,
              "zoomable": false
          },
          "categoryField": "status",
          "categoryAxis": {
              "gridPosition": "start",
              "labelRotation": 40
          },
          "export": {
              "enabled": true
          }
    });

  }
  
  function showDetail(el, people, people2, status) {
    listStatus = {'veryHigh':'VERY HIGH','high':'HIGH','moderate':'MODERATE','low':'LOW','veryLow':'VERY LOW'}
    $('#modalDetail').show()
    $('#modalDetail .modal-title').html(people+" detail on "+listStatus[status].toLowerCase()+" status")

    var headerCol = ['No','Tanggal','Full Name','Department / Company','Risk Score','Tracing Store']
    $('#modalDetail table').empty().append('<thead><tr></tr></thead><tbody></tbody>')
    for (let x = 0; x < headerCol.length; x++) {
      $('#modalDetail table thead tr').append('<td>'+headerCol[x]+'</td>')
    }
    
    $.ajax({
      dataType        : "JSON",
      method          : "POST",
      data            : {people:people2, status:listStatus[status]},
      url             : window.location.origin+'/takeda/DashboardEhs/getStatusByPeople',
      success         : function(data) {
        console.log(data.listDetail)
        $.each(data.listDetail, function(key, obj) {
          $('#modalDetail tbody').append('<tr></tr>')
          $('#modalDetail tbody tr:last').append('<td>'+((key++)+1)+'</td>')
          $('#modalDetail tbody tr:last').append('<td>'+this.tgl+'</td>')
          $('#modalDetail tbody tr:last').append('<td>'+(this.Nama).replaceAll("+", " ")+'</td>')
          $('#modalDetail tbody tr:last').append('<td>'+(this.Company).replaceAll("+", " ")+'</td>')
          $('#modalDetail tbody tr:last').append('<td>'+this.total_risk+'</td>')
          $('#modalDetail tbody tr:last').append('<td>'+this.total_tracing+'</td>')
        })
      }
    })

  }

  // Close modal pop up (window)
  $('#modalDetail').on('click', function(e) {
    if (e.target !== this) {
      return;
    }
    $('#modalDetail').hide();
  });

  // Close modal pop up (Button)
  function close_modal() {
    $('#modalDetail').hide()
  }
  
  function setPie(filter){
    dateStart   = $('#dateStart2').val();
    dateFinish  = $('#dateFinish2').val();
    
    listPeople = {'Contractor':'Contractor','Outsourcing':'Outsourcing','Tamu':'Visitor','Karyawan':'Employee'}
    listStatus = {'veryHigh':'rgb(208, 0, 0)','high':'rgb(232, 93, 4)','moderate':'rgb(255, 213, 0)','low':'rgb(0, 119, 182)','veryLow':'rgb(8, 160, 69)'}
    text = '<h3>'+listPeople[filter]+'</h3>'
    $.each(listStatus, function(key, obj) {
      fontColor='white'
      if(key == "moderate") fontColor = 'black';
      text += '<button id="btn'+filter+''+key+'" style="display:none; font-size:10px; background-color:'+obj+'; color:'+fontColor+'; border:0px solid white" onclick="showDetail(this, \''+listPeople[filter]+'\', \''+filter+'\', \''+key+'\')">'+key+'</button>' 
    })
    
    $('#cardPie'+filter).find('.card-header').css({"display": "flex", "gap":".5rem"})
    $('#cardPie'+filter).find('.card-header').html(text)

    $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/getPieValue/'; ?>',
      data: {col:filter, dateStart:dateStart, dateFinish:dateFinish},
      dataType: "json",
      success: function(data) {
        if(data.respone == 'sukses'){
          total = data.pieValue[0]['total']

          veryHigh = data.pieValue[0]['very_high'] / total * 100   
          high     = data.pieValue[0]['high'] / total * 100  
          moderate = data.pieValue[0]['moderate'] / total * 100   
          low      = data.pieValue[0]['low'] / total * 100    
          veryLow  = data.pieValue[0]['very_low'] / total * 100   

          setPie2(filter,veryHigh,high,moderate,low,veryLow,dateStart,dateFinish)
        }
      },error: function() {
      }
    });
  }
    
  function setPie2(filter,veryHigh,high,moderate,low,veryLow,dateStart,dateFinish){
    listStatus2 = {'Very High':'veryHigh','High':'high','Moderate':'moderate','Low':'low','Very Low':'veryLow'}

    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart_'+filter,
      data: {
        columns: [
          ['Very Low', veryLow],
          ['Low', low],
          ['Moderate', moderate],
          ['High', high],
          ['Very High', veryHigh],
        ],
        type: 'donut',
        onclick: function(d, i) {
          console.log("onclick", d, i);
          $('#cardPie'+filter+' #btn'+filter+''+listStatus2[d.id]).trigger('onclick')
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      },
      color: {
        pattern: ['#08a045', '#7ddc1f', '#ffd500', '#e85d04', '#d00000']
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