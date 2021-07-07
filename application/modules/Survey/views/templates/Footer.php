			<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
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
			<script src="https://use.fontawesome.com/7ad89d9866.js"></script>

			<!-- HTML5 EXPORT -->
			<script src="<?php echo base_url('assets/js/dataTables.buttons.min.js');?>"></script>
			<script src="<?php echo base_url('assets/js/jszip.min.js');?>"></script>
			<script src="<?php echo base_url('assets/js/pdfmake.min.js');?>"></script>
			<script src="<?php echo base_url('assets/js/vfs_fonts.js');?>"></script>
			<script src="<?php echo base_url('assets/js/buttons.html5.min.js');?>"></script>
			<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
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

				var pageArr = {}
				var noResp = 0
				var noPage = 0
				var idSurvey 	= "<?php echo $id ?>"
				
				var form 			= $('#allPages')[0]
				var formData 	= new FormData(form)

				$(document).ready(function() {
					$('body').append('<div class="loader"></div>')
					$('body').append('<div class="overlay"></div>')
					$('.loader, .overlay').hide()
					// window.history.replaceState(null,null,window.location.pathname)
					setSurvey(idSurvey)
				});

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

				function setPages(page, title, desc, id, url) {
					// SET THE CARD PAGES --ir
					$('#allPages').append('<div class="card" id='+page+' value="'+id+'"></div>')
					$('#allPages').find('.card:last').append('<div class="card-header"></div>')
					$('#allPages').find('.card:last').append('<div class="card-body"></div>')
					$('#allPages').find('.card:last').append('<div class="card-footer"></div>')
					$('#allPages').find('.card-header:last').append('<span></span>')
					$('#allPages').find('span:last').append('<h1 class="pageTitle" ></h1>')
					$('#allPages').find('span:last').append('<h4 class="pageDesc" ></h4>')
					$('#allPages').find('.pageTitle:last').append(title)
					$('#allPages').find('.card-footer:last').append('<div class="spanFoot"></div>')

					// SET BUTTONS ON FOOTER FOR PREV AND NEXT BETWEEN PAGES --ir
					if(page == 'pageWelcome'){
						$('#allPages').find('.card-body:last').append('<div class="questBox">'+desc+'</div>')
						$('#allPages').find('.card-footer:last .spanFoot:last').append('<a class="btnPage welcomeBtn"></a>')
						$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<span>Start</span>')
						$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<div class="transition"></div>')

						$('.btnPage:last').attr('onclick', "setResponses(\""+page+"\")")
					}else if(page == 'pageThanks'){
						$('#allPages').find('.card-footer:last .spanFoot:last').append('<div class="questBox">'+desc+'</div>')
						

						// $('#allPages').find('.card-footer:last .spanFoot:last').append('<a class="btnPage prevBtn"></a>')
						// $('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<span>Start Again!</span>')
						// $('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<div class="transition"></div>')
						// $('.btnPage:last').attr('onClick', 'window.location.reload()')

						// HIDE THANKS PAGE --ir
						$('#allPages').find('.card:last').hide()
					}else{
						$('#allPages').find('.pageDesc:last').append(desc)
						$('#allPages').find('.card-footer:last .spanFoot:last').append('<a class="btnPage prevBtn"></a>')
						$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<span>Prev</span>')
						$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<div class="transition"></div>')
						$('#allPages').find('.card-footer:last .spanFoot:last a:last').css({"float" : "left"})
						$('.btnPage:last').attr('onclick', "prevPage(\""+page+"\")")

						if(page.replace("page", "") == noPage){
							$('#allPages').find('.card-footer:last .spanFoot:last').append('<a class="btnPage thanksBtn"></a>')
							$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<span>Finish</span>')
							$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<div class="transition"></div>')
							$('#allPages').find('.card-footer:last .spanFoot:last a:last').css({"float" : "right"})
							$('.btnPage:last').attr('onclick', "sendSurvey(\""+page+"\", \"final\", \""+url+"\",)")
						}else{
							$('#allPages').find('.card-footer:last .spanFoot:last').append('<a class="btnPage nextBtn"></a>')
							$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<span>Next</span>')
							$('#allPages').find('.card-footer:last .spanFoot:last a:last').append('<div class="transition"></div>')
							$('#allPages').find('.card-footer:last .spanFoot:last a:last').css({"float" : "right"})
							$('.btnPage:last').attr('onclick', "setResponses(\""+page+"\")")
						}

						// HIDE ALL PAGES --ir
						$('#allPages').find('.card:last').hide()
					}
				}

				function setQuestions(question, titleQ, desc, type, id) {
					$('.card-body:last').append('<div class="questBox '+question+'" value="'+id+'"></div>')
					$('.card-body:last').find('.questBox:last').append("<h2><b>"+titleQ+"</b></h2>")
					$('.card-body:last').find('.questBox:last').append("<hr></hr>")
					// if(type == "rating") rating = 'rating'; else rating = '';
					$('.card-body:last').find('.questBox:last').append('<div class="'+typeQ+'Ans '+question.replace("quest", "ans")+'" value="'+typeQ+'"></div>')
				}

				function setAnswers(page, question, answer, titleAns, typeQ, id, req) {
					id = "ans"+id
					if(req == "Y") req = 'required'; else req = '';
					// id = page+question+answer
					col = '.'+typeQ+'Ans:last'
					if(typeQ == "line"){
						$(col).append("<div class = 'inputStyle'></div>")
						$(col).find('.inputStyle:last').append("<input id='"+id+"' placeholder='"+titleAns+"' "+req+">")
						$(col).find('.inputStyle:last').append("<label for='"+id+"'>"+titleAns+"</label>")
						$(col).find('.inputStyle:last').append("<div class='req-mark'>!</div>")
					}else if(typeQ == "radio"){
						$(col).append('<input type="radio" id="'+id+'" name="ansQuest'+(question)+'" value="'+titleAns+'">&nbsp;')
						$(col).append('<label for="'+id+'">'+titleAns+'</label><br>')
						// $(col).find('input:first').prop('checked',true)
						$(col).find('input:first').prop('required',true)
					}else if(typeQ == "rating"){
						$(col).append('<input type="radio" id="'+id+'" name="'+(question)+'" value="'+titleAns+'">')
						$(col).append('<label class="star" for="'+id+'" title="'+titleAns+'" aria-hidden="true"></label>')
						$(col).find('input:first').prop('required',true)
						// $(col).find('input').get().reverse()
						// $(col).find('input').get().reverse()

						// $(col).find('input:first').prop('checked',true)
					}else if(typeQ == "check"){
						$(col).append('<input type="checkbox" id="'+id+'" name="'+id+'" value="'+titleAns+'">&nbsp;')
						$(col).append('<label for="'+id+'">'+titleAns+'</label><br>')
					}else if(typeQ == "paragraph"){
						$(col).append(titleAns)
						$(col).append("<span class='textarea' role='textbox' id='"+id+"' contenteditable></span>")
					}else if(typeQ == "image"){
						$(col).append('<input type="file" id="'+id+'" accept="image/*" capture="camera" class="form-control '+req+'">')
					}else{
						$(col).append("<h6><b>"+titleAns+"</b></h6>")
					} 
				}

				function setSurvey(id) {
					$.ajax({
						type			: "POST",
						url 			: '<?php echo base_url('General/setSurvey') ?>',
						data			: {id:id},
						dataType	: "JSON",
						success: function(data) {
							if(data !== undefined){
								$.each(data, function(key, survey) {
									$('#surveyTitle, .titleSurvey').html(survey.title).css({"color":"white"})
									console.log(survey)
									if(survey.status == "0"){ 
										swal({title : "Please Wait", text : "This survey isn't published yet!", type : "info", showCancelButton : false, showConfirmButton : false}); return false;
									}else if(survey.max_responden>0){
										if(survey.responses >= survey.max_responden){
											swal({title : "Over Limit", text : "This survey is over limit!", type : "info", showCancelButton : false, showConfirmButton : false}); return false;
										}
										
									}
									noPage = Object.keys(survey.pages).length
									// SET THE WELCOME PAGE --ir
									setPages("pageWelcome", survey.welcomeTitle, survey.welcomeText)
									// SET THE PAGES --ir
									countPage = 0
									$.each(survey.pages, function(titlePage, pages) {
										countPage++
										page = "page"+(countPage)
										setPages(page, titlePage, pages.desc, pages.id, survey.url)
										countQ = 0
										$.each(pages.questions, function(titleQ, questions) {
											countQ++
											question = "quest"+(countQ)
											typeQ = questions.type
											setQuestions(question, titleQ, questions.desc, typeQ, questions.id)
											countAns = 0
											$.each(questions.answers, function(titleAns, answers) {
												countAns++
												answer = "ans"+(countAns)
												setAnswers(page, questions.id, answer, titleAns, typeQ, answers.id, questions.req)
											})
										})
									})
									// SET THE THANKS PAGE --ir
									setPages("pageThanks", survey.thanksTitle, survey.thanksText)
								})
							}
						},    
						error: function() {
						}
					});
				}

				// USE MULTIDIMENSIONAL ARRAY STACK FOR GATHERING ALL OF RESPONSES --ir
				function nextPage2(page) {
					$('#'+page).hide()
					$('#'+page).next().show()

					if(page.includes("Welcome") || page.includes("Thanks")) return true
					else{
						qArr = []
						countQ = $('#'+page).find('.card-body .questBox').length
						for (let x = 1; x <= countQ; x++) {
							ansArr 	= []
							countAns = $('#'+page).find('.card-body .quest'+x+' input').length
							typeQ = String($('#'+page).find('.card-body .quest'+x+' div').attr('value'))
							if(typeQ == "paragraph") countAns = $('#'+page).find('.card-body .quest'+x+' span').length

							for (let y = 1; y <= countAns; y++) {
								var bol = true
								respArr 	= []
								respArr['idSurvey'] = idSurvey
								respArr['idPage'] 	= $('#'+page).attr('value')
								respArr['idQ'] 			= $('#'+page).find('.card-body .quest'+x+'').attr('value')

								// SET THE INPUT BASED ON TYPE OF QUESTIONS --ir
								input = "input:nth-of-type("+y+")"
								if(typeQ == "paragraph") input = "span:nth-of-type("+y+")"
								respArr['idAns'] 	= String($('#'+page).find('.card-body .quest'+x+' .ans'+x+' '+input).attr('id')).replace("ans","")	

								// INPUT:CHECKED FOR RADIO AND THE GANG --ir
								if(typeQ == "radio" || typeQ == "rating" || typeQ == "check") input = input+":checked"; 

								// GET AND SET THE VALUE ON EACH RESPONSES --ir
								value 	= $('#'+page).find('.card-body .quest'+x+' .ans'+x+' '+input)
								if(typeQ == "paragraph") respArr['valAns'] = String(value.html())	
								else respArr['valAns'] = String(value.val())

								// IF NULL OR UNDEFINED ON RADIO AND THE GANG, DONT INCLUDE IT --ir
								if((typeQ == "radio" || typeQ == "rating" || typeQ == "check") && respArr['valAns'] == "undefined") bol = false;
								if(bol)ansArr['resp'+y] = respArr
							}
							qArr['Q'+x] = ansArr
						}
					
						pageArr[page] = qArr
						console.log(pageArr)
					}
				}

				// USE ONE DIMENSIONAL ARRAY STACK FOR GATHERING ALL OF RESPONSES --ir
				function setResponses(page, final) {
					if(page.includes("Welcome") || page.includes("Thanks")) ''
					else{
						countQ = $('#'+page).find('.card-body .questBox').length
						for (let x = 1; x <= countQ; x++) {
							countAns = $('#'+page).find('.card-body .quest'+x+' input').length
							typeQ = String($('#'+page).find('.card-body .quest'+x+' div').attr('value'))
							if(typeQ == "paragraph") countAns = $('#'+page).find('.card-body .quest'+x+' span').length
							for (let y = 1; y <= countAns; y++) {
								var bol = true
								respArr 	= {}
								respArr['survey'] 	= idSurvey
								// respArr['type'] 		= typeQ
								respArr['page'] 		= $('#'+page).attr('value')
								respArr['question'] = $('#'+page).find('.card-body .quest'+x+'').attr('value')

								// SET THE INPUT BASED ON TYPE OF QUESTIONS --ir
								input = "input:nth-of-type("+y+")"
								if(typeQ == "paragraph") input = "span:nth-of-type("+y+")"
								respArr['answer'] 	= String($('#'+page).find('.card-body .quest'+x+' .ans'+x+' '+input).attr('id')).replace("ans","")	
								
								// DELETE PREV KEY OF ARRAY RESPONE --ir
								delete pageArr['resp'+(respArr['answer'])]

								// INPUT:CHECKED FOR RADIO AND THE GANG --ir
								if(typeQ == "radio" || typeQ == "rating" || typeQ == "check") input = input+":checked"; 

								// GET AND SET THE VALUE ON EACH RESPONSES --ir
								value 	= $('#'+page).find('.card-body .quest'+x+' .ans'+x+' '+input)
								if(typeQ == "paragraph") respArr['response'] = String(value.html())	
								else if(typeQ == "image") respArr['responseImg'] = value.prop('files')[0]	
								else respArr['response'] = String(value.val())

								// IF NULL OR UNDEFINED ON RADIO AND THE GANG, DONT INCLUDE IT --ir
								if((typeQ == "radio" || typeQ == "rating" || typeQ == "check") && respArr['response'] == "undefined") bol = false;
								if(bol){
									if(typeQ !== "image") pageArr['resp'+(respArr['answer'])] = respArr
									else{
										image = respArr['survey']+"_"+respArr['page']+"_"+respArr['question']+"_"+respArr['answer']
										formData.append(image, value.prop('files')[0])
									}
								}
							}
						}
						// console.log(pageArr)
					}
					if(!(final)) nextPage(page)
				}

				function nextPage(page) {
					bol = true
					$('#'+page).find('input[required]').each(function(){
						if(!$(this).val()){
							swal("Hold up!", "Please fill all required field!", "warning");
							bol = false
						}
					})

					if(bol){
						window.scrollTo({ top: 0, behavior: 'smooth' });
						$('#'+page).hide()
						$('#'+page).next().show()
					}
				}

				// JUST FUNC PREV PAGE --ir
				function prevPage(page) {
					window.scrollTo({ top: 0, behavior: 'smooth' });
					$('#'+page).hide()
					$('#'+page).prev().show()
				}

				function sendSurvey(page, final, url) {
					console.log(pageArr)
					console.log(formData)
					setResponses(page, final)
					swal({
						title 						 : "Submit this?",
						// text 							 : "Are you sure to delete "+type+" "+title+"? You cannot recover this!",
						type							 : "warning",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-info",
						confirmButtonText	 : "Yes, submit this!", 
						cancelButtonText	 : "Check it again.",
						closeOnConfirm		 : true,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
								type			: "POST",
								url 			: '<?php echo base_url('Survey/sendSurvey') ?>',
								data			: {data : JSON.stringify(pageArr)},
								dataType	: "JSON",
								success: function(data) {
									$.ajax({
										method		 : "POST",
      	    				dataType : "JSON",
										url 			: '<?php echo base_url('Survey/saveFiles') ?>',
										// data		 : {q:q, id:id, idPage:idPage, idAns:idAns, idQ:idQ, titleAns:titleAns, typeAns:typeAns},
										data 				: formData,
        						processData : false,
        						contentType : false,
        						cache 			: false,
										success: function(data) {
										},    
										error: function() {
										
										},
										beforeSend: function(){
											// $('.loader, .overlay').show()
      	  				  },complete: function(){
											// $('.loader, .overlay').hide()
											// nextPage(page)
											// swal({title : "Success", text : "", type : "success"})
      	  				  },
									});
								},    
								error: function() {
								
								},
								beforeSend: function(){
									$('.loader, .overlay').show()
      	  		  },complete: function(){
									$('.loader, .overlay').hide()
									nextPage(page)
									if(url){
										setInterval(function() {
											window.location.href = url
										}, 3000);
									}
									// swal({title : "Success", text : "", type : "success"})
      	  		  },
							});
						}else{
							swal("Canceled", "", "success");
						}	
					});
				}

			</script>
    </body>
</html>