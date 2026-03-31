<?php
define("DIR",str_replace("\\", "/", dirname(__FILE__))."/../");
require_once DIR."library/extension/utility.php";
class Lang {

   public static function getThaiMonth($month) {
    $monthList = array(
        1 => "มกราคม",
        2 => "กุมภาพันธ์",
        3 => "มีนาคม",
        4 => "เมษายน",
        5 => "พฤษภาคม",
        6 => "มิถุนายน",
        7 => "กรกฎาคม",
        8 => "สิงหาคม",
        9 => "กันยายน",
        10 => "ตุลาคม",
        11 => "พฤศจิกายน",
        12 => "ธันวาคม"
    );
    return $monthList[intval($month)];
  }

  public static function getThaiMonthShort($month) {
    $monthList = array(
        1 => "ม.ค.",
        2 => "ก.พ.",
        3 => "มี.ค.",
        4 => "เม.ย.",
        5 => "พ.ค.",
        6 => "มิ.ย.",
        7 => "ก.ค.",
        8 => "ส.ค.",
        9 => "ก.ย.",
        10 => "ต.ค.",
        11 => "พ.ย.",
        12 => "ธ.ค."
    );
    return $monthList[intval($month)];
  }

  public static function getEnMonth($month) {
    $monthList = array(
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "November",
        12 => "December"
    );
    return $monthList[intval($month)];
  }

  public static function getEnMonthShort($month) {
    $monthList = array(
        1 => "Jan",
        2 => "Feb",
        3 => "Mar",
        4 => "Apr",
        5 => "May",
        6 => "Jun",
        7 => "Jul",
        8 => "Aug",
        9 => "Sep",
        10 => "Oct",
        11 => "Nov",
        12 => "Dec"
    );
    return $monthList[intval($month)];
  }

  public static function getMonth($month, $lang = "th") {
    switch (strtolower ($lang)) {
      case "th" :
        return self::getThaiMonth($month);
        break;
      case "en" :
        return self::getEnMonth($month);
        break;
      default :
        return self::getThaiMonth($month);
    }
  }

  public static function getMonthShort($month, $lang = "th") {
    switch (strtolower ($lang)) {
      case "th" :
        return self::getThaiMonthShort($month);
        break;
      case "en" :
        return self::getEnMonthShort($month);
        break;
      default :
        return self::getThaiMonthShort($month);
    }
  }

  public static function getCountryList($lang = "th") {
    $list = null;
    global $db;
    if ($lang == "th") {
      $sql = "
          SELECT info_countries.id, info_countries.title AS title, info_countries.title_en AS title_en
          FROM info_countries
          WHERE 1 = 1
          ORDER BY info_countries.title ASC
          ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
      $tempList = $rs->GetAssoc();
      $tempListCount = $rs->maxRecordCount();
      if ($tempListCount > 0) {
        $list = array();
        foreach ($tempList as $val) {
          $list[$val["id"]] = $val["title"];
        }
      }
    } else {
      $sql = "
          SELECT info_countries.id, info_countries.title AS title, info_countries.title_en AS title_en
          FROM info_countries
          WHERE 1 = 1
          ORDER BY info_countries.title_en ASC
          ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
      $tempList = $rs->GetAssoc();
      $tempListCount = $rs->maxRecordCount();
      if ($tempListCount > 0) {
        $list = array();
        foreach ($tempList as $val) {
          $list[$val["id"]] = $val["title_en"];
        }
      }
    }
    return $list;
  }

  public static function getCountry($id, $lang = "th") {
    $title = null;
    if ($id != null) {
      global $db;
      $sql = "
          SELECT info_countries.title AS title, info_countries.title_en AS title_en
          FROM info_countries
          WHERE info_countries.id = ?
          ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $row = $db->GetRow($stmt, array($id));
      switch (strtolower ($lang)) {
        case "th" :
          $title = encodeFromDB($row["title"]);
          break;
        case "en" :
          $title = encodeFromDB($row["title_en"]);
          break;
        default :
          $title = encodeFromDB($row["title"]);
      }
    }
    return $title;
  }

