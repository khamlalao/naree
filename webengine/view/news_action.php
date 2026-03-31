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
$upload_path = "../../img_news/";

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

        $stmt = $db->Prepare("DELETE FROM news_items WHERE news_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      
      // Set Log.
      saverecord("Delete News");
      
      $render = "news_list.php?mn=3&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
	  
  break;
  case "insert" :
    class news_item extends ADOdb_Active_Record{}
    $item = new news_item();
    
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
      
      // Upload image Thumbnail
      if ($_FILES["image"] != null) {
        $gettmp["image"] = $item->image;
        $upload = new upload($_FILES["image"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
      //        if ($upload->image_src_x > 226 || $upload->image_src_y > 152) 
			  $upload->image_resize = true;
              $upload->image_x = 250;
              $upload->image_y = 169;
          //    $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;
              
			  $upload->file_overwrite = true;
              if ($upload->image_src_x > 900) 
			  $upload->image_resize = true;
              $upload->image_x = 900;
          //    $upload->image_y = 413;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."detail/");


			  $upload->file_overwrite = true;
                if ($upload->image_src_x > 650) 
				$upload->image_resize = true;
                $upload->image_x = 649;
                $upload->image_ratio_y = true;
                $upload->jpeg_quality = 100;
                $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."large/");
               
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
                if (file_exists($upload_path."detail/".$gettmp["image"])) unlink($upload_path."detail/".$gettmp["image"]);
                if (file_exists($upload_path."large/".$gettmp["image"])) unlink($upload_path."large/".$gettmp["image"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }
	  
      // Upload image Index
      if ($_FILES["image_index"] != null) {
        $gettmp["image_index"] = $item->image_index;
        $upload = new upload($_FILES["image_index"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image_index-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
       //       if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
	          $upload->image_resize = true;
              $upload->image_x = 394;
              $upload->image_y = 183;
      //        $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."index/");
            if ($upload->processed) {
              $update = true;
      
              $item->image_index = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["image_index"] != null) {
                if (file_exists($upload_path."index/".$gettmp["image_index"])) unlink($upload_path."index/".$gettmp["image_index"]);
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
    
      $render = "news_list.php?mn=3&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "news_list.php?mn=3&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
 // $db->debug=1;
    class news_item extends ADOdb_Active_Record{}
    $item = new news_item();
    $item->load("id = ?", array($gettmp["id"]));

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
   // $item->count_read = 1;
    $item->file_doc = ($_FILES["file_doc"] != null)? $_FILES["file_doc"] : "";
    $item->file_size = ($_FILES["file_doc"] != null)? $_FILES["file_doc"] : "";
	
	
    $item->url_youtube = ($_POST["url_youtube"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["url_youtube"]))) : null;
    if ($_POST["created_date"] != null) {
      list($birth_day,$birth_month,$birth_year) = explode("/",$_POST["created_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->created_date = date("Y-m-d", strtotime($birth_year."-".$birth_month."-".$birth_day));
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
              $upload->image_x = 900;
          //    $upload->image_y = 413;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."detail/");


			  $upload->file_overwrite = true;
                if ($upload->image_src_x > 650) 
				$upload->image_resize = true;
                $upload->image_x = 649;
                $upload->image_ratio_y = true;
                $upload->jpeg_quality = 100;
                $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."large/");
               
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
                if (file_exists($upload_path."detail/".$gettmp["image"])) unlink($upload_path."detail/".$gettmp["image"]);
                if (file_exists($upload_path."large/".$gettmp["image"])) unlink($upload_path."large/".$gettmp["image"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }


      // Upload image Index
      if ($_FILES["image_index"] != null) {
        $gettmp["image_index"] = $item->image_index;
        $upload = new upload($_FILES["image_index"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image_index-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
         //     if ($upload->image_src_x > 394 || $upload->image_src_y > 183) 
			  $upload->image_resize = true;
              $upload->image_x = 394;
              $upload->image_y = 183;
       //       $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."index/");
            if ($upload->processed) {
              $update = true;
      
              $item->image_index = $upload->file_dst_name;              
              $upload->clean();
      
              if ($gettmp["image_index"] != null) {
                if (file_exists($upload_path."index/".$gettmp["image_index"])) unlink($upload_path."index/".$gettmp["image_index"]);
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
    
      $render = "news_list.php?mn=3&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "news_list.php?mn=3&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
  case "status" :
    class news_item extends ADOdb_Active_Record{}
    $item = new news_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->status = $gettmp['value'];
    $item->Replace();

    saverecord("Change Status");

      $render = "news_list.php?mn=3&sub=2&parent_id=".$gettmp["parent_id"];
    die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "delete" : 
    class news_item extends ADOdb_Active_Record{}
    $item = new news_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();
 
      saverecord("Delete News");
      $render = "news_list.php?mn=3&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
	
  case "delete_thumb" : 
 // $db->debug = 1;
    class news_item extends ADOdb_Active_Record{}
    $item = new news_item();
    $item->load("id = ?", array($gettmp["id"]));
	if ($item->image != null) {
                unlink($upload_path.$item->image);
                unlink($upload_path."detail/".$item->image);     
                unlink($upload_path."large/".$item->image);     
	}
	    $stmt = $db->Prepare("UPDATE news_items SET news_items.image = ''  WHERE news_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"])); 	
 
      saverecord("Delete Image News");
      $render = "news_edit.php?mn=3&sub=2&id=".$gettmp["id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;

  case "delete_file" : 
      class news_item extends ADOdb_Active_Record{}
    $item = new news_item();
    $item->load("id = ?", array($gettmp["id"]));
	if ($item->file_doc != null) {
                unlink($upload_path."document/".$item->file_doc);     
	}
	    $stmt = $db->Prepare("UPDATE news_items SET news_items.file_doc = ''  WHERE news_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"])); 	
 
      saverecord("Delete File News");
      $render = "news_edit.php?mn=3&sub=2&id=".$gettmp["id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");

    break;
		
  case "delete_cate" : 
    class news_category extends ADOdb_Active_Record{}
    $item = new news_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();

    saverecord("Delete News");
      $render = "news_cate.php?mn=3&sub=1";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;	
    
}

//$template->display($render);
?>