<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>NAREE HANDBAGS :: BACKOFFICE</title>

		<meta name="description" content="Static &amp; Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->

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
   if (document.getElementById('title_la').value == '') {	
      alert(' Please Key Title Name SHop :');
      document.getElementById('title_la').focus();
      return false;
    }
   if (document.getElementById('title_en').value == '') {	
      alert(' Please Key Title Name SHop :');
      document.getElementById('title_en').focus();
      return false;
    }
   if (document.getElementById('address_en').value == '') {	
      alert(' Please Key Address SHop :');
      document.getElementById('address_en').focus();
      return false;
    }
   if (document.getElementById('address_la').value == '') {	
      alert(' Please Key Address SHop :');
      document.getElementById('address_la').focus();
      return false;
    }		
			
    SetAction('shop_action.php');
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
							<li class="active">Shop Management</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
								
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />


<form class="form-horizontal" role="form" name="form1" id="form1" method="post" enctype="multipart/form-data" action="shop_action.php">
<div class="tabbable">
											<div class="tab-content">
												<div id="thai" class="tab-pane fade in active">
													<!--<p>Raw denim you probably haven't heard of them jean shorts Austin.</p> -->
                                                    <h3 class="header smaller lighter blue">Shop Management</h3>
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
    <td width="14%">Address (LAO) &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="address_la" name="address_la" value="<?php echo  ($this->item->address_la != null) ? $this->item->address_la : '' ?>" placeholder="Address" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="14%">Address (EN) &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="address_en" name="address_en" value="<?php echo  ($this->item->address_en != null) ? $this->item->address_en : '' ?>" placeholder="Address" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="14%">Phone &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="phone" name="phone" value="<?php echo  ($this->item->phone != null) ? $this->item->phone : '' ?>" placeholder="phone" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td width="14%">Mobile &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="mobile" name="mobile" value="<?php echo  ($this->item->mobile != null) ? $this->item->mobile : '' ?>" placeholder="mobile" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td width="14%">Line ID &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="line_id" name="line_id" value="<?php echo  ($this->item->line_id != null) ? $this->item->line_id : '' ?>" placeholder="line_id" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td width="14%">WhatsApp &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="whatsapp" name="whatsapp" value="<?php echo  ($this->item->whatsapp != null) ? $this->item->whatsapp : '' ?>" placeholder="whatsapp" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td width="14%">Facebook &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="facebook" name="facebook" value="<?php echo  ($this->item->facebook != null) ? $this->item->facebook : '' ?>" placeholder="facebook" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td width="14%">Instagram &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="instagram" name="instagram" value="<?php echo  ($this->item->instagram != null) ? $this->item->instagram : '' ?>" placeholder="Instagram" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td width="14%">Google Map (URL) &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="gmap" name="gmap" value="<?php echo  ($this->item->gmap != null) ? $this->item->gmap : '' ?>" placeholder="Title" class="col-xs-6" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="14%">Sequence &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="sequence" name="sequence" value="<?php echo $this->sequence?>"  class="col-sm-2" style="width:50px; text-align:center" maxlength="2" /></td>
  </tr>
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
       </select>
       </td>
   </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>  
  </table>
									
										</div>
												</div>

											</div>
                                            <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
                                        <input type="hidden" id="do" name="do" value="insert" />
											<button class="btn btn-info" type="button" onClick="return checkForm('save')">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="button" onclick="location.href='javascript:window.history.back();'">
												<i class="ace-icon fa fa-times bigger-110"></i>
												Cancel
											</button>
										</div>
									</div>
										</div>
		</form>									
		</div>

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