  public static function getPart($id, $lang = "th") {
    $title = null;
    if ($id != null) {
      global $db;
      $sql = "
          SELECT info_parts.title AS title, info_parts.title_en AS title_en
          FROM info_parts
          WHERE info_parts.id = ?
          ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $row = $db->GetRow($stmt, array($id));
      switch (strtolower ($lang)) {
        case "th" :
          $title = encodeFromDB($row["title"]);
          break;
        case "en" :
          $title = encodeFromDB($row["title_en"]);
          break;
        default :
          $title = encodeFromDB($row["title"]);
      }
    }
    return $title;
  }


  public static function getProvince($id, $lang = "th") {
    $title = null;
    if ($id != null) {
      global $db;
      $sql = "
          SELECT p.pv_dest AS title, p.pv_dese AS title_en
          FROM provinces p
          WHERE p.id = ?
          ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $row = $db->GetRow($stmt, array($id));
      switch (strtolower ($lang)) {
        case "th" :
          $title = encodeFromDB($row["title"]);
          break;
        case "en" :
          $title = encodeFromDB($row["title_en"]);
          break;
        default :
          $title = encodeFromDB($row["title"]);
      }
    }
    return $title;
  }
  
  public static function getMonthView($month) {
    $monthView = array(
        1 => "2015-01-01 00:00:00",
        2 => "2015-02-01 00:00:00",
        3 => "2015-03-01 00:00:00",
        4 => "2015-04-01 00:00:00",
        5 => "2015-05-01 00:00:00",
        6 => "2015-06-01 00:00:00",
        7 => "2015-07-01 00:00:00",
        8 => "2015-08-01 00:00:00",
        9 => "2015-09-01 00:00:00",
    );
    return $monthView[intval($month)];
  }
  

  public static function getPostcode($id, $lang = "th") {
    $postcode = null;
    if ($id != null) {
      global $db;
      $sql = "SELECT p.pv_zipcode AS postcode FROM provinces p  WHERE p.id = ?  ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $row = $db->GetRow($stmt, array($id));
      $postcode = encodeFromDB($row["postcode"]);
    }
    return $postcode;
  }
 
  public static function getPrefix($prefix,$id) {
	global $db;
    $prefixname = null;	  
    switch ($prefix) {
      case "1" : $prefixname = "นาย"; break;
      case "2" : $prefixname = "นาง"; break;
      case "3" : $prefixname = "นางสาว"; break;
	  case "4" :
	 if ($id != null) {
      $sql = "SELECT p.prefix_other AS prefix FROM bizclub_registers p  WHERE p.id = ?  ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $row = $db->GetRow($stmt, array($id));
      $prefixname = encodeFromDB($row["prefix"]);
    }
	break;
    }
    return $prefixname;
  }  
 
  public static function getPermission($rt_id) {
	global $db;
    $assign = null;	  
    switch ($rt_id) {
      case "1" : $assign = "อ่านได้อย่างเดียว"; break;
      case "2" : $assign = "อ่านและสร้างเนื้อหาในเครือข่ายได้"; break;
      case "3" : $assign = "เจ้าหน้าที่เครือข่าย"; break;
      default :
    }
    return $assign;
  }
  public static function getBirthday ($birth_day){
  	global $db;
  	$birthdate = null;
  	list($year,$month,$day) = explode("-",$birth_day);

  	$month = self::getMonth($month);
  	$year = $year+543;

  	$birthdate = $day." ".$month." ".$year;
  	return $birthdate;
  }

