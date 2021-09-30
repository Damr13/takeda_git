			<!-- Chart code -->
			<script>
				// SET DEMOGRAPHIC AGE RESPONDENS --ir
				function gaugeBands(chartEl, data, dataGrade, chartMin, chartMax) {
					var generalChart = {}
					if(generalChart[chartEl]){
						generalChart[chartEl].disposeChildren()
						generalChart[chartEl].dispose()
					} 


					// var data	= '',
					//  		chart	= '',
					//  		axis	= '',
					//  		axis2	= '',
					//  		range	= '',
					//  		matchingGrade	= '',
					//  		label	= '',
					//  		label2	= '',
					//  		hand = ''

					// Themes begin
					// if(data) alert("YES")
					am4core.useTheme(am4themes_animated);
					am4core.options.autoDispose = true;

					// var data = {
				  // 	score: score,
				  // 	gradingData: grades
					// };

					console.log(data)
					
					// LOOK UP GRADE --ir
					function lookUpGrade(lookupScore, grades) {
					  // Only change code below this line
					  for (var i = 0; i < grades.length; i++) {
					    if (
					      grades[i].lowScore < lookupScore &&
					      grades[i].highScore >= lookupScore
					    ) {
					      return grades[i];
					    }

					  }
					  return null;
					}

					// CREATE GAUGE --ir
					generalChart[chartEl] = am4core.create(chartEl, am4charts.GaugeChart);
					generalChart[chartEl].hiddenState.properties.opacity = 0;
					generalChart[chartEl].fontSize = 11;
					generalChart[chartEl].innerRadius = am4core.percent(80);
					generalChart[chartEl].resizable = true;

					// CREATE AXIS --ir
					var axis = generalChart[chartEl].xAxes.push(new am4charts.ValueAxis());
					axis.min = chartMin;
					axis.max = chartMax;
					axis.strictMinMax = true;
					axis.renderer.radius = am4core.percent(80);
					axis.renderer.inside = true;
					axis.renderer.line.strokeOpacity = 0.1;
					axis.renderer.ticks.template.disabled = false;
					axis.renderer.ticks.template.strokeOpacity = 1;
					axis.renderer.ticks.template.strokeWidth = 0.5;
					axis.renderer.ticks.template.length = 5;
					axis.renderer.grid.template.disabled = true;
					axis.renderer.labels.template.radius = am4core.percent(15);
					axis.renderer.labels.template.fontSize = "0.9em";

					// AXIS FOR RANGE --ir
					var axis2 = generalChart[chartEl].xAxes.push(new am4charts.ValueAxis());
					axis2.min = chartMin;
					axis2.max = chartMax;
					axis2.strictMinMax = true;
					axis2.renderer.labels.template.disabled = true;
					axis2.renderer.ticks.template.disabled = true;
					axis2.renderer.grid.template.disabled = false;
					axis2.renderer.grid.template.opacity = 0.5;
					axis2.renderer.labels.template.bent = true;
					axis2.renderer.labels.template.fill = am4core.color("#000");
					axis2.renderer.labels.template.fontWeight = "bold";
					axis2.renderer.labels.template.fillOpacity = 0.3;
					
					// SET RANGE ON GAUGE --ir
					for (let grading of data.gradingData) {
						var range = axis2.axisRanges.create();
					  range.axisFill.fill = am4core.color(grading.color);
					  range.axisFill.fillOpacity = 0.8;
					  range.axisFill.zIndex = -1;
					  range.value = grading.lowScore > chartMin ? grading.lowScore : chartMin;
					  range.endValue = grading.highScore < chartMax ? grading.highScore : chartMax;
					  range.grid.strokeOpacity = 0;
					  range.stroke = am4core.color(grading.color).lighten(-0.1);
					  range.label.inside = true;
					  range.label.text = grading.title.toUpperCase();
					  range.label.inside = true;
					  range.label.location = 0.5;
					  range.label.inside = true;
					  range.label.radius = am4core.percent(10);
					  range.label.paddingBottom = -5; // ~half font size
					  range.label.fontSize = "0.9em";
					}

					// GET COLOR MATCHING GRADE --ir
					var matchingGrade = lookUpGrade(data.score, dataGrade);

					// SET VALUE --ir
					var label = generalChart[chartEl].radarContainer.createChild(am4core.Label);
					label.isMeasured = false;
					label.fontSize = "6em";
					label.x = am4core.percent(50);
					label.paddingBottom = 15;
					label.horizontalCenter = "middle";
					label.verticalCenter = "bottom";
					//label.dataItem = data;
					label.text = data.score.toString();
					//label.text = "{score}";
					label.fill = am4core.color(matchingGrade.color);

					// SET GRADE --ir
					var label2 = generalChart[chartEl].radarContainer.createChild(am4core.Label);
					label2.isMeasured = false;
					label2.fontSize = "2em";
					label2.horizontalCenter = "middle";
					label2.verticalCenter = "bottom";
					label2.text = matchingGrade.title.toUpperCase();
					label2.fill = am4core.color(matchingGrade.color);

					// SET POINTER --ir
						// if(old) {return false; }

					var hand = generalChart[chartEl].hands.push(new am4charts.ClockHand());
					hand.axis = axis2;
					hand.innerRadius = am4core.percent(55);
					hand.startWidth = 8;
					hand.pin.disabled = true;
					hand.value = data.score;
					hand.fill = am4core.color("#444");
					hand.stroke = am4core.color("#000");
					
					// hand.axis2.positionToValue(hand.currentPosition).toFixed(1);
					// hand.axis.positionToValue(hand.currentPosition);

						// if(old) {return false; }
					hand.events.on("positionchanged", function(){
					// alert(hand.value)
					  // label.text = axis2.positionToValue(hand.currentPosition).toFixed(1);
					  // var value2 = axis.positionToValue(hand.currentPosition);
					  // var matchingGrade = lookUpGrade(axis.positionToValue(hand.currentPosition), dataGrade);
					  // label2.text = matchingGrade.title.toUpperCase();
					  // label2.fill = am4core.color(matchingGrade.color);
					  // label2.stroke = am4core.color(matchingGrade.color);  
					  // label.fill = am4core.color(matchingGrade.color);
					})
				}

				// SET TAG CLOUD --ir
				function wordCloud(chartEl, data) {
					am4core.useTheme(am4themes_animated);
					// Themes end

					var chart = {}
					chart[chartEl] = am4core.create(chartEl, am4plugins_wordCloud.WordCloud);
					chart[chartEl].fontFamily = "Courier New";
					var series = chart[chartEl].series.push(new am4plugins_wordCloud.WordCloudSeries());
					series.randomness = 0.1;
					series.rotationThreshold = 0.5;

					series.data = data

					series.dataFields.word = "tag";
					series.dataFields.value = "count";

					series.heatRules.push({
					 "target": series.labels.template,
					 "property": "fill",
					 "min": am4core.color("#0000CC"),
					 "max": am4core.color("#CC00CC"),
					 "dataField": "value"
					});

					series.labels.template.url = "https://www.google.com/search?q={word}";
					series.labels.template.urlTarget = "_blank";
					series.labels.template.tooltipText = "{word}: {value}";

					var hoverState = series.labels.template.states.create("hover");
					hoverState.properties.fill = am4core.color("#FF0000");

					var subtitle = chart[chartEl].titles.create();
					// subtitle.text = "(click to open)";

					var title = chart[chartEl].titles.create();
					// title.text = "Most Popular Tags @ StackOverflow";
					title.fontSize = 20;
					title.fontWeight = "800";
				}

				// SET SEMI CIRCLE PIE CHART --ir
				function semiCirclePie(chartEl, data) {
					am4core.useTheme(am4themes_animated);
					console.log(data)
					// Themes end
									
					var graphAge = am4core.create(chartEl, am4charts.PieChart);
					graphAge.hiddenState.properties.opacity = 0; // this creates initial fade-in
									
					graphAge.data = data
					graphAge.radius = am4core.percent(70);
					graphAge.innerRadius = am4core.percent(40);
					graphAge.startAngle = 180;
					graphAge.endAngle = 360;  
					
					var series = graphAge.series.push(new am4charts.PieSeries());
					series.dataFields.value = "value";
					series.dataFields.category = "name";
					
					series.slices.template.cornerRadius = 10;
					series.slices.template.innerCornerRadius = 7;
					series.slices.template.draggable = true;
					series.slices.template.inert = true;
					series.alignLabels = false;
					
					series.hiddenState.properties.startAngle = 90;
					series.hiddenState.properties.endAngle = 90;
					
					graphAge.legend = new am4charts.Legend();
				}

				// SET RADIUS PIE CHART --ir
				function radiusPie(chartEl, data) {
					var typeOfResp = am4core.create(chartEl, am4charts.PieChart);
					typeOfResp.hiddenState.properties.opacity = 0; // this creates initial fade-in
									
					typeOfResp.data = data
					
					var series = typeOfResp.series.push(new am4charts.PieSeries());
					series.dataFields.value = "value";
					series.dataFields.radiusValue = "value";
					series.dataFields.category = "country";
					series.slices.template.cornerRadius = 6;
					series.colors.step = 3;
					
					series.hiddenState.properties.endAngle = -90;
					
					typeOfResp.legend = new am4charts.Legend();
				}

				// SET WHOLE PIE CHART --ir
				function wholePie(chartEl, data) {
					am4core.useTheme(am4themes_animated);
					var freqApp = am4core.create(chartEl, am4charts.PieChart);

					// Add and configure Series
					var pieSeries = freqApp.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					freqApp.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					freqApp.legend = new am4charts.Legend();
					
					freqApp.data = data
				}

				// SET VEHICLE --ir
				function vehicle(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("vehicle", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET DEMOGRAPHIC AGE RESPONDENS --ir
				function ratingChart(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end

					var chart = am4core.create("ratingChart", am4charts.RadarChart);
					chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

					chart.data = data

					chart.padding(20, 20, 20, 20);

					var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
					categoryAxis.dataFields.category = "category";
					categoryAxis.renderer.labels.template.location = 0.5;
					categoryAxis.renderer.tooltipLocation = 0.5;
					categoryAxis.renderer.cellStartLocation = 0.2;
					categoryAxis.renderer.cellEndLocation = 0.8;

					var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
					valueAxis.tooltip.disabled = true;
					valueAxis.renderer.labels.template.horizontalCenter = "left";
					valueAxis.min = 0;

					var series1 = chart.series.push(new am4charts.RadarColumnSeries());
					series1.columns.template.tooltipText = "{name}: {valueY.value}";
					series1.columns.template.width = am4core.percent(100);
					series1.name = "Bus";
					series1.dataFields.categoryX = "category";
					series1.dataFields.valueY = "value1";

					var series2 = chart.series.push(new am4charts.RadarColumnSeries());
					series2.columns.template.width = am4core.percent(100);
					series2.columns.template.tooltipText = "{name}: {valueY.value}";
					series2.name = "Travel";
					series2.dataFields.categoryX = "category";
					series2.dataFields.valueY = "value2";

					var series3 = chart.series.push(new am4charts.RadarColumnSeries());
					series3.columns.template.tooltipText = "{name}: {valueY.value}";
					series3.columns.template.width = am4core.percent(100);
					series3.name = "Kereta Api";
					series3.dataFields.categoryX = "category";
					series3.dataFields.valueY = "value3";

					var series4 = chart.series.push(new am4charts.RadarColumnSeries());
					series4.columns.template.width = am4core.percent(100);
					series4.columns.template.tooltipText = "{name}: {valueY.value}";
					series4.name = "Pesawat";
					series4.dataFields.categoryX = "category";
					series4.dataFields.valueY = "value4";
					
					var series5 = chart.series.push(new am4charts.RadarColumnSeries());
					series5.columns.template.width = am4core.percent(100);
					series5.columns.template.tooltipText = "{name}: {valueY.value}";
					series5.name = "Transportasi Online";
					series5.dataFields.categoryX = "category";
					series5.dataFields.valueY = "value5";


					chart.seriesContainer.zIndex = -1;

					chart.scrollbarX = new am4core.Scrollbar();
					chart.scrollbarX.exportable = false;
					chart.scrollbarY = new am4core.Scrollbar();
					chart.scrollbarY.exportable = false;

					chart.cursor = new am4charts.RadarCursor();
					chart.cursor.xAxis = categoryAxis;
					chart.cursor.fullWidthXLine = true;
					chart.cursor.lineX.strokeOpacity = 0;
					chart.cursor.lineX.fillOpacity = 0.1;
					chart.cursor.lineX.fill = am4core.color("#000000"); 
				}

				// SET SATISFACTION --ir
				function satisfaction(data) {
					am4core.useTheme(am4themes_animated);
					var chart = am4core.create("satisfaction", am4charts.XYChart);
					chart.data = data
					chart.padding(40, 40, 40, 40);

					var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
					categoryAxis.renderer.grid.template.location = 0;
					categoryAxis.dataFields.category = "category";
					categoryAxis.renderer.minGridDistance = 60;
					categoryAxis.renderer.inversed = true;
					categoryAxis.renderer.grid.template.disabled = true;
					
					var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
					valueAxis.min = 0;
					valueAxis.extraMax = 0.1;
					//valueAxis.rangeChangeEasing = am4core.ease.linear;
					//valueAxis.rangeChangeDuration = 1500;
					
					var series = chart.series.push(new am4charts.ColumnSeries());
					series.dataFields.categoryX = "category";
					series.dataFields.valueY = "avg";
					series.tooltipText = "{valueY.value}"
					series.columns.template.strokeOpacity = 0;
					series.columns.template.column.cornerRadiusTopRight = 10;
					series.columns.template.column.cornerRadiusTopLeft = 10;
					//series.interpolationDuration = 1500;
					//series.interpolationEasing = am4core.ease.linear;
					var labelBullet = series.bullets.push(new am4charts.LabelBullet());
					labelBullet.label.verticalCenter = "bottom";
					labelBullet.label.dy = -10;
					labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.00')}";
					
					chart.zoomOutButton.disabled = true;
					
					// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
					series.columns.template.adapter.add("fill", function (fill, target) {
					 return chart.colors.getIndex(target.dataItem.index);
					});
					
					categoryAxis.sortBySeries = series;
				}

				// SET TAG CLOUD --ir
				function tagCloud(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end

					var chart = am4core.create("tagCloud", am4plugins_wordCloud.WordCloud);
					chart.fontFamily = "Courier New";
					var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());
					series.randomness = 0.1;
					series.rotationThreshold = 0.5;

					series.data = data

					series.dataFields.word = "tag";
					series.dataFields.value = "count";

					series.heatRules.push({
					 "target": series.labels.template,
					 "property": "fill",
					 "min": am4core.color("#0000CC"),
					 "max": am4core.color("#CC00CC"),
					 "dataField": "value"
					});

					series.labels.template.url = "https://www.google.com/search?q={word}";
					series.labels.template.urlTarget = "_blank";
					series.labels.template.tooltipText = "{word}: {value}";

					var hoverState = series.labels.template.states.create("hover");
					hoverState.properties.fill = am4core.color("#FF0000");

					var subtitle = chart.titles.create();
					// subtitle.text = "(click to open)";

					var title = chart.titles.create();
					// title.text = "Most Popular Tags @ StackOverflow";
					title.fontSize = 20;
					title.fontWeight = "800";
				}

				// SET TAG CLOUD 2 --ir
				function tagCloud2(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end

					var chart = am4core.create("tagCloud2", am4plugins_wordCloud.WordCloud);
					chart.fontFamily = "Courier New";
					var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());
					series.randomness = 0.1;
					series.rotationThreshold = 0.5;

					series.data = data

					series.dataFields.word = "tag";
					series.dataFields.value = "count";

					series.heatRules.push({
					 "target": series.labels.template,
					 "property": "fill",
					 "min": am4core.color("#0000CC"),
					 "max": am4core.color("#CC00CC"),
					 "dataField": "value"
					});

					series.labels.template.url = "https://www.google.com/search?q={word}";
					series.labels.template.urlTarget = "_blank";
					series.labels.template.tooltipText = "{word}: {value}";

					var hoverState = series.labels.template.states.create("hover");
					hoverState.properties.fill = am4core.color("#FF0000");

					var subtitle = chart.titles.create();
					// subtitle.text = "(click to open)";

					var title = chart.titles.create();
					// title.text = "Most Popular Tags @ StackOverflow";
					title.fontSize = 20;
					title.fontWeight = "800";
				}

				// SET TYPE OF RESPONDENS --ir
				function typeOfResp(data) {
					var typeOfResp = am4core.create("typeOfResp", am4charts.PieChart);
					typeOfResp.hiddenState.properties.opacity = 0; // this creates initial fade-in
									
					typeOfResp.data = data
					
					var series = typeOfResp.series.push(new am4charts.PieSeries());
					series.dataFields.value = "value";
					series.dataFields.radiusValue = "value";
					series.dataFields.category = "country";
					series.slices.template.cornerRadius = 6;
					series.colors.step = 3;
					
					series.hiddenState.properties.endAngle = -90;
					
					typeOfResp.legend = new am4charts.Legend();
				}

				// SET FREQUENTB OF USING ONLINE TRANSACTIONS --ir
				function freqApp(data) {
					am4core.useTheme(am4themes_animated);
					var freqApp = am4core.create("freqApp", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = freqApp.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					freqApp.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					freqApp.legend = new am4charts.Legend();
					
					freqApp.data = data
				}

				// SET MONEY SPENT --ir
				function moneySpent(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("moneySpent", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET SATISFACTION --ir
				function satisfaction2(data) {
					// Themes begin
					am4core.useTheme(am4themes_animated);
					// Themes end
									
					// Create chart instance
					var chart = am4core.create("satisfaction", am4charts.XYChart);
									
									
					// Add data
					chart.data = data
					
					// Create axes
					var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
					categoryAxis.dataFields.category = "category";
					categoryAxis.renderer.grid.template.location = 0;
					
					
					var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
					valueAxis.renderer.inside = true;
					valueAxis.renderer.labels.template.disabled = true;
					valueAxis.min = 0;
					
					// Create series
					function createSeries(field, name) {
					
					  // Set up series
					  var series = chart.series.push(new am4charts.ColumnSeries());
					  series.name = name;
					  series.dataFields.valueY = field;
					  series.dataFields.categoryX = "category";
					  series.sequencedInterpolation = true;
					
					  // Make it stacked
					  series.stacked = true;
					
					  // Configure columns
					  series.columns.template.width = am4core.percent(60);
					  series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]Jumlah Responden: {valueY}";
					
					  // Add label
					  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
					  labelBullet.label.text = "{valueY}";
					  labelBullet.locationY = 0.5;
					  labelBullet.label.hideOversized = true;
					
					  return series;
					}
					
					createSeries("value5", "5");
					createSeries("value4", "4");
					createSeries("value3", "3");
					createSeries("value2", "2");
					createSeries("value1", "1");
					
					// Legend
					chart.legend = new am4charts.Legend();
				}

				// SET TAG CLOUD --ir
				function tagCloudHope(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end

					var chart = am4core.create("tagCloudHope", am4plugins_wordCloud.WordCloud);
					chart.fontFamily = "Courier New";
					var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());
					series.randomness = 0.1;
					series.rotationThreshold = 0.5;

					series.data = data

					series.dataFields.word = "tag";
					series.dataFields.value = "count";

					series.heatRules.push({
					 "target": series.labels.template,
					 "property": "fill",
					 "min": am4core.color("#0000CC"),
					 "max": am4core.color("#CC00CC"),
					 "dataField": "value"
					});

					series.labels.template.url = "https://www.google.com/search?q={word}";
					series.labels.template.urlTarget = "_blank";
					series.labels.template.tooltipText = "{word}: {value}";

					var hoverState = series.labels.template.states.create("hover");
					hoverState.properties.fill = am4core.color("#FF0000");

					var subtitle = chart.titles.create();
					// subtitle.text = "(click to open)";

					var title = chart.titles.create();
					// title.text = "Most Popular Tags @ StackOverflow";
					title.fontSize = 20;
					title.fontWeight = "800";
				}

				// SET TAG CLOUD --ir
				function tagCloudHope2(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end

					var chart = am4core.create("tagCloudHope2", am4plugins_wordCloud.WordCloud);
					chart.fontFamily = "Courier New";
					var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());
					series.randomness = 0.1;
					series.rotationThreshold = 0.5;

					series.data = data

					series.dataFields.word = "tag";
					series.dataFields.value = "count";

					series.heatRules.push({
					 "target": series.labels.template,
					 "property": "fill",
					 "min": am4core.color("#0000CC"),
					 "max": am4core.color("#CC00CC"),
					 "dataField": "value"
					});

					series.labels.template.url = "https://www.google.com/search?q={word}";
					series.labels.template.urlTarget = "_blank";
					series.labels.template.tooltipText = "{word}: {value}";

					var hoverState = series.labels.template.states.create("hover");
					hoverState.properties.fill = am4core.color("#FF0000");

					var subtitle = chart.titles.create();
					// subtitle.text = "(click to open)";

					var title = chart.titles.create();
					// title.text = "Most Popular Tags @ StackOverflow";
					title.fontSize = 20;
					title.fontWeight = "800";
				}

				// SET TAG CLOUD --ir
				function tagCloudHope3(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end

					var chart = am4core.create("tagCloudHope3", am4plugins_wordCloud.WordCloud);
					chart.fontFamily = "Courier New";
					var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());
					series.randomness = 0.1;
					series.rotationThreshold = 0.5;

					series.data = data

					series.dataFields.word = "tag";
					series.dataFields.value = "count";

					series.heatRules.push({
					 "target": series.labels.template,
					 "property": "fill",
					 "min": am4core.color("#0000CC"),
					 "max": am4core.color("#CC00CC"),
					 "dataField": "value"
					});

					series.labels.template.url = "https://www.google.com/search?q={word}";
					series.labels.template.urlTarget = "_blank";
					series.labels.template.tooltipText = "{word}: {value}";

					var hoverState = series.labels.template.states.create("hover");
					hoverState.properties.fill = am4core.color("#FF0000");

					var subtitle = chart.titles.create();
					// subtitle.text = "(click to open)";

					var title = chart.titles.create();
					// title.text = "Most Popular Tags @ StackOverflow";
					title.fontSize = 20;
					title.fontWeight = "800";
				}

				// CHANGE SURVEY'S QUESTION AND SET THE RESPONSES --ir
				function setResponses(id) {
					toggleShow(true)
					clear()
					if($('#tableResponsesLists').val() == "1") {
						table.destroy()
						$('#tableResponsesLists').empty()
					}

					$.ajax({
        	  type: "POST",
						url : '<?php echo base_url('General/surveyQuestions') ?>',
						data: {id:id},
						dataType: "json",
						success: function(data) {
						table = $('#tableResponsesLists').DataTable({
							"autoWidth": true,
							dom: 'Bfrtip',
							buttons: [
							'copyHtml5',
							'excelHtml5',
							],
							columns: data,
							"pageLength": 25 
						});
						$('#tableResponsesLists').val('1')

							$.ajax({
								type: "POST",
								url : '<?php echo base_url('General/surveyResponses') ?>',
								data: {id:id},
								dataType: "json",
								success: function(data) {
									if(data !== undefined){
										$.each(data, function(idResponse, responses) {
											row = []
											$.each(responses, function(q, answer) {
												if(q.includes("IMAGE") && (answer)){
													answer = '<img style="display:block;" width="70px" src="'+answer+'">'
												}
												row.push(answer)
											})
											table.row.add(row).draw()
										})
									}
								},    
								error: function() {
								}
							});
        	  },    
        	  error: function() {
        	  }
        	});
					// table.clear().draw()
				}

				// SET FIVE VALUE --ir
				function fiveValue(data) {
					am4core.useTheme(am4themes_animated);
					var chart = am4core.create('fiveValue', am4charts.XYChart)
					chart.colors.step = 2;
					
					chart.legend = new am4charts.Legend()
					chart.legend.position = 'top'
					chart.legend.paddingBottom = 20
					chart.legend.labels.template.maxWidth = 95
					
					var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
					xAxis.dataFields.category = 'category'
					xAxis.renderer.cellStartLocation = 0.1
					xAxis.renderer.cellEndLocation = 0.9
					xAxis.renderer.grid.template.location = 0;
					
					var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
					yAxis.min = 0;
					
					function createSeries(value, name) {
					    var series = chart.series.push(new am4charts.ColumnSeries())
					    series.dataFields.valueY = value
					    series.dataFields.categoryX = 'category'
					    series.name = name
					
					    series.events.on("hidden", arrangeColumns);
					    series.events.on("shown", arrangeColumns);
					
					    var bullet = series.bullets.push(new am4charts.LabelBullet())
					    bullet.interactionsEnabled = false
					    bullet.dy = 30;
					    bullet.label.text = '{valueY}'
					    bullet.label.fill = am4core.color('#ffffff')
					
					    return series;
					}

					chart.data = data
						
					// createSeries('390', 'Ditjen Hubdat');
					createSeries('391', 'BPTD');
					createSeries('392', 'TPAJ Tipe A');
						
					function arrangeColumns() {
					
					    var series = chart.series.getIndex(0);
					
					    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
					    if (series.dataItems.length > 1) {
					        var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
					        var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
					        var delta = ((x1 - x0) / chart.series.length) * w;
					        if (am4core.isNumber(delta)) {
					            var middle = chart.series.length / 2;
									
					            var newIndex = 0;
					            chart.series.each(function(series) {
					                if (!series.isHidden && !series.isHiding) {
					                    series.dummyData = newIndex;
					                    newIndex++;
					                }
					                else {
					                    series.dummyData = chart.series.indexOf(series);
					                }
					            })
					            var visibleCount = newIndex;
					            var newMiddle = visibleCount / 2;
										
					            chart.series.each(function(series) {
					                var trueIndex = chart.series.indexOf(series);
					                var newIndex = series.dummyData;
											
					                var dx = (newIndex - trueIndex + middle - newMiddle) * delta
											
					                series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
					                series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
					            })
					        }
					    }
					}
				}

				// SET FIVE VALUE --ir
				function fiveValue2(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end
									
					/* Create chart instance */
					var chart = am4core.create("fiveValue2", am4charts.RadarChart);
									
					/* Add data */
					chart.data = data
					
					/* Create axes */
					var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
					categoryAxis.dataFields.category = "category";
					
					var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
					//valueAxis.renderer.gridType = "polygons";
					
					/* Create and configure series */
					// var series = chart.series.push(new am4charts.RadarSeries());
					// series.dataFields.valueY = "390";
					// series.dataFields.categoryX = "category";
					// series.name = "Ditjen Hubdat";
					// series.strokeWidth = 3;
					// series.fillOpacity = 0.2;
					
					/* Create and configure series */
					var series = chart.series.push(new am4charts.RadarSeries());
					series.dataFields.valueY = "391";
					series.dataFields.categoryX = "category";
					series.name = "BPTD";
					series.strokeWidth = 3;
					series.fillOpacity = 0.2;
					
					/* Create and configure series */
					var series = chart.series.push(new am4charts.RadarSeries());
					series.dataFields.valueY = "392";
					series.dataFields.categoryX = "category";
					series.name = "TPAJ Tipe A";
					series.strokeWidth = 3;
					series.fillOpacity = 0.2;
				}

				// SET FIVE VALUE --ir
				function fiveValuePO(data) {
					am4core.useTheme(am4themes_animated);
					var chart = am4core.create('fiveValuePO', am4charts.XYChart)
					chart.colors.step = 2;
					
					chart.legend = new am4charts.Legend()
					chart.legend.position = 'top'
					chart.legend.paddingBottom = 20
					chart.legend.labels.template.maxWidth = 95
					
					var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
					xAxis.dataFields.category = 'category'
					xAxis.renderer.cellStartLocation = 0.1
					xAxis.renderer.cellEndLocation = 0.9
					xAxis.renderer.grid.template.location = 0;
					
					var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
					yAxis.min = 0;
					
					function createSeries(value, name) {
					    var series = chart.series.push(new am4charts.ColumnSeries())
					    series.dataFields.valueY = value
					    series.dataFields.categoryX = 'category'
					    series.name = name
					
					    series.events.on("hidden", arrangeColumns);
					    series.events.on("shown", arrangeColumns);
					
					    var bullet = series.bullets.push(new am4charts.LabelBullet())
					    bullet.interactionsEnabled = false
					    bullet.dy = 30;
					    bullet.label.text = '{valueY}'
					    bullet.label.fill = am4core.color('#ffffff')
					
					    return series;
					}

					chart.data = data
						
					createSeries('538', 'ALBN');
					createSeries('539', 'AKAP');
					createSeries('540', 'AKDP');
					createSeries('541', 'BRT (Bus Rapid Transit)');
						
					function arrangeColumns() {
					
					    var series = chart.series.getIndex(0);
					
					    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
					    if (series.dataItems.length > 1) {
					        var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
					        var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
					        var delta = ((x1 - x0) / chart.series.length) * w;
					        if (am4core.isNumber(delta)) {
					            var middle = chart.series.length / 2;
									
					            var newIndex = 0;
					            chart.series.each(function(series) {
					                if (!series.isHidden && !series.isHiding) {
					                    series.dummyData = newIndex;
					                    newIndex++;
					                }
					                else {
					                    series.dummyData = chart.series.indexOf(series);
					                }
					            })
					            var visibleCount = newIndex;
					            var newMiddle = visibleCount / 2;
										
					            chart.series.each(function(series) {
					                var trueIndex = chart.series.indexOf(series);
					                var newIndex = series.dummyData;
											
					                var dx = (newIndex - trueIndex + middle - newMiddle) * delta
											
					                series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
					                series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
					            })
					        }
					    }
					}
				}

				// SET FIVE VALUE --ir
				function fiveValuePO2(data) {
					am4core.useTheme(am4themes_animated);
					// Themes end
									
					/* Create chart instance */
					var chart = am4core.create("fiveValuePO2", am4charts.RadarChart);
									
					/* Add data */
					chart.data = data
					
					/* Create axes */
					var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
					categoryAxis.dataFields.category = "category";
					
					var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
					//valueAxis.renderer.gridType = "polygons";
					
					/* Create and configure series */
					var series = chart.series.push(new am4charts.RadarSeries());
					series.dataFields.valueY = "538";
					series.dataFields.categoryX = "category";
					series.name = "ALBN";
					series.strokeWidth = 3;
					series.fillOpacity = 0.2;
					
					/* Create and configure series */
					var series = chart.series.push(new am4charts.RadarSeries());
					series.dataFields.valueY = "539";
					series.dataFields.categoryX = "category";
					series.name = "AKAP";
					series.strokeWidth = 3;
					series.fillOpacity = 0.2;
					
					/* Create and configure series */
					var series = chart.series.push(new am4charts.RadarSeries());
					series.dataFields.valueY = "540";
					series.dataFields.categoryX = "category";
					series.name = "AKDP";
					series.strokeWidth = 3;
					series.fillOpacity = 0.2;
					
					/* Create and configure series */
					var series = chart.series.push(new am4charts.RadarSeries());
					series.dataFields.valueY = "541";
					series.dataFields.categoryX = "category";
					series.name = "BRT (Bus Rapid Transit)";
					series.strokeWidth = 3;
					series.fillOpacity = 0.2;
				}

				// SET VEHICLE --ir
				function vehicle(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("vehicle", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET ROUTE --ir
				function route(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("route", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET REQUEST --ir
				function request(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("request", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET VEHICLE --ir
				function vehiclePO(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("vehiclePO", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET ROUTE --ir
				function routePO(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("routePO", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET DEPARTURE --ir
				function departurePO(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("departurePO", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET ARRIVAL --ir
				function arrivalPO(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("arrivalPO", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET OCCUPANCY --ir
				function occupancyPO(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("occupancyPO", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

				// SET DECREASE --ir
				function decreasePO(data) {
					am4core.useTheme(am4themes_animated);
					var moneySpent = am4core.create("decreasePO", am4charts.PieChart);

					// Add and configure Series
					var pieSeries = moneySpent.series.push(new am4charts.PieSeries());
					pieSeries.dataFields.value = "value";
					pieSeries.dataFields.category = "category";

					// Let's cut a hole in our Pie chart the size of 30% the radius
					moneySpent.innerRadius = am4core.percent(30);

					// Put a thick white border around each Slice
					pieSeries.slices.template.stroke = am4core.color("#fff");
					pieSeries.slices.template.strokeWidth = 2;
					pieSeries.slices.template.strokeOpacity = 1;
					pieSeries.slices.template
					  // change the cursor on hover to make it apparent the object can be interacted with
					  .cursorOverStyle = [
					    {
					      "property": "cursor",
					      "value": "pointer"
					    }
					  ];
					
					pieSeries.alignLabels = false;
					pieSeries.labels.template.bent = true;
					pieSeries.labels.template.radius = 3;
					pieSeries.labels.template.padding(0,0,0,0);
					
					pieSeries.ticks.template.disabled = true;
					
					// Create a base filter effect (as if it's not there) for the hover to return to
					var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
					shadow.opacity = 0;
					
					// Create hover state
					var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists
					
					// Slightly shift the shadow and make it more prominent on hover
					var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
					hoverShadow.opacity = 0.7;
					hoverShadow.blur = 5;
					
					// Add a legend
					moneySpent.legend = new am4charts.Legend();
					
					moneySpent.data = data
				}

			</script>
    </body>
</html>