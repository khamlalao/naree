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
$upload_path = "../../img_story/";

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "insert" :
  
      $sql = "SELECT Count(story_items.id) AS amout FROM story_items ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
      $gettmp["sequence"] = $rs->fields["amout"] + 1;  
  
    class story_item extends ADOdb_Active_Record{}
    $item = new story_item();
    
    $item->sequence = $gettmp["sequence"];		
    $item->detail_la = ($_POST["detail_la"] != null) ? encodeToDB(htmlspecialchars_decode($_POST["detail_la"])) : null;
    $item->detail_en = ($_POST["detail_en"] != null) ? encodeToDB(htmlspecialchars_decode($_POST["detail_en"])) : null;
	$item->status = ($_POST["status"] != null) ? $_POST["status"] : '0';
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
 
   
    if ($item->save()) {

      $update = false;
      
      // Upload image Desktop
      if ($_FILES["file_name"] != null) {
        $gettmp["file_name"] = $item->file_name;
        $upload = new upload($_FILES["file_name"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-desk-th-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
              if ($upload->image_src_x > 1000) 
			  $upload->image_resize = true;
              $upload->image_x = 1000;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name = $upload->file_dst_name;
              
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
      
              if ($gettmp["file_name"] != null) {
                if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
                if (file_exists($upload_path."thumbnail/".$gettmp["file_name"])) unlink($upload_path."thumbnail/".$gettmp["file_name"]);
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
          $sql = "SELECT Count(story_items.id) AS amount FROM story_items";
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
              $sql = "UPDATE story_items SET story_items.sequence = story_items.sequence + 1 WHERE story_items.sequence >= ? AND story_items.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE story_items SET story_items.sequence = story_items.sequence - 1 WHERE story_items.sequence > ? AND story_items.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;		
		
       if ($update) {
        $item->Replace();
      }
    
      $render = "story_list.php?mn=10&menu=c3RvcnkgTWFuYWdlbWVudA";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "story_list.php?mn=10&menu=c3RvcnkgTWFuYWdlbWVudA";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
    class story_item extends ADOdb_Active_Record{}
    $item = new story_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->detail_la = ($_POST["detail_la"] != null) ? encodeToDB(htmlspecialchars_decode($_POST["detail_la"])) : null;
    $item->detail_en = ($_POST["detail_en"] != null) ? encodeToDB(htmlspecialchars_decode($_POST["detail_en"])) : null;
	$item->status = ($_POST["status"] != null) ? $_POST["status"] : '0';
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
	
   
    if ($item->Replace()) {

      $update = false;
      
      // Upload image Desktop
      if ($_FILES["file_name"] != null) {
        $gettmp["file_name"] = $item->file_name;
        $upload = new upload($_FILES["file_name"]);
        if ($upload->uploaded) { // Upload success
          $file_new_name_body = $item->id."-desk-th-".rand(1000,9999);
          $upload->file_max_size = $upload_max_size;
          $upload->file_overwrite = true;
          if ($upload->file_is_image) {
              if ($upload->image_src_x > 1000) 
			  $upload->image_resize = true;
              $upload->image_x = 1000;
              $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->file_name = $upload->file_dst_name;
              
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
      
              if ($gettmp["file_name"] != null) {
                if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
                if (file_exists($upload_path."thumbnail/".$gettmp["file_name"])) unlink($upload_path."thumbnail/".$gettmp["file_name"]);
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
          $sql = "SELECT Count(story_items.id) AS amount FROM story_items";
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
              $sql = "UPDATE story_items SET story_items.sequence = story_items.sequence + 1 WHERE story_items.sequence >= ? AND story_items.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE story_items SET story_items.sequence = story_items.sequence - 1 WHERE story_items.sequence > ? AND story_items.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;	 		

           
      if ($update) {
        $item->Replace();
      }
    
      $render = "story_list.php?mn=10&menu=c3RvcnkgTWFuYWdlbWVudA";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "story_list.php?mn=10&menu=c3RvcnkgTWFuYWdlbWVudA";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
 
  case "delete" : 
    class story_item extends ADOdb_Active_Record{}
    $item = new story_item();
    $item->load("id = ?", array($gettmp["id"]));
	$gettmp["file_name"] = $item->file_name;
    if($item->Delete()){
		  if ($gettmp["file_name"] != null) : 
           if (file_exists($upload_path."thumbnail/".$gettmp["file_name"])) unlink($upload_path."thumbnail/".$gettmp["file_name"]);
           if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
          endif;  
		    
	}

    saverecord("Delete Story");
      $render = "story_list.php?mn=10&menu=c3RvcnkgTWFuYWdlbWVudA";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;

    case "listupdate" :                            
                       
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];        
        $gettmp["to"] = $_POST["sequence_new"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM story_items WHERE story_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"];   
        $gettmp["parent_id"] = $rs->fields["parent_id"];   
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM story_items");
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
            $stmt = $db->Prepare("UPDATE story_items SET story_items.sequence = story_items.sequence + 1 WHERE story_items.sequence >= ? AND story_items.sequence < ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $sequence));
            $stmt = $db->Prepare("UPDATE story_items SET story_items.sequence = ? WHERE story_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));  
          else :                      
            $stmt = $db->Prepare("UPDATE story_items SET story_items.sequence = story_items.sequence - 1 WHERE story_items.sequence > ? AND story_items.sequence <= ? ");
            $rs = $db->Execute($stmt, array($sequence, $gettmp["to"]));
            $stmt = $db->Prepare("UPDATE story_items SET story_items.sequence = ? WHERE story_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));     
          endif;   
        endif;     
      endforeach;                       
                     

      $render = "story_list.php?mn=10&menu=c3RvcnkgTWFuYWdlbWVudA";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");

      saverecord("Save Data Item");        
      break; 

  case "listdelete" :
      
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM story_items WHERE story_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"]; 
        $gettmp["file_name"] = $rs->fields["file_name"];	
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM story_items");
        $rs = $db->Execute($stmt);
        $max = $rs->fields["amount"]; 
        
        if ($sequence < $max) :                                                                                     
          $stmt = $db->Prepare("UPDATE story_items SET story_items.sequence = story_items.sequence - 1 WHERE story_items.sequence > ?  ");
          $rs = $db->Execute($stmt, array($sequence));           
        endif;                      
                                  
 		 if ($gettmp["file_name"] != null) : 
           if (file_exists($upload_path."thumbnail/".$gettmp["file_name"])) unlink($upload_path."thumbnail/".$gettmp["file_name"]);
           if (file_exists($upload_path.$gettmp["file_name"])) unlink($upload_path.$gettmp["file_name"]);
         endif;  

			  								                  
        $stmt = $db->Prepare("DELETE FROM story_items WHERE story_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      

      saverecord("Delete Status Image");
      $render = "story_list.php?mn=10&menu=c3RvcnkgTWFuYWdlbWVudA";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");        
      break;   
   
}

//$template->display($render);
?>