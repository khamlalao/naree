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
//exit();
$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$upload_max_size = 10 * 1024 * 1024;
$upload_temp_path = "../../temp/";
$upload_path = "../../img_lookbook_gallery/";

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["parent_id"] = ($_REQUEST["parent_id"] != null) ? $_REQUEST["parent_id"] : '';
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "insert" :
 
      $sql = "SELECT Count(lookbook_items.id) AS amout FROM lookbook_items WHERE lookbook_items.parent_id = ? ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($gettmp["parent_id"]));
      $gettmp["sequence"] = $rs->fields["amout"] + 1; 
  
    class lookbook_item extends ADOdb_Active_Record{}
    $item = new lookbook_item();
    
    if ($gettmp["parent_id"] != null) {
      $item->parent_id = $gettmp["parent_id"];
    } else {
      $item->parent_id = 0;
    }
    $item->sequence = $gettmp["sequence"];		
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->status = ($_POST["status"] == "1") ? "1" : "0";
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
   
    if ($item->save()) {

      $update = false;
      
      // Upload image Thumbnail
      if ($_FILES["file_name"] != null) {
        $gettmp["file_name"] = $item->file_name;
        $upload = new upload($_FILES["file_name"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
              if ($upload->image_src_x > 900) 
			  $upload->image_resize = true;
              $upload->image_x = 900;
       //       $upload->image_y = 152;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name = $upload->file_dst_name;
              $item->file_size = $upload->file_src_size;                       
              $upload->clean();
      
              if ($gettmp["file_name"] != null) {
                if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
              }
            } else {
              echo "error : ".$upload->error;
            }
          }
        }
      }
		
        $gettmp["sequence"] = $_POST["sequence"];
        if ($item->sequence != $gettmp["sequence"]) : 
          $update = true;
          $sql = "SELECT Count(lookbook_items.id) AS amount FROM lookbook_items WHERE lookbook_items.parent_id = ? ";
          $stmt = $db->Prepare($sql);
          $rs = $db->Execute($stmt, array($item->parent_id));
          $max = $rs->fields["amount"]; 
          
          if ($item->sequence != $gettmp["sequence"]) : 
            if ($gettmp["sequence"] < 1) : 
              $gettmp["sequence"] = 1;
            endif;
            if ($gettmp["sequence"] > $max) : 
              $gettmp["sequence"] = $max;
            endif;
            if ($item->sequence > $gettmp["sequence"]) : 
              $sql = "UPDATE lookbook_items SET lookbook_items.sequence = lookbook_items.sequence + 1 WHERE lookbook_items.sequence >= ? AND lookbook_items.sequence < ? AND lookbook_items.parent_id = ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence, $item->parent_id));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE lookbook_items SET lookbook_items.sequence = lookbook_items.sequence - 1 WHERE lookbook_items.sequence > ? AND lookbook_items.sequence <= ? AND lookbook_items.parent_id = ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"], $item->parent_id));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;
		
		
       if ($update) {
        $item->Replace();
  	    }
    
      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
    case "listupdate" :                            
                       
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];        
        $gettmp["to"] = $_POST["sequence_new"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM lookbook_items WHERE lookbook_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"];   
        $gettmp["parent_id"] = $rs->fields["parent_id"];   
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM lookbook_items WHERE lookbook_items.parent_id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["parent_id"]));
        $max = $rs->fields["amount"]; 
                                  
        if ($sequence != $gettmp["to"]) :  
          if ($gettmp["to"] < 1) :     
            $gettmp["to"] = 1;
          endif;  
          if ($gettmp["to"] > $max) :    
            $gettmp["to"] = $max;
          endif;
          if ($sequence > $gettmp["to"]) : 
            $stmt = $db->Prepare("UPDATE lookbook_items SET lookbook_items.sequence = lookbook_items.sequence + 1 WHERE lookbook_items.sequence >= ? AND lookbook_items.sequence < ? AND lookbook_items.parent_id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $sequence, $gettmp["parent_id"]));
            $stmt = $db->Prepare("UPDATE lookbook_items SET lookbook_items.sequence = ? WHERE lookbook_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));  
          else :                      
            $stmt = $db->Prepare("UPDATE lookbook_items SET lookbook_items.sequence = lookbook_items.sequence - 1 WHERE lookbook_items.sequence > ? AND lookbook_items.sequence <= ? AND lookbook_items.parent_id = ?  ");
            $rs = $db->Execute($stmt, array($sequence, $gettmp["to"], $gettmp["parent_id"]));
            $stmt = $db->Prepare("UPDATE lookbook_items SET lookbook_items.sequence = ? WHERE lookbook_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));     
          endif;   
        endif;     
      endforeach;                       
                     

      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");

      saverecord("Save Data Item");        
      break; 
	case "update" :
    class lookbook_item extends ADOdb_Active_Record{}
    $item = new lookbook_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->sequence = $_POST["sequence"];	
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->status = ($_POST["status"] == "1") ? "1" : "0";
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
   
    if ($item->Replace()) {

      $update = false;
      
      // Upload image Thumbnail
      if ($_FILES["file_name"] != null) {
        $gettmp["file_name"] = $item->file_name;
        $upload = new upload($_FILES["file_name"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-image-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
              if ($upload->image_src_x > 900) 
			  $upload->image_resize = true;
              $upload->image_x = 900;
       //       $upload->image_y = 152;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name = $upload->file_dst_name;
              $item->file_size = $upload->file_src_size;                       
              $upload->clean();
      
              if ($gettmp["file_name"] != null) {
                if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
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
    
      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
  case "listdelete" :
      
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM lookbook_items WHERE lookbook_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"]; 
        $gettmp["parent_id"] = $rs->fields["parent_id"];	
		$gettmp["file_name"] = $rs->fields["file_name"]; 	    
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM lookbook_items WHERE lookbook_items.parent_id = ?  ");
        $rs = $db->Execute($stmt, array($gettmp["parent_id"]));
        $max = $rs->fields["amount"]; 
        
        if ($sequence < $max) :                                                                                     
          $stmt = $db->Prepare("UPDATE lookbook_items SET lookbook_items.sequence = lookbook_items.sequence - 1 WHERE lookbook_items.sequence > ?  AND lookbook_items.parent_id = ? ");
          $rs = $db->Execute($stmt, array($sequence, $gettmp["parent_id"]));           
        endif;                      
                                  
		if ($gettmp["file_name"] != null) : 
			 if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
		endif; 
			  								                  
        $stmt = $db->Prepare("DELETE FROM lookbook_items WHERE lookbook_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      

      saverecord("Delete Status Image News");
      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");        
      break;   
  case "delete" : 
    class lookbook_item extends ADOdb_Active_Record{}
    $item = new lookbook_item();
    $item->load("id = ?", array($gettmp["id"]));
	$gettmp["file_name"] = $item->file_name;
    $gettmp["parent_id"] = $item->parent_id;	
    $gettmp["sequence"] = $item->sequence;	    
        
    $stmt = $db->Prepare("SELECT Count(id) AS amount FROM lookbook_items WHERE lookbook_items.parent_id = ?  ");
    $rs = $db->Execute($stmt, array($gettmp["parent_id"]));
    $max = $rs->fields["amount"]; 
        
    if ($sequence < $max) :                                                                                     
       $stmt = $db->Prepare("UPDATE lookbook_items SET lookbook_items.sequence = lookbook_items.sequence - 1 WHERE lookbook_items.sequence > ?  AND lookbook_items.parent_id = ? ");
       $rs = $db->Execute($stmt, array($gettmp["sequence"], $gettmp["parent_id"]));           
    endif;                      
                                  

    if($item->Delete()){
		   if ($gettmp["file_name"] != null) : 
           if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
          endif;    
	}

      saverecord("Delete Status Image News");
      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
    case "status" :              
      $gettmp["id"] = $_GET["id"];
      $gettmp["value"] = ($_GET["value"] == "1") ? 1 : 0;
      
      $stmt = $db->Prepare("UPDATE lookbook_items SET lookbook_items.status = ? WHERE lookbook_items.id = ? ");
      $rs = $db->Execute($stmt, array($gettmp["value"], $gettmp["id"])); 
      
      saverecord("Update Status Image News");
      $render = "lookbook_image_list.php?mn=4&sub=2&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">"); 
      break;   
}

//$template->display($render);
?>