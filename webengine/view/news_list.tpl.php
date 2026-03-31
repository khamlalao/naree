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
		function chkform(){
			//alert("sss");
			 SetAction('news_action.php?do=deletelist&mn=3&menu=TmV3cw');
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

					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">NEWS</h3>
                                        <BR>
										<!-- <div class="dataTables_borderWrap"> -->
										<div>
                                        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center" width="5%">
                                                           <label class="position-relative">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
                                                         </th>
														<th width="30%">Title (LAO)</th>
                                                        <th width="30%">Title (EN)</th>
														<th width="10%">Media</th>
														<th width="10%"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Create</th>
														<th width="10%">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Update
														</th>
														<th width="7%">Status</th>
														<th width="8%">Manage</th>
													</tr>
												</thead>

												<tbody>
                        
													<!-- BEGIN LOOP -->
													<?php if ($this->itemListCount > 0) { ?>
                                                      <?php $i = 0; ?>
                                                      <?php foreach ($this->itemList as $val) { ?> 
                                                      <?php $i++;?>
                                                    <tr>
														<td align="center">
														<label class="position-relative">
																<input type="checkbox" class="ace" name="chkbox[]" id="chkbox" value="<?php echo $i?>" />
																<span class="lbl"></span>
															</label>
                                                            <input type="hidden" name="id[]" id="id" value="<?php echo  $val['id'] ?>" />
                                                           </td>
														<td><?php echo  ($val['subject_la'] != null) ? $val['subject_la'] : '' ?></td>
														<td><?php echo  ($val['subject_en'] != null) ? $val['subject_en'] : '' ?></td>
														<td><a href="news_image_list.php?mn=3&sub=2&parent_id=<?php echo $val['id']?>" title="Photo Gallery">
													    <img src="../assets/img/ico-photo.png" width="30" height="30"></a></td>
														<td><?php echo  ($val['created_date'] != null) ?  date('j/m/Y', strtotime($val['created_date'])) : date('j/m/Y') ?></td>
													  <td><?php echo  ($val['update_date'] != null) ?  date('j/m/Y', strtotime($val['update_date'])) : date('j/m/Y') ?></td>

														<td><?php echo Lang::getStatus($val['status'])?></td>

														<td align="center">
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="news_edit.php?id=<?php echo  $val['id'] ?>&mn=3&sub=2">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																  <a class="red" href="news_action.php?id=<?php echo  $val['id'] ?>&do=delete&mn=3&sub=2" onClick="javascript:return confirm('Are you sure you want to delete this item ?')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
															</div>
														</td>
													</tr>
  <?php } // foreach ?>
<?php } // if ?>
                          <!-- END LOOP -->
												</tbody>
											</table>
                                         </form>
                                            <BR>
                                                <button class="btn btn-info" type="button" onclick="location.href='news_add.php?parent_id=<?php echo  $this->parent_id ?>&mn=3&sub=2'">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Add
											</button>  
                                             <button class="btn btn-info" type="button" onclick="return chkform();">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Delete
											</button>    
										</div>
									</div>
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
		<script src="../assets/js/jquery.dataTables.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>

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
				var oTable1 = 
				$('#sample-table-2')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					"pageLength": 25,
			
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
