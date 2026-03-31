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
#print_r($_POST);
//echo stripslashes($_POST['detail_la']);
//exit();
$render = explode("/", $_SERVER["PHP_SELF"]);
$render = str_replace(".php", ".tpl.php", end($render));

$upload_max_size = 10 * 1024 * 1024;
$upload_temp_path = "../../temp/";
$upload_path = "../../img_product/";

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

        $stmt = $db->Prepare("DELETE FROM product_items WHERE product_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      
      // Set Log.
      saverecord("Delete News");
      
      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
	  
  break;
  case "insert" :
    class product_item extends ADOdb_Active_Record{}
    $item = new product_item();
    
    if ($gettmp["parent_id"] != null) {
      $item->parent_id = $gettmp["parent_id"];
    } else {
      $item->parent_id = 0;
    }
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->size_la = ($_POST["size_la"] != null) ? encodeToDB($_POST["size_la"]) : null;
    $item->code = ($_POST["code"] != null) ? encodeToDB($_POST["code"]) : null;
    $item->detail_la = ($_POST["detail_la"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["detail_la"]))) : null;
    $item->color_la = ($_POST["color_la"] != null) ? encodeToDB($_POST["color_la"]) : null;
    $item->fabric_la = ($_POST["fabric_la"] != null) ? encodeToDB($_POST["fabric_la"]) : null;
    $item->material_la = ($_POST["material_la"] != null) ? encodeToDB($_POST["material_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->size_en = ($_POST["size_en"] != null) ? encodeToDB($_POST["size_en"]) : null;
    $item->detail_en = ($_POST["detail_en"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["detail_en"]))) : null;
    $item->color_en = ($_POST["color_en"] != null) ? encodeToDB($_POST["color_en"]) : null;
    $item->fabric_en = ($_POST["fabric_en"] != null) ? encodeToDB($_POST["fabric_en"]) : null;
    $item->material_en = ($_POST["material_en"] != null) ? encodeToDB($_POST["material_en"]) : null;
    $item->status = ($_POST["status"] != null) ? $_POST['status'] : "0";
    $item->promotion = ($_POST["promotion"] == "Y") ? "Y" : "N";
    $item->sequence = ($_POST["sequence"] != null) ? encodeToDB($_POST["sequence"]) : null;
	
    $item->size_cm = ($_POST["size_cm"] != null) ? $_POST["size_cm"] : null;
    $item->size_inch = ($_POST["size_inch"] != null) ? $_POST["size_inch"] : null;
    $item->weight = ($_POST["weight"] != null) ? $_POST["weight"] : null;
    $item->price = ($_POST["price"] != null) ? number_format($_POST["price"],2) : null;
    $item->discount = ($_POST["discount"] != null) ? number_format($_POST["discount"],2) : null;
    if ($_POST["created_date"] != null) {
      list($birth_day,$birth_month,$birth_year) = explode("/",$_POST["created_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->created_date = date("Y-m-d", strtotime($birth_year."-".$birth_month."-".$birth_day));
    } else {
      $item->created_date = null;
    }
    $item->update_date = date("Y-m-d H:i:s");
	
    if ($item->Save()) {

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
              $upload->image_x = 380;
              $upload->image_y = 253;
          //    $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;
              
			   $upload->file_overwrite = true;
              if ($upload->image_src_x > 800) 
			  $upload->image_resize = true;
              $upload->image_x = 800;
          //    $upload->image_y = 413;
              $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."detail/");
               
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
                if (file_exists($upload_path."detail/".$gettmp["image"])) unlink($upload_path."detail/".$gettmp["image"]);
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
    
      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
    class product_item extends ADOdb_Active_Record{}
    $item = new product_item();
    $item->load("id = ?", array($gettmp["id"]));

    if ($gettmp["parent_id"] != null) {
      $item->parent_id = $gettmp["parent_id"];
    } else {
      $item->parent_id = 0;
    }
     $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->size_la = ($_POST["size_la"] != null) ? encodeToDB($_POST["size_la"]) : null;
    $item->code = ($_POST["code"] != null) ? encodeToDB($_POST["code"]) : null;
    $item->detail_la = ($_POST["detail_la"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["detail_la"]))) : null;
    $item->color_la = ($_POST["color_la"] != null) ? encodeToDB($_POST["color_la"]) : null;
    $item->fabric_la = ($_POST["fabric_la"] != null) ? encodeToDB($_POST["fabric_la"]) : null;
    $item->material_la = ($_POST["material_la"] != null) ? encodeToDB($_POST["material_la"]) : null;
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->size_en = ($_POST["size_en"] != null) ? encodeToDB($_POST["size_en"]) : null;
    $item->detail_en = ($_POST["detail_en"] != null) ? convTextToDB(html_entity_decode(encodeToDB($_POST["detail_en"]))) : null;
    $item->color_en = ($_POST["color_en"] != null) ? encodeToDB($_POST["color_en"]) : null;
    $item->fabric_en = ($_POST["fabric_en"] != null) ? encodeToDB($_POST["fabric_en"]) : null;
    $item->material_en = ($_POST["material_en"] != null) ? encodeToDB($_POST["material_en"]) : null;
    $item->status = ($_POST["status"] != null) ? $_POST['status'] : "0";
    $item->promotion = ($_POST["promotion"] == "Y") ? "Y" : "N";
    $item->sequence = ($_POST["sequence"] != null) ? encodeToDB($_POST["sequence"]) : null;
	
    $item->size_cm = ($_POST["size_cm"] != null) ? $_POST["size_cm"] : null;
    $item->size_inch = ($_POST["size_inch"] != null) ? $_POST["size_inch"] : null;
    $item->weight = ($_POST["weight"] != null) ? $_POST["weight"] : null;
    $item->price = ($_POST["price"] != null) ? number_format($_POST["price"],2) : null;
    $item->discount = ($_POST["discount"] != null) ? number_format($_POST["discount"],2) : null;
	
    if ($_POST["created_date"] != null) {
      list($birth_day,$birth_month,$birth_year) = explode("/",$_POST["created_date"]); //03/04/2493
      //$birth_year = $birth_year-543;
      $item->created_date = date("Y-m-d", strtotime($birth_year."-".$birth_month."-".$birth_day));
    } else {
      $item->created_date = null;
    }
    $item->update_date = date("Y-m-d H:i:s");
   	
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
              $upload->image_x = 380;
              $upload->image_y = 253;
         //     $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path);
            if ($upload->processed) {
              $update = true;
      
              $item->image = $upload->file_dst_name;
			   $upload->file_overwrite = true;
              if ($upload->image_src_x > 800) 
			  $upload->image_resize = true;
              $upload->image_x = 800;
          //    $upload->image_y = 413;
              $upload->image_ratio = true;
              $upload->jpeg_quality = 100;
              $upload->file_new_name_body = $file_new_name_body;
              $upload->Process($upload_path."detail/");
               
              $upload->clean();
      
              if ($gettmp["image"] != null) {
                if (file_exists($upload_path.$gettmp["image"])) unlink($upload_path.$gettmp["image"]);
                if (file_exists($upload_path."detail/".$gettmp["image"])) unlink($upload_path."detail/".$gettmp["image"]);
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
    
      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
  case "status" :
    class product_item extends ADOdb_Active_Record{}
    $item = new product_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->status = $gettmp['value'];
    $item->Replace();

    saverecord("Change Status");

      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
    die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
  case "delete" : 
    class product_item extends ADOdb_Active_Record{}
    $item = new product_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->Delete();
 
      saverecord("Delete News");
      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;
case "listupdate" :   
		//$db->debug=1;
		 $gettmp["parent_id"] = $_POST['parent_id'];                       
                       
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];        
        $gettmp["to"] = $_POST["sequence_new"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM product_items WHERE product_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"];   
          
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM product_items WHERE product_items.parent_id = ? ");
        $rs = $db->Execute($stmt, array($gettmp['parent_id']));
        $max = $rs->fields["amount"]; 
                                  
        if ($sequence != $gettmp["to"]) :  
          if ($gettmp["to"] < 1) :     
            $gettmp["to"] = 1;
          endif;  
          if ($gettmp["to"] > $max) :    
            $gettmp["to"] = $max;
          endif;
          if ($sequence > $gettmp["to"]) : 
            $stmt = $db->Prepare("UPDATE product_items SET product_items.sequence = product_items.sequence + 1 WHERE product_items.sequence >= ? AND product_items.sequence < ? AND  product_items.parent_id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $sequence, $gettmp['parent_id']));
            $stmt = $db->Prepare("UPDATE product_items SET product_items.sequence = ? WHERE product_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));  
          else :                      
            $stmt = $db->Prepare("UPDATE product_items SET product_items.sequence = product_items.sequence - 1 WHERE product_items.sequence > ? AND product_items.sequence <= ? AND product_items.parent_id = ? ");
            $rs = $db->Execute($stmt, array($sequence, $gettmp["to"], $gettmp['parent_id']));
            $stmt = $db->Prepare("UPDATE product_items SET product_items.sequence = ? WHERE product_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));     
          endif;   
        endif;     
      endforeach;                       
                     

      $render = "product_list.php?mn=6&sub=1&parent_id=".$gettmp["parent_id"];
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    //  exit();
      saverecord("Save Data Item");        
      break; 	
    case "listdelete" :
      
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM product_items WHERE product_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"]; 

        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM product_items WHERE product_items = ? ");
        $rs = $db->Execute($stmt,array($gettmp["parent_id"]));
        $max = $rs->fields["amount"]; 
        
        if ($sequence < $max) :                                                                                     
          $stmt = $db->Prepare("UPDATE product_items SET product_items.sequence = product_items.sequence - 1 WHERE product_items.sequence > ?   AND product_items.parent_id = ? ");
          $rs = $db->Execute($stmt, array($sequence,$gettmp["parent_id"]));           
        endif;                      
                                  
			  								                  
        $stmt = $db->Prepare("DELETE FROM product_items WHERE product_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      

      saverecord("Delete Status product");
      $render = "product_list.php?mn=6&sub=1&menu=Q2F0ZWxvZw";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");        
      break;     
}

//$template->display($render);
?>