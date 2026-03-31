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
							<li class="active">Banner Management</li>
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


    
<script language="javascript" type="text/javascript">
function checkForm(){
  with(document.form1){
   if (document.getElementById('file_name_la').value == '') {	
      alert(' กรุณาใส่ไฟล์แนบ :');
      document.getElementById('file_name_la').focus();
      return false;
    }		
   if (document.getElementById('file_name_en').value == '') {	
      alert(' กรุณาใส่ไฟล์แนบ :');
      document.getElementById('file_name_en').focus();
      return false;
    }		
				
    SetAction('banner_action.php');
    //return true;
  }
}

function SetAction(url) {
	document.getElementById('form1').action = url;
	document.getElementById('form1').target = '_self';
	document.getElementById('form1').submit();
}
</script>
<form class="form-horizontal" role="form" name="form1" id="form1" method="post" enctype="multipart/form-data" action="banner_action.php">
<div class="tabbable">
											<div class="tab-content">
												<div id="thai" class="tab-pane fade in active">
													<!--<p>Raw denim you probably haven't heard of them jean shorts Austin.</p> -->
                                                    <h3 class="header smaller lighter blue">Banner Management</h3>
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
    <td width="14%">URL (LAO) &nbsp;: </td>
    <td width="0%">&nbsp;</td>
    <td width="86%"><input type="text" id="url_la" name="url_la" value="<?php echo  ($this->item->url_la != null) ? $this->item->url_la : '' ?>" placeholder="URL" class="col-xs-6" /></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><SPAN style="color:#CCC">Ex. http://www.nareeLAObrand.com/</SPAN></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>Image Desktop (LAO) &nbsp;: </td>
    <td>&nbsp;</td>
    <td>
	<input type="file" id="file_name_la" name="file_name_la" value="" placeholder="Image" class="col-xs-10 col-sm-5" /></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><SPAN style="color:#F00">Image jpg Desktop 1366x446 px. </SPAN></td>
  </tr>  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
      <tr>
        <td>Title (EN) &nbsp;: </td>
        <td>&nbsp;</td>
        <td><input type="text" id="title_en" name="title_en" value="<?php echo  ($this->item->title_en != null) ? $this->item->title_en : '' ?>" placeholder="Title" class="col-xs-6" /></td>
      </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>URL (EN) &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="url_en" name="url_en" value="<?php echo  ($this->item->url_en != null) ? $this->item->url_en : '' ?>" placeholder="URL" class="col-xs-6" /></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><SPAN style="color:#CCC">Ex. http://www.nareeLAObrand.com/</SPAN></td>
  </tr> 
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>Image Desktop (EN) &nbsp;: </td>
    <td>&nbsp;</td>
    <td>
	<input type="file" id="file_name_en" name="file_name_en" value="" placeholder="Image" class="col-xs-10 col-sm-5" /></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><SPAN style="color:#F00">Image Desktop 1366x446 px. </SPAN></td>
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
    <td>Publish Date &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="publish_date" name="publish_date" value="<?php echo  ($this->item->publish_date != null) ?  date('j/m/Y', strtotime($this->item->publish_date)) : date('j/m/Y') ?>" data-date-format="dd/mm/yyyy" class="date-picker col-xs-2" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>End Date &nbsp;: </td>
    <td>&nbsp;</td>
    <td><input type="text" id="end_date" name="end_date" value="<?php echo  ($this->item->end_date != null) ?  date('j/m/Y', strtotime($this->item->end_date)) : date('j/m/Y') ?>" data-date-format="dd/mm/yyyy" class="date-picker col-xs-2" /></td>
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
    <option value="0">Disable</option>
    <option value="1" selected>Display All</option>
    <option value="2">Display LAO Only</option>
    <option value="3">Display EN Only</option>
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
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
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
			jQuery(function($) {
				
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})	
								
				var oTable1 = 
				$('#sample-table-2')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			    } );
				/**
				var tableTools = new $.fn.dataTable.TableTools( oTable1, {
					"sSwfPath": "../../copy_csv_xls_pdf.swf",
			        "buttons": [
			            "copy",
			            "csv",
			            "xls",
						"pdf",
			            "print"
			        ]
			    } );
			    $( tableTools.fnContainer() ).insertBefore('#sample-table-2');
				*/
				
				
				//oTable1.fnAdjustColumnSizing();
			
			
				$(document).on('click', 'th input:checkbox' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			})
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
