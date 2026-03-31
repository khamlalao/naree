<?php
require_once "common.inc.php";
require_once DIR."library/config/sessionstart.php";
//require_once DIR."library/config/checksessionlogin.php";
require_once DIR."library/adodb5/adodb.inc.php";
require_once DIR."library/adodb5/adodb-active-record.inc.php";
require_once DIR."library/config/config.php";
require_once DIR."library/config/connect.php";
require_once DIR."library/extension/extension.php";
require_once DIR."library/extension/utility.php";
require_once DIR."library/extension/lang.php";
require_once DIR."library/config/rewrite.php";
require_once DIR."library/class/class.upload2.php";
require_once DIR."library/Savant3.php";
?>
<?php
//$db->debug = 1;

$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$upload_max_size = 10 * 1024 * 1024;
$upload_temp_path = "../../temp/";
$upload_path = "../../img_banner/";

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "insert" :
  
      $sql = "SELECT Count(banner_items.id) AS amout FROM banner_items ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
      $gettmp["sequence"] = $rs->fields["amout"] + 1;  
  
    class banner_item extends ADOdb_Active_Record{}
    $item = new banner_item();
    
    if ($gettmp["parent_id"] != null) {
      $item->parent_id = $gettmp["parent_id"];
    } else {
      $item->parent_id = 0;
    }
    $item->sequence = $gettmp["sequence"];		
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->url_la = ($_POST["url_la"] != null) ? encodeToDB($_POST["url_la"]) : null;
    $item->url_en = ($_POST["url_en"] != null) ? encodeToDB($_POST["url_en"]) : null;
	$item->status = ($_POST["status"] != null) ? $_POST["status"] : '0';
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
  
   if ($_POST["publish_date"] != null) {
      list($pb_day,$pb_month,$pb_year) = explode("/",$_POST["publish_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->publish_date = date("Y-m-d", strtotime($pb_year."-".$pb_month."-".$pb_day));
    } else {
      $item->publish_date = null;
    }    
   if ($_POST["end_date"] != null) {
      list($end_day,$end_month,$end_year) = explode("/",$_POST["end_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->end_date = date("Y-m-d", strtotime($end_year."-".$end_month."-".$end_day));
    } else {
      $item->end_date = null;
    }	
   
    if ($item->save()) {

      $update = false;
      
      // Upload image Desktop
      if ($_FILES["file_name_la"] != null) {
        $gettmp["file_name_la"] = $item->file_name_la;
        $upload = new upload($_FILES["file_name_la"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-desk-th-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
      //        if ($upload->image_src_x > 226 || $upload->image_src_y > 152) 
			  $upload->image_resize = true;
              $upload->image_x = 1440;
              $upload->image_y = 714;
          //    $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_la = $upload->file_dst_name;
              
			   $upload->file_overwrite = true;
              if ($upload->image_src_y > 100) 
			  $upload->image_resize = true;
           //   $upload->image_x = 508;
              $upload->image_y = 100;
              $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."thumbnail/");
               
              $upload->clean();
      
              if ($gettmp["file_name_la"] != null) {
                if (file_exists($upload_path.$gettmp["file_name_la"])) unlink($upload_path.$gettmp["file_name_la"]);
                if (file_exists($upload_path."thumbnail/".$gettmp["file_name_la"])) unlink($upload_path."thumbnail/".$gettmp["file_name_la"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }
		
		
      if ($_FILES["file_name_en"] != null) {
        $gettmp["file_name_en"] = $item->file_name_en;
        $upload = new upload($_FILES["file_name_en"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-desk-en-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
      //        if ($upload->image_src_x > 226 || $upload->image_src_y > 152) 
			  $upload->image_resize = true;
              $upload->image_x = 1440;
              $upload->image_y = 714;
          //    $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_en = $upload->file_dst_name;
              
			   $upload->file_overwrite = true;
              if ($upload->image_src_y > 100) 
			  $upload->image_resize = true;
           //   $upload->image_x = 508;
              $upload->image_y = 100;
              $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."thumbnail/");
               
              $upload->clean();
      
              if ($gettmp["file_name_en"] != null) {
                if (file_exists($upload_path.$gettmp["file_name_en"])) unlink($upload_path.$gettmp["file_name_en"]);
                if (file_exists($upload_path."thumbnail/".$gettmp["file_name_en"])) unlink($upload_path."thumbnail/".$gettmp["file_name_en"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }


		
		
      // Upload image Mobile Version
      if ($_FILES["file_name_mobile_la"] != null) {
        $gettmp["file_name_mobile_la"] = $item->file_name_mobile_la;
        $upload = new upload($_FILES["file_name_mobile_la"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-file_name_mobile_la-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
       //       if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
	          $upload->image_resize = true;
              $upload->image_x = 960;
              $upload->image_y = 550;
      //        $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."mobile/");
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_mobile_la = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["file_name_mobile_la"] != null) {
                if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_la"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_la"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	  		



      if ($_FILES["file_name_mobile_en"] != null) {
        $gettmp["file_name_mobile_en"] = $item->file_name_mobile_en;
        $upload = new upload($_FILES["file_name_mobile_en"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-file_name_mobile_en-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
       //       if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
	          $upload->image_resize = true;
              $upload->image_x = 960;
              $upload->image_y = 550;
      //        $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."mobile/");
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_mobile_en = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["file_name_mobile_en"] != null) {
                if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_en"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_en"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	  		
		
		
		// SET Sequence
		$gettmp["sequence"] = $_POST["sequence"];
        if ($item->sequence != $gettmp["sequence"]) : 
          $update = true;
          $sql = "SELECT Count(banner_items.id) AS amount FROM banner_items";
          $stmt = $db->Prepare($sql);
          $rs = $db->Execute($stmt);
          $max = $rs->fields["amount"]; 
          
          if ($item->sequence != $gettmp["sequence"]) : 
            if ($gettmp["sequence"] < 1) : 
              $gettmp["sequence"] = 1;
            endif;
            if ($gettmp["sequence"] > $max) : 
              $gettmp["sequence"] = $max;
            endif;
            if ($item->sequence > $gettmp["sequence"]) : 
              $sql = "UPDATE banner_items SET banner_items.sequence = banner_items.sequence + 1 WHERE banner_items.sequence >= ? AND banner_items.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE banner_items SET banner_items.sequence = banner_items.sequence - 1 WHERE banner_items.sequence > ? AND banner_items.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;		
		
       if ($update) {
        $item->Replace();
      }
    
      $render = "banner_list.php?mn=2&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "banner_list.php?mn=2&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
    class banner_item extends ADOdb_Active_Record{}
    $item = new banner_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->url_la = ($_POST["url_la"] != null) ? encodeToDB($_POST["url_la"]) : null;
    $item->url_en = ($_POST["url_en"] != null) ? encodeToDB($_POST["url_en"]) : null;
	$item->status = ($_POST["status"] != null) ? $_POST["status"] : '0';
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
	
   if ($_POST["publish_date"] != null) {
      list($pb_day,$pb_month,$pb_year) = explode("/",$_POST["publish_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->publish_date = date("Y-m-d", strtotime($pb_year."-".$pb_month."-".$pb_day));
    } else {
      $item->publish_date = null;
    }    
   if ($_POST["end_date"] != null) {
      list($end_day,$end_month,$end_year) = explode("/",$_POST["end_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->end_date = date("Y-m-d", strtotime($end_year."-".$end_month."-".$end_day));
    } else {
      $item->end_date = null;
    }		
	
   
    if ($item->Replace()) {

      $update = false;
      
      // Upload image Desktop
      if ($_FILES["file_name_la"] != null) {
        $gettmp["file_name_la"] = $item->file_name_la;
        $upload = new upload($_FILES["file_name_la"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-desk-th-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
      //        if ($upload->image_src_x > 226 || $upload->image_src_y > 152) 
			  $upload->image_resize = true;
              $upload->image_x = 1440;
              $upload->image_y = 714;
          //    $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_la = $upload->file_dst_name;
              
			   $upload->file_overwrite = true;
              if ($upload->image_src_y > 100) 
			  $upload->image_resize = true;
           //   $upload->image_x = 508;
              $upload->image_y = 100;
              $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."thumbnail/");
               
              $upload->clean();
      
              if ($gettmp["file_name_la"] != null) {
                if (file_exists($upload_path.$gettmp["file_name_la"])) unlink($upload_path.$gettmp["file_name_la"]);
                if (file_exists($upload_path."thumbnail/".$gettmp["file_name_la"])) unlink($upload_path."thumbnail/".$gettmp["file_name_la"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }
		
		
      if ($_FILES["file_name_en"] != null) {
        $gettmp["file_name_en"] = $item->file_name_en;
        $upload = new upload($_FILES["file_name_en"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-desk-en-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
      //        if ($upload->image_src_x > 226 || $upload->image_src_y > 152) 
			  $upload->image_resize = true;
              $upload->image_x = 1440;
              $upload->image_y = 714;
          //    $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_en = $upload->file_dst_name;
              
			   $upload->file_overwrite = true;
              if ($upload->image_src_y > 100) 
			  $upload->image_resize = true;
           //   $upload->image_x = 508;
              $upload->image_y = 100;
              $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."thumbnail/");
               
              $upload->clean();
      
              if ($gettmp["file_name_en"] != null) {
                if (file_exists($upload_path.$gettmp["file_name_en"])) unlink($upload_path.$gettmp["file_name_en"]);
                if (file_exists($upload_path."thumbnail/".$gettmp["file_name_en"])) unlink($upload_path."thumbnail/".$gettmp["file_name_en"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }


		
		
      // Upload image Mobile Version
      if ($_FILES["file_name_mobile_la"] != null) {
        $gettmp["file_name_mobile_la"] = $item->file_name_mobile_la;
        $upload = new upload($_FILES["file_name_mobile_la"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-file_name_mobile_la-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
       //       if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
	          $upload->image_resize = true;
              $upload->image_x = 960;
              $upload->image_y = 550;
      //        $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."mobile/");
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_mobile_la = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["file_name_mobile_la"] != null) {
                if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_la"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_la"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	  		



      if ($_FILES["file_name_mobile_en"] != null) {
        $gettmp["file_name_mobile_en"] = $item->file_name_mobile_en;
        $upload = new upload($_FILES["file_name_mobile_en"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-file_name_mobile_en-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
       //       if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
	          $upload->image_resize = true;
              $upload->image_x = 960;
              $upload->image_y = 550;
      //        $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."mobile/");
            if ($upload->processed) {
              $update = true;
      
              $item->file_name_mobile_en = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["file_name_mobile_en"] != null) {
                if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_en"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_en"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	  		
		
		
		// SET Sequence
		$gettmp["sequence"] = $_POST["sequence"];
        if ($item->sequence != $gettmp["sequence"]) : 
          $update = true;
          $sql = "SELECT Count(banner_items.id) AS amount FROM banner_items";
          $stmt = $db->Prepare($sql);
          $rs = $db->Execute($stmt);
          $max = $rs->fields["amount"]; 
          
          if ($item->sequence != $gettmp["sequence"]) : 
            if ($gettmp["sequence"] < 1) : 
              $gettmp["sequence"] = 1;
            endif;
            if ($gettmp["sequence"] > $max) : 
              $gettmp["sequence"] = $max;
            endif;
            if ($item->sequence > $gettmp["sequence"]) : 
              $sql = "UPDATE banner_items SET banner_items.sequence = banner_items.sequence + 1 WHERE banner_items.sequence >= ? AND banner_items.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE banner_items SET banner_items.sequence = banner_items.sequence - 1 WHERE banner_items.sequence > ? AND banner_items.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;	 		

           
      if ($update) {
        $item->Replace();
      }
    
      $render = "banner_list.php?mn=2&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "banner_list.php?mn=2&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
 
  case "delete" : 
    class banner_item extends ADOdb_Active_Record{}
    $item = new banner_item();
    $item->load("id = ?", array($gettmp["id"]));
	$gettmp["file_name_la"] = $item->file_name_la;
	$gettmp["file_name_en"] = $item->file_name_en;
	$gettmp["file_name_mobile_la"] = $item->file_name_mobile_la;
	$gettmp["file_name_mobile_en"] = $item->file_name_mobile_en;
    if($item->Delete()){
		  if ($gettmp["file_name_la"] != null) : 
           if (file_exists($upload_path."thumbnail/".$gettmp["file_name_la"])) unlink($upload_path."thumbnail/".$gettmp["file_name_la"]);
           if (file_exists($upload_path.$gettmp["file_name_la"])) unlink($upload_path.$gettmp["file_name_la"]);
          endif;  
		  if ($gettmp["file_name_en"] != null) : 
           if (file_exists($upload_path."thumbnail/".$gettmp["file_name_en"])) unlink($upload_path."thumbnail/".$gettmp["file_name_en"]);
           if (file_exists($upload_path.$gettmp["file_name_en"])) unlink($upload_path.$gettmp["file_name_en"]);
          endif; 		    
	      if ($gettmp["file_name_mobile_la"] != null) : 
           if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_la"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_la"]);
          endif;
	      if ($gettmp["file_name_mobile_en"] != null) : 
           if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_en"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_en"]);
          endif;		      		  
		  
	}

    saverecord("Delete Banner");
      $render = "banner_list.php?mn=2&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;

    case "listupdate" :                            
                       
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];        
        $gettmp["to"] = $_POST["sequence_new"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM banner_items WHERE banner_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"];   
        $gettmp["parent_id"] = $rs->fields["parent_id"];   
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM banner_items");
        $rs = $db->Execute($stmt);
        $max = $rs->fields["amount"]; 
                                  
        if ($sequence != $gettmp["to"]) :  
          if ($gettmp["to"] < 1) :     
            $gettmp["to"] = 1;
          endif;  
          if ($gettmp["to"] > $max) :    
            $gettmp["to"] = $max;
          endif;
          if ($sequence > $gettmp["to"]) : 
            $stmt = $db->Prepare("UPDATE banner_items SET banner_items.sequence = banner_items.sequence + 1 WHERE banner_items.sequence >= ? AND banner_items.sequence < ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $sequence));
            $stmt = $db->Prepare("UPDATE banner_items SET banner_items.sequence = ? WHERE banner_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));  
          else :                      
            $stmt = $db->Prepare("UPDATE banner_items SET banner_items.sequence = banner_items.sequence - 1 WHERE banner_items.sequence > ? AND banner_items.sequence <= ? ");
            $rs = $db->Execute($stmt, array($sequence, $gettmp["to"]));
            $stmt = $db->Prepare("UPDATE banner_items SET banner_items.sequence = ? WHERE banner_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));     
          endif;   
        endif;     
      endforeach;                       
                     

      $render = "banner_list.php?mn=2&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");

      saverecord("Save Data Item");        
      break; 

  case "listdelete" :
      
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM banner_items WHERE banner_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"]; 
        $gettmp["file_name_la"] = $rs->fields["file_name_la"];	
		$gettmp["file_name_en"] = $rs->fields["file_name_en"]; 	    
        $gettmp["file_name_mobile_la"] = $rs->fields["file_name_mobile_la"];	
		$gettmp["file_name_mobile_en"] = $rs->fields["file_name_mobile_en"];   
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM banner_items");
        $rs = $db->Execute($stmt);
        $max = $rs->fields["amount"]; 
        
        if ($sequence < $max) :                                                                                     
          $stmt = $db->Prepare("UPDATE banner_items SET banner_items.sequence = banner_items.sequence - 1 WHERE banner_items.sequence > ?  ");
          $rs = $db->Execute($stmt, array($sequence));           
        endif;                      
                                  
 		 if ($gettmp["file_name_la"] != null) : 
           if (file_exists($upload_path."thumbnail/".$gettmp["file_name_la"])) unlink($upload_path."thumbnail/".$gettmp["file_name_la"]);
           if (file_exists($upload_path.$gettmp["file_name_la"])) unlink($upload_path.$gettmp["file_name_la"]);
          endif;  
		  if ($gettmp["file_name_en"] != null) : 
           if (file_exists($upload_path."thumbnail/".$gettmp["file_name_en"])) unlink($upload_path."thumbnail/".$gettmp["file_name_en"]);
           if (file_exists($upload_path.$gettmp["file_name_en"])) unlink($upload_path.$gettmp["file_name_en"]);
          endif; 		    
	      if ($gettmp["file_name_mobile_la"] != null) : 
           if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_la"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_la"]);
          endif;
	      if ($gettmp["file_name_mobile_en"] != null) : 
           if (file_exists($upload_path."mobile/".$gettmp["file_name_mobile_en"])) unlink($upload_path."mobile/".$gettmp["file_name_mobile_en"]);
          endif;	
			  								                  
        $stmt = $db->Prepare("DELETE FROM banner_items WHERE banner_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      

      saverecord("Delete Status Image News");
      $render = "banner_list.php?mn=2&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");        
      break;   
   
}

//$template->display($render);
?>