<script type="text/javascript">

  $(document).ready(function() {
    setPie('Tamu');
    setPie('Contractor');
    setPie('Karyawan');
    setPie('Outsourcing');
    // judgement();
    departement();
    setPieUncheck('Karyawan');
    setPieUncheck('Outsourcing');
  });
  // Function Submit
  function setPiePie(){
    setPie('Tamu');
    setPie('Contractor');
    setPie('Karyawan');
    setPie('Outsourcing');
    judgement();
    departement();
  }
  function search_dept(){
    departement();
  }
  // Pie Chart List People
  function setPie(filter){
    startDate   = $('#startDate').val();
    endDate  = $('#endDate').val();
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
      data: {col:filter, startDate:startDate, endDate:endDate},
      dataType: "JSON",
      success: function(data) {
        if(data.respone == 'sukses'){
          total     = data.pieValue[0]['total']
          veryHigh  = data.pieValue[0]['very_high'] / total * 100   
          high      = data.pieValue[0]['high'] / total * 100  
          moderate  = data.pieValue[0]['moderate'] / total * 100   
          low       = data.pieValue[0]['low'] / total * 100    
          veryLow   = data.pieValue[0]['very_low'] / total * 100   

          setPie2(filter,veryHigh,high,moderate,low,veryLow)
        }
      },
      beforeSend: function(){
        $('.loaders').show();
        $('#c3-donut-chart_'+filter).hide();
      },
      complete: function(){
        $('.loaders').hide();
        $('#c3-donut-chart_'+filter).show();
        setPie2(filter,veryHigh,high,moderate,low,veryLow)
      },
      error: function() {
      }
    });
  }
  function setPie2(filter,veryHigh,high,moderate,low,veryLow){
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
  // Judgement
  function judgement(){
    startDate   = $('#startDate').val();
    endDate  = $('#endDate').val();
    chart   = "atPie";

    $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/getJudgementValue/'; ?>',
      data: {startDate:startDate, endDate:endDate},
      dataType: "JSON",
      success: function(data) {
        if(data.respone == 'sukses'){
          veryHigh = data.judgementVal[0]['very_high']
          high = data.judgementVal[0]['high']
          moderate = data.judgementVal[0]['moderate']
          low = data.judgementVal[0]['low']
          veryLow = data.judgementVal[0]['very_low']

          judgement2(veryHigh,high,moderate,low,veryLow)
        }
      },
      beforeSend: function(){
        $('.loaders').show();
        $('#judgement').hide();
      },
      complete: function(){
        $('.loaders').hide();
        $('#judgement').show();
      },
      error: function() {}
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
          "color": "#7ddc1f"
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
      },
    });

  }
  // Pie chart people not filled
  function setPieUncheck(filters){
    listPeoples = {'Outsourcing':'Outsourcing','Karyawan':'Employee'}
    listStatuss = {'totUncheck':'rgb(208, 0, 0)','totCheck':'rgb(255, 213, 0)'}
    text = '<h3>'+listPeoples[filters]+'</h3>'
    $.each(listStatuss, function(keys, objs) {
      fontColor='white'
      if(keys == "tot_check") fontColor = 'black';
      text += '<button id="btn'+filters+''+keys+'" style="display:none; font-size:10px; background-color:'+objs+'; color:'+fontColor+'; border:0px solid white" onclick="showDetailUncheck(this, \''+listPeoples[filters]+'\', \''+filters+'\', \''+keys+'\')">'+keys+'</button>' 
    })

    $('#cardPieUncheck'+filters).find('.card-header').css({"display": "flex", "gap":".5rem"})
    $('#cardPieUncheck'+filters).find('.card-header').html(text)

    $.ajax({
      type: "POST",
      url: '<?php echo base_url().'DashboardEhs/getPieValueUncheck/'; ?>',
      data: {cols:filters},
      dataType: "json",
      success: function(data) {
        console.log(data)
        if(data.respone == 'sukses'){
          total = data.pieValues[0]['total']

          totUncheck = data.pieValues[0]['tot_uncheck'] / total * 100   
          totCheck     = data.pieValues[0]['tot_check'] / total * 100   

          setPieUncheck2(filters,totUncheck,totCheck)
        }
      },error: function() {
      }
    });
  }
  function setPieUncheck2(filters,totUncheck,totCheck){
    listStatuss2 = {'Have not filled out the form':'totUncheck','Have filled out the form':'totCheck'}
    var c3DonutChart = c3.generate({
      bindto: '#c3-donut-chart__Uncheck-'+filters,
      data: {
        columns: [
          ['Have not filled out the form', totUncheck],
          ['Have filled out the form', totCheck],
        ],
        type: 'donut',
        onclick: function(d, i) {
          console.log("onclick", d, i);
          $('#cardPieUncheck'+filters+' #btn'+filters+''+listStatuss2[d.id]).trigger('onclick')
        },
        onmouseover: function(d, i) {
          console.log("onmouseover", d, i);
        },
        onmouseout: function(d, i) {
          console.log("onmouseout", d, i);
        }
      },
      color: {
        pattern: ['#1f3a93','#2c82c9']
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
  // List People by Judgement
  function showDetail(el, people, people2, status) {
    startDate   = $('#startDate').val();
    endDate  = $('#endDate').val();
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
      data            : {people:people2, status:listStatus[status], startDate:startDate, endDate:endDate},
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
  $('#close_modal').on('click', function(e) {
    if (e.target !== this) {
      return;
    }
    $('#modalDetail').hide();
  });
  // Pie chart list people filled form
  function showDetailUncheck(els, peoples, peoples2, statuss) {
    listStatuss = {'totUncheck':'Have not filled out the form','totCheck':'Have filled out the form'}
    $('#modalDetailUncheck').show()
    $('#modalDetailUncheck .modal-title').html(peoples+" detail on "+listStatuss[statuss].toLowerCase()+"")

    var headerCol = ['No','Nik','Name','Departement']
    $('#modalDetailUncheck table').empty().append('<thead><tr></tr></thead><tbody></tbody>')
    for (let x = 0; x < headerCol.length; x++) {
      $('#modalDetailUncheck table thead tr').append('<td>'+headerCol[x]+'</td>')
    }
    
    $.ajax({
      dataType        : "JSON",
      method          : "POST",
      data            : {peoples:peoples2,statuss:listStatuss[statuss]},
      url             : window.location.origin+'/takeda/DashboardEhs/getStatusByPeoples',
      success         : function(data) {
        console.log(data.listDetails)
        $.each(data.listDetails, function(keys, objs) {
          $('#modalDetailUncheck tbody').append('<tr></tr>')
          $('#modalDetailUncheck tbody tr:last').append('<td>'+((keys++)+1)+'</td>')
          $('#modalDetailUncheck tbody tr:last').append('<td>'+this.Nik+'</td>')
          $('#modalDetailUncheck tbody tr:last').append('<td>'+(this.Nama).replaceAll("+", " ")+'</td>')
          $('#modalDetailUncheck tbody tr:last').append('<td>'+(this.DeptName).replaceAll("+", " ")+'</td>')
        })
      }
    })

  }
  // Close modal pop up (window)
  $('#modalDetailUncheck').on('click', function(e) {
    if (e.target !== this) {
      return;
    }
    $('#modalDetailUncheck').hide();
  });
  // Close modal pop up (Button)
  $('#close_modals').on('click', function(e) {
    if (e.target !== this) {
      return;
    }
    $('#modalDetailUncheck').hide();
  });

  // Departement
  function departement(){
    // Filter date
    startDate  = $('#startDates').val();
    endDate    = $('#endDates').val();
    // Get date (endDate - startDate)
    startCal   = $('#startDates').datepicker('getDate');
    endCal     = $('#endDates').datepicker('getDate');
    // Get date (endDate - startDate)
    totalDate  = (endCal - startCal)/1000/60/60/24+1;

    chart      = "departement";

    if(startDate == '' && endDate == '') {
      departement3();
      $('#table-depts').css('padding-left','53px');
      $('#table-dept').css('width','240px');
      // swal("PERINGATAN", "Start Date dan Finish Date tidak boleh kosong !!!", "warning");
    }else {
      $.ajax({
        type: "POST",
        url: '<?php echo base_url().'DashboardEhs/getDeptValue/'; ?>',
        data: {startDate:startDate, endDate:endDate},
        dataType: "JSON",
        beforeSend: function(){
          $('#loadersa').show();
          $('#loaders-text').show();
        },
        success: function(data) {
          if(data.respone == 'sukses'){
            $('#loadersa').hide();
            $('#loaders-text').hide();
            // Form Employee (Plan)
            be_fe     = data.deptVal[0]['be_fe']    * totalDate
            eng_fe    = data.deptVal[0]['eng_fe']   * totalDate
            fnc_fe    = data.deptVal[0]['fnc_fe']   * totalDate
            hr_fe     = data.deptVal[0]['hr_fe']    * totalDate
            ms_fe     = data.deptVal[0]['ms_fe']    * totalDate
            pack_fe   = data.deptVal[0]['pack_fe']  * totalDate
            plant_fe  = data.deptVal[0]['plant_fe'] * totalDate
            p2_fe     = data.deptVal[0]['p2_fe']    * totalDate
            qa_fe     = data.deptVal[0]['qa_fe']    * totalDate
            qc_fe     = data.deptVal[0]['qc_fe']    * totalDate
            sc_fe     = data.deptVal[0]['sc_fe']    * totalDate
            // Form Submissions (Actual)
            be_fs     = data.deptVal[0]['be_fs']
            eng_fs    = data.deptVal[0]['eng_fs']
            fnc_fs    = data.deptVal[0]['fnc_fs']
            hr_fs     = data.deptVal[0]['hr_fs']
            ms_fs     = data.deptVal[0]['ms_fs']
            pack_fs   = data.deptVal[0]['pack_fs']
            plant_fs  = data.deptVal[0]['plant_fs']
            p2_fs     = data.deptVal[0]['p2_fs']
            qa_fs     = data.deptVal[0]['qa_fs']
            qc_fs     = data.deptVal[0]['qc_fs']
            sc_fs     = data.deptVal[0]['sc_fs']

            if(totalDate < 10){
              $('#table-depts').css('padding-left','58px');
              $('#table-dept').css('width','245px');
            }
            else if(totalDate > 10){
              $('#table-depts').css('padding-left','68px');
              $('#table-dept').css('width','255px');
            }
            departement2(be_fe,eng_fe,fnc_fe,hr_fe,ms_fe,pack_fe,plant_fe,p2_fe,qa_fe,qc_fe,sc_fe,be_fs,eng_fs,fnc_fs,hr_fs,ms_fs,pack_fs,plant_fs,p2_fs,qa_fs,qc_fs,sc_fs);
            tableCountDept(be_fe,eng_fe,fnc_fe,hr_fe,ms_fe,pack_fe,plant_fe,p2_fe,qa_fe,qc_fe,sc_fe,be_fs,eng_fs,fnc_fs,hr_fs,ms_fs,pack_fs,plant_fs,p2_fs,qa_fs,qc_fs,sc_fs);
          }
        },
        error: function() {}
      });
    }
  }

  function departement2(be_fe,eng_fe,fnc_fe,hr_fe,ms_fe,pack_fe,plant_fe,p2_fe,qa_fe,qc_fe,sc_fe,be_fs,eng_fs,fnc_fs,hr_fs,ms_fs,pack_fs,plant_fs,p2_fs,qa_fs,qc_fs,sc_fs){
    am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    var chart = am4core.create("departement", am4charts.XYChart);
    // some extra padding for range labels
    chart.paddingBottom = 50;
    chart.cursor = new am4charts.XYCursor();
    chart.scrollbarX = new am4core.Scrollbar();
    // will use this to store colors of the same items
    var colors = {};
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "category";
      categoryAxis.renderer.minGridDistance = 60;
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.dataItems.template.text = "{realName}";
      categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
      return categoryAxis.tooltipDataItem.dataContext.realName;
    })
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;
    valueAxis.min = 0;
    // single column series for all data
    var columnSeries = chart.series.push(new am4charts.ColumnSeries());
    columnSeries.columns.template.width = am4core.percent(80);
    columnSeries.tooltipText = "{provider}: {realName}, {valueY}";
    columnSeries.dataFields.categoryX = "category";
    columnSeries.dataFields.valueY = "value";
    // second value axis for Submission
    var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis2.renderer.opposite = true;
    valueAxis2.syncWithAxis = valueAxis;
    valueAxis2.tooltip.disabled = true;
    valueAxis2.calculateTotals = true;
    valueAxis2.min = 0;
    valueAxis2.max = 100;
    valueAxis2.strictMinMax = true;
    valueAxis2.renderer.labels.template.adapter.add("text", function(text) {
      return text + "%";
    });
    // Target line series
    var lineSeries = chart.series.push(new am4charts.LineSeries());
    lineSeries.tooltipText = "{valueY}%";
    lineSeries.dataFields.categoryX = "category";
    lineSeries.dataFields.valueY = "Target";
    lineSeries.yAxis = valueAxis2;
    // lineSeries.bullets.push(new am4charts.CircleBullet());
    lineSeries.stroke = "#ffb703";
    lineSeries.fill = lineSeries.stroke;
    lineSeries.strokeWidth = 3;
    lineSeries.snapTooltip = true;
    // Submission line series
    var lineSeries = chart.series.push(new am4charts.LineSeries());
    lineSeries.tooltipText = "{valueY}%";
    lineSeries.dataFields.categoryX = "category";
    lineSeries.dataFields.valueY = "Submission";
    lineSeries.yAxis = valueAxis2;
    // lineSeries.bullets.push(new am4charts.CircleBullet());
    lineSeries.stroke = "#6b705c";
    lineSeries.fill = lineSeries.stroke;
    lineSeries.strokeWidth = 3;
    lineSeries.snapTooltip = true;
    // when data validated, adjust location of data item based on count
    lineSeries.events.on("datavalidated", function(){
      lineSeries.dataItems.each(function(dataItem){
        // if count divides by two, location is 0 (on the grid)
        if(dataItem.dataContext.count / 2 == Math.round(dataItem.dataContext.count / 2)){
          dataItem.setLocation("categoryX", 0);
        }
        // otherwise location is 0.5 (middle)
        else{
          dataItem.setLocation("categoryX", 0.5);
        }
      })
    })
    // fill adapter, here we save color value to colors object so that each time the item has the same name, the same color is used
    columnSeries.columns.template.adapter.add("fill", function(fill, target) {
      var name = target.dataItem.dataContext.realName;
      if (!colors[name]) {
        colors[name] = chart.colors.next();
      }
      target.stroke = colors[name];
      return colors[name];
    })
    var rangeTemplate = categoryAxis.axisRanges.template;
    rangeTemplate.tick.disabled = false;
    rangeTemplate.tick.location = 0;
    rangeTemplate.tick.strokeOpacity = 0.6;
    rangeTemplate.tick.length = 60;
    rangeTemplate.grid.strokeOpacity = 0.5;
    rangeTemplate.label.tooltip = new am4core.Tooltip();
    rangeTemplate.label.tooltip.dy = -10;
    rangeTemplate.label.cloneTooltip = false;
    ///// DATA
    var chartData = [];
    var lineSeriesData = [];
    var data =
    {
      "BE": {
        "FE": be_fe,
        "FS": be_fs,
        "Submission":Math.round(be_fs/be_fe*100),
        "Target":100
      },
      "ENG": {
        "FE": eng_fe,
        "FS": eng_fs,
        "Submission":Math.round(eng_fs/eng_fe*100),
        "Target":100
      },
      "FINANCE": {
        "FE": fnc_fe,
        "FS": fnc_fs,
        "Submission":Math.round(fnc_fs/fnc_fe*100),
        "Target":100
      },
      "HR": {
        "FE": hr_fe,
        "FS": hr_fs,
        "Submission":Math.round(hr_fs/hr_fe*100),
        "Target":100
      },
      "MS": {
        "FE": ms_fe,
        "FS": ms_fs,
        "Submission":Math.round(ms_fs/ms_fe*100),
        "Target":100
      },
      "PACK": {
        "FE": pack_fe,
        "FS": pack_fs,
        "Submission":Math.round(pack_fs/pack_fe*100),
        "Target":100
      },
      "PLANT": {
        "FE": plant_fe,
        "FS": plant_fs,
        "Submission":Math.round(plant_fs/plant_fe*100),
        "Target":100
      },
      "P2": {
        "FE": p2_fe,
        "FS": p2_fs,
        "Submission":Math.round(p2_fs/p2_fe*100),
        "Target":100
      },
      "QA": {
        "FE": qa_fe,
        "FS": qa_fs,
        "Submission":Math.round(qa_fs/qa_fe*100),
        "Target":100
      },
      "QC": {
        "FE": qc_fe,
        "FS": qc_fs,
        "Submission":Math.round(qc_fs/qc_fe*100),
        "Target":100
      },
      "SC": {
        "FE": sc_fe,
        "FS": sc_fs,
        "Submission":Math.round(sc_fs/sc_fe*100),
        "Target":100
      }
    }

    // process data ant prepare it for the chart
    for (var providerName in data) {
    var providerData = data[providerName];

    // add data of one provider to temp array
    var tempArray = [];
    var count = 0;
    // add items
    for (var itemName in providerData) {
    if(itemName != "Submission" && itemName != "Target"){
    count++;
    // we generate unique category for each column (providerName + "_" + itemName) and store realName
    tempArray.push({ category: providerName + "_" + itemName, realName: itemName, value: providerData[itemName], provider: providerName})
    }
    }
    // sort temp array
    tempArray.sort(function(a, b) {
    if (a.value > b.value) {
    return 1;
    }
    else if (a.value < b.value) {
    return -1
    }
    else {
    return 0;
    }
    })

    // add Submission and count to middle data item (line series uses it)
    var lineSeriesDataIndex = Math.floor(count / 2);
    tempArray[lineSeriesDataIndex].Submission = providerData.Submission;
    tempArray[lineSeriesDataIndex].count = count;
    // push to the final data
    am4core.array.each(tempArray, function(item) {
    chartData.push(item);
    })
    // add Submission and count to middle data item (line series uses it)
    var lineSeriesDataIndex = Math.floor(count / 2);
    tempArray[lineSeriesDataIndex].Target = providerData.Target;
    tempArray[lineSeriesDataIndex].count = count;
    // push to the final data
    am4core.array.each(tempArray, function(item) {
    chartData.push(item);
    })

    // create range (the additional label at the bottom)
    var range = categoryAxis.axisRanges.create();
    range.category = tempArray[0].category;
    range.endCategory = tempArray[tempArray.length - 1].category;
    range.label.text = tempArray[0].provider;
    range.label.dy = 30;
    range.label.truncate = true;
    range.label.fontWeight = "bold";
    range.label.tooltipText = tempArray[0].provider;

    range.label.adapter.add("maxWidth", function(maxWidth, target){
    var range = target.dataItem;
    var startPosition = categoryAxis.categoryToPosition(range.category, 0);
    var endPosition = categoryAxis.categoryToPosition(range.endCategory, 1);
    var startX = categoryAxis.positionToCoordinate(startPosition);
    var endX = categoryAxis.positionToCoordinate(endPosition);
    return endX - startX;
    })
    }
    chart.data = chartData;
    // last tick
    var range = categoryAxis.axisRanges.create();
    range.category = chart.data[chart.data.length - 1].category;
    range.label.disabled = true;
    range.tick.location = 1;
    range.grid.location = 1;
    });
  
  }

  function tableCountDept(be_fe,eng_fe,fnc_fe,hr_fe,ms_fe,pack_fe,plant_fe,p2_fe,qa_fe,qc_fe,sc_fe,be_fs,eng_fs,fnc_fs,hr_fs,ms_fs,pack_fs,plant_fs,p2_fs,qa_fs,qc_fs,sc_fs) {
    $('#table-depts table tbody').empty().append('<tr id="formEmp"></tr>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.be_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.eng_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.fnc_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.hr_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.ms_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.pack_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.plant_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.p2_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.qa_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.qc_fe+'</center></td>')
    $('#table-depts table tbody #formEmp').append('<td><center>'+this.sc_fe+'</center></td>')
 
    $('#table-depts table tbody').append('<tr id="formSub"></tr>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.be_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.eng_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.fnc_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.hr_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.ms_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.pack_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.plant_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.p2_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.qa_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.qc_fs+'</center></td>')
    $('#table-depts table tbody #formSub').append('<td><center>'+this.sc_fs+'</center></td>')

    $('#table-depts table tbody').append('<tr id="subMission"></tr>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(be_fs/be_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(eng_fs/eng_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(fnc_fs/fnc_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(hr_fs/hr_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(ms_fs/ms_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(pack_fs/pack_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(plant_fs/plant_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(p2_fs/p2_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(qa_fs/qa_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(qc_fs/qc_fe*100)+'%</center></td>')
    $('#table-depts table tbody #subMission').append('<td><center>'+this.Math.round(sc_fs/sc_fe*100)+'%</center></td>')
    
    $('#table-depts table tbody').append('<tr id="targetSub"></tr>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    $('#table-depts table tbody #targetSub').append('<td><center>100%</center></td>')
    // $.each(data.listDetail, function(key, obj) {
    //   $('#modalDetail tbody').append('<tr></tr>')
    //   $('#modalDetail tbody tr:last').append('<td>'+((key++)+1)+'</td>')
    //   $('#modalDetail tbody tr:last').append('<td>'+this.tgl+'</td>')
    //   $('#modalDetail tbody tr:last').append('<td>'+(this.Nama).replaceAll("+", " ")+'</td>')
    //   $('#modalDetail tbody tr:last').append('<td>'+(this.Company).replaceAll("+", " ")+'</td>')
    //   $('#modalDetail tbody tr:last').append('<td>'+this.total_risk+'</td>')
    //   $('#modalDetail tbody tr:last').append('<td>'+this.total_tracing+'</td>')
    // })
  }
  // Kalau tanggal ga di isi, Menampilkan chart dept dengan data kosong saat pertama load
  function departement3(){
    am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    var chart = am4core.create("departement", am4charts.XYChart);
    // some extra padding for range labels
    chart.paddingBottom = 50;
    chart.cursor = new am4charts.XYCursor();
    chart.scrollbarX = new am4core.Scrollbar();
    // will use this to store colors of the same items
    var colors = {};
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      categoryAxis.dataFields.category = "category";
      categoryAxis.renderer.minGridDistance = 60;
      categoryAxis.renderer.grid.template.location = 0;
      categoryAxis.dataItems.template.text = "{realName}";
      categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
      return categoryAxis.tooltipDataItem.dataContext.realName;
    })
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;
    valueAxis.min = 0;
    // single column series for all data
    var columnSeries = chart.series.push(new am4charts.ColumnSeries());
    columnSeries.columns.template.width = am4core.percent(80);
    columnSeries.tooltipText = "{provider}: {realName}, {valueY}";
    columnSeries.dataFields.categoryX = "category";
    columnSeries.dataFields.valueY = "value";
    // second value axis for Submission
    var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis2.renderer.opposite = true;
    valueAxis2.syncWithAxis = valueAxis;
    valueAxis2.tooltip.disabled = true;
    valueAxis2.calculateTotals = true;
    valueAxis2.min = 0;
    valueAxis2.max = 100;
    valueAxis2.strictMinMax = true;
    valueAxis2.renderer.labels.template.adapter.add("text", function(text) {
      return text + "%";
    });
    // Target line series
    var lineSeries = chart.series.push(new am4charts.LineSeries());
    lineSeries.tooltipText = "{valueY}%";
    lineSeries.dataFields.categoryX = "category";
    lineSeries.dataFields.valueY = "Target";
    lineSeries.yAxis = valueAxis2;
    // lineSeries.bullets.push(new am4charts.CircleBullet());
    lineSeries.stroke = "#ffb703";
    lineSeries.fill = lineSeries.stroke;
    lineSeries.strokeWidth = 3;
    lineSeries.snapTooltip = true;
    // Submission line series
    var lineSeries = chart.series.push(new am4charts.LineSeries());
    lineSeries.tooltipText = "{valueY}%";
    lineSeries.dataFields.categoryX = "category";
    lineSeries.dataFields.valueY = "Submission";
    lineSeries.yAxis = valueAxis2;
    // lineSeries.bullets.push(new am4charts.CircleBullet());
    lineSeries.stroke = "#6b705c";
    lineSeries.fill = lineSeries.stroke;
    lineSeries.strokeWidth = 3;
    lineSeries.snapTooltip = true;
    // when data validated, adjust location of data item based on count
    lineSeries.events.on("datavalidated", function(){
      lineSeries.dataItems.each(function(dataItem){
        // if count divides by two, location is 0 (on the grid)
        if(dataItem.dataContext.count / 2 == Math.round(dataItem.dataContext.count / 2)){
          dataItem.setLocation("categoryX", 0);
        }
        // otherwise location is 0.5 (middle)
        else{
          dataItem.setLocation("categoryX", 0.5);
        }
      })
    })
    // fill adapter, here we save color value to colors object so that each time the item has the same name, the same color is used
    columnSeries.columns.template.adapter.add("fill", function(fill, target) {
      var name = target.dataItem.dataContext.realName;
      if (!colors[name]) {
        colors[name] = chart.colors.next();
      }
      target.stroke = colors[name];
      return colors[name];
    })
    var rangeTemplate = categoryAxis.axisRanges.template;
    rangeTemplate.tick.disabled = false;
    rangeTemplate.tick.location = 0;
    rangeTemplate.tick.strokeOpacity = 0.6;
    rangeTemplate.tick.length = 60;
    rangeTemplate.grid.strokeOpacity = 0.5;
    rangeTemplate.label.tooltip = new am4core.Tooltip();
    rangeTemplate.label.tooltip.dy = -10;
    rangeTemplate.label.cloneTooltip = false;
    ///// DATA
    var chartData = [];
    var lineSeriesData = [];
    var data =
    {
      "BE": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "ENG": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "FINANCE": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "HR": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "MS": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "PACK": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "PLANT": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "P2": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "QA": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "QC": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      },
      "SC": {
        "FE": 0,
        "FS": 0,
        "Submission":0,
        "Target":100
      }
    }

    // process data ant prepare it for the chart
    for (var providerName in data) {
    var providerData = data[providerName];

    // add data of one provider to temp array
    var tempArray = [];
    var count = 0;
    // add items
    for (var itemName in providerData) {
    if(itemName != "Submission" && itemName != "Target"){
    count++;
    // we generate unique category for each column (providerName + "_" + itemName) and store realName
    tempArray.push({ category: providerName + "_" + itemName, realName: itemName, value: providerData[itemName], provider: providerName})
    }
    }
    // sort temp array
    tempArray.sort(function(a, b) {
    if (a.value > b.value) {
    return 1;
    }
    else if (a.value < b.value) {
    return -1
    }
    else {
    return 0;
    }
    })

    // add Submission and count to middle data item (line series uses it)
    var lineSeriesDataIndex = Math.floor(count / 2);
    tempArray[lineSeriesDataIndex].Submission = providerData.Submission;
    tempArray[lineSeriesDataIndex].count = count;
    // push to the final data
    am4core.array.each(tempArray, function(item) {
    chartData.push(item);
    })
    // add Submission and count to middle data item (line series uses it)
    var lineSeriesDataIndex = Math.floor(count / 2);
    tempArray[lineSeriesDataIndex].Target = providerData.Target;
    tempArray[lineSeriesDataIndex].count = count;
    // push to the final data
    am4core.array.each(tempArray, function(item) {
    chartData.push(item);
    })

    // create range (the additional label at the bottom)
    var range = categoryAxis.axisRanges.create();
    range.category = tempArray[0].category;
    range.endCategory = tempArray[tempArray.length - 1].category;
    range.label.text = tempArray[0].provider;
    range.label.dy = 30;
    range.label.truncate = true;
    range.label.fontWeight = "bold";
    range.label.tooltipText = tempArray[0].provider;

    range.label.adapter.add("maxWidth", function(maxWidth, target){
    var range = target.dataItem;
    var startPosition = categoryAxis.categoryToPosition(range.category, 0);
    var endPosition = categoryAxis.categoryToPosition(range.endCategory, 1);
    var startX = categoryAxis.positionToCoordinate(startPosition);
    var endX = categoryAxis.positionToCoordinate(endPosition);
    return endX - startX;
    })
    }
    chart.data = chartData;
    // last tick
    var range = categoryAxis.axisRanges.create();
    range.category = chart.data[chart.data.length - 1].category;
    range.label.disabled = true;
    range.tick.location = 1;
    range.grid.location = 1;
    });
  
  }
  
</script>