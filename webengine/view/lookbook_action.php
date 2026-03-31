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
$upload_path = "../../img_lookbook/";

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

        $stmt = $db->Prepare("DELETE FROM lookbook_categories WHERE lookbook_categories.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      
      // Set Log.
      saverecord("Delete News Category");
      
      $render = "lookbook_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
	  
  break;
  case "insert" :
    class lookbook_category extends ADOdb_Active_Record{}
    $item = new lookbook_category();
    
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->subject_la = ($_POST["subject_la"] != null) ? encodeToDB($_POST["subject_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->subject_en = ($_POST["subject_en"] != null) ? encodeToDB($_POST["subject_en"]) : null;
    $item->status = ($_POST["status"] != null) ? $_POST["status"] : "0";

	
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
              $upload->image_x = 400;
         //     $upload->image_y = 152;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."thumbnail/");
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;
              
			   $upload->file_overwrite = true;
              if ($upload->image_src_x > 1180) 
			  $upload->image_resize = true;
              $upload->image_x = 1180;
          //    $upload->image_y = 413;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
               
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path."thumbnail/".$gettmp["image"])) unlink($upload_path."thumbnail/".$gettmp["image"]);
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
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
    
      $render = "lookbook_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "lookbook_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
    class lookbook_category extends ADOdb_Active_Record{}
    $item = new lookbook_category();
    $item->load("id = ?", array($gettmp["id"]));

    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->subject_la = ($_POST["subject_la"] != null) ? encodeToDB($_POST["subject_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->subject_en = ($_POST["subject_en"] != null) ? encodeToDB($_POST["subject_en"]) : null;
    $item->status = ($_POST["status"] != null) ? $_POST["status"] : "0";
	
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
              $upload->image_x = 400;
         //     $upload->image_y = 152;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."thumbnail/");
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;
			   $upload->file_overwrite = true;
              if ($upload->image_src_x > 1180) 
			  $upload->image_resize = true;
              $upload->image_x = 1180;
          //    $upload->image_y = 413;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
               
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path."thumbnail/".$gettmp["image"])) unlink($upload_path."thumbnail/".$gettmp["image"]);
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
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
    
      $render = "lookbook_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "lookbook_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
  case "status" :
    class lookbook_category extends ADOdb_Active_Record{}
    $item = new lookbook_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->status = $gettmp['value'];
    $item->Replace();

    saverecord("Change Status");

    $render = "admin_list.php?listitem=news&parent_id=".$gettmp["parent_id"]."&menu=".$gettmp['menu'];
    die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "delete" : 
    class lookbook_category extends ADOdb_Active_Record{}
    $item = new lookbook_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();
 
      saverecord("Delete lookbook");
      $render = "lookbook_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "delete_cate" : 
    class lookbook_category extends ADOdb_Active_Record{}
    $item = new lookbook_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();

    saverecord("Delete ");
      $render = "lookbook_cate.php?mn=4&sub=1";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;	
    
}

//$template->display($render);
?>