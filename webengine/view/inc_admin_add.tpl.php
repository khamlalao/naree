
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="../assets/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.js"></script>
		<![endif]-->
    
<script language="javascript" type="text/javascript">
function checkForm(){
  with(document.form1){
		if (document.getElementById('st_member').value == '') {	
      alert(' Please Key User Type');
      document.getElementById('st_member').focus();
      return false;
    }		  
		if (document.getElementById('username').value == '') {	
      alert(' Please Key Username :');
      document.getElementById('username').focus();
      return false;
    }	
		if (document.getElementById('password').value == '') {	
      alert(' Please Key Password :');
      document.getElementById('password').focus();
      return false;
    }	

	    SetAction('admin_action.php');
    //return true;
  }
}

function SetAction(url) {
	document.getElementById('form1').action = url;
	document.getElementById('form1').target = '_self';
	document.getElementById('form1').submit();
}
</script>

<div class="col-xs-12">
										<h3 class="header smaller lighter blue">User </h3>
                                        <BR>
										<!-- <div class="dataTables_borderWrap"> -->
                    
                    
                    
										<div>
                    
								<form class="form-horizontal" role="form" name="form1" id="form1" method="post" enctype="multipart/form-data" action="">
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="title"> USERNAME </label>
										<div class="col-sm-9">
											<input type="text" id="username" name="username" value="<?php echo  ($this->admin->username != null) ? $this->admin->username : '' ?>" placeholder="USERNAME" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                  
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="subject"> PASSWORD </label>
										<div class="col-sm-9">
											<input type="text" id="password" name="password" value="<?php echo  ($this->admin->password != null) ? $this->admin->password : '' ?>" placeholder="PASSWORD" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                  
                 
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="subject"> Name </label>
										<div class="col-sm-9">
											<input type="text" id="name" name="name" value="<?php echo  ($this->admin->name != null) ? $this->admin->name : '' ?>" placeholder="NAME" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="subject"> Surname </label>
										<div class="col-sm-9">
											<input type="text" id="surname" name="surname" value="<?php echo  ($this->admin->surname != null) ? $this->admin->surname : '' ?>" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                  
									<!--<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="created_date"> Started Date  </label>
										<div class="col-sm-9">
											<div class="input-group col-xs-10 col-sm-5">
											<input type="text" id="begin_date" name="begin_date" value="<?php //= ($this->admin->begin_date != null) ?  date('j/m/Y', strtotime($this->admin->begin_date)) : '' ?>" data-date-format="dd/mm/yyyy" class="form-control date-picker col-xs-10 col-sm-5" />
											<span class="input-group-addon">
											  <i class="fa fa-calendar bigger-110"></i>
											</span>
											
											</div>
										</div>
									</div> 
                  
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="created_date"> End Date  </label>
										<div class="col-sm-9">
											<div class="input-group col-xs-10 col-sm-5">
											<input type="text" id="end_date" name="end_date" value="<?php //= ($this->admin->end_date != null) ?  date('j/m/Y', strtotime($this->admin->end_date)) : '' ?>" data-date-format="dd/mm/yyyy" class="form-control date-picker col-xs-10 col-sm-5" />
											<span class="input-group-addon">
											  <i class="fa fa-calendar bigger-110"></i>
											</span>
											</div>
										</div>
									</div>
                                    -->
                                    <input type="hidden" id="begin_date" name="begin_date" value="<?php echo  ($this->admin->begin_date != null) ?  date('j/m/Y', strtotime($this->admin->begin_date)) : '' ?>" />
                                    <input type="hidden" id="end_date" name="end_date" value="<?php echo  ($this->admin->begin_date != null) ?  date('j/m/Y', strtotime($this->admin->begin_date)) : '' ?>" />
                  
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="subject"> Email </label>
										<div class="col-sm-9">
											<input type="text" id="email" name="email" value="<?php echo  ($this->admin->email != null) ? $this->admin->email : '' ?>" placeholder="Email" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="subject"> Telephone </label>
										<div class="col-sm-9">
											<input type="text" id="tel" name="tel" value="<?php echo  ($this->admin->tel != null) ? $this->admin->tel : '' ?>" placeholder="Telephone" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                  
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="subject"> User role</label>
										<div class="col-sm-9">
											<input type="text" id="position" name="position" value="<?php echo  ($this->admin->position != null) ? $this->admin->position : '' ?>" placeholder="User role" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                  
                  <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="created_date"> Created  </label>
										<div class="col-sm-9">
											<div class="input-group col-xs-10 col-sm-5">
											<input type="text" id="created_date" name="created_date" value="<?php echo  ($this->admin->created_date != null) ?  date('j/m/Y', strtotime($this->admin->created_date)) : date('j/m/Y') ?>" data-date-format="dd/mm/yyyy" class="form-control date-picker col-xs-10 col-sm-5" />
											<span class="input-group-addon">
											  <i class="fa fa-calendar bigger-110"></i>
											</span>
											</div>
										</div>
                  </div>
                  
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="subject"> Updated </label>
										<div class="col-sm-9">
											<input type="text" id="updated_date" name="updated_date" value="<?php echo  ($this->admin->updated_date != null) ?  date('j/m/Y', strtotime($this->admin->updated_date)) : date('j/m/Y') ?>" class="col-xs-10 col-sm-5" readonly="readonly" />
										</div>
									</div>
                  
                  
                  <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="status"> Status  </label>
										<div class="col-sm-9">
                    <input type="checkbox" id="status" name="status" value="1" class="ace ace-switch ace-switch-4 btn-empty"<?php echo  ($this->admin->status == 1) ? ' checked="checked"' : '' ?> />
										  <span class="lbl"></span>
										</div>
                  </div>
                  
                  
                  
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
                   						 <input type="hidden" id="do" name="do" value="insert" />
                                         <input type="hidden" id="st_member" name="st_member" value="3" />
										 <button class="btn btn-info" type="button" onClick="return checkForm('save')">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="button" onclick="location.href='admin_list.php?listitem=admin&menu=<?php echo  $this->menu ?>&active=7'">
												<i class="ace-icon fa fa-times bigger-110"></i>
												Cancel
											</button>
										</div>
									</div>
                  
                  
                  
                  
                  
                  
								</form>
                  
											
										</div>
									</div>	



		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<!-- 
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.js"></script>
		 -->
		
		<!-- page specific plugin scripts -->
		<script src="../assets/js/jquery-ui.custom.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.js"></script>
		<script src="../assets/js/markdown/markdown.js"></script>
		<script src="../assets/js/markdown/bootstrap-markdown.js"></script>
		<script src="../assets/js/jquery.hotkeys.js"></script>
		<script src="../assets/js/bootstrap-wysiwyg.js"></script>
		<script src="../assets/js/bootbox.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.js"></script>
		<!-- 
		<script src="../assets/js/chosen.jquery.js"></script>
		<script src="../assets/js/date-time/bootstrap-timepicker.js"></script>
		<script src="../assets/js/date-time/moment.js"></script>
		<script src="../assets/js/jquery.autosize.js"></script>
		<script src="../assets/js/jquery.maskedinput.js"></script>
		 -->

		<!-- ace scripts -->
		<!-- 
		<script src="../assets/js/ace/elements.scroller.js"></script>
		<script src="../assets/js/ace/elements.colorpicker.js"></script>
		<script src="../assets/js/ace/elements.fileinput.js"></script>
		<script src="../assets/js/ace/elements.typeahead.js"></script>
		<script src="../assets/js/ace/elements.wysiwyg.js"></script>
		<script src="../assets/js/ace/elements.spinner.js"></script>
		<script src="../assets/js/ace/elements.treeview.js"></script>
		<script src="../assets/js/ace/elements.wizard.js"></script>
		<script src="../assets/js/ace/elements.aside.js"></script>
		<script src="../assets/js/ace/ace.js"></script>
		<script src="../assets/js/ace/ace.ajax-content.js"></script>
		<script src="../assets/js/ace/ace.touch-drag.js"></script>
		<script src="../assets/js/ace/ace.sidebar.js"></script>
		<script src="../assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="../assets/js/ace/ace.submenu-hover.js"></script>
		<script src="../assets/js/ace/ace.widget-box.js"></script>
		<script src="../assets/js/ace/ace.settings.js"></script>
		<script src="../assets/js/ace/ace.settings-rtl.js"></script>
		<script src="../assets/js/ace/ace.settings-skin.js"></script>
		<script src="../assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="../assets/js/ace/ace.searchbox-autocomplete.js"></script>
		 -->
		
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				
	  if ($("#st_member").val() == '1') {
	    $('#show_group').hide();
	  } else if ($("#st_member").val() == '2') {
	    $('#show_group').show();
	  } else if ($("#st_member").val() == '3') {
	    $('#show_group').hide();
	  } else {
	    $('#show_group').hide();
	  }
		
  $("#st_member").change(function(){
	  if ($("#st_member").val() == '1') {
	    $('#show_group').hide();
	  } else if ($("#st_member").val() == '2') {
	    $('#show_group').show();
	  } else if ($("#st_member").val() == '3') {
	    $('#show_group').hide();
	  } else {
	    $('#show_group').hide();
	  }
  });

				$.get('ajax_get_dropdown_corp_province.php', {
				  //id : $('#form1_corp_part').val(),
				  id : '<?php echo  ($_SESSION['admin_form']['corp_part'] != null) ? $_SESSION['admin_form']['corp_part'] : (($this->admin->corp_part != null) ? $this->admin->corp_part : '') ?>',
				  time : new Date().getTime()
				}, function(data) {
				  $('#corp_province').html(data);
				  $('#corp_province').val('<?php echo  ($_SESSION['admin_form']['corp_province'] != null) ? $_SESSION['admin_form']['corp_province'] : (($this->province->id != null) ? $this->province->id : '') ?>');
				});
				
				$("#corp_part").change(function(){
				  if ($('#corp_part').val() != '') {
				    $.get('ajax_get_dropdown_corp_province.php', {
				      id : $('#corp_part').val(),
				      time : new Date().getTime()
				    }, function(data) {
				      $('#corp_province').html(data);
				    });
				  }
				});
				
				
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
				
				$(document).one('ajaxloadstart.page', function(e) {
					$('textarea[class*=autosize]').trigger('autosize.destroy');
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($){
	
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			//console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	}

	//$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

	//but we want to change a few buttons colors for the third style
	$('#editor1').ace_wysiwyg({
		toolbar:
		[
			'font',
			null,
			'fontSize',
			null,
			{name:'bold', className:'btn-info'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,
			{name:'insertunorderedlist', className:'btn-success'},
			{name:'insertorderedlist', className:'btn-success'},
			{name:'outdent', className:'btn-purple'},
			{name:'indent', className:'btn-purple'},
			null,
			{name:'justifyleft', className:'btn-primary'},
			{name:'justifycenter', className:'btn-primary'},
			{name:'justifyright', className:'btn-primary'},
			{name:'justifyfull', className:'btn-inverse'},
			null,
			{name:'createLink', className:'btn-pink'},
			{name:'unlink', className:'btn-pink'},
			null,
			{name:'insertImage', className:'btn-success'},
			null,
			'foreColor',
			null,
			{name:'undo', className:'btn-grey'},
			{name:'redo', className:'btn-grey'}
		],
		'wysiwyg': {
			fileUploadError: showErrorAlert
		}
	}).prev().addClass('wysiwyg-style2');
	
	/**
	//make the editor have all the available height
	$(window).on('resize.editor', function() {
		var offset = $('#editor1').parent().offset();
		var winHeight =  $(this).height();
		
		$('#editor1').css({'height':winHeight - offset.top - 10, 'max-height': 'none'});
	}).triggerHandler('resize.editor');
	*/

	$('[data-toggle="buttons"] .btn').on('click', function(e){
		var target = $(this).find('input[type=radio]');
		var which = parseInt(target.val());
		var toolbar = $('#editor1').prev().get(0);
		if(which >= 1 && which <= 4) {
			toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
			if(which == 1) $(toolbar).addClass('wysiwyg-style1');
			else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
			if(which == 4) {
				$(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
			} else $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
		}
	});

	//RESIZE IMAGE
	
	//Add Image Resize Functionality to Chrome and Safari
	//webkit browsers don't have image resize functionality when content is editable
	//so let's add something using jQuery UI resizable
	//another option would be opening a dialog for user to enter dimensions.
	if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {
		
		var lastResizableImg = null;
		function destroyResizable() {
			if(lastResizableImg == null) return;
			lastResizableImg.resizable( "destroy" );
			lastResizableImg.removeData('resizable');
			lastResizableImg = null;
		}

		var enableImageResize = function() {
			$('.wysiwyg-editor')
			.on('mousedown', function(e) {
				var target = $(e.target);
				if( e.target instanceof HTMLImageElement ) {
					if( !target.data('resizable') ) {
						target.resizable({
							aspectRatio: e.target.width / e.target.height,
						});
						target.data('resizable', true);
						
						if( lastResizableImg != null ) {
							//disable previous resizable image
							lastResizableImg.resizable( "destroy" );
							lastResizableImg.removeData('resizable');
						}
						lastResizableImg = target;
					}
				}
			})
			.on('click', function(e) {
				if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
					destroyResizable();
				}
			})
			.on('keydown', function() {
				destroyResizable();
			});
	    }

		enableImageResize();

		/**
		//or we can load the jQuery UI dynamically only if needed
		if (typeof jQuery.ui !== 'undefined') enableImageResize();
		else {//load jQuery UI if not loaded
			$.getScript($path_assets+"/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
				enableImageResize()
			});
		}
		*/
	}

});
		</script>

		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="../assets/css/ace.onpage-help.css" />
		<link rel="stylesheet" href="../docs/assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="../assets/js/ace/elements.onpage-help.js"></script>
		<script src="../assets/js/ace/ace.onpage-help.js"></script>
		<script src="../docs/assets/js/rainbow.js"></script>
		<script src="../docs/assets/js/language/generic.js"></script>
		<script src="../docs/assets/js/language/html.js"></script>
		<script src="../docs/assets/js/language/css.js"></script>
		<script src="../docs/assets/js/language/javascript.js"></script>
<?php unset($_SESSION['admin_form']); ?>