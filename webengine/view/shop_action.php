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

$gettmp["status"] = ($_REQUEST["status"] != null) ? $_REQUEST["status"] : 0;
$gettmp["id"] = ($_REQUEST["id"] != null) ? $_REQUEST["id"] : '';
$gettmp["do"] = ($_REQUEST["do"] != null) ? $_REQUEST["do"] : '';


$template = new Savant3();
ADOdb_Active_Record::SetDatabaseAdapter($db);

switch ($gettmp["do"]) {
  case "insert" :
  
      $sql = "SELECT Count(shop_items.id) AS amout FROM shop_items ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
      $gettmp["sequence"] = $rs->fields["amout"] + 1;  
  
    class shop_item extends ADOdb_Active_Record{}
    $item = new shop_item();
    
    $item->sequence = $gettmp["sequence"];		
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->address_en = ($_POST["address_en"] != null) ? encodeToDB($_POST["address_en"]) : null;
    $item->address_la = ($_POST["address_la"] != null) ? encodeToDB($_POST["address_la"]) : null;
    $item->phone = ($_POST["phone"] != null) ? encodeToDB($_POST["phone"]) : null;
    $item->mobile = ($_POST["mobile"] != null) ? encodeToDB($_POST["mobile"]) : null;
    $item->line_id = ($_POST["line_id"] != null) ? encodeToDB($_POST["line_id"]) : null;
    $item->whatsapp = ($_POST["whatsapp"] != null) ? encodeToDB($_POST["whatsapp"]) : null;
    $item->facebook = ($_POST["facebook"] != null) ? encodeToDB($_POST["facebook"]) : null;
    $item->instagram = ($_POST["instagram"] != null) ? encodeToDB($_POST["instagram"]) : null;
    $item->gmap = ($_POST["gmap"] != null) ? encodeToDB($_POST["gmap"]) : null;
	$item->status = ($_POST["status"] != null) ? $_POST["status"] : '0';
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
 
   
    if ($item->save()) {

      $update = false;
      
		
		// SET Sequence
		$gettmp["sequence"] = $_POST["sequence"];
        if ($item->sequence != $gettmp["sequence"]) : 
          $update = true;
          $sql = "SELECT Count(shop_items.id) AS amount FROM shop_items";
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
              $sql = "UPDATE shop_items SET shop_items.sequence = shop_items.sequence + 1 WHERE shop_items.sequence >= ? AND shop_items.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE shop_items SET shop_items.sequence = shop_items.sequence - 1 WHERE shop_items.sequence > ? AND shop_items.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;		
		
       if ($update) {
        $item->Replace();
      }
    
      $render = "shop_list.php?mn=11&menu=U2hvcCBNYW5hZ2VtZW50";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "shop_list.php?mn=11&menu=U2hvcCBNYW5hZ2VtZW50";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }

    saverecord("Save Data Item");
    break;
  case "update" :
    class shop_item extends ADOdb_Active_Record{}
    $item = new shop_item();
    $item->load("id = ?", array($gettmp["id"]));
    $item->title_en = ($_POST["title_en"] != null) ? encodeToDB($_POST["title_en"]) : null;
    $item->title_la = ($_POST["title_la"] != null) ? encodeToDB($_POST["title_la"]) : null;
    $item->address_en = ($_POST["address_en"] != null) ? encodeToDB($_POST["address_en"]) : null;
    $item->address_la = ($_POST["address_la"] != null) ? encodeToDB($_POST["address_la"]) : null;
    $item->phone = ($_POST["phone"] != null) ? encodeToDB($_POST["phone"]) : null;
    $item->mobile = ($_POST["mobile"] != null) ? encodeToDB($_POST["mobile"]) : null;
    $item->line_id = ($_POST["line_id"] != null) ? encodeToDB($_POST["line_id"]) : null;
    $item->whatsapp = ($_POST["whatsapp"] != null) ? encodeToDB($_POST["whatsapp"]) : null;
    $item->facebook = ($_POST["facebook"] != null) ? encodeToDB($_POST["facebook"]) : null;
    $item->instagram = ($_POST["instagram"] != null) ? encodeToDB($_POST["instagram"]) : null;
    $item->gmap = ($_POST["gmap"] != null) ? encodeToDB($_POST["gmap"]) : null;
	$item->status = ($_POST["status"] != null) ? $_POST["status"] : '0';
    $item->created_date = date("Y-m-d H:i:s");
    $item->update_date = date("Y-m-d H:i:s");
	
   
    if ($item->Replace()) {

      $update = false;
      
 	
		
		// SET Sequence
		$gettmp["sequence"] = $_POST["sequence"];
        if ($item->sequence != $gettmp["sequence"]) : 
          $update = true;
          $sql = "SELECT Count(shop_items.id) AS amount FROM shop_items";
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
              $sql = "UPDATE shop_items SET shop_items.sequence = shop_items.sequence + 1 WHERE shop_items.sequence >= ? AND shop_items.sequence < ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($gettmp["sequence"], $item->sequence));
              $item->sequence = $gettmp["sequence"];
            else :
              $sql = "UPDATE shop_items SET shop_items.sequence = shop_items.sequence - 1 WHERE shop_items.sequence > ? AND shop_items.sequence <= ? ";
              $stmt = $db->Prepare($sql);
              $rs = $db->Execute($stmt, array($item->sequence, $gettmp["sequence"]));
              $item->sequence = $gettmp["sequence"];
            endif;
          endif;
        endif;	 		

           
      if ($update) {
        $item->Replace();
      }
    
      $render = "shop_list.php?mn=11&menu=U2hvcCBNYW5hZ2VtZW50";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    } else {
      $render = "shop_list.php?mn=11&menu=U2hvcCBNYW5hZ2VtZW50";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    }
    saverecord("Save Data Item");
    break;
 
  case "delete" : 
    class shop_item extends ADOdb_Active_Record{}
    $item = new shop_item();
    $item->load("id = ?", array($gettmp["id"]));
	$gettmp["file_name"] = $item->file_name;
    $item->Delete();

    saverecord("Delete Shop");
      $render = "shop_list.php?mn=11&menu=U2hvcCBNYW5hZ2VtZW50";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");
    break;

    case "listupdate" :                            
                       
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];        
        $gettmp["to"] = $_POST["sequence_new"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM shop_items WHERE shop_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"];   
        $gettmp["parent_id"] = $rs->fields["parent_id"];   
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM shop_items");
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
            $stmt = $db->Prepare("UPDATE shop_items SET shop_items.sequence = shop_items.sequence + 1 WHERE shop_items.sequence >= ? AND shop_items.sequence < ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $sequence));
            $stmt = $db->Prepare("UPDATE shop_items SET shop_items.sequence = ? WHERE shop_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));  
          else :                      
            $stmt = $db->Prepare("UPDATE shop_items SET shop_items.sequence = shop_items.sequence - 1 WHERE shop_items.sequence > ? AND shop_items.sequence <= ? ");
            $rs = $db->Execute($stmt, array($sequence, $gettmp["to"]));
            $stmt = $db->Prepare("UPDATE shop_items SET shop_items.sequence = ? WHERE shop_items.id = ? ");
            $rs = $db->Execute($stmt, array($gettmp["to"], $gettmp["id"]));     
          endif;   
        endif;     
      endforeach;                       
                     

      $render = "shop_list.php?mn=11&menu=U2hvcCBNYW5hZ2VtZW50";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");

      saverecord("Save Data Item");        
      break; 

  case "listdelete" :
      
      foreach ($_POST["chkbox"] as $row => $gettmp["no"]) :   
        $gettmp["id"] = $_POST["id"][$gettmp["no"] - 1];
        
        $stmt = $db->Prepare("SELECT * FROM shop_items WHERE shop_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));
        $sequence = $rs->fields["sequence"]; 
        $gettmp["file_name"] = $rs->fields["file_name"];	
        
        $stmt = $db->Prepare("SELECT Count(id) AS amount FROM shop_items");
        $rs = $db->Execute($stmt);
        $max = $rs->fields["amount"]; 
        
        if ($sequence < $max) :                                                                                     
          $stmt = $db->Prepare("UPDATE shop_items SET shop_items.sequence = shop_items.sequence - 1 WHERE shop_items.sequence > ?  ");
          $rs = $db->Execute($stmt, array($sequence));           
        endif;                      
                                  


        $stmt = $db->Prepare("DELETE FROM shop_items WHERE shop_items.id = ? ");
        $rs = $db->Execute($stmt, array($gettmp["id"]));  
      endforeach;
      

      saverecord("Delete Status Image");
      $render = "shop_list.php?mn=11&menu=U2hvcCBNYW5hZ2VtZW50";
      die("<meta http-equiv=\"refresh\" content=\"0; URL=$render\">");        
      break;   
   
}

//$template->display($render);
?>