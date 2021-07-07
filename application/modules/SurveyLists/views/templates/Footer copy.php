			<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
			<!-- <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/src/js/vendor/jquery-3.3.1.min.js')?>"></script>')</script>
			<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			<script>window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"></script>')</script> -->
			<script src="<?php echo base_url('assets/plugins/popper.js/dist/umd/popper.min.js')?>"></script>
			<script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js')?>"></script>
			<script src="<?php echo base_url('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')?>"></script>
			<script src="<?php echo base_url('assets/plugins/screenfull/dist/screenfull.js')?>"></script>
			<script src="<?php echo base_url('assets/plugins/sweetalert/dist/sweetalert.min.js')?>"></script>
			<script src="<?php echo base_url('assets/plugins/summernote/dist/summernote-bs4.min.js')?>"></script>
			<script src="<?php echo base_url('assets/dist/js/theme.min.js')?>"></script>
			<script src="<?php echo base_url('assets/js/layouts.js')?>"></script>
			<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
			<script src="<?php echo base_url('assets/js/select2.min.js')?>"></script>

			<!-- <script src="<?php echo base_url() ?>assets/plugins/datapicker/bootstrap-datepicker.js"></script> -->
			<script src="<?php echo base_url('assets/js/datatables.js')?>"></script>
			<!-- <script src="<?php echo base_url() ?>assets/inspinia/js/jquery-2.1.1.js"></script> -->
			<script src="<?php echo base_url() ?>assets/inspinia/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url() ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
			<script src="<?php echo base_url() ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
			<!-- Custom and plugin javascript -->
			<script src="<?php echo base_url() ?>assets/inspinia/js/inspinia.js"></script>
			<script src="<?php echo base_url() ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
			<script src="<?php echo base_url() ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
			<script src="<?php echo base_url() ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
			
			<script src="<?php echo base_url() ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>
			<script src="<?php echo base_url() ?>assets/js/moment.js"></script>
			<script src="<?php echo base_url() ?>assets/js/bootstrap-datetimepicker.min.js"></script>
			<script src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
			
			<script src="<?php echo base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js');?>"></script>
			<script src="<?php echo base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
			<script src="<?php echo base_url('assets/js/datatables.js');?>"></script>
			<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

			<!-- HTML5 EXPORT -->
			<script src="<?php echo base_url('assets/js/dataTables.buttons.min.js');?>"></script>
			<script src="<?php echo base_url('assets/js/jszip.min.js');?>"></script>
			<script src="<?php echo base_url('assets/js/pdfmake.min.js');?>"></script>
			<script src="<?php echo base_url('assets/js/vfs_fonts.js');?>"></script>
			<script src="<?php echo base_url('assets/js/buttons.html5.min.js');?>"></script>
			<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

			<script src="<?php echo base_url('assets/js/chart-flot.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/amcharts/amcharts.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/amcharts/gauge.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/amcharts/serial.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/amcharts/themes/light.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/amcharts/animate.min.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/amcharts/pie.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/ammap3/ammap/ammap.js');?>"></script>
    	<script src="<?php echo base_url('assets/plugins/ammap3/ammap/maps/js/usaLow.js');?>"></script>

			<!-- SCRIPT DEMOGRAPHIC AGE --ir -->
			<script src="<?php echo base_url('assets/js/amcharts/core.js');?>"></script>
			<script src="<?php echo base_url('assets/js/amcharts/charts.js');?>"></script>
			<script src="<?php echo base_url('assets/js/amcharts/wordCloud.js');?>"></script>
			<script src="<?php echo base_url('assets/js/amcharts/animated.js');?>"></script>

			<script>
			    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			    e.src='https://www.google-analytics.com/analytics.js';
			    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
			</script>
			<script>
				$('#surveyBegin, #surveyEnd').datepicker({
      	  // minViewMode: 1,
      	  keyboardNavigation: false,
      	  forceParse: false,
      	  autoclose: true,
      	  todayHighlight: true,
      	  // endDate: 'd',
      	  format: "yyyy-mm-dd"
				});

				
				// SET MACHINE AVAILABILITY VALUES --ir
  			// function respValue(value) {
				// 	// CHART MACHINE AVAILABILITY --ir 
				// 	var respChart = AmCharts.makeChart("getPieTerminalSurvey1", {
  			// 	  "type": "gauge",
  			// 	  "theme": "none",
  			// 	  "axes": [{
  			// 	    "axisThickness": 1,
  			// 	    "axisAlpha": 0.2,
  			// 	    "tickAlpha": 0.2,
  			// 	    "valueInterval": 20,
  			// 	    "bands": [
  			// 	      {
  			// 	        "color": "#D7263D",
  			// 	        "endValue": 150,
  			// 	        "startValue": 0
  			// 	      }, {
  			// 	        "color": "#F7971E",
  			// 	        "endValue": 400,
  			// 	        "startValue": 150
  			// 	      }, {
  			// 	        "color": "#1a7bb9",
  			// 	        "endValue": 500,
  			// 	        "innerRadius": "95%",
  			// 	        "startValue": 400
  			// 	      }
  			// 	    ],
  			// 	    "bottomText": "0 Responses",
  			// 	    "bottomTextYOffset": -20,
  			// 	    "endValue": 500
  			// 	  }],
  			// 	  "arrows": [{}],
  			// 	  "export": {
  			// 	    "enabled": true
  			// 	  }
  			// 	});

  			//   if (respChart) {
  			//     if (respChart.arrows) {
  			//       if (respChart.arrows[0]) {
  			//         if (respChart.arrows[0].setValue) {
  			//           respChart.arrows[0].setValue(value);
  			//           respChart.axes[0].setBottomText(value + " Responses");
  			//           // respChart.axes[0].setEndValue(1000);
  			//         }
  			//       }
  			//     }
  			//   }
  			// }

				// CHART FOR SURVEY PENUMPANG DAN MASYARAKAT --ir
				var chartsA = {
					graphAge : {
						'chart'			: {
							'graphAge'		: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '6',
						'button'		: ' Demografis Usia',
						'title'			: 'Demografis Responden berdasarkan usia',
						'subtitle'	: '',
					},
					typeOfResp : {
						'chart'			: {
							'typeOfResp'	: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '6',
						'button'		: ' Frekuensi Penggunaan Bus',
						'title'			: 'Frekuensi penggunaan moda transportasi bus',
						'subtitle'	: '',
					},
					ratingChart : {
						'chart'			: {
							'ratingChart'	: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Skor Penilaian Transportasi',
						'title'			: 'Skor penilaian di setiap moda transportasi',
						'subtitle'	: '(Dalam %)',
					},
					satisfaction : {
						'chart'			: {
							'satisfaction': {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Rating Kepuasan Pelayanan Terminal',
						'title'			: 'Rating tingkat kepuasan pelayanan terminal dan PO Bus',
						'subtitle'	: '(Dalam %)',
					},
					tagCloud : {
						'chart'			: {
							'tagCloud'		: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Citra Terminal dan Transportasi Bus',
						'title'			: 'Citra Terminal dan Moda Transportasi Bus',
						'subtitle'	: '(Words Cloud)',
					},
					tagCloud2 : {
						'chart'			: {
							'tagCloud2'		: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Citra PO Bus',
						'title'			: 'Citra PO Bus di mata masyarakat',
						'subtitle'	: '(Words Cloud)',
					},
					moneySpent : {
						'chart'			: {
							'moneySpent'	: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '6',
						'button'		: ' Biaya yang dihabiskan untuk Internet',
						'title'			: 'Biaya yang dihabiskan untuk kuota internet',
						'subtitle'	: '',
					},
					freqApp : {
						'chart'			: {
							'freqApp'		: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '6',
						'button'		: ' Frekuensi Penggunaan Aplikasi',
						'title'			: 'Frekuensi penggunaan aplikasi untuk bertransaksi',
						'subtitle'	: '',
					},
					tagCloudHope : {
						'chart'			: {
							'tagCloudHope': {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Harapan untuk Terminal',
						'title'			: 'Harapan terkait terminal di masa mendatang',
						'subtitle'	: '(Words Cloud)',
					},
					tagCloudHope2 : {
						'chart'			: {
							'tagCloudHope2': {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Harapan untuk Transportasi Bus',
						'title'			: 'Harapan terkait moda transportasi di masa mendatang',
						'subtitle'	: '(Words Cloud)',
					},
					tagCloudHope3 : {
						'chart'			: {
							'tagCloudHope3': {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Harapan terkait penerapan Digitalisasi di Terminal',
						'title'			: 'Harapan terkait penerapan teknologi/digitalisasi di terminal di masa mendatang',
						'subtitle'	: '(Words Cloud)',
					},
				}
				
				// CHART FOR SURVEY INTERNAL ORGANISASI --ir
				var chartsB = {
					tagFiveValue : {
						'chart'			: {
							'tagFiveValue2'	: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
							'tagFiveValue'	: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'button'		: ' Strategi Kompetensi Internal Organisasi',
						'cardCol'		: '12',
						'title'			: 'Strategi Kompetensi',
						'subtitle'	: '(Dalam %)',
					},
					tagVehicle : {
						'chart'			: {
							'tagVehicle'		: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '4',
						'button'		: ' Kondisi Eksisting (Kendaraan)',
						'title'			: 'Jumlah Izin Kendaraan',
						'subtitle'	: '',
					},
					tagRoute : {
						'chart'			: {
							'tagRoute'			: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '4',
						'button'		: ' Kondisi Eksisting (Trayek)',
						'title'			: 'Jumlah Trayek',
						'subtitle'	: '',
					},
					tagRequest : {
						'chart'			: {
							'tagRequest'		: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '4',
						'button'		: ' Kondisi Eksisting (Keberangkatan & Kedatangan)',
						'title'			: 'Permintaan keberangkatan dan kedatangan angkutan',
						'subtitle'	: '',
					},
				}
				
				// CHART FOR SURVEY PO BUS --ir
				var chartsC = {
					tagFiveValuePO : {
						'chart'			: {
							'tagFiveValuePO2'	: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
							'tagFiveValuePO'	: {
								'chartCol'		: '12',
								'title'				: '',
								'subtitle'		: '',
							},
						}, 
						'button'		: ' Strategi Kompetensi PO BUS',
						'cardCol'		: '12',
						'title'			: 'Strategi Kompetensi',
						'subtitle'	: '(Dalam %)',
					},
					tagConditionPO : {
						'chart'			: {
							'tagVehiclePO'		: {
								'chartCol'		: '6',
								'title'				: 'Jumlah Izin Kendaraan',
								'subtitle'		: '',
							},
							'tagRoutePO'		: {
								'chartCol'		: '6',
								'title'				: 'Jumlah Trayek',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '6',
						'button'		: ' Kondisi Eksisting (Kendaraan & Trayek)',
						'title'			: 'Kondisi Eksisting',
						'subtitle'	: '(Kendaraan & Trayek)',
					},
					tagConditionPO2 : {
						'chart'			: {
							'tagDeparturePO'		: {
								'chartCol'		: '6',
								'title'				: 'Permintaan keberangkatan angkutan',
								'subtitle'		: '',
							},
							'tagArrivalPO'		: {
								'chartCol'		: '6',
								'title'				: 'Permintaan kedatangan angkutan',
								'subtitle'		: '',
							},
						}, 
						'cardCol'		: '6',
						'button'		: ' Kondisi Eksisting (Keberangkatan & Kedatangan)',
						'title'			: 'Kondisi Eksisting',
						'subtitle'	: '(Keberangkatan & Kedatangan)',
					},
					tagConditionPO3 : {
						'chart'			: {
							'tagOccupancyPO'		: {
								'chartCol'		: '6',
								'title'				: 'Tingkat Keterisian Penumpang',
								'subtitle'		: '',
							},
							'tagDecreasePO'		: {
								'chartCol'		: '6',
								'title'				: 'Penurunan Penumpang selama 3 tahun',
								'subtitle'		: '(Sebelum Covid-19)',
							},
						}, 
						'cardCol'		: '12',
						'button'		: ' Kondisi Eksisting (Keterisian & Penurunan Penumpang)',
						'title'			: 'Kondisi Eksisting',
						'subtitle'	: '(Keterisian & Penurunan Penumpang)',
					},
				}

				// SET CHART CARDS --ir
				function setChartCards(id) {
					if(id == "27") charts = chartsA
					if(id == "28") charts = chartsB
					if(id == "29") charts = chartsC
					if(!charts) return false

					$.each(charts, function(key, val) {
						// $('#chartResponses').find('.row:last').append('<div class="col-md-12"></div>')
						// $('#chartResponses').find('.row:last div:last').append('<button style="width:100%; text-transform: uppercase;" id="'+key+'Button" class="btn btn-info btn-md" onclick="'+key+'Button()"><i class="fa fa-eye"></i>'+val["button"]+'</button><hr>')
						$('.listBtnCharts').append('<button style="width:100%; text-transform: uppercase; white-space: normal; height: auto; margin: 2px 0" id="'+key+'Button" value="0" class="btn btn-info btn-md text-left" onclick="showBtnChart(\''+key+'\')"><i class="fa fa-eye"></i>'+val["button"]+'</button><hr>')
						$('#chartResponses').append('<div class="col-md-'+val["cardCol"]+'" id="'+key+'Body" style="display:none;"><div class="card"><div class="card-body"><div class="row"></div></div></div></div>')
						$('#chartResponses').find('.row:last').append('<div class="col-md-12 contentChart"></div>')
						$('#chartResponses').find('.row:last .contentChart').append('<h2 align="center"><b>'+val["title"]+'</b></h2>')
						$('#chartResponses').find('.row:last .contentChart').append('<h5 align="center"><b>'+val["subtitle"]+'</b></h5><hr>')
						$.each(val['chart'], function(key, chartOpt) {
							$('#chartResponses').find('.row:last .contentChart').append('<div class="col-md-'+chartOpt["chartCol"]+' chart"></div>')
							$('#chartResponses').find('.row:last .contentChart .chart:last').append('<h5 align="center"><b>'+chartOpt["title"]+'</b></h5>')
							$('#chartResponses').find('.row:last .contentChart .chart:last').append('<h6 align="center"><b>'+chartOpt["subtitle"]+'</b></h6>')
							$('#chartResponses').find('.row:last .contentChart .chart:last').append('<div style="height:500px" id="'+key+'"></div>')
						})
					})
				}

				$(document).ready(function() {
					toggleShow(false)
					setSurveyLists()
					$('#goBack, #surveyTitle, #surveyDesc, #tableResponses, #deptProc').hide()
					$('.titleModule').empty().html("SURVEY LISTS")

				});

				// FUNCTION SHOW OR HIDE ALL CHARTS --ir
				function showHideAllCharts(act) {
					if(act == "show") val = 0
					else val = 1
					$('.listBtnCharts').find("button").each(function(i) {
					  var btn = $(this);
						btn.val(val)
					  setTimeout(btn.trigger.bind(btn, "click"), i * 30);
					});
				}

				// FUNCTION SHOW OR HIDE CHARTS --ir
				function showBtnChart(chart) {
					btn = $('#'+chart+'Button').val()
					if(btn == "0"){
						$('#'+chart+'Body').show()
						$('#'+chart+'Button').val("1")
						$('#'+chart+'Button').removeClass("btn-info")
						$('#'+chart+'Button').addClass("btn-danger")

						getDataChart(chart)

						var container = $('#chartResponses'),
						    scrollTo 	= $('#'+chart+'Body');
											
					window.scrollTo({ top: scrollTo.offset().top - container.offset().top + container.scrollTop() + 200, behavior: 'smooth' });
					}else{
						$('#'+chart+'Body').hide()
						$('#'+chart+'Button').val("0")
						$('#'+chart+'Button').removeClass("btn-danger")
						$('#'+chart+'Button').addClass("btn-info")
					}
				}

				// CONVERT DATE TO FULL DATE --ir 
				function convertDate(d) {
					var weekday 	= ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
					var monthList = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
					var date = new Date(d)
					date = weekday[date.getDay()]+", "+("0"+date.getDate()).slice(-2)+" "+monthList[date.getMonth()]+" "+date.getFullYear()
					return date
				}

				// CONVERT NULL TO BLANK --ir
  			function nullToBlank(value) {
					return !(value) ? "" : value;
				}
			
				// CALL FUNCTION SELECT PICKER --ir
  			function select(){
  			  $(function() {
  			    $('.selectpicker').selectpicker();
  			  });
  			}
			
  			// RESET SELECTPICKER --ir
  			function refreshSelect(){
  			  $(function() {
  			    $('.selectpicker').selectpicker('refresh');
  			  });
  			}

				// CLEAR INPUT --ir 
				function clear() {
					$('#infoSurveys').empty()
				}

				// SHOW/HIDE TABLES --ir
				function toggleShow(bol) {
					if (bol) {
						$('#headPages').show()
					}else{
						$('#headPages').hide()
					}
				}

				function showSurveys() {
					toggleShow(false);
					doNotRemoveMe = $('#chartResponses').find('.doNotRemoveMe')
					$('.listBtnCharts').empty()
					$('#chartResponses').empty()
					$('#chartResponses').html(doNotRemoveMe);

					$('#graphAgeBody, #typeOfRespBody').hide()
					$('#idPage').val('')
					$('#tableSurveys').show()
					$('#tableResponses, #chartResponses, #goBack, #surveyTitle, #surveyDate, #surveyURL').hide()
					$('#typeOfRespBody, #ratingChartBody, #satisfactionBody, #tagCloudBody, #tagCloud2Body, #freqAppBody, #moneySpentBody, #tagCloudHopeBody, #tagCloudHope2Body, #tagCloudHope3Body, #tagFiveValueBody, #tagVehicleBody, #tagRouteBody, #tagRequestBody, #tagFiveValuePOBody, #tagConditionPOBody, #tagConditionPO2Body, #tagConditionPO3Body').hide()
					$('#surveyTitle, #surveyDate, #surveyURL').empty()
				}

				// CHANGE SURVEY AND SET THE STEPS
				function setSurveyLists() {
					toggleShow(false)
					showSurveys()
					clear()

					$('#tableSurveyLists').DataTable().destroy()
					tableSurveyLists = $('#tableSurveyLists').DataTable({
						"autoWidth": false,
        		dom: 'Bfrtip',
        		buttons: [
        		  'copyHtml5',
        		  'excelHtml5',
        		]
					})
					tableSurveyLists.clear().draw()

					$.ajax({
      	    url : '<?php echo base_url('General/surveyLists') ?>',
      	    type: "post",
      	    // data: {author:author},
      	    dataType: "JSON",
      	    success : function(data){
							$.each(data, function() {
								if(nullToBlank(this.status) == "0"){
									btn = 'warning'
									text = 'Unpublished'
								}else{
									btn = 'info'
									text = 'Published'
								}

								status = "<center><button style='width:100%' onclick='changeStatus(\"survey\", \""+this.id+"\", \""+nullToBlank(this.status)+"\")' class = 'btn btn-"+btn+" btn-md' value='"+nullToBlank(this.status)+"'>"+text+"</button></center>"
								title  = "<center><a style='width:100%' href='"+window.location.origin+"/do-trans/Survey?id="+this.id+"' class = 'btn btn-primary btn-md' value='"+nullToBlank(this.id)+"'>"+nullToBlank(this.title)+"</a></center>"
								action = "<center><span class='actionSpan'>"
								action += "<button id='btnViewResponses' onclick='showResponses(\""+this.id+"\", \""+this.title+"\", \""+nullToBlank(this.beginDate)+"\", \""+nullToBlank(this.endDate)+"\", \""+nullToBlank(this.url)+"\", \""+nullToBlank(this.status)+"\", \""+nullToBlank(this.status)+"\")' class = 'btn btn-info btn-md' ><i class='fa fa-comment-dots'></i></button>"
								action += "<button id='btnViewCharts' onclick='viewCharts(\""+this.id+"\", \""+this.title+"\", \""+nullToBlank(this.beginDate)+"\", \""+nullToBlank(this.endDate)+"\", \""+nullToBlank(this.url)+"\", \""+nullToBlank(this.status)+"\", \""+nullToBlank(this.status)+"\")' class = 'btn btn-success btn-md' ><i class='fa fa-chart-bar'></i></button>"
								action += "<a id='btnEditSurvey' href='"+window.location.origin+"/do-trans/MstSurvey?id="+this.id+"' class = 'btn btn-warning btn-md' ><i class='fa fa-edit'></i></a>"
								action += "<button id='btnDelSurvey' onclick='delRow(\"survey\", \""+this.id+"\", \""+nullToBlank(this.title)+"\")' class = 'btn btn-danger btn-md' ><i class='fa fa-trash'></i></button>"
								action += "</span></center>"
								lastResponse = '<center>'+this.lastResponse+'</center>'
								responses = '<center>'+this.responses+'</center>'

								row = []
								row.push(status, title, responses, convertDate(this.date), lastResponse, action)
								tableSurveyLists.row.add(row).draw()
							})
							$('.actionSpan').find('button').css({'margin' : '3px', 'width' : '40px'})
							$('.actionSpan').find('a').css({'margin' : '3px', 'width' : '40px'})
							// tableSurveyLists.css({'vertical-align' : 'middle'})
      	    },
      	    beforeSend: function(){
      	    },complete: function(){
      	    },error: function() {
						}
      	  })
				}

				// FUNCTION CHANGE STATUS SURVEY --ir
      	function changeStatus(type, id, status){
					idSurvey 	= $('#id').val()
					idPage 		= $('#idPage').val()
					if(type == "survey"){
						if(status == "0") text = "Publish"
						else text = "Revoke"
					}else{
						if(status == "0") text = "show"
						else text = "hide"
					}

					swal({
						title 						 : "Hold Up!",
						text 							 : "Are you sure to "+text+" this "+type+"?",
						type							 : "warning",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-info",
						confirmButtonText	 : "Yes, "+text.toLowerCase()+" this "+type+"!", 
						cancelButtonText	 : "No, nevermind!",
						closeOnConfirm		 : false,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
      	  		  url : '<?php echo base_url('MstSurvey/changeStatus') ?>',
      	  		  type: "post",
      	  		  data: {type:type, id:id, status:status},
      	  		  dataType: "JSON",
      	  		  success : function(data){
									if(data=='success'){
										text = "Success "+text.toLowerCase()+" this "+type+"!";
										title = "Success"
									}else{
										text = "Failed "+text.toLowerCase()+" this "+type+"!";
										title = "Warning"
									}
      	  		  },
      	  		  beforeSend: function(){
								
      	  		  },complete: function(){
									swal({title : title, text  : text, type	: title.toLowerCase()}) 
									if(title === "Success"){
										setSurveyLists()
									} 
      	  		  },error: function() {

								}
      	  		})
						}else{
							swal("Canceled", "This "+type+" will not be "+text.toLowerCase()+"!", "success");
						}	
					})
				}

				// CALL MODAL CREATE SURVEY --ir
				function modalCreateSurvey(){
			    // if(!check('save')) return false
      	  $('#modalSurvey').show()
					$('.modal-title').html("Add Survey")
					$('#action').val("create")
				}

				// CLOSE MODAL --ir 
				function closeModal(){
					// $('#id').val('');
					$('#title').val('')
					$('#surveyBegin').val('')
					$('#surveyEnd').val('')
					$('#url').val('')
					$('#action').val('')
      	  $('#modalSurvey').hide()
				}

				// FUNCTION CREATE OR UPDATE SURVEY --ir
      	function updateSurvey(){
					var id					= $('#id').val()
					var title	 			= $('#title').val()
					var surveyBegin	= $('#surveyBegin').val()
					var surveyEnd		= $('#surveyEnd').val()
					var url					= $('#url').val()
					var action 			= $('#action').val()
					if(action == "update") text = "Update"
					else text = "Add"

					swal({
						title 						 : text+" this?",
						type							 : "warning",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-info",
						confirmButtonText	 : "Yes, "+text.toLowerCase()+" this!", 
						cancelButtonText	 : "No, nevermind!",
						closeOnConfirm		 : false,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
      	  		  type		: "POST",
      	  		  dataType: "JSON",
      	  		  url 		: '<?php echo base_url('MstSurvey/updateSurvey') ?>',
      	  		  data		: {id:id, action:action, title:title, surveyBegin:surveyBegin, surveyEnd:surveyEnd, url:url},
      	  		  success : function(data){
      	  		    if(data=='success'){
										if (action === "create") text = "Success adding a new survey!";
										else text = "Success update survey!";
										title = "Success"
      	  		    }else if(data=="duplicate"){
										text = "Survey "+title+" is already existed!";
										title = "Warning"
      	  		    }else{
										if (action === "create") text = "Failed to add a new survey!";
										else text = "Failed to update survey!";
										title = "Warning"
      	  		    }
      	  		  },
      	  		  beforeSend: function(){
								
      	  		  },complete: function(){
									closeModal();
									swal({title : title, text  : text, type	: title.toLowerCase()}) 
									if(title==="Success"){
										setSurveyLists()
									} 
      	  		  },
      	  		});
						}else{
							swal("Canceled", "Cancel "+text.toLowerCase()+"!", "success");
						}	
					})
				}
				
				// SHOW TABLE QUESTIONS --ir
				function showResponses(id, title, beginDate, endDate, url, status) {
					$('#idPage').val(idPage)
					$('#tableSurveys, #chartResponses').hide()
					$('#tableResponses, #goBack, #surveyTitle, #surveyDate, #surveyURL').show()
					// $('#surveyTitle').html("<b>"+title+"</b>")
					// $('#surveyDesc').html('')

					$('#surveyTitle').html('Title &emsp;&emsp;&emsp;: <b>'+nullToBlank(title)+'</b>')
					if(nullToBlank(beginDate) && nullToBlank(endDate) && nullToBlank(beginDate) != "0000-00-00" && nullToBlank(endDate) != "0000-00-00") $('#surveyDate').html('Start/End Survey &ensp;: &nbsp;<b>'+nullToBlank(convertDate(beginDate))+'</b> to <b>'+nullToBlank(convertDate(endDate))+"</b>")
					if(url){
						$('#surveyURL').append('Redirected to &emsp;&emsp;: &nbsp;<a></a>')
					 	$('#surveyURL').find('a').attr('href', url)
						$('#surveyURL').find('a').html(url)
					} 
					$('.infoSurvey').css({'margin' : '5px'})
					$('#surveyTitle').css({'margin-top' : '15px'})

					setResponses(id)
				}

				// SHOW CHART RESPONSES --ir
				function viewCharts(id, title, beginDate, endDate, url, status) {
					$('#id').val(id)
					if(id != "27" && id != "28" && id != "29" ) return false
					$('#idPage').val(idPage)
					$('#tableSurveys').hide()
					$('#chartResponses, #goBack, #surveyTitle, #surveyDate, #surveyURL').show()

					$('#surveyTitle').html('Title &emsp;&emsp;&emsp;: <b>'+nullToBlank(title)+'</b>')
					if(nullToBlank(beginDate) && nullToBlank(endDate) && nullToBlank(beginDate) != "0000-00-00" && nullToBlank(endDate) != "0000-00-00") $('#surveyDate').html('Start/End Survey &ensp;: &nbsp;<b>'+nullToBlank(convertDate(beginDate))+'</b> to <b>'+nullToBlank(convertDate(endDate))+"</b>")
					if(url){
						$('#surveyURL').append('Redirected to &emsp;&emsp;: &nbsp;<a></a>')
					 	$('#surveyURL').find('a').attr('href', url)
						$('#surveyURL').find('a').html(url)
					} 
					$('.infoSurvey').css({'margin' : '5px'})
					$('#surveyTitle').css({'margin-top' : '15px'})
					toggleShow(true)

					setChartCards(id)					
					// console.log(setChartCards(id))

					setTerminal(id)
				}

				function setTerminal(id) {
  			  $('#terminal').find('option').remove().end().append('<option value="">All Terminal</option>')
					$.ajax({
  			    url 			: '<?php echo base_url('SurveyLists/listTerminal') ?>',
  			    type			: "post",
      	    data			: {id:id},
  			    dataType	: "JSON",
  			    success: function(data) {
  			      // REMOVE ALL OPTIONS --ir
  			      // APPEND RELVANT OPTIONS --ir
							$.each(data, function(key, val) {
								id 		= val.id
								term 	= val.title
  			        $('#terminal').append('<option value = '+id+'>' +term+'</option>')
							})
  					},	
  			    error: function() {
  			      swal({title : "Failed", text  : "Failed to load terminal!", type	: "error"})
  			    }, 
  			    complete: function() {
							changeTerminal()
							// getDataChart('getResponden')
  			    } 
  			  })
				}

				function getDataChart(chart) {
					terminal = $('#terminal').val()
					id 			 = $('#id').val()

					// GET VALUE RESPONDENS ON THIS TERMINAL --ir 
				  $.ajax({
						type: "POST",
				  	url: '<?php echo base_url().'SurveyLists/getDataChart/'; ?>',
  			    data: {terminal:terminal, id:id, chart:chart},
				  	dataType: "json",
				  	success: function(data) {
							
  			    },	
  			    error: function() {
							
  			    }
  			  });
				}

				//  ONCHANGE MACHINE DROPDOWN --ir
  			function changeTerminal() {
					terminal = $('#terminal').val()
					id 			 = $('#id').val()
					// alert(id)
					
  			  // GET VALUE RESPONDENS ON THIS TERMINAL --ir 
				  $.ajax({
						type: "POST",
				  	url: '<?php echo base_url().'SurveyLists/changeTerminal/'; ?>',
  			    data: {terminal:terminal, id:id},
				  	dataType: "json",
				  	success: function(data) {
							// $('#graphAgeBody').show()
							minResp = 0;
							maxResp = 500;
							grades = [
				  		  {
				  		    title: "Kurang dari "+((maxResp / 4) * 1)+" Responden",
				  		    color: "#ee1f25",
				  		    lowScore: minResp,
				  		    highScore: ((maxResp / 4) * 1)-1
				  		  },
				  		  {
				  		    title: "Kurang dari "+((maxResp / 4) * 2)+" Responden",
				  		    color: "#fdae19",
				  		    lowScore: ((maxResp / 4) * 1),
				  		    highScore: ((maxResp / 4) * 2)-1
				  		  },
				  		  {
				  		    title: "Lebih dari "+((maxResp / 4) * 2)+" Responden",
				  		    color: "#b0d136",
				  		    lowScore: ((maxResp / 4) * 2)+1,
				  		    highScore: ((maxResp / 4) * 3)
				  		  },
				  		  {
				  		    title: "Lebih dari "+((maxResp / 4) * 3)+" Responden",
				  		    color: "#0f9747",
				  		    lowScore: ((maxResp / 4) * 3)+1,
				  		    highScore: ((maxResp / 4) * 4)
				  		  },
				  		]

  			      // respValue(0);
  			      gaugeBands(data.getResponden, grades, minResp, maxResp);
							graphAge(data.getGraphAge)
							// $('#graphAgeBody').removeClass()
							if(id == "27"){
							// $('#graphAgeBody').addClass('col-md-6')
								typeOfResp(data.getTypeOfResp)
								ratingChart(data.getRatingChart)
								satisfaction(data.getSatisfaction)
								tagCloud(data.getTagCloud)
								tagCloud2(data.getTagCloud2)
								freqApp(data.getFreqApp)
								moneySpent(data.getmoneySpent)
								tagCloudHope(data.getTagCloudHope)
								tagCloudHope2(data.getTagCloudHope2)
								tagCloudHope3(data.getTagCloudHope3)

								console.log(data.getTypeOfResp)
								console.log(data.getRatingChart)
								console.log(data.getSatisfaction)
								console.log(data.getTagCloud)
								console.log(data.getTagCloud2)
								console.log(data.getFreqApp)
								console.log(data.getmoneySpent)
								console.log(data.getTagCloudHope)
								console.log(data.getTagCloudHope2)
								console.log(data.getTagCloudHope3)
								// $('#typeOfRespBody, #ratingChartBody, #satisfactionBody, #tagCloudBody, #tagCloud2Body, #freqAppBody, #moneySpentBody, #tagCloudHopeBody, #tagCloudHope2Body, #tagCloudHope3Body').show()
							}else if(id == "28"){
								tagFiveValue(data.getFiveValue)
								tagFiveValue2(data.getFiveValue)
								tagVehicle(data.getVehicle)
								tagRoute(data.getRoute)
								tagRequest(data.getRequest)

								console.log(data.getFiveValue)
								console.log(data.getVehicle)
								console.log(data.getRoute)
								console.log(data.getRequest)
								// $('#tagFiveValueBody').show()
								// $('#tagVehicleBody').show()
								// $('#tagRouteBody').show()
								// $('#tagRequestBody').show()
								// $('#graphAgeBody').addClass('col-md-12')
							}else if(id == "29"){
								tagFiveValuePO(data.getFiveValuePO)
								tagFiveValuePO2(data.getFiveValuePO)
								tagVehiclePO(data.getVehiclePO)
								tagRoutePO(data.getRoutePO)
								tagDeparturePO(data.getDeparturePO)
								tagArrivalPO(data.getArrivalPO)
								tagOccupancyPO(data.getOccupancyPO)
								tagDecreasePO(data.getDecreasePO)

								console.log(data.getFiveValuePO)
								console.log(data.getVehiclePO)
								console.log(data.getRoutePO)
								console.log(data.getDeparturePO)
								console.log(data.getArrivalPO)
								console.log(data.getOccupancyPO)
								console.log(data.getDecreasePO)
								// $('#tagFiveValuePOBody').show()
								// $('#tagConditionPOBody').show()
								// $('#tagConditionPO2Body').show()
								// $('#tagConditionPO3Body').show()
								// $('#graphAgeBody').addClass('col-md-12')
							}else return true 
  			    },	
  			    error: function() {
  			      // alert('Load Responden Failed!');
  			      // gaugeBands(0);
							graphAge('')
							if(id == "27"){
								typeOfResp('')
								ratingChart('')
								satisfaction('')
								tagCloud('')
								tagCloud2('')
								freqApp('')
								moneySpent('')
								tagCloudHope('')
								tagCloudHope2('')
								tagCloudHope3('')
							}else if(id == "28"){
								tagFiveValue('')
								tagFiveValue2('')
								tagVehicle('')
								tagRoute('')
								tagRequest('')
							}else return true 
  			    }
  			  });
  			}

				// DELETE SURVEY/PAGE/QUESTION/ANSWER --ir
				function delRow(type, id, title) {
					// if(!check('del')) return false
					swal({
						title 						 : "Hold on!",
						text 							 : "Are you sure to delete "+type+" "+title+"? You cannot recover this!",
						type							 : "warning",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-danger",
						confirmButtonText	 : "Yes, delete that!", 
						cancelButtonText	 : "No, nevermind!",
						closeOnConfirm		 : false,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
								type			:	"post",
								url				:	"<?php echo base_url('MstSurvey/delRow') ?>",
								data 			: {type:type, idSurvey:id},
								dataType	: "JSON",
								success 	: function(data){
									if(data == "success"){
										swal({title : "Success", text : "Success delete "+type+" "+title+"!", type : "success"})
									}else{
										swal({title : "Failed", text : "Failed to delete "+type+" "+title+"!", type : "error"})
									}
								},complete: function(){
									setSurveyLists()
      	  		  },
							});
						}else{
							swal("Canceled", "Your "+type+" is safe!", "success");
						}	
					});
				}

			</script>
