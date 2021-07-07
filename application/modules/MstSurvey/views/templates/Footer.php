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
			<script src="<?php echo base_url('assets/js/select2.min.js')?>"></script>
			<!-- <script src="<?php echo base_url() ?>assets/plugins/datapicker/bootstrap-datepicker.js"></script> -->
			<!-- <script src="<?php echo base_url('assets/js/datatables.js')?>"></script> -->
			<!-- <script src="<?php echo base_url() ?>assets/inspinia/js/jquery-2.1.1.js"></script> -->
			<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
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

			<!-- EDITOR QUILL -->
			<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
			<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
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
				var quill = new Quill('#textPage', {
				  modules: {
				    toolbar: [
  						[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
  						[{ 'font': [] }],
				      // ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
				      ['bold', 'italic', 'underline'],        // toggled buttons
  						[{ 'list': 'ordered'}, { 'list': 'bullet' }],
  						// [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  						// [{ 'align': [] }],

  						// ['blockquote', 'code-block'],

  						// [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  						// [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  						// [{ 'direction': 'rtl' }],                         // text direction
												


  						// ['clean']   
				    ]
				  },
				  placeholder: 'Description on Welcome Page...',
				  theme: 'snow'  // or 'bubble'
				});

				$('#surveyBegin, #surveyEnd').datepicker({
      	  // minViewMode: 1,
      	  keyboardNavigation: false,
      	  forceParse: false,
      	  autoclose: true,
      	  todayHighlight: true,
      	  // endDate: 'd',
      	  format: "yyyy-mm-dd"
      	});

				$(document).ready(function() {
					window.history.replaceState(null,null,window.location.pathname)
					id = "<?php echo $id ?>"
					toggleShow(false)
					setTypeAns()
					surveyLists("", id)
					$('#goBack, #addQ, #btnDuplicatePage, #pageTitle, #pageDesc, #tableQ, #deptProc').hide()
					$('.titleModule').empty().html("MASTER SURVEYS")
				});

				// CONVERT DATE TO FULL DATE --ir 
				function convertDate(d) {
					var weekday 	= ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
					var monthList = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
					var date = new Date(d)
					date = weekday[date.getDay()]+", "+("0"+date.getDate()).slice(-2)+" "+monthList[date.getMonth()]+" "+date.getFullYear()
					return date
				}

				function setTypeAns() {
					$.ajax({
  			    url : '<?php echo base_url('General/listTypeAns') ?>',
  			    type: "post",
  			    dataType: "JSON",
  			    success: function(data) {
  			      // REMOVE ALL OPTIONS --ir
  			      $('#typeAns').find('option').remove().end().append('<option value="">Select Type</option>')
  			      // APPEND RELVANT OPTIONS --ir
							$.each(data, function() {
  			        id 			= this.id
  			        type 		= this.type
  			        $('#typeAns').append('<option value = '+type+'>' +type+'</option>')
							})
  					},	
  			    error: function() {
  			      swal({title : "Failed", text  : "Failed to load types answer!", type	: "error"})
  			    }, 
  			    complete: function() {

  			    } 
  			  })
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
					$('#surveyTitle').empty()
					$('#surveyDate').empty()
					$('#surveyURL').empty()
				}

				// SHOW/HIDE TABLES --ir
				function toggleShow(bol) {
					if (bol) {
						$('#headPages').show()
						$('#btnAddPage').show()
					}else{
						$('#headPages').hide()
						$('#btnAddPage').hide()
					}
				}
				
				// GET SURVEY LISTS BASED ON AUTHOR
				function surveyLists(author, survey) {
  			  $.ajax({
  			    url : '<?php echo base_url('General/surveyLists') ?>',
  			    type: "post",
  			    data: {author:author},
  			    dataType: "JSON",
  			    success: function(data) {
  			      // REMOVE ALL OPTIONS --ir
  			      $('#surveys').find('option').remove().end().append('<option value="">Select Survey</option>')
  			      // APPEND RELVANT OPTIONS --ir
							$.each(data, function() {
  			        id 			= this.id
  			        text 		= this.title
  			        tokens 	= id+text
  			        tokens 	= tokens.replace(/ /g,'')
  			        if(survey && survey === id) $('#surveys').append('<option selected data-tokens = "'+tokens+'" value = '+id+'>' +text+'</option>')
  			        else if(!(survey)) $('#surveys').append('<option selected data-tokens = "'+tokens+'" value = '+id+'>' +text+'</option>')
  			        else $('#surveys').append('<option data-tokens = "'+tokens+'" value = '+id+'>' +text+'</option>')
							})
  					},	
  			    error: function() {
  			      swal({title : "Failed", text  : "Failed to load Surveys!", type	: "error"})
  			    }, 
  			    complete: function() {
							select()
  			      refreshSelect()
							changeSurvey($('#surveys :selected').val())
  			    } 
  			  })
  			}

				// CHANGE SURVEY AND SET THE STEPS
				function changeSurvey(id) {
					toggleShow(false)
					showPages()
					clear()
					$('#tBodyPages').empty()
					$('#btnUpdateSurvey').attr('onclick', '');

					$.ajax({
  			    url : '<?php echo base_url('General/surveyPages') ?>',
  			    type: "post",
  			    data: {id:id},
  			    dataType: "JSON",
  			    success: function(data) {
  			      // REMOVE ALL OPTIONS --ir
  			      console.log(data)
							var a = 0
							var length = data.length
							$.each(data, function() {
								a++
								$('#id').val(this.id)
								$('#titleSurvey').val(this.title)

								// SET SURVEY INFO, WELCOME ROW, AND OTHERS --ir
								if(a==1){
									$('#surveyTitle').html('Title &emsp;&emsp;&emsp;: <b>'+nullToBlank(this.title)+'</b>')
									if(nullToBlank(this.beginDate) && nullToBlank(this.endDate) && nullToBlank(this.beginDate) != "0000-00-00" && nullToBlank(this.endDate) != "0000-00-00") $('#surveyDate').html('Start/End Survey &ensp;: &nbsp;<b>'+nullToBlank(convertDate(this.beginDate))+'</b> to <b>'+nullToBlank(convertDate(this.endDate))+"</b>")
									if(this.category){
										$('#surveyCategory').html('Category &emsp;&emsp;&emsp;&emsp;: <b>'+nullToBlank(this.category)+'</b>')
									} 
									if(this.url){
										$('#surveyURL').append('Redirected to &emsp;&emsp;: &nbsp;<a></a>')
									 	$('#surveyURL').find('a').attr('href', this.url)
										$('#surveyURL').find('a').html(this.url)
									} 
									$('.infoSurvey').css({'margin' : '5px'})
									$('#surveyTitle').css({'margin-top' : '15px'})

									// CHANGE STAT SURVEY --ir
									$('#btnStatSurvey').removeClass()
									$('#btnStatSurvey').attr("onclick", "");
									$('#btnStatSurvey').attr("onclick", "changeStatus(\"survey\", \""+id+"\", \""+nullToBlank(this.status)+"\")");
									if(nullToBlank(this.status) == "0"){
										$('#btnStatSurvey').addClass("btn btn-warning btn-md")
										$('#btnStatSurvey').html("Unpublished")
										$('#btnStatSurvey').val(nullToBlank(this.status))
									}else{
										$('#btnStatSurvey').addClass("btn btn-info btn-md")
										$('#btnStatSurvey').html("Published")
										$('#btnStatSurvey').val(nullToBlank(this.status))
									}

									// CHANGE ATTR ONCLICK MODAL --ir
									$('#btnUpdateSurvey').attr("onclick", "modalUpdateSurvey(\""+id+"\", \""+nullToBlank(this.title)+"\", \""+nullToBlank(this.beginDate)+"\", \""+nullToBlank(this.endDate)+"\", \""+nullToBlank(this.url)+"\", \""+this.target+"\")");

									// ADD WELCOME ROW --ir
									$('#tBodyPages').append('<tr></tr>')
									$('#tBodyPages').find('tr:last').append('<td align="center">First</td>')
									$('#tBodyPages').find('tr:last').append('<td align="center"><b>Welcome Pages</b></td>')
									$('#tBodyPages').find('tr:last').append('<td align="center">'+nullToBlank(this.welcomeText)+'</td>')
									$('#tBodyPages').find('tr:last').append('<td align="center"><b>-</b></td>')
									$('#tBodyPages').find('tr:last').append('<td align="center"></td>')
									$('#tBodyPages').find('tr:last td:last').append("<button class='modalWelcome btn btn-warning btn-md' onclick='modalPage(\"welcome\", \""+id+"\", \"\", \""+nullToBlank(this.welcomeTitle)+"\", \""+nullToBlank(this.welcomeText).replace('\"','\'')+"\", \""+nullToBlank(this.welcomeBtn)+"\")'><i class='fa fa-edit'></i></button>")

									// SET THANKS ROW --ir
									$('#tBodyPages').append('<tr></tr>')
									$('#tBodyPages').find('tr:last').append('<td align="center">Last</td>')
									$('#tBodyPages').find('tr:last').append('<td align="center"><b>Thanks Pages</b></td>')
									$('#tBodyPages').find('tr:last').append('<td align="center">'+nullToBlank(this.thanksText)+'</td>')
									$('#tBodyPages').find('tr:last').append('<td align="center"><b>-</b></td>')
									$('#tBodyPages').find('tr:last').append('<td align="center"></td>')
									$('#tBodyPages').find('tr:last td:last').append("<button class='modalPage btn btn-warning btn-md' onclick='modalPage(\"thanks\", \""+id+"\", \"\", \""+nullToBlank(this.thanksTitle)+"\", \""+nullToBlank(this.thanksText).replace('\"','\'')+"\", \""+nullToBlank(this.thanksBtn)+"\")'><i class='fa fa-edit'></i></button>")
								}

								// SET ROW PAGES IF EXIST --ir
								if(nullToBlank(this.titlePage) != ""){
									$('#tBodyPages').append('<tr data-order="'+this.sort+'" class="site_heading"></tr>')

									$('#tBodyPages').find('tr:last').append('<td align="center"></td>')
									$('#tBodyPages').find('tr:last td:last').append('<span></span>');
									$('#tBodyPages').find('tr:last td:last span').append("<button class='btnMinus btn btn-sm' value="+this.sort+" onclick='changeOrder2(\""+this.idPage+"\", \"minus\", \"#tBodyPages\")'><i class='fa fa-arrow-up'></i></button>")
									$('#tBodyPages').find('tr:last td:last span').append("<button class='btnOrder btn btn-sm' value="+this.sort+" >"+this.sort+"</button>")
									$('#tBodyPages').find('tr:last td:last span').append("<button class='btnPlus btn btn-sm' value="+this.sort+" onclick='changeOrder2(\""+this.idPage+"\", \"plus\", \"#tBodyPages\")'><i class='fa fa-arrow-down'></i></button>")
									$('#tBodyPages').find('tr:last td:last span .btnMinus').attr('id', 'minus'+this.idPage)
									$('#tBodyPages').find('tr:last td:last span .btnOrder').attr('id', 'order'+this.idPage)
									$('#tBodyPages').find('tr:last td:last span .btnPlus').attr('id', 'plus'+this.idPage)

									$('#tBodyPages').find('tr:last').append('<td align="center"><b>'+nullToBlank(this.titlePage)+'</b></td>')
									$('#tBodyPages').find('tr:last').append('<td align="center">'+nullToBlank(this.desc)+'</td>')
									$('#tBodyPages').find('tr:last').append('<td align="center"><b>-</b></td>')

									$('#tBodyPages').find('tr:last').append('<td align="center"></td>')
									$('#tBodyPages').find('tr:last td:last').append('<span></span>');
									$('#tBodyPages').find('tr:last td:last span').append("<button class='showQ  	 btn btn-primary btn-md' onclick='showQ(\""+id+"\", \""+this.idPage+"\", \""+nullToBlank(this.titlePage)+"\", \""+nullToBlank(this.desc)+"\")'><i class='fa fa-question'></i></button>")
									$('#tBodyPages').find('tr:last td:last span').append("<button class='modalPage btn btn-warning btn-md' onclick='modalPage(\""+nullToBlank(this.titlePage)+"\", \""+id+"\", \""+this.idPage+"\", \""+nullToBlank(this.titlePage)+"\", \""+nullToBlank(this.desc)+"\", \"\")'><i class='fa fa-edit'></i></button>")
									$('#tBodyPages').find('tr:last td:last span').append("<button class='delRow 	 btn btn-danger btn-md'  onclick='delRow(\"page\", \""+this.idPage+"\", \""+nullToBlank(this.titlePage)+"\")'><i class='fa fa-trash'></i></button>")
									if(nullToBlank(this.statusPage) == "0"){
										btn  = "default"
										icon = "eye-slash"
									}else{
										btn  = "info"
										icon = "eye"
									}
									$('#tBodyPages').find('tr:last td:last span').append("<button class='statPage  btn btn-"+btn+" btn-md' onclick='changeStatus(\"page\", \""+this.idPage+"\", \""+this.statusPage+"\")'><i class='fa fa-"+icon+"'></i></button>")
								}

								// if(a == length){

								// }
								toggleShow(true)
								$('#tBodyPages').find('button').css({'margin' : '3px', 'width' : '40px'})
								$('#tBodyPages').find('td').css({'vertical-align' : 'middle'})
								RowOrder("page")
							})
  					},	
  			    error: function() {
  			      swal({title : "Failed", text  : "Failed to load this survey!", type	: "error"})
  			    }, 
  			    complete: function() {
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
						if(checkStat()) return false
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
										if(type == "survey" || type == "page" ) surveyLists("", idSurvey)
										else if(type == "question") changePage(idPage)
									} 
      	  		  },error: function() {

								}
      	  		})
						}else{
							swal("Canceled", "This "+type+" will not be "+text.toLowerCase()+"!", "success")
						}	
					})
				}

				function checkStat() {
					if($('#btnStatSurvey').val() == "1"){
						swal("You Can't", "This survey has not been published, it cannot be edited!", "warning")
						return true
					} 
				}

				// CALL MODAL CREATE SURVEY --ir
				function modalCreateSurvey(){
			    // if(!check('save')) return false
      	  $('#modalSurvey').show()
					$('.modal-title').html("Add Survey")
					$('#action').val("create")
				}

				// CALL MODAL UPDATE SURVEY --ir
				function modalUpdateSurvey(id, title, begin, end, url, target){
			    if(checkStat()) return false
			    // if(!check('save')) return false
      	  $('#modalSurvey').show()
					$('.modal-title').html("Update Survey "+$('#surveyTitle').html())
					$('#title').val(title)
					$('#surveyBegin').val(begin)
					$('#surveyEnd').val(end)
					$('#url').val(url)
					$('#target').val(target)
					$('#action').val("update")
				}

				// CLOSE MODAL --ir 
				function closeModal(){
					// $('#id').val('');
					$('#title').val('')
					$('#surveyBegin').val('')
					$('#surveyEnd').val('')
					$('#url').val('')
					$('#target').val('')
					$('#action').val('')
      	  $('#modalSurvey').hide()
				}

				// FUNCTION CREATE OR UPDATE SURVEY --ir
      	function updateSurvey(){
					var id					= $('#id').val()
					var title	 			= $('#title').val()
					var surveyBegin	= $('#surveyBegin').val()
					var surveyEnd		= $('#surveyEnd').val()
					var category		= $('#category').val()
					var url					= $('#url').val()
					var target			= $('#target').val()
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
      	  		  data		: {id:id, action:action, title:title, surveyBegin:surveyBegin, surveyEnd:surveyEnd, category:category, url:url, target:target},
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
										if(action == "update") surveyLists("", id)
										else surveyLists("", "")
									} 
      	  		  },
      	  		});
						}else{
							swal("Canceled", "Cancel "+text.toLowerCase()+"!", "success");
						}	
					})
      	}

				// CALL MODAL UPDATE WELCOME --ir
				function modalPage(page, id, idPage, title, text, btn){
			    if(checkStat()) return false
					id 		= $('#id').val()
					if(text) $("#labelDesc").show()
					else $("#labelDesc").hide()
      		$('#modalPage').show()
      		$('.modal-title').html((page)+"  Page")
					$('#id').val(id)
					$('#idPage').val(idPage)
					$('#actionPage').val(page)

					if(page != "welcome" || page != "thanks") $('.btnPage, #btnPage').hide()
					else $('.btnPage, #btnPage').show()

					if(page != "create"){
						$('#titlePage').val(title)
						$('#textCopy').html(text)
						window.getSelection()
    				.selectAllChildren(
    				  document.getElementById("textCopy") 
    				);
  					document.execCommand("copy");
						$("#textCopy").hide()
						
						// alert($('#modalPage text').html())
						// quill.setText();
						// $('#textPage').html(text)
						$('#btnPage').val(btn)
					}
				}

				// CLOSE MODAL --ir 
				function closeModalPage(){
					$('#idPage').val('')
					$('#actionPage').val('')
					$('#titlePage').val('')
					$('#textCopy').empty()
					$("#textCopy").show()
					quill.setText('');
					// $('#textPage').html('')
					$('#btnPage').val('')
      	  $('#modalPage').hide()
				}

				// FUNCTION UPDATE WELCOME OR THANKS STEPS --ir
      	function updatePage(){
					var id				 = $('#id').val()
					var idPage		 = $('#idPage').val()
					var page   		 = $('#actionPage').val()
					var titlePage  = $('#titlePage').val()
					// var textPage	 = $('#textPage').html()
					var textPage	 = quill.root.innerHTML
					var btnPage		 = $('#btnPage').val()

					if(page == "welcome"){
						text2 = "Welcome"
					} else if(page == "thanks"){
						text2 = "Thanks"
					} else text2 = page
					
					if(page == "create") text = "Add this "+titlePage+" page?"
					else text = "Are you sure you wanna change this "+text2+" page?"

					swal({
						title 						 : "Hold up!",
						text 							 : text,
						type							 : "info",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-info",
						confirmButtonText	 : "Yes!", 
						cancelButtonText	 : "No, nevermind!",
						closeOnConfirm		 : false,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
      	  		  type		 : "POST",
      	  		  dataType : "JSON",
      	  		  url 		 : '<?php echo base_url('MstSurvey/updatePage') ?>',
      	  		  data		 : {page:page, id:id, idPage:idPage, titlePage:titlePage, textPage:textPage, btnPage:btnPage},
      	  		  success  : function(data){
      	  		    if(data=='success'){
										if(page != "create") text  = "Success update "+page+" Page!";
										else text  = "Success add "+titlePage+" Page!";
										title = "Success"
      	  		    }else{
										if(page != "create") text = "Failed to update "+page+" Page!";
										else text = "Failed to add "+titlePage+" Page!";
										title = "Warning"
      	  		    }
      	  		  },
      	  		  beforeSend: function(){
								
      	  		  },complete: function(){
									closeModalPage();
									swal({title : title, text  : text, type	: title.toLowerCase()}) 
									if(title==="Success") changeSurvey(id)
      	  		  },
      	  		});
						}else{
							swal("Canceled", "Your "+text2+" Page did not changed!", "success");
						}	
					})
      	}

				// SHOW TABLE QUESTIONS --ir
				function showQ(id, idPage, pageTitle, desc) {
					$('#idPage').val(idPage)
					$('#tablePages, #btnAddPage').hide()
					$('#tableQ, #goBack, #addQ, #btnDuplicatePage, #pageTitle, #pageDesc').show()
					$('#pageTitle').html("<b>"+pageTitle+"</b>")
					$('#pageDesc').html(desc)
					changePage()
				}

				// SHOW TABLE PAGES --ir
				function showPages() {
					$('#idPage').val('')
					$('#tablePages, #btnAddPage').show()
					$('#tableQ, #goBack, #addQ, #btnDuplicatePage, #pageTitle, #pageDesc').hide()
					$('#pageTitle, #pageDesc').empty()
				}

				// SHOW MODAL UPDATE OR ADD QUESTIONS --ir
				function modalQ(q, idQ, title, text, type, reqQ, cat_risk) {
			    if(checkStat()) return false
					idPage = $('#idPage').val()
					$('#idQ').val(idQ)
					$('#actionQ').val(q)
					$('#modalQ').show()
					$('.modal-title').html("<h3>Question for <b>"+$('#pageTitle').html()+"</b></h3>")
					// $('#typeAns, .typeAns').show()
					if(q != "create"){
						// $('#typeAns, .typeAns').hide()
						$('#titleQ').val(title)
						$('#textQ').val(text)
						$('#typeAns').val(type)
						$('#reqQ').val(reqQ)
						$('#cat_risk').val(cat_risk)
					}
				}

				// CLOSE MODAL QUESTIONS --ir
				function closeModalQ() {
					$('#idQ').val('')
					$('#titleQ').val('')
					$('#textQ').val('')
					$('#typeAns').val('')
					$('#reqQ').val('')
					$('#actionQ').val('')
					$('#modalQ').hide()
				}

				// FUNCTION UPDATE OR ADD QUESTIONS --ir
      	function updateQ(){
					var id				 = $('#id').val()
					var idPage		 = $('#idPage').val()
					var idQ		 		 = $('#idQ').val()
					var titleQ  	 = $('#titleQ').val()
					var textQ	 		 = $('#textQ').val()
					var typeAns		 = $('#typeAns').val()
					var reqQ		 	 = $('#reqQ').val()
					var cat_risk		 	 = $('#cat_risk').val()
					var q					 = $('#actionQ').val()

					if(q == "create") text = "Add this question?"
					else text = "Are you sure you wanna change this question?"

					swal({
						title 						 : "Hold up!",
						text 							 : text,
						type							 : "info",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-info",
						confirmButtonText	 : "Yes!", 
						cancelButtonText	 : "No, nevermind!",
						closeOnConfirm		 : false,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
      	  		  type		 : "POST",
      	  		  dataType : "JSON",
      	  		  url 		 : '<?php echo base_url('MstSurvey/updateQ') ?>',
      	  		  data		 : {q:q, id:id, idPage:idPage, idQ:idQ, titleQ:titleQ, textQ:textQ, typeAns:typeAns, reqQ:reqQ, cat_risk:cat_risk},
      	  		  success  : function(data){
      	  		    if(data=='success'){
										text  = "Success "+q+" question!";
										title = "Success"
      	  		    }else{
										text  = "Failed to "+q+" question!";
										title = "Warning"
      	  		    }
      	  		  },
      	  		  beforeSend: function(){
								
      	  		  },complete: function(){
									closeModalQ();
									swal({title : title, text  : text, type	: title.toLowerCase()}) 
									if(title==="Success") changePage()
      	  		  },
      	  		});
						}else{
							swal("Canceled", "This has not been changed!", "success");
						}	
					})
      	}

				// CHANGE PAGES AND SET THE QUESTIONS
				function changePage(idPage) {
					idPage = $('#idPage').val()
					$('#tBodyQ').empty()

					$.ajax({
  			    url : '<?php echo base_url('General/pageQuestionsAnswers') ?>',
  			    type: "post",
  			    data: {idPage:idPage},
  			    dataType: "JSON",
  			    success: function(data) {
  			      // REMOVE ALL OPTIONS --ir
							var a = 0
							var length = data.length
							$.each(data, function() {
								a++
								// SET ROW PAGES IF EXIST --ir
								if(nullToBlank(this.title) != ""){
									$('#tBodyQ').append('<tr data-order="'+this.sort+'" class="site_heading"></tr>')

									$('#tBodyQ').find('tr:last').append('<td align="center"></td>')
									$('#tBodyQ').find('tr:last td:last').append('<span></span>');
									$('#tBodyQ').find('tr:last td:last span').append("<button class='btnMinus btn btn-sm' value="+this.sort+"  onclick='changeOrder2(\""+this.id+"\", \"minus\", \"#tBodyQ\")'><i class='fa fa-arrow-up'></i></button>")
									$('#tBodyQ').find('tr:last td:last span').append("<button class='btnOrder btn btn-sm' value="+this.sort+" >"+this.sort+"</button>")
									$('#tBodyQ').find('tr:last td:last span').append("<button class='btnPlus btn btn-sm' value="+this.sort+" onclick='changeOrder2(\""+this.id+"\", \"plus\", \"#tBodyQ\")'><i class='fa fa-arrow-down'></i></button>")
									$('#tBodyQ').find('tr:last td:last span .btnMinus').attr('id', 'minus'+this.id)
									$('#tBodyQ').find('tr:last td:last span .btnOrder').attr('id', 'order'+this.id)
									$('#tBodyQ').find('tr:last td:last span .btnPlus').attr('id', 'plus'+this.id)

									$('#tBodyQ').find('tr:last').append('<td align="center"><b>'+nullToBlank(this.title)+'</b></td>')
									$('#tBodyQ').find('tr:last').append('<td align="center">'+nullToBlank(this.desc)+'</td>')
									$('#tBodyQ').find('tr:last').append('<td align="center">'+nullToBlank(this.type)+'</td>')

									$('#tBodyQ').find('tr:last').append('<td align="center"></td>')
									
									if(this.answer != ''){
										// SET THE ANSWERS FOR EACH OF QUESTIONS --ir
										answer = []
										risk = []
										$.each(this.answer, function() {
											if(this.rightAns == "y") rightAns = "<i class='fa fa-check-circle fa-lg' style='color:dodgerblue'></i>"
											else if(this.rightAns == "n") rightAns = "<i class='fa fa-times-circle fa-lg' style='color:tomato'></i>"
											else rightAns = ''
											$('#tBodyQ').find('tr:last td:last').append('<b>'+nullToBlank(this.title)+'</b>&nbsp;&nbsp;'+rightAns+'('+this.risk+') <hr style="margin-bottom:10px; margin-top:10px">')
											answer.push(this.title)
											risk.push(this.risk)
										})
										answer = answer.join(" /***/ ")
										risk = risk.join(" /***/ ")
										// console.log(answer)
										// console.log(risk)
										// answer = this.answer 
										$('#tBodyQ').find('tr:last td:last').append("<button class='modalAns btn btn-warning btn-md' onclick='modalAns(\"update\", \""+this.id+"\", \"\", \""+nullToBlank(this.title)+"\", \""+nullToBlank(this.type)+"\", \""+nullToBlank(this.multi)+"\", \""+answer+"\", \""+risk+"\")'><i class='fa fa-pencil'></i> Change</button>")
									}else{
										$('#tBodyQ').find('tr:last td:last').append("<button class='modalAns btn btn-primary btn-md' onclick='modalAns(\"create\", \""+this.id+"\", \"\", \""+nullToBlank(this.title)+"\", \""+nullToBlank(this.type)+"\", \""+nullToBlank(this.multi)+"\", \"\", \"\")'><i class='fa fa-plus'></i> Add</button>")
									}

									$('#tBodyQ').find('tr:last').append('<td align="center"></td>')
									$('#tBodyQ').find('tr:last td:last').append('<span></span>')
									$('#tBodyQ').find('tr:last td:last span').append("<button class='modalQ  btn btn-success btn-md' onclick='modalQ(\"update\", \""+this.id+"\", \""+nullToBlank(this.title)+"\", \""+nullToBlank(this.desc)+"\", \""+nullToBlank(this.type)+"\", \""+nullToBlank(this.reqQ)+"\", \""+nullToBlank(this.cat_risk)+"\")'><i class='fa fa-edit'></i></button>")
									$('#tBodyQ').find('tr:last td:last span').append("<button class='delRow btn btn-danger btn-md'  onclick='delRow(\"question\", \""+this.id+"\", \""+nullToBlank(this.title)+"\")'><i class='fa fa-trash'></i></button>")
									
									if(nullToBlank(this.status) == "0"){
										btn  = "default"
										icon = "eye-slash"
									}else{
										btn  = "info"
										icon = "eye"
									}
									$('#tBodyQ').find('tr:last td:last span').append("<button class='statPage  btn btn-"+btn+" btn-md' onclick='changeStatus(\"question\", \""+this.id+"\", \""+this.status+"\")'><i class='fa fa-"+icon+"'></i></button>")
									$('#tBodyQ').find('tr:last td:last span').append("<button class='duplicateQ  btn btn-warning btn-md' onclick='duplicate(\"question\", \""+this.id+"\")'><i class='fa fa-copy'></i></button>")
														
									
									$('#tBodyQ').find('td').css({'vertical-align' : 'middle'})
									$('#tBodyQ').find('button').not('.modalAns').css({'margin' : '3px', 'width' : '40px'})
								}
							})
  					},	
  			    error: function() {
  			      swal({title : "Failed", text  : "Failed to load this survey!", type	: "error"})
  			    }, 
  			    complete: function() {
  						RowOrder();
							// alert(tQ)
							// alert(rowsQ)
  			    } 
  			  })
				}

				function duplicate(obj, id='') {
					idSurvey = $('#id').val()
					idPage 	 = $('#idPage').val()
					idQ 	 	 = id
					if(obj == "survey") id=$('#id').val()
					if(obj == "page") 	id=$('#idPage').val()

					swal({
						title 						 : "Hold on!",
						text 							 : "Are you sure to duplicate this "+obj+"?",
						type							 : "warning",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-info",
						confirmButtonText	 : "Yes, duplicate this!", 
						cancelButtonText	 : "No, nevermind!",
						closeOnConfirm		 : false,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
								type 			: 'POST',
								dataType 	: 'JSON',
								url 			: '<?php echo base_url().'MstSurvey/duplicate/' ?>',
								data 			: {id:id, idSurvey:idSurvey, idPage:idPage, idQ:idQ, obj:obj},
								success 	: function(data) {
									if (data === "success") {
									}else{
										swal('Failed!', ''+obj.toUpperCase()+' has failed to duplicate!', "warning");
									}
									// $('#order'+id).val(value)
									// $('#order'+id).html(value)
								},	
  						  error: function() {
									swal('Failed!', ''+obj.toUpperCase()+' has failed to duplicate!', "warning");
  						  },	
  						  complete: function() {
										closeModal()
										swal('Success!', ''+obj.charAt(0).toUpperCase() + obj.substr(1).toLowerCase()+' has been duplicate!', "success");
										if(obj == "survey") surveyLists("", "")
										if(obj == "page") changeSurvey(idSurvey)
										if(obj == "question") changePage()
									// id = $('#id').val()
									// changeSurvey(id)
  						  }	
							})
						}else{
							swal("Canceled", "", "success");
						}	
					})
				}

				// SHOW MODAL UPDATE OR ADD QUESTIONS --ir
				function modalAns(q, idQ, idAns, title, type, multi, answer,risk) {
			    if(checkStat()) return false
			    	// alert(answer)
					if(answer){
						answer = answer.split(" /***/ ")
						for (let index = 0; index < answer.length; index++) {
							if(index>0) addMoreAnswers()
							$('#titleAns'+index).val(answer[index])
							// alert(answer[index])
						}
					}

					if(risk){
						risk = risk.split(" /***/ ")
						// console.log(risk)
						for (let index = 0; index < risk.length; index++) {
							// if(index>0) addMoreAnswers()
							// $('#skorAns'+index+' selected').val(risk[index])
							// $('select>option:eq('+index+')').attr('selected', true);
							$('#skorAns'+index+' [value='+risk[index]+']').attr('selected', 'true');
							// console.log(index)
							// alert(risk[index])
						}
					}
					// length = answer.length
					// alert(answer)
					// $.each(answer, function() {
					// 	alert("dsa")
					// })
					// console.log(idAns)
					$('#idQ').val(idQ)
					$('#idAns').val(idAns)
					$('#multi').val(multi)
					$('#actionAns').val(q)
					$('#modalAns').show()
					$('.modal-title').html("<h3>Answer for <b>"+title+"</b></h3>")
					if(type == "rating") $('.modal-desc').html("Scale from up to down!")
					$('#typeAns2').val(type)
					if(multi == "yes"){ $('#btnAddAnswer').show(); $('#btnResetAnswer').show(); $('#btnRightAns').show(); }
					if(q != "create"){
					}
				}

				// CLOSE MODAL ANSWERS --ir
				function closeModalAns(multi) {
					$('#titleAns0').val('')
					$('.modal-desc').val('')
					if(multi != "nsdsad"){
						$('#idQ').val('')
						$('#idAns').val('')
						$('#multi').val('')
						$('#typeAns2').val('')
						$('#actionAns').val('')
						$('#modalAns').hide()
						$('#moreAnswersCol').empty()
						$('#btnAddAnswer').hide()
						$('#btnResetAnswer').hide()
					}
				}

				function addMoreAnswers() {
					countAnswersCount = 1
					answerCount = $("input[class*='moreAnswer']").length+1
					$('#moreAnswersCol').append('<div class="form-inline" id="rowAnswer'+answerCount+'"></div>');
					$('#moreAnswersCol').find('.form-inline:last').append('<div class="form-group" style="width:100%"></div>');

					// $('#moreAnswersCol').find('.form-inline:last .form-group:last').append('<br><input type="text" id="titleAns'+answerCount+'" name="titleAns'+answerCount+'" class="moreAnswer form-control"">&nbsp;&nbsp;');

					$('#moreAnswersCol').find('.form-inline:last .form-group:last').append('<br/><div class="col-md-6" style="padding: 0 0;"><input type="text" id="titleAns'+answerCount+'" name="titleAns'+answerCount+'" class="moreAnswer form-control""></div>');

					$('#moreAnswersCol').find('.form-inline:last .form-group:last').append('<div class="col-md-4""><select class="select2_demo_1 form-control" style="width: 100% !important;" id="skorAns'+answerCount+'" name="skorAns'+answerCount+'" ><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="27">27</option></select></div>');

					$('#moreAnswersCol').find('.form-inline:last .form-group:last').append('<a style="heigth:100%" id="btnRemoveAnswer'+answerCount+'" class="btn btn-danger btn-md" onclick="removeAnswer(\''+answerCount+'\')"><i class="fa fa-close" style="color:white"></i></a>&nbsp;&nbsp;');

					$('#moreAnswersCol').find('.form-inline:last .form-group:last').append('<a style="heigth:100%; color:white; display:none" value="o" id="btnRightAns'+answerCount+'" class="rightAns btn btn-warning btn-md" onclick="rightAnswer(\''+answerCount+'\')">Wrong Answer <i class="fa fa-close" style="color:white"></i></a>');
				}

				function removeAnswer(no) {
					row = "#rowAnswer"+no
					ans = "#titleAns"+no
					$(ans).val('')
					$(row).hide()
				}

				function resetAnswers() {
					if(!$.trim($('#moreAnswersCol').html())) { swal("There's nothing to reset!", "", "warning"); return false }
					swal({
						title 						 : "Hold on!",
						text 							 : "Are you sure to reset all these answers?",
						type							 : "warning",
						showCancelButton 	 : true,
						confirmButtonClass : "btn-danger",
						confirmButtonText	 : "Yes, delete these!", 
						cancelButtonText	 : "No, nevermind!",
						closeOnConfirm		 : false,
						closeOnCancel			 : false
					},
					function(isConfirm) {
						if (isConfirm) {
							$('#moreAnswersCol').empty()
							swal("All Reset!", "", "success");
						}else{
							swal("Canceled", "", "success");
						}	
					});
				}

				function showRightAns() {
					if($('.rightAns').is(':visible')){
						$(".rightAns").hide()
						resetRightAns()
					}else{
						$(".rightAns").show()
					}
				}

				function resetRightAns(act) {
					if(act) value = "n"
					else value = "o"
					$(".rightAns").removeClass("btn btn-warning btn-success btn-md").addClass("btn btn-warning btn-md").empty().val(value).append('Wrong Answer <i class="fa fa-close" style="color:white"></i>')
				}

				function rightAnswer(no) {
					resetRightAns("set")
					$("#btnRightAns"+no).removeClass("btn-warning").addClass("btn-success").empty().val("y").append('Right Answer <i class="fa fa-check" style="color:white"></i>')
				}

				// FUNCTION UPDATE OR ADD QUESTIONS --ir
      	function updateAns(){
					var id				 = $('#id').val()
					var idPage		 = $('#idPage').val()
					var idQ		 		 = $('#idQ').val()
					var idAns		 	 = $('#idAns').val()
					var titleAns   = $('#titleAns0').val()
					var typeAns		 = $('#typeAns2').val()
					var multi		   = $('#multi').val()
					var q					 = $('#actionAns').val()

					var form 			= $('#formAns')[0]
					var formData 	= new FormData(form)
					formData.append('id', id)
					formData.append('idPage', idPage)
					formData.append('idQ', idQ)
					formData.append('idAns', idAns)
					formData.append('titleAns0', titleAns)
					formData.append('rightAns0', "n")
					formData.append('typeAns', typeAns)
					formData.append('multi', multi)
					formData.append('q', q)

					answerCount = $("input[class*='moreAnswer']").length
					formData.append('answerCount', answerCount)
					let x = 1, y = 1
					$('input.moreAnswer').each(function() {
						rowAns   = $(this).val()
						formData.append('titleAns'+(x++), rowAns)
					})
					$('a.rightAns').each(function() {
						rightAns   = $(this).val()
						formData.append('rightAns'+(y++), rightAns)
					})

					console.log(formData)

					$.ajax({
      	    method		 	: "POST",
      	    dataType 		: "JSON",
      	    url 		 		: '<?php echo base_url('MstSurvey/updateAns') ?>',
      	    // data		 : {q:q, id:id, idPage:idPage, idAns:idAns, idQ:idQ, titleAns:titleAns, typeAns:typeAns},
						data 				: formData,
        		processData : false,
        		contentType : false,
        		cache 			: false,
      	    success  : function(data){
      	      if(data == 'success'){
								text  = "Success "+q+" question!";
								title = "Success"
      	      }else{
								text  = "Failed to "+q+" question!";
								title = "Warning"
      	      }
      	    },
      	    beforeSend: function(){
						
      	    },complete: function(){
							closeModalAns(multi)
							swal({title : title, text  : text, type	: title.toLowerCase()}) 
							if(title==="Success") changePage()
      	    },
      	  });
      	}

				// DYNAMICALLY SET ORDER ON EACH PAGES OR QUESTIONS --ir
				function changeOrder2(id, order, idTable) {
			    // if(!check('edit')) return false
					maxValue = $(idTable+' tr').length
					if(idTable.includes("Pages")) maxValue = maxValue-2
					var value = $('#order'+id).val()
					if(order === "plus" && value < maxValue) value++
					else if(order === "minus" && value > 1) value--
					
					$('#order'+id).val(value)
					$('#order'+id).html(value)
					if(idTable.includes("Pages")) var table = "page"
					if(idTable.includes("Q")) var table = "question"
					// alert(maxValue+idTable)
					// return true
					$.ajax({
						type 			: 'POST',
						dataType 	: 'JSON',
						url 			: '<?php echo base_url().'MstSurvey/changeOrder/' ?>',
						data 			: {id:id, value:value, table:table},
						success 	: function(data) {
							$('#order'+id).val(value)
							$('#order'+id).html(value)
						},	
  				  error: function() {
  				    alert('Failed to change order!');
  				  },	
  				  complete: function() {
							// id = $('#id').val()
							// changeSurvey(id)
  				  }	
					})
				}

				function RowOrder(tables) {
					var table = $('#tQ');
					if(tables=="page") var table = $('#tPage');
					// alert(table)
  				var rows = table.find('tr.site_heading').get();
					// alert(rowsQ)
  			  rows.sort(function(a, b) {
  			    var keyA = $(a).attr('data-order');
  			    var keyB = $(b).attr('data-order');
						// alert(keyA)
  			    if (!keyA || !keyB) return -1;
  			    if (keyA > keyB) return 1;
  			    if (keyA < keyB) return -1;
  			    return 0;
  			  });
				
  			  $.each(rows, function(index, row) {
						if(tables == "question") table.find('#tBodyQ').append(row);//.attr("data-order", index+1);
						else table.find('#tBodyPages').append(row);//.attr("data-order", index+1);
  			  });
				
  			  // Set data-order
  			  $.each(rows, function(index, row) {
  			    $(this).attr("data-order", index+1);
  			  });
  			}

				function changeOrder(id, order, table) {
					if(order == "up"){
  				  var thisRow = $(id).closest("tr");
  				  var prevRow = $(id).closest("tr").prev(".site_heading");
  				  var thisRowVal = thisRow.find('.btnOrder')
  				  var prevRowVal = prevRow.find('.btnOrder')
						// alert(thisRowVal.val())
						// alert(prevRowVal.val())

  				  newOrder = prevRow.attr("data-order");
  				  oldOrder = thisRow.attr("data-order");

  				  thisRow.attr("data-order", newOrder);
  				  prevRow.attr("data-order", oldOrder);
						if(newOrder && oldOrder){
  				  	thisRowVal.html(newOrder);
							thisRowVal.val(newOrder)
							setOrder(thisRowVal.attr("id"), newOrder, table)
  				  	prevRowVal.html(oldOrder);
							prevRowVal.val(oldOrder);
							setOrder(prevRowVal.attr("id"), oldOrder, table)
  				  	RowOrder(table);
						}
					}else{
						var thisRow = $(id).closest("tr");
  				  var nextRow = $(id).closest("tr").next(".site_heading");
						var thisRowVal = thisRow.find('.btnOrder')
  				  var nextRowVal = nextRow.find('.btnOrder')
						// alert(thisRowVal.val())
						// alert(nextRowVal.val())
					
  				  oldOrder = thisRow.attr("data-order");
  				  newOrder = nextRow.attr("data-order");
					
  				  thisRow.attr("data-order", newOrder);
  				  nextRow.attr("data-order", oldOrder);
						if(newOrder && oldOrder){
							thisRowVal.html(newOrder)
							thisRowVal.val(newOrder)
							setOrder(thisRowVal.attr("id"), newOrder, table)
  				  	nextRowVal.html(oldOrder);
  				  	nextRowVal.val(oldOrder);
							setOrder(nextRowVal.attr("id"), oldOrder, table)
  				  	RowOrder(table);
						}
					}

				}

				// DYNAMICALLY SET ORDER ON EACH PAGES OR QUESTIONS --ir
				function setOrder(id, value, table) {
					$.ajax({
						type 			: 'POST',
						dataType 	: 'JSON',
						url 			: '<?php echo base_url().'MstSurvey/changeOrder/' ?>',
						data 			: {id:id, value:value, table:table},
						success 	: function(data) {
							$('#order'+id).val(value)
							$('#order'+id).html(value)
						},	
  				  error: function() {
  				    alert('Failed to change order!');
  				  },	
  				  complete: function() {
							// id = $('#id').val()
							// changeSurvey(id)
  				  }	
					})
				}
				// DELETE SURVEY/PAGE/QUESTION/ANSWER --ir
				function delRow(type, id, title) {
			    if(checkStat()) return false
					idSurvey = $('#id').val()
					idPage   = $('#idPage').val()
					idQ      = $('#idQ').val()

					if(type == "page"){
						 idPage = id
					}else if(type == "question"){
						 idQ = id
					}else{
						title = $('#surveys :selected').html()
					}
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
								data 			: {type:type, idSurvey:idSurvey, idPage:idPage, idQ:idQ},
								dataType	: "JSON",
								success 	: function(data){
									if(data == "success"){
										swal({title : "Success", text : "Success delete "+type+" "+title+"!", type : "success"})
									}else{
										swal({title : "Failed", text : "Failed to delete "+type+" "+title+"!", type : "error"})
									}
								},complete: function(){
									if(type == "survey") surveyLists("", "")
									else if(type == "page") changeSurvey(idSurvey)
									else if(type == "question") changePage(idPage)
      	  		  },
							});
						}else{
							swal("Canceled", "Your "+type+" is safe!", "success");
						}	
					});
				}

			</script>
    </body>
</html>