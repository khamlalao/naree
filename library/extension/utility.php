<?php

function convert($number)
{
  $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
  $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
  $number = str_replace(",","",$number);
  $number = str_replace(" ","",$number);
  $number = str_replace("บาท","",$number);
  $number = explode(".",$number);
  if(sizeof($number)>2){
    return 'ทศนิยมหลายตัวนะจ๊ะ';
    exit;
  }
  $strlen = strlen($number[0]);
  $convert = '';
  for($i=0;$i<$strlen;$i++){
    $n = substr($number[0], $i,1);
    if($n!=0){
      if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
      elseif($i==($strlen-2) AND $n==2){ $convert .= 'ยี่'; }
      elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
      else{ $convert .= $txtnum1[$n]; }
      $convert .= $txtnum2[$strlen-$i-1];
    }
  }
  $convert .= 'บาท';
  if($number[1]=='0' OR $number[1]=='00' OR $number[1]==''){
    $convert .= 'ถ้วน';
  }else{
    $strlen = strlen($number[1]);
    for($i=0;$i<$strlen;$i++){
      $n = substr($number[1], $i,1);
      if($n!=0){
        if($i==($strlen-1) AND $n==1){$convert .= 'เอ็ด';}
        elseif($i==($strlen-2) AND $n==2){$convert .= 'ยี่';}
        elseif($i==($strlen-2) AND $n==1){$convert .= '';}
        else{ $convert .= $txtnum1[$n];}
        $convert .= $txtnum2[$strlen-$i-1];
      }
    }
    $convert .= 'สตางค์';
  }
  return $convert;
}

function setFilter($text)
{
  return preg_replace('/\+?[0-9][0-9()-\s+]{4,20}[0-9]/', 'xxxx', $text);
}