  public static function getHeadMenu($id, $lang = "th") {
    $list = null;
    global $db;
	
    if ($lang == "th") {
      $sql = "SELECT m.id, m.title_th AS title_sub, m.url_th AS url_sub FROM menu_heads m WHERE 1 = 1 AND m.id = ? ";
    } else {
      $sql = "SELECT m.id, m.title_en AS title_sub, m.url_en AS url_sub FROM menu_heads m WHERE 1 = 1 AND m.id = ? ";
    }
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
      $menu_name = null;
	  if ($rs->fields['title_sub'] != null) $menu_name = "&raquo; <a href='".$rs->fields['url_sub']."'>".$rs->fields['title_sub']."</a>";
    return $menu_name;
  }

  public static function getCateMenu($id, $lang = "th") {
    $list = null;
    global $db;
    if ($lang == "th") {
      $sql = "
	      SELECT m.id, m.title_th AS title_sub, m.url_th AS url_sub
          FROM menu_categories m
          WHERE 1 = 1
          AND m.id = ?
          ORDER BY m.id ASC";
    } else {
      $sql = "
	      SELECT m.id, m.title_en AS title_sub, m.url_en AS url_sub
          FROM menu_categories m
          WHERE 1 = 1
          AND m.id = ?
          ORDER BY m.id ASC";
	}

      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
      $menu_name = null;
	  if ($rs->fields['title_sub'] != null) $menu_name = "&raquo; <a href='".$rs->fields['url_sub']."'>".$rs->fields['title_sub']."</a>";

    
    return $menu_name;
  }

  public static function getMainMenu($id, $lang = "th") {
    $list = null;
    global $db;
    if ($lang == "th") {
      $sql = "
	      SELECT m.id, m.title_th AS title_sub, m.url_th AS url_sub
          FROM menu_mains m
          WHERE 1 = 1
          AND m.id = ?
          AND (m.sub_id = '' OR m.sub_id IS NULL)
          ORDER BY m.id ASC";
    } else {
      $sql = "
	      SELECT m.id, m.title_en AS title_sub, m.url_en AS url_sub
          FROM menu_mains m
          WHERE 1 = 1
          AND m.id = ?
          AND (m.sub_id = '' OR m.sub_id IS NULL)
          ORDER BY m.id ASC";
	}	  

      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
      $menu_name = null;
	  if ($rs->fields['title_sub'] != null) $menu_name = "&raquo; <a href='".$rs->fields['url_sub']."'>".$rs->fields['title_sub']."</a>";


    return $menu_name;
  }

  public static function getSubMainMenu($id, $lang = "th") {
    $list = null;
    global $db;
    if ($lang == "th") {
      $sql = "
	      SELECT m.id, m.title_th AS title_sub, m.url_th AS url_sub
          FROM menu_mains m
          WHERE 1 = 1
          AND ((m.parent_id = 0) OR (m.parent_id IS NULL))
          AND m.sub_id = ?
          ORDER BY m.id ASC";
    } else {
      $sql = "
	      SELECT m.id, m.title_en AS title_sub, m.url_en AS url_sub
          FROM menu_mains m
          WHERE 1 = 1
          AND ((m.parent_id = 0) OR (m.parent_id IS NULL))
          AND m.sub_id = ?
          ORDER BY m.id ASC";
	}	  

      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
      $menu_name = null;
	  if ($rs->fields['title_sub'] != null) $menu_name = "&raquo; <a href='".$rs->fields['url_sub']."'>".$rs->fields['title_sub']."</a>";


    return $menu_name;
  }


