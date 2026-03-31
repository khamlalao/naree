										<div class="col-xs-12">
										<h3 class="header smaller lighter blue">User Management</h3>
										<!-- <div class="table-responsive"> -->

										<!-- <div class="dataTables_borderWrap"> -->
										<div>
											<?php if (is_array($this->listAdmin)) { ?>
											<table id="inc-list-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															<label class="position-relative">
																No
																<span class="lbl"></span>
															</label>
														</th>
														<th>Username</th>
														<th>Name</th>
														<th> User type</th>
														<th>Status</th>
														<th>Manage</th>
													</tr>
												</thead>
												<tbody>
												<?php $i=1; foreach ($this->listAdmin as $val) { ?>                                                
													<tr>
														<td class="center">
															<label class="position-relative">
																<?php echo $i?>
																<span class="lbl"></span>
															</label>
														</td>

														<td>
															<a href="" target="_blank"><?php echo $val['username']?></a>
														</td>
														<td><?php echo  encodeFromDB($val['name']) ?> <?php echo  encodeFromDB($val['surname']) ?></td>
														<td><?php echo Lang::getAdminType($val['st_member']); ?> </td>
														<td><?php if($val['status'] == '1'){?><span class="label label-sm label-success">Active</span><?php }else{ ?><span class="label label-sm label-warning">Inactive</span><?php } ?></td>
														<td align="center"><?php if($val['id'] != '1'){ ?>
                                                        <div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="admin_list.php?listitem=admin_edit&id=<?php echo  $val['id'] ?>&menu=4Lij4Liy4Lii4LiK4Li34LmI4Lit4LmA4LiI4LmJ4Liy4Lir4LiZ4LmJ4Liy4LiX4Li14LmI&active=7"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
																<a class="red" href="admin_action.php?do=delete&id=<?php echo  $val['id'] ?>&menu=<?php echo  $this->menu ?>" onClick="return confirm('Do you want to delete ?')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>  
															</div><?php }else{ ?>ADMINISTRATOR<?php } ?></td>
													</tr>
												<?php $i++; } // for ?>      
												</tbody>
											</table>
											<?php } // if  ?><BR />
                                           <button class="btn btn-info" type="button" onclick="location.href='admin_list.php?listitem=admin_add&menu=VXNlciBNYW5hZ2VtZW50&active=7'">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Add User
											</button>  
										</div>
									</div>

		<!-- basic scripts -->
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
                  
		<!-- page specific plugin scripts -->
		<script src="../assets/js/jquery.dataTables.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>
    
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
    jQuery(function($) {
      $('#inc-list-table').dataTable({
        bAutoWidth : false,
        "aoColumns" : [
          null,
          null,
          null,
          null,		  
          null
        ],
        "aaSorting": []
      });
    });
    </script>		