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


$upload_max_size = 10 * 1024 * 1024;
$upload_temp_path = "../../temp/";
$upload_path = "../../img_product/";


$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "insert" :
  
      $sql = "SELECT Count(product_categories.id) AS amout FROM product_categories ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
      $gettmp["sequence"] = $rs->fields["amout"] + 1;   
  
    class product_category extends ADOdb_Active_Record{}
    $item = new product_category();
    
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->sequence = $gettmp["sequence"];		
	$item->status = ($_POST["status"] == "1") ? "1" : "0";
	
	 if ($item->save()) {

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
            //  if ($upload->image_src_x > 944) 
			  $upload->image_resize = true;
              $upload->image_x = 360;
              $upload->image_y = 250;
           //   $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."collection/");
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path."collection/".$gettmp["image"])) unlink($upload_path."collection/".$gettmp["image"]);
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
          $sql = "SELECT Count(product_categories.id) AS amount FROM product_categories";
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
              $sql = "UPDATE product_categories SET product_categories.sequence = product_categories.sequence + 1 WHERE product_categories.sequence >= ? AND product_categories.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE product_categories SET product_categories.sequence = product_categories.sequence - 1 WHERE product_categories.sequence > ? AND product_categories.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;		
		
		
       if ($update) {
        $item->Replace();
  	    }
    
      $render = "product_cate_list.php?mn=6&sub=1&menu=Q2F0ZWxvZw";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "product_cate_list.php?mn=6&sub=1&menu=Q2F0ZWxvZw";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }


    saverecord("Save Data Item");
    break;
  case "update" :
    class product_category extends ADOdb_Active_Record{}
    $item = new product_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->sequence = ($_POST["sequence"] != null) ? encodeToDB($_POST["sequence"]) : null;
	$item->status = ($_POST["status"] == "1") ? "1" : "0";
	
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
            //  if ($upload->image_src_x > 944) 
			  $upload->image_resize = true;
              $upload->image_x = 360;
              $upload->image_y = 250;
           //   $upload->image_ratio_y = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."collection/");
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path."collection/".$gettmp["image"])) unlink($upload_path."collection/".$gettmp["image"]);
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
          $sql = "SELECT Count(product_categories.id) AS amount FROM product_categories";
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
              $sql = "UPDATE product_categories SET product_categories.sequence = product_categories.sequence + 1 WHERE product_categories.sequence >= ? AND product_categories.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE product_categories SET product_categories.sequence = product_categories.sequence - 1 WHERE product_categories.sequence > ? AND product_categories.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;		
		
		
       if ($update) {
        $item->Replace();
  	    }
    
      $render = "product_cate_list.php?mn=6&sub=1&menu=Q2F0ZWxvZw";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "product_cate_list.php?mn=6&sub=1&menu=Q2F0ZWxvZw";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
	
    saverecord("Save Data Item");
    break;

 case "listupdate" :                            
                       
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];        
        $gettmp["to"] = $_POST["sequence_new"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM product_categories WHERE product_categories.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"];   
        $gettmp["parent_id"] = $rs->fields["parent_id"];   
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM product_categories");
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
            $stmt = $db->Prepare("UPDATE product_categories SET product_categories.sequence = product_categories.sequence + 1 WHERE product_categories.sequence >= ? AND product_categories.sequence < ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $sequence));
            $stmt = $db->Prepare("UPDATE product_categories SET product_categories.sequence = ? WHERE product_categories.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));  
          else :                      
            $stmt = $db->Prepare("UPDATE product_categories SET product_categories.sequence = product_categories.sequence - 1 WHERE product_categories.sequence > ? AND product_categories.sequence <= ? ");
            $rs = $db->Execute($stmt, array($sequence, $gettmp["to"]));
            $stmt = $db->Prepare("UPDATE product_categories SET product_categories.sequence = ? WHERE product_categories.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));     
          endif;   
        endif;     
      endforeach;                       
                     

      $render = "product_cate_list.php?mn=6&sub=1&menu=QmFubmVyIE1hbmFnZW1lbnQ";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");

      saverecord("Save Data Item");        
      break; 
 
  case "delete" : 

		$stmt = $db->Prepare("DELETE FROM product_items WHERE product_items.parent_id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));    
  
    class product_category extends ADOdb_Active_Record{}
    $item = new product_category();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();

    saverecord("Delete product Category");
      $render = "product_cate_list.php?mn=6&sub=1&menu=Q2F0ZWxvZw";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "listdelete" :
      
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM product_categories WHERE product_categories.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"]; 

        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM product_categories");
        $rs = $db->Execute($stmt);
        $max = $rs->fields["amount"]; 
        
        if ($sequence < $max) :                                                                                     
          $stmt = $db->Prepare("UPDATE product_categories SET product_categories.sequence = product_categories.sequence - 1 WHERE product_categories.sequence > ?  ");
          $rs = $db->Execute($stmt, array($sequence));           
        endif;                      
                                  
		$stmt = $db->Prepare("DELETE FROM product_items WHERE product_items.parent_id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  								  
			  								                  
        $stmt = $db->Prepare("DELETE FROM product_categories WHERE product_categories.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      

      saverecord("Delete Status product categories");
      $render = "product_cate_list.php?mn=6&sub=1&menu=Q2F0ZWxvZw";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");        
      break;     
}

//$template->display($render);
?>