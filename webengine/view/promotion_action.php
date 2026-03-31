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
#$db->debug = 1;

//if (! in_array($_SESSION['st_member'], array(1, 4))) {
//  die("<meta http-equiv=\"refresh\" content=\"0; URL=login.php\">");
//}
//print_r($_POST);
//echo stripslashes($_POST['description_la']);
//exit();
$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$upload_max_size = 10 * 1024 * 1024;
$upload_temp_path = "../../temp/";
$upload_path = "../../img_promotion/";

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["parent_id"] = ($_REQUEST["parent_id"] != null) ? $_REQUEST["parent_id"] : '1';
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
	  case "deletelist" :
      #print_r($_POST); exit();
 
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];

        $stmt = $db->Prepare("DELETE FROM promotion_items WHERE promotion_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      
      // Set Log.
      saverecord("Delete Promotion");
      
      $render = "promotion_list.php?mn=12&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
	  
  break;
  case "insert" :
    class promotion_item extends ADOdb_Active_Record{}
    $item = new promotion_item();
    
    if ($gettmp["parent_id"] != null) {
      $item->parent_id = $gettmp["parent_id"];
    } else {
      $item->parent_id = 0;
    }
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->date_show = ($_POST["date_show"] != null) ? encodeToDB($_POST["date_show"]) : null;
    $item->subject_la = ($_POST["subject_la"] != null) ? encodeToDB($_POST["subject_la"]) : null;
    $item->description_la = ($_POST["description_la"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["description_la"]))) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->subject_en = ($_POST["subject_en"] != null) ? encodeToDB($_POST["subject_en"]) : null;
    $item->description_en = ($_POST["description_en"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["description_en"]))) : null;
    $item->status = ($_POST["status"] != null) ? $_POST['status'] : "0";
 //   $item->status_hot = ($_POST["status_hot"] == "1") ? "1" : "0";
	
    $item->url_youtube = ($_POST["url_youtube"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["url_youtube"]))) : null;
    if ($_POST["created_date"] != null) {
      list($birth_day,$birth_month,$birth_year) = explode("/",$_POST["created_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->created_date = date("Y-m-d", strtotime($birth_year."-".$birth_month."-".$birth_day));
    } else {
      $item->created_date = null;
    }
    $item->update_date = date("Y-m-d H:i:s");
	
    if ($item->Replace()) {

      $update = false;
      
       // Upload image
      if ($_FILES["image"] != null) {
        $gettmp["image"] = $item->image;
        $upload = new upload($_FILES["image"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
       //       if ($upload->image_src_x > 226 || $upload->image_src_y > 152) 
	          $upload->image_resize = true;
              $upload->image_x = 250;
              $upload->image_y = 169;
         //     $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;

			  $upload->file_overwrite = true;
              if ($upload->image_src_x > 900) 
			  $upload->image_resize = true;
              $upload->image_x = 1000;
          //    $upload->image_y = 413;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."banner/");

              
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
                if (file_exists($upload_path."banner/".$gettmp["image"])) unlink($upload_path."banner/".$gettmp["image"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }

          
  		// Upload file_doc
      if ($_FILES["file_doc"] != null) {
        $gettmp["file_doc"] = $item->file_doc;
        $upload = new upload($_FILES["file_doc"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-file-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."document/");
            if ($upload->processed) {
              $update = true;
              $item->file_doc = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["file_doc"] != null) {
                if (file_exists($upload_path."document/".$gettmp["file_doc"])) unlink($upload_path."document/".$gettmp["file_doc"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	
           
      if ($update) {
        $item->Replace();
      }
    
      $render = "promotion_list.php?mn=12&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "promotion_list.php?mn=12&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
//  $db->debug=1;
    class promotion_item extends ADOdb_Active_Record{}
    $item = new promotion_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->date_show = ($_POST["date_show"] != null) ? encodeToDB($_POST["date_show"]) : null;
    $item->subject_la = ($_POST["subject_la"] != null) ? encodeToDB($_POST["subject_la"]) : null;
    $item->description_la = ($_POST["description_la"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["description_la"]))) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->subject_en = ($_POST["subject_en"] != null) ? encodeToDB($_POST["subject_en"]) : null;
    $item->description_en = ($_POST["description_en"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["description_en"]))) : null;
    $item->status = ($_POST["status"] != null) ? $_POST['status'] : "0";
   // $item->count_read = 1;
    $item->file_doc = ($_FILES["file_doc"] != null)? $_FILES["file_doc"] : "";
    $item->file_size = ($_FILES["file_doc"] != null)? $_FILES["file_doc"] : "";
	
	
    $item->url_youtube = ($_POST["url_youtube"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["url_youtube"]))) : null;
    if ($_POST["created_date"] != null) {
      list($day,$month,$year) = explode("/",$_POST["created_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->created_date = date("Y-m-d", strtotime($year."-".$month."-".$day));
    } else {
      $item->created_date = null;
    }
    $item->update_date = date("Y-m-d");
   	
    if ($item->replace()) {

      $update = false;
      
      // Upload image
      if ($_FILES["image"] != null) {
        $gettmp["image"] = $item->image;
        $upload = new upload($_FILES["image"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
       //       if ($upload->image_src_x > 226 || $upload->image_src_y > 152) 
	          $upload->image_resize = true;
              $upload->image_x = 250;
              $upload->image_y = 169;
         //     $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;

			  $upload->file_overwrite = true;
              if ($upload->image_src_x > 900) 
			  $upload->image_resize = true;
              $upload->image_x = 1000;
          //    $upload->image_y = 413;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."banner/");

              
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
                if (file_exists($upload_path."banner/".$gettmp["image"])) unlink($upload_path."banner/".$gettmp["image"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }

          
  		// Upload file_doc
      if ($_FILES["file_doc"] != null) {
        $gettmp["file_doc"] = $item->file_doc;
        $upload = new upload($_FILES["file_doc"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-file-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."document/");
            if ($upload->processed) {
              $update = true;
              $item->file_doc = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["file_doc"] != null) {
                if (file_exists($upload_path."document/".$gettmp["file_doc"])) unlink($upload_path."document/".$gettmp["file_doc"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	  
		   
		   
      if ($update) {
        $item->Replace();
      }
    
      $render = "promotion_list.php?mn=12&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "promotion_list.php?mn=12&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
  case "status" :
    class promotion_item extends ADOdb_Active_Record{}
    $item = new promotion_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->status = $gettmp['value'];
    $item->Replace();

    saverecord("Change Status");

      $render = "promotion_list.php?mn=12&sub=2&parent_id=".$gettmp["parent_id"];
    die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "delete" : 
    class promotion_item extends ADOdb_Active_Record{}
    $item = new promotion_item();
    $item->load("id = ?", array($gettmp["id"]));
	
    if ($item->image != null) {
         if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
         if (file_exists($upload_path."banner/".$gettmp["image"])) unlink($upload_path."banner/".$gettmp["image"]);
      }	
    $item->Delete();
	 
      saverecord("Delete Promotion");
      $render = "promotion_list.php?mn=12&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
	
  case "delete_thumb" : 
 // $db->debug = 1;
    class promotion_item extends ADOdb_Active_Record{}
    $item = new promotion_item();
    $item->load("id = ?", array($gettmp["id"]));
	if ($item->image != null) {
                unlink($upload_path.$item->image);
                unlink($upload_path."banner/".$item->image);     
	}
	    $stmt = $db->Prepare("UPDATE promotion_items SET promotion_items.image = ''  WHERE promotion_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"])); 	
 
      saverecord("Delete Image Promotion");
      $render = "promotion_edit.php?mn=12&sub=2&id=".$gettmp["id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;

  case "delete_file" : 
      class promotion_item extends ADOdb_Active_Record{}
    $item = new promotion_item();
    $item->load("id = ?", array($gettmp["id"]));
	if ($item->file_doc != null) {
                unlink($upload_path."document/".$item->file_doc);     
	}
	    $stmt = $db->Prepare("UPDATE promotion_items SET promotion_items.file_doc = ''  WHERE promotion_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"])); 	
 
      saverecord("Delete File Promotion");
      $render = "promotion_edit.php?mn=12&sub=2&id=".$gettmp["id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");

    break;
  case "update_cover" :
  // $db->debug=1;
    class cover_promotion extends ADOdb_Active_Record{}
    $item = new cover_promotion();
    $item->load("id = ?", array($gettmp["id"]));
    $item->status = ($_POST["status"] != null) ? $_POST['status'] : "0";
    $item->updated_date = date("Y-m-d");
   	
    if ($item->replace()) {

      $update = false;
      
       // Upload image Index
      if ($_FILES["image1"] != null) {
        $gettmp["image1"] = $item->image1;
        $upload = new upload($_FILES["image1"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image1-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
         //     if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
			  $upload->image_resize = true;
              $upload->image_x = 525;
              $upload->image_y = 390;
       //       $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."cover/");
            if ($upload->processed) {
              $update = true;
      
              $item->image1 = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["image1"] != null) {
                if (file_exists($upload_path."cover/".$gettmp["image1"])) unlink($upload_path."cover/".$gettmp["image1"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	  


       // Upload image Index
      if ($_FILES["image2"] != null) {
        $gettmp["image2"] = $item->image2;
        $upload = new upload($_FILES["image2"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image2-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
         //     if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
			  $upload->image_resize = true;
              $upload->image_x = 525;
              $upload->image_y = 390;
       //       $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."cover/");
            if ($upload->processed) {
              $update = true;
      
              $item->image2 = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["image2"] != null) {
                if (file_exists($upload_path."cover/".$gettmp["image2"])) unlink($upload_path."cover/".$gettmp["image2"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }	  
  
		   
      if ($update) {
        $item->Replace();
      }
    
      $render = "promotion_cover.php?mn=12&sub=1";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "promotion_cover.php?mn=12&sub=1";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;		    
}

//$template->display($render);
?>