function genxml($parent_id){
	global $db;
	global $system;
		$gettmp['parent_id'] = $parent_id ; 
		$query_Recordset1 = " SELECT * FROM ebook_content_attachments WHERE ebook_content_attachments.parent_id='".$gettmp['parent_id']."' ORDER BY ebook_content_attachments.sequence ASC ";		
		$rs = $db->Execute($query_Recordset1);
				
$xml_output = "<?xml version=\"1.0\"?>\n"; 
$xml_output .= "<FlippingBook>\n"; 					
$xml_output .= "<width>900</width>\n"; 
$xml_output .= "<height>450</height>\n"; 
$xml_output .= "<scaleContent>true</scaleContent>\n"; 
$xml_output .= "<firstPage>0</firstPage>\n"; 
$xml_output .= "<alwaysOpened> false </alwaysOpened>\n";
$xml_output .= "<autoFlip> 50 </autoFlip>\n"; 
$xml_output .= "<flipOnClick> true </flipOnClick>\n"; 
$xml_output .= "<staticShadowsDepth> 0.8 </staticShadowsDepth>\n"; 
$xml_output .= "<dynamicShadowsDepth> 0.5 </dynamicShadowsDepth>\n"; 
$xml_output .= "<moveSpeed> 5 </moveSpeed>\n"; 
$xml_output .= "<closeSpeed> 2 </closeSpeed>\n"; 
$xml_output .= "<gotoSpeed> 2 </gotoSpeed>\n"; 
$xml_output .= "<flipSound></flipSound>\n"; 
$xml_output .= "<pageBack> 0xffffff </pageBack>\n"; 
$xml_output .= "<loadOnDemand> true </loadOnDemand>\n"; 
$xml_output .= "<cachePages> true </cachePages>\n"; 
$xml_output .= "<cacheSize> 4 </cacheSize>\n"; 
$xml_output .= "<preloaderType> Progress Bar </preloaderType>\n"; 
$xml_output .= "<userPreloaderId></userPreloaderId>\n"; 
$xml_output .= "<pages>\n"; 

//	<page>pages/page01.jpg</page>
if (!$rs->EOF): 
	while (!$rs->EOF): 
	$xml_output .= "<page>pages/".$rs->fields['file_name']."</page>\n"; 
//	$xml_output .= "<page>../../attachments/".$rs->fields['file_name']."</page>\n"; 
	$rs->MoveNext(); 
	endwhile; 
 endif;
$xml_output .= "</pages>\n"; 
$xml_output .= "</FlippingBook>\n"; 
//echo $xml_output; 

//$directory = "../img_ebooks/issue/".$gettmp['parent_id']."/";
$directory = "../img_ebooks/book/issue".$gettmp['parent_id']."/";
$directory_css = "../img_ebooks/book/issue".$gettmp['parent_id']."/css/";
$directory_img = "../img_ebooks/book/issue".$gettmp['parent_id']."/pages/";
$directory_scr = "../img_ebooks/book/issue".$gettmp['parent_id']."/Scripts/";
$directory_xml = "../img_ebooks/book/issue".$gettmp['parent_id']."/xml/";

if (!file_exists($directory)) {
mkdir($directory, 0777); 
}
if (!file_exists($directory_css)) {
mkdir($directory_css, 0777); 
}
if (!file_exists($directory_img)) {
mkdir($directory_img, 0777); 
}
if (!file_exists($directory_scr)) {
mkdir($directory_scr, 0777); 
}
if (!file_exists($directory_xml)) {
mkdir($directory_xml, 0777); 
}


$fileflash = '../img_ebooks/book/issue_source/book.swf';
$fileflash_new = "book.swf";
$filehtml = '../img_ebooks/book/issue_source/main.htm';
$filehtml_new = "main.htm";
$fileobj = '../img_ebooks/book/issue_source/swfobject.js';
$fileobj_new = "swfobject.js";
$filecss1 = '../img_ebooks/book/issue_source/css/intro.css';
$filecss1_new = "intro.css";
$filecss2 = '../img_ebooks/book/issue_source/css/tahoma.css';
$filecss2_new = "tahoma.css";
$filesrc = '../img_ebooks/book/issue_source/Scripts/AC_RunActiveContent.js';
$filesrc_new = "AC_RunActiveContent.js";

    $file = fopen($directory_xml."config.xml","w");
	copy($fileflash, $directory.$fileflash_new);
	copy($filehtml, $directory.$filehtml_new);
	copy($fileobj, $directory.$fileobj_new);	
	copy($filecss1, $directory_css.$filecss1_new);	
	copy($filecss2, $directory_css.$filecss2_new);	
	copy($filesrc, $directory_scr.$filesrc_new);	

    fwrite($file, $xml_output);
    fclose($file);	
}
function genxml_all($parent_id){
	global $db;
	global $system;
		$gettmp['parent_id'] = $parent_id ; 
		$today = date("Y-m-d H:i:s");
		$query_Recordset1 = "SELECT * FROM ebook_contents WHERE ebook_contents.id='".$gettmp['parent_id']."' ";
		$rs1 = $db->Execute($query_Recordset1);
		$numAll = $rs1->Recordcount();		

		$query_Recordset2 = "SELECT * FROM ebook_contents WHERE ebook_contents.parent_id='".$rs1->fields['parent_id']."' AND ebook_contents.enabled = 'yes' ORDER BY ebook_contents.sequence ASC ";			
		$rs2 = $db->Execute($query_Recordset2);		
	//     echo $query_Recordset1."<BR>".$query_Recordset2;
$xml_output = "<?xml version=\"1.0\"?>\n"; 
$xml_output .= "<allBook>\n"; 					

if (!$rs2->EOF): 
	while (!$rs2->EOF): 
		$query_Recordset1 = " SELECT * FROM ebook_content_attachments WHERE ebook_content_attachments.parent_id='".$rs2->fields['id']."' ";		
		$rs = $db->Execute($query_Recordset1);	
		$num = $rs->Recordcount();
		if($num!=0):
    $xml_output .= "<book>\n"; 
	$xml_output .= "<page>../../contents/".$rs2->fields['file_thumbnail']."</page>\n"; 
	$xml_output .= "<link>../issue".$rs2->fields['id']."/main.htm</link>\n"; 
	$xml_output .= "<title>".$rs2->fields['title']."</title>\n"; 	
    $xml_output .= "</book>\n"; 
		endif;
	$rs2->MoveNext(); 
	endwhile; 
 endif;
$xml_output .= "</allBook>\n"; 

	$directory_xml = "../img_ebooks/book/issue".$gettmp['parent_id']."/";
				// Check File Or  Folder  issue id  
					if (!file_exists($directory_xml)) {
					genxml($gettmp['parent_id']); 
					}
    $file = fopen($directory_xml."all_book.xml","w");
    fwrite($file, $xml_output);
    fclose($file);	
}
function genxml_all_dellist($parent_id){
	global $db;
	global $system;
		$gettmp['parent_id'] = $parent_id ; 
		$today = date("Y-m-d H:i:s");
		$query_Recordset2 = "SELECT * FROM ebook_contents WHERE ebook_contents.parent_id='".$gettmp['parent_id']."' AND ebook_contents.enabled = 'yes' ORDER BY ebook_contents.sequence ASC ";			
		$rs2 = $db->Execute($query_Recordset2);		
	//     echo $query_Recordset1."<BR>".$query_Recordset2;
$xml_output = "<?xml version=\"1.0\"?>\n"; 
$xml_output .= "<allBook>\n"; 					

if (!$rs2->EOF): 
	while (!$rs2->EOF): 
		$query_Recordset1 = " SELECT * FROM ebook_content_attachments WHERE ebook_content_attachments.parent_id='".$rs2->fields['id']."' ";		
		$rs = $db->Execute($query_Recordset1);	
		$num = $rs->Recordcount();
		if($num!=0):
    $xml_output .= "<book>\n"; 
	$xml_output .= "<page>../../contents/".$rs2->fields['file_thumbnail']."</page>\n"; 
	$xml_output .= "<link>../issue".$rs2->fields['id']."/main.htm</link>\n"; 
	$xml_output .= "<title>".$rs2->fields['title']."</title>\n"; 	
    $xml_output .= "</book>\n"; 
		endif;
	$rs2->MoveNext(); 
	endwhile; 
 endif;
$xml_output .= "</allBook>\n"; 

	$directory_xml = "../img_ebooks/book/issue".$gettmp['parent_id']."/";
    $file = fopen($directory_xml."all_book.xml","w");
    fwrite($file, $xml_output);
    fclose($file);	
}

  function getParam($name) {
    $param = ($_GET[$name] == null) ? ($_POST[$name] == null) ? null : $_POST[$name] : $_GET[$name];
    return $param;
  }
  
  function getParamDefault($name, $default) {
    $param = ($_GET[$name] == null) ? ($_POST[$name] == null) ? $default : $_POST[$name] : $_GET[$name];
    return $param;
  }
  
  function getExtension($str) {
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
  }  

  function getIconImage($str) {
    $ext = getExtension($str);
    if (($ext == "gif") || ($ext == "GIF")) :      
    elseif (($ext == "jpg") || ($ext == "JPG") || ($ext == "jpeg") || ($ext == "JPEG")) : return "i.jpg.gif";
    elseif (($ext == "png") || ($ext == "PNG")) : return "i.png.gif";       
    elseif (($ext == "bmp") || ($ext == "BMP")) : return "i.image.gif";          
    elseif (($ext == "psd") || ($ext == "PSD")) : return "i.psd.gif";
    elseif (($ext == "tif") || ($ext == "TIF")) : return "i.tif.gif";
    elseif (($ext == "tiff") || ($ext == "TIFF")) : return "i.tiff.gif";
    elseif (($ext == "doc") || ($ext == "DOC")) : return "i.doc.gif";
    elseif (($ext == "docx") || ($ext == "DOCX")) : return "i.docx.gif";   
    elseif (($ext == "xls") || ($ext == "XLS")) : return "i.xls.gif";
    elseif (($ext == "xlsx") || ($ext == "XLSX")) : return "i.xlsx.gif";  
    elseif (($ext == "ppt") || ($ext == "PTT")) : return "i.ppt.gif";
    elseif (($ext == "pptx") || ($ext == "PTTX")) : return "i.pptx.gif";   
    elseif (($ext == "pdf") || ($ext == "PDF")) : return "i.pdf.gif";   
    elseif (($ext == "rar") || ($ext == "RAR")) : return "i.rar.gif";    
    elseif (($ext == "zip") || ($ext == "ZIP")) : return "i.zip.gif";  
    elseif (($ext == "txt") || ($ext == "TXT")) : return "i.txt.gif";  
    else : return "";
    endif;                        
  }  
  
  function getFileSizeText($byte_size) {
    if ($byte_size > (1024 * 1024 * 1024)) : // GB.
      return number_format(($byte_size / (1024 * 1024 * 1024)), 2)." GB.";
    elseif ($byte_size > (1024 * 1024)) : // MB.
      return number_format(($byte_size / (1024 * 1024)), 2)." MB.";
    elseif ($byte_size > (1024)) : // KB.
      return number_format(($byte_size / (1024)), 2)." KB.";     
    else : // Byte.
      return number_format($byte_size, 2)." Byte.";
    endif;
  }
  
  function getThaiMonthFull($month) {
    if (1 == $month) : 
      return "มกราคม";
    elseif (2 == $month) :
      return "กุมภาพันธ์";
    elseif (3 == $month) :
      return "มีนาคม";
    elseif (4 == $month) :
      return "เมษายน";
    elseif (5 == $month) :
      return "พฤษภาคม";
    elseif (6 == $month) :
      return "มิถุนายน";
    elseif (7 == $month) :
      return "กรกฎาคม";
    elseif (8 == $month) :
      return "สิงหาคม";
    elseif (9 == $month) :
      return "กันยายน";
    elseif (10 == $month) :
      return "ตุลาคม";
    elseif (11 == $month) :
      return "พฤศจิกายน";
    else :
      return "ธันวาคม";
    endif;
  }
  
  function getThaiMonthShort($month) {
    if (1 == $month) : 
      return "ม.ค.";
    elseif (2 == $month) :
      return "ก.พ.";
    elseif (3 == $month) :
      return "ม.ค.";
    elseif (4 == $month) :
      return "เม.ย.";
    elseif (5 == $month) :
      return "พ.ค.";
    elseif (6 == $month) :
      return "มิ.ย.";
    elseif (7 == $month) :
      return "ก.ค.";
    elseif (8 == $month) :
      return "ส.ค.";
    elseif (9 == $month) :
      return "ก.ย.";
    elseif (10 == $month) :
      return "ต.ค.";
    elseif (11 == $month) :
      return "พ.ย.";
    else :
      return "ธ.ค.";
    endif;
  }
    function getEnMonthFull($month) {
    if (1 == $month) : 
      return "January";
    elseif (2 == $month) :
      return "February";
    elseif (3 == $month) :
      return "March";
    elseif (4 == $month) :
      return "April";
    elseif (5 == $month) :
      return "May";
    elseif (6 == $month) :
      return "June";
    elseif (7 == $month) :
      return "July";
    elseif (8 == $month) :
      return "August";
    elseif (9 == $month) :
      return "September";
    elseif (10 == $month) :
      return "October";
    elseif (11 == $month) :
      return "November";
    else :
      return "December";
    endif;	
  }
  
  function getEnMonthShort($month) {
	  $enmonth=array("","Jan","Feb","Mar","April","May","June","July","Aug","Sep","Oct","Nov","Dec");
	  return $enmonth[$month];
  }
  
  function encodeToDB($text) {
    global $config;
    if ($text == null) {
      return null;
    } elseif ($config["encodingprogram"] == $config["encodingdb"]) {
      return $text;
    } else {
      return iconv($config["encodingprogram"], $config["encodingdb"], $text);
    }
  }
  
  function encodeFromDB($text) {
    global $config;
    if (($text == null) || ($config["encodingprogram"] == $config["encodingdb"])) {
      return $text;
    } else {
      return iconv($config["encodingdb"], $config["encodingprogram"], $text);
    }
  }
  
  function convTextToDB($text) {
    global $config;
    return str_replace($config["imagesadmpath"], $config["imageswebpath"], str_replace($config["tinymceadmpath"], $config["tinymcewebpath"], $text));
  }
  
  function convTextFromDB($text){
    global $config;
    return str_replace($config["imageswebpath"], $config["imagesadmpath"], str_replace($config["tinymcewebpath"], $config["tinymceadmpath"], $text));
  }
  
  function getCountDownText($timestamp) {
      $timestamp = $timestamp - mktime();
      $text = "";
      $count = 0;
      if (floor($timestamp / (24 * 60 * 60)) > 0) {
        $count++;
        $day = floor($timestamp / (24 * 60 * 60));
        $text = $text.$day." Days ";
        $timestamp = $timestamp - ($day * (24 * 60 * 60));
        if ($count > 1) {
          return $text;
        }
      }
      if (floor($timestamp / (60 * 60)) > 0) {
        $count++;
        $hour = floor($timestamp / (60 * 60));
        $text = $text.$hour." Hours ";
        $timestamp = $timestamp - ($hour * (60 * 60));
        if ($count > 1) {
          return $text;
        }
      }
      if (floor($timestamp / (60)) > 0) {
        $count++;
        $minite = floor($timestamp / (60));
        $text = $text.$minite." Minutes ";
        $timestamp = $timestamp - ($minite * (60));
        if ($count > 1) {
          return $text;
        }
      }
      if ($timestamp > 0) {
        $count++;
        $secound = $timestamp;
        $text = $text.$secound." วินาที ";
        $timestamp = $timestamp - ($secound);
        if ($count > 1) {
          return $text;
        }
      }
      return $text;
  }
  
  function getThaiCountDownText($timestamp) {
      $timestamp = $timestamp - mktime();
      $text = "";
      $count = 0;
      if (floor($timestamp / (24 * 60 * 60)) > 0) {
        $count++;
        $day = floor($timestamp / (24 * 60 * 60));
        $text = $text.$day." วัน ";
        $timestamp = $timestamp - ($day * (24 * 60 * 60));
        if ($count > 1) {
          return $text;
        }
      }
      if (floor($timestamp / (60 * 60)) > 0) {
        $count++;
        $hour = floor($timestamp / (60 * 60));
        $text = $text.$hour." ช.ม. ";
        $timestamp = $timestamp - ($hour * (60 * 60));
        if ($count > 1) {
          return $text;
        }
      }
      if (floor($timestamp / (60)) > 0) {
        $count++;
        $minite = floor($timestamp / (60));
        $text = $text.$minite." นาที ";
        $timestamp = $timestamp - ($minite * (60));
        if ($count > 1) {
          return $text;
        }
      }
      if ($timestamp > 0) {
        $count++;
        $secound = $timestamp;
        $text = $text.$secound." วินาที ";
        $timestamp = $timestamp - ($secound);
        if ($count > 1) {
          return $text;
        }
      }
      return $text;
  }

  function getAge($birthdate, $format = null) {
    //$birthday = "01/01/1970"; //d/m/Y
    if ($format == null) $format = "d/m/Y";
    $today = date("d/m/Y");
    list($bday, $bmonth, $byear)= explode("/",$birthday);
    list($tday, $tmonth, $tyear)= explode("/",$today);
    //$mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
    $mbirthday = mktime(0, 0, 0, intval($bmonth), intval($bday), intval($byear));
    $mnow = mktime(0, 0, 0, intval($tmonth), intval($tday), intval($tyear));
    $mage = ($mnow - $mbirthday);
    return (date("Y", $mage) - 1970);
  }
  
  function formatNationalId($num) {
    $num = preg_replace('/[^0-9]/', '', $num);
    $len = strlen($num);
    if ($len == 13) {
      $num = preg_replace('/([0-9]{1})([0-9]{4})([0-9]{5})([0-9]{2})([0-9]{1})/', '$1-$2-$3-$4-$5', $num);
    } else {
      $num = -1;
    }
    return $num;
  }
  
  
  function getThaiCurrencyText($number)
  {
    $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
    $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
    $number = str_replace(",","",$number);
    $number = str_replace(" ","",$number);
    $number = str_replace("บาท","",$number);
    $number = explode(".",$number);
    if(sizeof($number)>2){
    return 'ทศนิยมหลายตัวนะจ๊ะ';
    exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for($i=0;$i<$strlen;$i++){
    $n = substr($number[0], $i,1);
    if($n!=0){
      if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
      elseif($i==($strlen-2) AND $n==2){ $convert .= 'ยี่'; }
      elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
      else{ $convert .= $txtnum1[$n]; }
      $convert .= $txtnum2[$strlen-$i-1];
    }
    }
    $convert .= 'บาท';
    if($number[1]=='0' OR $number[1]=='00' OR $number[1]==''){
    $convert .= 'ถ้วน';
    }else{
    $strlen = strlen($number[1]);
    for($i=0;$i<$strlen;$i++){
      $n = substr($number[1], $i,1);
      if($n!=0){
      if($i==($strlen-1) AND $n==1){$convert .= 'เอ็ด';}
      elseif($i==($strlen-2) AND $n==2){$convert .= 'ยี่';}
      elseif($i==($strlen-2) AND $n==1){$convert .= '';}
      else{ $convert .= $txtnum1[$n];}
      $convert .= $txtnum2[$strlen-$i-1];
      }
    }
    $convert .= 'สตางค์';
    }
    return $convert;
  }
  
  function saveLog($description = null, $module = null, $item_id = null, $do = null) {
    global $config;
    global $db;
    
    $sql = "
        SELECT Count(logs.id) AS amount, Min(logs.created_date) AS min_date, '' AS temp 
        FROM logs ";
    $stmt = $db->Prepare($sql);
    if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
    $row = $db->GetRow($stmt);
    
    if (($row["amount"] >= $config["log_size"]) || ($row["min_date"] < date("Y-m-d H:i:s", strtotime($config["log_time"])))) {
      $sql = "
INSERT INTO log_olds( 
user_id, username, created_date, 
module, item_id, do, description, 
computer, systems, user_agent, ip, port, uri, script_name, query_string
)
SELECT 
user_id, username, created_date, 
module, item_id, do, description, 
computer, systems, user_agent, ip, port, uri, script_name, query_string
FROM logs
WHERE logs.created_date > ?
          ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $db->Execute($sql, array(date("Y-m-d H:i:s", strtotime($config["log_time"])))) ;
      
      $sql = "DELETE FROM logs WHERE logs.created_date > ? ";
      $stmt = $db->Prepare($sql);
      if ($db->databaseType == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
      $db->Execute($sql, array(date("Y-m-d H:i:s", strtotime($config["log_time"])))) ;
    }

    ADOdb_Active_Record::SetDatabaseAdapter($db);
    if (! class_exists("log")) {
      class log extends ADOdb_Active_Record{}
    }
    $log = new log();
    $log->user_id = $_SESSION['admin_id'];
    $log->username = $_SESSION['username'];
    $log->created_date = date("Y-m-d H:i:s");
    $log->module = ($module != null) ? $module : null;
    $log->item_id = ($item_id != null) ? $item_id : null;
    $log->do = ($do != null) ? $do : null;
    $log->description = ($description != null) ? $description : null;
    $log->computer = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $log->systems = $_SESSION['systemid_access'];
    $log->user_agent = $_SERVER['HTTP_USER_AGENT'];
    $log->ip = $_SERVER["REMOTE_ADDR"];
    $log->port = $_SERVER["SERVER_PORT"];
    $log->uri = $_SERVER["REQUEST_URI"];
    $log->script_name = $_SERVER["SCRIPT_NAME"];
    $log->query_string = $_SERVER["QUERY_STRING"];
    $log->Save("id");
  }
?>