  public static function getSubMenu($id = 0, $lang = "th") {
    $list = null;
    global $db;
    if ($lang == "th") {
      $sql = "
	      SELECT m.id, m.title_th AS title_sub, m.url_th AS url_sub
          FROM menu_mains m
          WHERE 1 = 1
          AND m.parent_id = 0
          AND m.sub_id = ?
          ORDER BY m.id ASC";

      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
      $tempList = $rs->GetAssoc();
      $tempListCount = $rs->maxRecordCount();
      if ($tempListCount > 0) {
        $list = array();
        foreach ($tempList as $val) {
          $list[$val["id"]] = $val["title_sub"];
        }
      }
    } else {
      $sql = "
	      SELECT m.id, m.title_en AS title_sub, m.url_en AS url_sub
          FROM menu_mains m
          WHERE 1 = 1
          AND m.parent_id = 0
          AND m.sub_id = ?
          ORDER BY m.id ASC";

      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
      $tempList = $rs->GetAssoc();
      $tempListCount = $rs->maxRecordCount();
      if ($tempListCount > 0) {
        $list = array();
        foreach ($tempList as $val) {
          $list[$val["id"]] = $val["title_sub"];
        }
      }
    }
    return $list;
  }
 public static function getAdminType($id) {
    $title = null;
    if ($id != null) {
      global $db;
      $sql = "SELECT * FROM st_members WHERE st_members.st_member = ? ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $row = $db->GetRow($stmt, array($id));
      $title = encodeFromDB($row["st_member_detail"]);

    }
    return $title;
  }	  
  public static function getStatus($status) {
    switch ($status) {
      case "0" :
        $label_status = "<span class='label label-sm'>Disable</span>";
        break;
      case "1" :
        $label_status = "<span class='label label-success arrowed-in arrowed-in-right'>Display All</span>";
        break;
      case "2" :
        $label_status = "<span class='label label-success arrowed'>Display LAOS Only</span>";
        break;
      case "3" :
        $label_status = "<span class='label label-warning arrowed'>Display EN Only</span>";
        break;				
      default :
        $label_status = "<span class='label label-success arrowed-in arrowed-in-right'>Display All</span>";
    }
    return $label_status;
	
  }
  public static function getProductOrder($id, $txtfield) {
    $titleName = null;
    global $db;
	#$db->debug=1;
      $sql = "SELECT ".$txtfield." AS titleName FROM product_items m WHERE 1 = 1 AND m.id = ? ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
   //   $title = null;
	//  if ($rs->fields['title_sub'] != null) $menu_name = "&raquo; <a href='".$rs->fields['url_sub']."'>".$rs->fields['title_sub']."</a>";
 		if($txtfield == 'price'){
		$gettmp['txtShow']	= number_format($rs->fields['titleName'],2);
		}else{
		$gettmp['txtShow']	= $rs->fields['titleName'];
		}
			
    return $gettmp['txtShow'];
  }
  
  public static function eXchangeRate($rateType, $cash) {
    $cashNew = null;
    global $db;
	#$db->debug=1;
	
      $sql = "SELECT ".$rateType." AS rateCash FROM rate_exchanges m WHERE 1 = 1 ORDER BY created_date DESC limit 0,1";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt);
	  
	  $cashNew = $rs->fields['rateCash']*$cash;
   //   $title = null;
	//  if ($rs->fields['title_sub'] != null) $menu_name = "&raquo; <a href='".$rs->fields['url_sub']."'>".$rs->fields['title_sub']."</a>";


    return number_format($cashNew,2);
  }  

