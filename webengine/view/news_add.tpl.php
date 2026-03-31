<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Naree HANDBAGS :: BACKOFFICE</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.css" />
        <!-- #ADD INC -->
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />
        <!-- /ADD INC

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
		if ((document.getElementById('title_la').value == '')&&(document.getElementById('title_en').value == '')) {	
      alert(' กรุณากรอก Title :');
      document.getElementById('title_la').focus();
      return false;
    }	
	$('#description_la').val($('#editor1').html());
	$('#description_en').val($('#editor2').html());		
    SetAction('news_action.php');
    //return true;
  }
}

function SetAction(url) {
	document.getElementById('form1').action = url;
	document.getElementById('form1').target = '_self';
	document.getElementById('form1').submit();
}
</script>

	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<?php require_once("inc_top.php"); ?>
		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			   <?php require_once("inc_sidebar.php");?>
			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Home</a>
							</li>
							<li class="active">News</li>
						</ul><!-- /.breadcrumb -->
						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<div class="page-header">
							<h1><?php echo $this->news_category->title_la?></h1>
						</div><!-- /.page-header -->

						<div class="row">
                        <form class="form-horizontal" role="form" name="form1" id="form1" method="post" enctype="multipart/form-data" action="news_action.php">
                        <div class="tabbable">
                        	<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#thai">
														<i class="green ace-icon fa fa-edit bigger-120"></i>
														Content (LAO)
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#eng">
														<i class="green ace-icon fa fa-edit bigger-120"></i>
														Content (EN)
													</a>
												</li>
											</ul>
											<div class="tab-content">
												<div id="thai" class="tab-pane fade in active">
													<!--<p>Raw denim you probably haven't heard of them jean shorts Austin.</p> -->
                                                    <h3 class="header smaller lighter blue">News (LAO)</h3>
                                        <BR>
										<!-- <div class="dataTables_borderWrap"> -->
										<div style="background-color:#FFF">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%">Title (LAO) &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="title_la" name="title_la" value="<?php echo  ($this->item->title_la != null) ? $this->item->title_la : '' ?>" placeholder="Title" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Display Date  &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="date_show" name="date_show" value="<?php echo  ($this->item->date_show != null) ? $this->item->date_show : '' ?>" placeholder="Display Date" class="col-xs-6" /> (Ex. 12-15.09.2016)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Subject (LAO) &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="subject_la" name="subject_la" value="<?php echo  ($this->item->subject_la != null) ? $this->item->subject_la : '' ?>" placeholder="Subject" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Description (LAO) &nbsp;: </td>
    <td>&nbsp;</td>
    <td><div class="wysiwyg-editor" id="editor1"></div><input type="hidden" name="description_la" id="description_la"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="14%">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="86%">&nbsp;</td>
    </tr>
    <tr>
    <td>Image (Thumbnail) &nbsp;: </td>
    <td>&nbsp;</td>
    <td><?php if ($this->item->image != null) { ?>
    <a href="../../img_news/" target="_blank"><img src="../../img_news/<?php echo $this->item->image?>" /></a><br />
	<?php } // if ?>
	<input type="file" id="image" name="image" value="" placeholder="Image" class="col-xs-10 col-sm-5" /></td>
  </tr>
     <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="30px">Image JPG size 650 x 440 px.</td>
  </tr> 
    
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
      <td>File Attachment &nbsp;: </td>
      <td>&nbsp;</td>
      <td><?php if ($this->item->file_doc != null) { ?>
        <a href="../../img_news/document/<?php echo $this->item->file_doc?>" target="_blank"><?php echo $this->item->file_doc?></a><br /><br />
        <?php } // if ?>
        <input type="file" id="file_doc" name="file_doc" value="" placeholder="File" class="col-xs-10 col-sm-5" /></td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="30px">File Attachment</td>
  </tr>   
  <tr>
    <td>Link Video (Youtube) &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="url_youtube" name="url_youtube" value="<?php echo  ($this->item->url_youtube != null) ? $this->item->url_youtube : '' ?>" placeholder="URL Youtube" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Create Date &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="created_date" name="created_date" value="<?php echo  ($this->item->created_date != null) ?  date('j/m/Y', strtotime($this->item->created_date)) : date('j/m/Y') ?>" data-date-format="dd/mm/yyyy" class="date-picker col-xs-2" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Update Date &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="update_date" name="update_date" value="<?php echo  ($this->item->update_date != null) ?  date('j/m/Y', strtotime($this->item->update_date)) : date('j/m/Y') ?>" data-date-format="dd/mm/yyyy" class="date-picker col-xs-2" disabled /></td>
  </tr>
   <!--
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Publish Date &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="publish_date" name="publish_date" value="" data-date-format="dd/mm/yyyy" class="date-picker col-xs-2" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>End Date &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="end_date" name="end_date" value="" data-date-format="dd/mm/yyyy" class="date-picker col-xs-2" /></td>
  </tr> -->
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 
    <tr>
    <td>Status &nbsp;: </td>
    <td>&nbsp;</td>
    <td><select name="status" id="status" class="col-sm-2" style="width:150px;">
    <option value="0"<?php echo  ($this->item->status == 0) ? ' selected' : '' ?>>Disable</option>
    <option value="1"<?php echo  ($this->item->status == 1) ? ' selected' : '' ?>>Display All</option>
    <option value="2"<?php echo  ($this->item->status == 2) ? ' selected' : '' ?>>Display LAO Only</option>
    <option value="3"<?php echo  ($this->item->status == 3) ? ' selected' : '' ?>>Display EN Only</option>
    </select><span class="lbl"></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>  
  </table>
									
										</div>
												</div>
                                                <div id="eng" class="tab-pane fade">
												 <h3 class="header smaller lighter blue">News (EN)</h3>
                                        <BR>
										<!-- <div class="dataTables_borderWrap"> -->
										<div style="background-color:#FFF">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%">Title (EN) &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="title_en" name="title_en" value="<?php echo  ($this->item->title_en != null) ? $this->item->title_en : '' ?>" placeholder="Title" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Subject (EN) &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="subject_en" name="subject_en" value="<?php echo  ($this->item->subject_en != null) ? $this->item->subject_en : '' ?>" placeholder="Subject" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Description (EN) &nbsp;: </td>
    <td>&nbsp;</td>
    <td><div class="wysiwyg-editor" id="editor2"></div><input type="hidden" name="description_en" id="description_en"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr></table>
									
										</div>
												</div>

											</div>
                                            <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
                                        <input type="hidden" id="parent_id" name="parent_id" value="<?php echo  ($this->parent_id != null) ? $this->parent_id : '' ?>" />
                                        <input type="hidden" id="do" name="do" value="insert" />
											<button class="btn btn-info" type="button" onClick="return checkForm('save')">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="button" onclick="location.href='news_list.php?mn=4&sub=2'">
												<i class="ace-icon fa fa-times bigger-110"></i>
												Cancel
											</button>
										</div>
									</div>
										</div>
                       		</form>
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<script type="text/javascript">
									var $path_assets = "../assets";//this will be used in loading jQuery UI if needed!
								</script>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php require_once("inc_footer.php"); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

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

		<script src="../assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="../assets/js/jquery-ui.custom.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.js"></script>
		<script src="../assets/js/markdown/markdown.js"></script>
		<script src="../assets/js/markdown/bootstrap-markdown.js"></script>
		<script src="../assets/js/jquery.hotkeys.js"></script>
		<script src="../assets/js/bootstrap-wysiwyg.js"></script>
		<script src="../assets/js/bootbox.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.js"></script>
		<!-- ace scripts -->
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

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($){
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
	
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
	$('#editor1').css({'height':'200px'}).ace_wysiwyg({
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


	$('#editor2').css({'height':'200px'}).ace_wysiwyg({
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
	</body>
</html>