public static function DeliveryFee($zone,$weight){
    $delivery_fee = null;
    global $db;	
	#$db->debug=1;
	$total_weight = $weight*1000;
	#echo "ZONE :".$zone." - WEIGHT : ".$weight." TOTAL = ".$total_weight;

	switch (true) {
      case ($total_weight <= 250) : $gettmp['zone_id'] = '1'; break;
      case ($total_weight > 250 && $total_weight <= 2000) : $gettmp['zone_id'] = '2'; break;
      case ($total_weight > 2000 && $total_weight <= 4500) : $gettmp['zone_id'] = '3'; break;
	  case ($total_weight > 4500 && $total_weight <= 7000) : $gettmp['zone_id'] = '4'; break;
	  case ($total_weight > 7000 && $total_weight <= 9500) : $gettmp['zone_id'] = '5'; break;
	  case ($total_weight > 9500 && $total_weight <= 12000) : $gettmp['zone_id'] = '6'; break;
	  case ($total_weight > 12000 && $total_weight <= 14500) : $gettmp['zone_id'] = '7'; break;
	  case ($total_weight > 14500 && $total_weight <= 17000) : $gettmp['zone_id'] = '8'; break;
	  case ($total_weight > 17000 && $total_weight <= 20000) : $gettmp['zone_id'] = '9'; break;
	  case ($total_weight > 20000 && $total_weight <= 22500) : $gettmp['zone_id'] = '10'; break;
	  case ($total_weight > 22500 && $total_weight <= 25000) : $gettmp['zone_id'] = '11'; break;
	  case ($total_weight > 25000 && $total_weight <= 27500) : $gettmp['zone_id'] = '12'; break;
	  case ($total_weight > 27500 && $total_weight <= 30000) : $gettmp['zone_id'] = '13'; break;
	  
      default :
        $gettmp['zone_id'] = "";
    }
	
		$sql = "SELECT m.".$zone." as delivery_fee FROM price_zones m WHERE 1 = 1  AND  m.id = ? ";
		$stmt = $db->Prepare($sql);
		$rs = $db->Execute($stmt,array($gettmp['zone_id']));
		$delivery_fee = $rs->fields['delivery_fee'];	
		
    return number_format($delivery_fee,2);
		
	}
  public static function ShippingMethod($shipping_method,$lang) {
    $gettmp['shipping_method'] = null;
    global $db;
	#$db->debug=1;
	if($lang == 'la'){
		 switch ($shipping_method) {
		  case '1' : $gettmp['shipping_method'] = 'ມາຮັບທີ່ຮ້ານນາຣີ'; break;
		  case '2' : $gettmp['shipping_method'] = 'Delivery Bus'; break;
		  case '3' : $gettmp['shipping_method'] = 'ຈັດສົ່ງໂດຍທາງລົດເມ'; break;
		  case '4' : $gettmp['shipping_method'] = 'ຈັດສົ່ງໂດຍທາງລົດຕູ້'; break;
		  case '5' : $gettmp['shipping_method'] = 'EMS'; break;
		  case '6' : $gettmp['shipping_method'] = 'ຈັດສົ່ງໂດຍທາງຍົນ'; break;		 

		  default :
			$gettmp['shipping_method'] = "";
		}
	}else{
		 switch ($shipping_method) {
		  case '1' : $gettmp['shipping_method'] = 'At Naree shop'; break;
		  case '2' : $gettmp['shipping_method'] = 'Delivery Bus'; break;
		  case '3' : $gettmp['shipping_method'] = 'Delivery By Bus'; break;
		  case '4' : $gettmp['shipping_method'] = 'Delivery By Van'; break;
		  case '5' : $gettmp['shipping_method'] = 'EMS'; break;
		  case '6' : $gettmp['shipping_method'] = 'Delivery By Plane'; break;
		  default :
			$gettmp['shipping_method'] = "";
		}
	} // End if Check Lang

    return $gettmp['shipping_method'];
  }  
public static function getMemberProfile($id,$value) {
    $title = null;
    if ($id != null) {
      global $db;
      $sql = "SELECT * FROM members_profiles WHERE members_profiles.id = ? ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $row = $db->GetRow($stmt, array($id));
	  if($value == 'memberID'){
      $title = encodeFromDB($row["memberID"]);
	  }else{
      $title = encodeFromDB($row["name"]);
	  }

    }
    return $title;
  }	    
  public static function getLocationZone($id, $txtfield) {
    $title = null;
    global $db;
	#$db->debug=1;
      $sql = "SELECT ".$txtfield." AS title FROM location_zones m WHERE 1 = 1 AND m.id = ? ";
      $stmt = $db->Prepare($sql);
      $rs = $db->Execute($stmt, array($id));
   //   $title = null;
	//  if ($rs->fields['title_sub'] != null) $menu_name = "&raquo; <a href='".$rs->fields['url_sub']."'>".$rs->fields['title_sub']."</a>";
 		$gettmp['txtShow']	= $rs->fields['title'];
			
    return $gettmp['txtShow'];
  }
   
}
?>