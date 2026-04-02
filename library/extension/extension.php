<?php
function datediff2($interval, $datefrom, $dateto, $using_timestamps = false)
{
  /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
    (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff2 is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
    */

  if (!$using_timestamps) {
    $datefrom = strtotime($datefrom, 0);
    $dateto = strtotime($dateto, 0);
  }
  $difference = $dateto - $datefrom; // Difference in seconds

  switch ($interval) {

    case 'yyyy': // Number of full years

      $years_difference = floor($difference / 31536000);
      if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
        $years_difference--;
      }
      if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
        $years_difference++;
      }
      $datediff2 = $years_difference;
      break;

    case "q": // Number of full quarters

      $quarters_difference = floor($difference / 8035200);
      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
        $months_difference++;
      }
      $quarters_difference--;
      $datediff2 = $quarters_difference;
      break;

    case "m": // Number of full months

      $months_difference = floor($difference / 2678400);
      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
        $months_difference++;
      }
      $months_difference--;
      $datediff2 = $months_difference;
      break;

    case 'y': // Difference between day numbers

      $datediff2 = @date("z", $dateto) - @date("z", $datefrom);
      break;

    case "d": // Number of full days

      $datediff2 = floor($difference / 86400);
      break;

    case "w": // Number of full weekdays

      $days_difference = floor($difference / 86400);
      $weeks_difference = floor($days_difference / 7); // Complete weeks
      $first_day = date("w", $datefrom);
      $days_remainder = floor($days_difference % 7);
      $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
      if ($odd_days > 7) { // Sunday
        $days_remainder--;
      }
      if ($odd_days > 6) { // Saturday
        $days_remainder--;
      }
      $datediff2 = ($weeks_difference * 5) + $days_remainder;
      break;
    case "ww": // Number of full weeks

      $datediff2 = floor($difference / 604800);
      break;

    case "h": // Number of full hours

      $datediff2 = floor($difference / 3600);
      break;

    case "n": // Number of full minutes

      $datediff2 = floor($difference / 60);
      break;

    default: // Number of full seconds (default)

      $datediff2 = $difference;
      break;
  }
  return $datediff2;
}

function numberofhour($end, $start)
{
  $i = datediff2('h', $end, $start, false);
  return $i;
}

function urlsafe_b64encode($string)
{
  $data = base64_encode($string);
  $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
  return $data;
}
function selfURL64()
{
  $s = empty($_SERVER["HTTPS"]) ? '' : (($_SERVER["HTTPS"] == "on") ? "s" : "");
  $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
  $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
  return urlsafe_b64encode($protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI']);
}
function selfurl()
{
  $s = empty($_SERVER["HTTPS"]) ? '' : (($_SERVER["HTTPS"] == "on") ? "s" : "");
  $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
  $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
  return urlsafe_b64encode($protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI']);
}
function strleft($s1, $s2)
{
  return substr($s1, 0, strpos($s1, $s2));
}
function urlsafe_b64decode($string)
{
  $data = str_replace(array('-', '_'), array('+', '/'), $string);
  $mod4 = strlen($data) % 4;
  if ($mod4) :
    $data .= substr('====', $mod4);
  endif;
  return base64_decode($data);
}
function getfilesize($filepath, $sizeunit)
{
  $SizeBite = filesize($filepath);

  switch ($sizeunit) {

    case "k": {
        $Sizeoffiile = $SizeBite / 1024;
      }
      break;

    case "m": {
        $Sizeoffiile = $SizeBite / 1024 / 1024;
      }
      break;
  }
  return  number_format($Sizeoffiile, 2);
}
function icontype($fullname)
{
  list($name, $type_ext) = explode(".", $fullname);
  switch (strtolower($type_ext)) {
    case "jpg": {
        $file_ext = "<img src='./images/i.jpg.gif' border='0' />";
      }
      break;

    case "ai": {
        $file_ext = "<img src='./images/iai.gif' border='0' />";
      }
      break;

    case "zip": {
        $file_ext = "<img src='./images/i.zip.gif' border='0' />";
      }
      break;
    case "rar": {
        $file_ext = "<img src='./images/i.rar.gif' border='0' />";
      }
      break;

    case "rtf": {
        $file_ext = "<img src='./images/i.rtf.gif' border='0' />";
      }
      break;
    case "txt": {
        $file_ext = "<img src='./images/i.rtf.gif' border='0' />";
      }
      break;
    case "doc": {
        $file_ext = "<img src='./images/i.doc.gif' border='0' />";
      }
      break;
    case "docx": {
        $file_ext = "<img src='./images/i.docx.gif' border='0' />";
      }
      break;
    case "xls": {
        $file_ext = "<img src='./images/i.xls.gif' border='0' />";
      }
      break;
    case "xlsx": {
        $file_ext = "<img src='./images/i.xlsx.gif' border='0' />";
      }
      break;
    case "ppt": {
        $file_ext = "<img src='./images/i.ppt.gif' border='0' />";
      }
      break;
    case "pptx": {
        $file_ext = "<img src='./images/i.pptx.gif' border='0' />";
      }
      break;
    case "pdf": {
        $file_ext = "<img src='./images/i.pdf.gif' border='0' />";
      }
      break;
    case "psd": {
        $file_ext = "<img src='./images/i.psd.gif' border='0' />";
      }
      break;
    case "tiff": {
        $file_ext = "<img src='./images/i.tiff.gif' border='0' />";
      }
      break;
    case "tif": {
        $file_ext = "<img src='./images/i.tif.gif' border='0' />";
      }
      break;
    case "png": {
        $file_ext = "<img src='./images/i.png.gif' border='0' />";
      }
      break;
    case "gif": {
        $file_ext = "<img src='./images/i.gif.gif' border='0'  />";
      }
      break;
  }

  return $file_ext;
}
function update_password($admin_id, $passwd)
{
  global $db;
  global $system;
  ADOdb_Active_Record::SetDatabaseAdapter($db);
  class admin_temp extends ADOdb_Active_Record {}
  $admin_temp = new admin_temp();
  $admin_temp->admin_id = $admin_id;
  $admin_temp->passwd = $passwd;
  $admin_temp->last_login = date("Y-m-d");
  $admin_temp->save();
}
function save_login($admin_id, $num)
{
  global $db;
  global $system;
  $sql = "SELECT * FROM admins WHERE admins.admin_id = ? ";
  if ($config["driver"] == "mssql") $stmt = $sql; // Fix for mssql prepare stmt
  $stmt = $db->Prepare($sql);
  $rs = $db->Execute($stmt, array($admin_id));
  $now_login = date('Y-m-d H:i:s');
  $lasttime =  floor((strtotime(date('Y-m-d H:i:s')) - strtotime($rs->fields['last_login'])) /  (60 * 60));

  //	if($lasttime < 24):

  if ($rs->fields['err_count'] < 3):

    ADOdb_Active_Record::SetDatabaseAdapter($db);
    class admin extends ADOdb_Active_Record {}
    $admin = new admin();
    $admin->load("admin_id=?", array($admin_id));
    $admin->err_count = $rs->fields['err_count'] + 1;
    $admin->last_login = date('Y-m-d H:i:s');
    $updatecommit = $admin->replace();
    $msg = "กรอกรหัสผิดพลาดครั้งที่ " . $admin->err_count . " ผิดได้ไม่เกิน 3 ครั้ง";

  else:
    ADOdb_Active_Record::SetDatabaseAdapter($db);
    class admin extends ADOdb_Active_Record {}
    $admin = new admin();
    $admin->load("admin_id=?", array($admin_id));
    $admin->passwd = md5(createRandomPassword());
    $admin->admin_active = "Inactive";
    $admin->err_count = 0;
    $admin->last_login = date('Y-m-d H:i:s');
    $updatecommit = $admin->replace();
    $msg = "alert";

  endif;
  /*else:
    ADOdb_Active_Record::SetDatabaseAdapter($db);
    class admin extends ADOdb_Active_Record{}
    $admin = new admin();
    $admin->load("admin_id=?", array($admin_id));					
    $admin->err_count =1;
    $admin->last_login = date('Y-m-d H:i:s');
    $updatecommit = $admin->replace();
    $msg = "กรอกรหัสผิดพลาดครั้งที่ ".$admin->err_count." ผิดได้ไม่เกิน 3 ครั้ง";		
    endif;*/
  return $msg;
}
function createRandomPassword()
{
  $chars = "abcdefghijkmnopqrstuvwxyz023456789";
  srand((float)microtime() * 1000000);
  $i = 0;
  $pass = '';
  while ($i <= 7) {
    $num = rand() % 33;
    $tmp = substr($chars, $num, 1);
    $pass = $pass . $tmp;
    $i++;
  }
  return $pass;
}

function saverecord($textdetail)
{
  global $db;
  global $system;
  $rs = $db->Execute("SELECT id FROM chk_logs");
  $numrows = $rs->RecordCount();
  if ($numrows >= 500)   $db->Execute("DELETE chk_logs FROM chk_logs");


  ADOdb_Active_Record::SetDatabaseAdapter($db);
  class chk_log extends ADOdb_Active_Record {}
  $chk_log = new chk_log();
  $chk_log->user_id = $_SESSION['admin_id'];
  $chk_log->sdate = date("Y-m-d H:i:s");
  $chk_log->ip = $_SERVER['REMOTE_ADDR'];
  $chk_log->detail = $textdetail;
  $chk_log->computer = gethostbyaddr($_SERVER['REMOTE_ADDR']);
  $chk_log->port = $port = $_SERVER["SERVER_PORT"];
  $chk_log->systems = $_SESSION['systemid_access'];
  $chk_log->user_agent = $_SERVER['HTTP_USER_AGENT'];
  $chk_log->referer = $_SERVER["REQUEST_URI"];
  $updatecommit = $chk_log->Save();
  if (!$updatecommit) :
    return  $chk_log->ErrorMsg();
    $chk_log = NULL;
  else:
    $chk_log = NULL;
    return  $updatecommit;
  endif;
}

function chkipban($ipaddress)
{
  global $db;
  global $system;
  $today = date("Y-m-d H:i:s");
  $gettmp['ip'] = $ipaddress;
  $sql = " SELECT * FROM ip_blocks WHERE ipaddress='" . $gettmp['ip'] . "' AND ip_status = 'Inactive'";
  $rs = $db->Execute($sql);
  if ($rs->Recordcount() > 0):

    ADOdb_Active_Record::SetDatabaseAdapter($db);
    class ip_block extends ADOdb_Active_Record {}
    $ip_block = new ip_block();
    $ip_block->load("ban_id=?", array($rs->fields[ban_id]));
    $ip_block->log_count = $rs->fields['log_count'] + 1;
    $ip_block->last_login = date('Y-m-d H:i:s');
    $ip_block->replace();
    return true;

  else:
    $sql1 = " SELECT * FROM ip_blocks WHERE ipaddress='" . $gettmp['ip'] . "' AND ip_status = 'Active' AND active_date > '" . $today . "' ";
    $rs1 = $db->Execute($sql1);
    if ($rs1->Recordcount() > 0):
      ADOdb_Active_Record::SetDatabaseAdapter($db);
      class ip_block extends ADOdb_Active_Record {}
      $ip_block = new ip_block();
      $ip_block->load("ban_id=?", array($rs->fields[ban_id]));
      $ip_block->log_count = $rs->fields['log_count'] + 1;
      $ip_block->last_login = date('Y-m-d H:i:s');
      $ip_block->replace();
      return true;
    else: return false;
    endif;
  endif;
}

function saverecordFile($textdetail, $name, $fileid)
{
  global $db;
  /*global $system;
    $rs = $db->Execute(' SELECT `chk_logs`.id FROM `chk_logs` ');
    $numrows=$rs->RecordCount();
    if ($numrows>=500) 	$db->Execute('DELETE `chk_logs` FROM `chk_logs` ') ;*/
  if ($fileid != 0):
    $rs = $db->Execute(" SELECT *  FROM file_payments WHERE file_pay_id='" . $fileid . "' ");
    $md5 = $rs->fields['md5hash'];
    $file_name = $rs->fields['file_name'];
  else:
    $md5 = 0;
    $file_name = "";
  endif;
  ADOdb_Active_Record::SetDatabaseAdapter($db);
  class file_payment_log extends ADOdb_Active_Record {}
  $file_payment_log = new file_payment_log();
  $file_payment_log->file_pay_id = $fileid;
  $file_payment_log->detail = $textdetail;
  $file_payment_log->user = $name;
  $file_payment_log->ip = $_SERVER['REMOTE_ADDR'];
  $file_payment_log->md5_last = $md5;
  $file_payment_log->file_name = $file_name;
  $file_payment_log->date_log = date('Y=m-d H:i:s');
  $updatecommit = $file_payment_log->save();
  if (!$updatecommit) :
    return  $file_payment_log->ErrorMsg();
    $file_payment_log = NULL;
  else:
    $file_payment_log = NULL;
    return  $updatecommit;
  endif;
}

function cuttext($nums, $text)
{
  if (strlen($text) > $nums) {
    //$getdata[txt]=substr($text,0,$nums)."...";
    $getdata['txt'] = mb_strcut($text, 0, $nums, 'UTF-8') . "...";
  } else {
    $getdata['txt'] = $text;
  }
  return $getdata['txt'];
}
function list_day($name, $id, $val, $class, $condition, $title)
{
  // FIX: Added quotes to 'listday' to prevent Undefined Constant error
  $getdata['listday'] = "<select name='$name' id='$id' $class $condition >";
  $getdata['listday'] .= "<option value=''>" . $title . "</option>";
  for ($loop = 1; $loop <= 31; $loop++) {
    $getdata['listday'] .= "<option value='$loop' ";
    if ($loop == $val) $getdata['listday'] .= " selected ";
    $getdata['listday'] .= ">$loop</option>";
  }
  $getdata['listday'] .= "</select>";
  return $getdata['listday'];
}

function list_month($name, $id, $val, $class, $condition, $monthtype)
{
  switch ($monthtype) {
    case "en":
      $getdata['monthdetail'] = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
      $txtshow = "Month";
      break;
    case "th":
      $getdata['monthdetail'] = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
      $txtshow = "เดือน";
      break;
    case "la":
      $getdata['monthdetail'] = array("ມັງກອນ", "ກຸມພາ", "ມີນາ", "ເມສາ", "ພຶດສະພາ", "ມິຖຸນາ", "ກໍລະກົດ", "ສິງຫາ", "ກັນຍາ", "ຕຸລາ", "ພະຈິກ", "ທັນວາ");
      $txtshow = "ເດືອນ";
      break;
    default:
      $getdata['monthdetail'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
      $txtshow = "Month";
      break;
  }

  $getdata['listday'] = "<select name='$name' id='$id' $class $condition >";
  $getdata['listday'] .= "<option value='' >" . $txtshow . "</option>";
  for ($loop = 1; $loop <= 12; $loop++) {
    $getdata['listday'] .= "<option value='$loop' ";
    if ($loop == $val) $getdata['listday'] .= " selected ";
    $getdata['listday'] .= ">" . $getdata['monthdetail'][$loop - 1] . "</option>";
  }
  $getdata['listday'] .= "</select>";
  return $getdata['listday'];
}

function list_year($name, $id, $val, $class, $condition, $yeartype)
{
  switch ($yeartype) {
    case "th":
      $getdata['yeartype'] = 543;
      $txtshow = "ปี";
      break;
    case "la":
      $getdata['yeartype'] = 0;
      $txtshow = "ປີ";
      break;
    default:
      $getdata['yeartype'] = 0;
      $txtshow = "Year";
      break;
  }

  $getdata['listday'] = "<select name='$name' id='$id' $class $condition>";
  $getdata['listday'] .= "<option value='' >" . $txtshow . "</option>";
  // Show 60 years back
  for ($loop = (date("Y") - 60); $loop <= (date("Y")); $loop++) {
    $getdata['listday'] .= "<option value='$loop' ";
    if ($loop == $val) $getdata['listday'] .= " selected ";
    $getdata['listday'] .= ">" . ($loop + $getdata['yeartype']) . "</option>";
  }
  $getdata['listday'] .= "</select>";
  return $getdata['listday'];
}

function list_year_full($name, $id, $val, $class, $condition, $yeartype)
{
  // Added quotes to 'yeartype' and 'listday'
  $getdata['yeartype'] = ($yeartype == "th") ? 543 : 0;

  $getdata['listday'] = "<select name='$name' id='$id' $class $condition>";
  $getdata['listday'] .= "<option value='-' >Year</option>";
  for ($loop = (date("Y")); $loop <= (date("Y") + 5); $loop++) {
    $getdata['listday'] .= "<option value='$loop' ";
    if ($loop == $val) $getdata['listday'] .= " selected ";
    $getdata['listday'] .= ">" . ($loop + $getdata['yeartype']) . "</option>";
  }
  $getdata['listday'] .= "</select>";
  return $getdata['listday'];
}

// And finally, the missing function that likely started at the end of your text:
function list_year_age($name, $id, $val, $class, $condition, $yeartype)
{
  $offset = ($yeartype == "th") ? 543 : 0;

  $getdata['listday'] = "<select name='$name' id='$id' $class $condition>";
  $getdata['listday'] .= "<option value='' > Year</option>";
  for ($loop = (date("Y") - 18); $loop >= (date("Y") - 100); $loop--) {
    $getdata['listday'] .= "<option value='$loop' ";
    if ($loop == $val) $getdata['listday'] .= " selected ";
    $getdata['listday'] .= ">" . ($loop + $offset) . "</option>";
  }
  $getdata['listday'] .= "</select>";
  return $getdata['listday'];
}


function date_nottime_edit_with_slash($date)
{
  list($yy, $mm, $dd) = explode("-", $date);
  if ($dd < 10) {    // óդҴ
    $dd = substr($dd, 1, 2);
  }
  if ($mm < 10) {    // óդҴ
    $mm = substr($mm, 1, 2);
  }
  $date = $dd . "/" . $mm . "/" . $yy;
  return $date;
}
function date_edit_with_slash($date, $type)
{
  if ($type != "") {    // óդҴ
    list($date, $time) = explode(" ", $date);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  if ($dd < 10) {    // óդҴ
    $dd = substr($dd, 1, 2);
  }
  if ($mm < 10) {    // óդҴ
    $mm = substr($mm, 1, 2);
  }
  $date = $dd . "/" . $mm . "/" . $yy . "&nbsp;" . $time;
  return $date;
}

function checkfile($fullname)
{
  list($name, $type_ext) = explode(".", $fullname);
  switch (strtolower($type_ext)) {
    case "jpg": {
        $file_ext = ".jpg";
      }
      break;

    case "swf": {
        $file_ext = ".swf";
      }
      break;

    case "zip": {
        $file_ext = ".zip";
      }
      break;
    case "rar": {
        $file_ext = ".rar";
      }
      break;

    case "rtf": {
        $file_ext = ".rtf";
      }

    case "doc": {
        $file_ext = ".doc";
      }
      break;
    case "xls": {
        $file_ext = ".xls";
      }
      break;
    case "ppt": {
        $file_ext = ".ppt";
      }
      break;
    case "pdf": {
        $file_ext = ".pdf";
      }
      break;
    default: {
        return false;
      }
      break;
  }

  return $file_ext;
}

function insertzeroid($num)
{
  $temp = "";
  $looptotal =  5 - strlen($num);
  for ($i = 1; $i <= $looptotal; $i++) {
    $temp .= "0";
  }
  return $temp . $num;
}

function randompassword($length)
{
  /*
    Programmed by Christian Haensel, christian@chftp.com, LINK1http://www.chftp.comLINK1
    Exclusively published on weberdev.com.
    If you like my scripts, please let me know or link to me.

    You may copy, redistirubte, change and alter my scripts as long as this information remains intact
    */


  $length        =    8; // Must be a multiple of 2 !! So 14 will work, 15 won't, 16 will, 17 won't and so on

  // Password generation
  $conso = array(
    "b",
    "c",
    "d",
    "f",
    "g",
    "h",
    "j",
    "k",
    "l",
    "m",
    "n",
    "p",
    "r",
    "s",
    "t",
    "v",
    "w",
    "x",
    "y",
    "z"
  );
  $vocal = array("a", "e", "i", "o", "u");
  $password = "";
  srand((float)microtime() * 1000000);
  $max = $length / 2;
  for ($i = 1; $i <= $max; $i++) {
    $password .= $conso[rand(0, 19)];
    $password .= $vocal[rand(0, 4)];
  }
  $newpass = $password;
  return $newpass;
}

function list_keycode($val)
{
  // Added quotes to 'keylist' and 'keycode'
  $getdata['keylist'] = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
  $getdata['keycode'] = "";

  for ($loop = 1; $loop <= 52; $loop++) {
    if ($loop == $val) {
      $getdata['keycode'] = $getdata['keylist'][$loop - 1];
    }
  }
  return $getdata['keycode'];
}

function valid_email($email)
{
  // PHP's built-in validator is much faster and more accurate than ereg
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return 2; // Success code based on your original logic
  } else {
    return 1; // Error code based on your original logic
  }
}
function date_edit($date, $dlm)
{
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . $dlm . $mm . $dlm . $yy;
  return $date;
}

function date_edit_with_dash($date, $type)
{
  if ($type != "") {    // óդҴ
    list($date, $time) = explode(" ", $date);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . "-" . $mm . "-" . substr($yy, 2, 4) . " " . $time;
  return $date;
}
function date_edit_with_dash_xx($date)
{
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . "-" . $mm . "-" . substr($yy, 2, 4);
  return $date;
}
function date_edit_with_dash3($date, $type)
{
  if ($type != "") {    // óդҴ
    list($date, $time) = explode(" ", $date);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . "-" . $mm . "-" . substr($yy, 2, 4);
  return $date;
}


function edit_en_shot_date($tmp)
{

  $thmonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

  // tmp : value date
  // type of  obj : 1=วันที่กับเวลา, 0=วันที่อย่างเดีย
  list($year, $month, $day) = explode("-", $tmp);
  /*	if($day<10){
    $day = substr($day,1,2);
    }*/
  $datedit = $day . " " . $thmonth[$month - 1] . " " . $year;

  return $datedit;
}
function edit_en_comma_date($tmp)
{

  $thmonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  list($year, $month, $day) = explode("-", $tmp);
  $datedit = $thmonth[$month - 1] . " " . $day . ",  " . $year;

  return $datedit;
}
function time_edit($date, $type)
{
  // type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว
  if ($type != "") {    // กรณีมีค่าเวลามาด้วย
    list($date, $time) = explode(" ", $date);
    list($hh, $mmm, $ss) = explode(":", $time);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . "-" . $mm . "-" . substr($yy, 2, 4) . "&nbsp;" . $hh . ":" . $mmm;
  return $date;
}
function time_editz($date)
{
  // type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . "-" . $mm . "-" . substr($yy, 2, 4);
  return $date;
}
function time_edit2($date, $type)
{
  // type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว
  if ($type != "") {    // กรณีมีค่าเวลามาด้วย
    list($date, $time) = explode(" ", $date);
    list($hh, $mmm, $ss) = explode(":", $time);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $hh . ":" . $mmm;
  return $date;
}
function date_edit2($date, $type)
{
  // type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว	
  if ($type != "") {    // กรณีมีค่าเวลามาด้วย
    list($date, $time) = explode(" ", $date);
    list($hh, $mmm, $ss) = explode(":", $time);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . "." . $mm . "." . substr($yy, 2, 4) . "&nbsp;" . $hh . ":" . $mmm;
  return $date;
}
function date_edit3($date, $type)
{
  // type of  obj : 1=วันที่กับเวลา, ค่่าว่าง=วันที่อย่างเดียว	
  if ($type != "") {    // กรณีมีค่าเวลามาด้วย
    list($date, $time) = explode(" ", $date);
    list($hh, $mmm, $ss) = explode(":", $time);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$mm)); $i++) $dd = "0" . $mm;
  $date = $dd . "-" . $mm . "-" . substr($yy, 2, 4) . "&nbsp;" . $hh . ":" . $mmm;
  return $date;
}

function datetime_with_dep($datetime)
{
  list($date, $time) = explode(" ", $datetime);
  list($yy, $mm, $dd) = explode("-", $date);
  list($hh, $ii, $ss) = explode(":", $time);
  $printdate = date("d / m / y   h.i  a.", (mktime($hh, $ii, 0, $mm, $dd, $yy)));
  return $printdate;
}
function date_edit_with_dash2($date, $type)
{
  if ($type != "") {    // óդҴ
    list($date, $time) = explode(" ", $date);
  }
  list($yy, $mm, $dd) = explode("-", $date);
  for ($i = 1; $i <= (2 - strlen((string)$dd)); $i++) $dd = "0" . $dd;
  for ($i = 1; $i <= (2 - strlen((string)$MM)); $i++) $dd = "0" . $MM;
  $date = $dd . "-" . $MM . "-" . substr($yy, 4, 4) . " " . $time;
  return $date;
}

//calculate years of age (input string: YYYY-MM-DD)
function birthday($birthday)
{
  list($year, $month, $day) = explode("-", $birthday);
  $year_diff  = date("Y") - $year;
  $month_diff = date("m") - $month;
  $day_diff   = date("d") - $day;
  if ($month_diff < 0) $year_diff--;
  elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
  return $year_diff;
}
function edittime($edittime)
{
  $edittime = substr($edittime, 0, -3);
  return $edittime;
}
function islock($curdate, $curtime)
{
  $disable = "";
  $getvar['time'] = date("G");
  $num = (int)$getvar['time'];
  $num = $num + 2;
  $curtime = (int)$curtime;

  $getvar['now'] = date("Y-m-d");
  if ($getvar['now'] == $curdate) {
    if ($num >= $curtime) {
      $disable = "disabled=\"disabled\"";
    }
  }

  return $disable;
}
function prekey($id)
{
  $id = sprintf("%04d", $id);
  return $id;
}
function isok($curstatus)
{
  $bgcolor = "";
  if ($curstatus == "Close") :
    $bgcolor = "bgcolor=\"#9A9A9A\"";
  endif;
  if ($curstatus == "Reserve") :
    $bgcolor = "bgcolor=\"#336799\"";
  endif;
  if ($curstatus == "Active") :
    $bgcolor = "bgcolor=\"#578E3D\"";
  endif;
  return $bgcolor;
}
function is_av($curstatus)
{
  $disable = "";
  if ($curstatus == "Reserve") :
    $disable = "disabled=\"disabled\"";
  endif;

  if ($curstatus == "Active") :
    $disable = "disabled=\"disabled\"";
  endif;

  /*	if ($curstatus == "Close") :
    $disable ="disabled=\"disabled\"" ; 
    endif ;
    */
  return $disable;
}
function is_av2($curstatus)
{
  $disable = "";
  if ($curstatus == "Reserve") :
    $disable = "disabled=\"disabled\"";
  endif;

  if ($curstatus == "Active") :
    $disable = "disabled=\"disabled\"";
  endif;

  if ($curstatus == "Close") :
    $disable = "disabled=\"disabled\"";
  endif;

  return $disable;
}
// get_magic_quotes_gpc() was removed in PHP 8.0 - it always returned false since PHP 5.4
if (false) {
  function stripslashes_gpc(&$value)
  {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
  array_walk_recursive($_GET, 'stripslashes_gpc');
  array_walk_recursive($_POST, 'stripslashes_gpc');
  array_walk_recursive($_COOKIE, 'stripslashes_gpc');
  array_walk_recursive($_REQUEST, 'stripslashes_gpc');
} else {
  function htmlspecialchars_deep(&$value)
  {
    $value = trim($value);
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
  array_walk_recursive($_GET, 'htmlspecialchars_deep');
  array_walk_recursive($_POST, 'htmlspecialchars_deep');
  array_walk_recursive($_COOKIE, 'htmlspecialchars_deep');
  array_walk_recursive($_REQUEST, 'htmlspecialchars_deep');
}
function htmldecode($value)
{
  $value =  htmlspecialchars_decode($value, ENT_QUOTES);
  //$value = htmlspecialchars($value, ENT_QUOTES,'UTF-8');
  return $value;
}
function dmy($dateselect)
{
  if (!empty($dateselect)) :
    $dateselect =  strtotime($dateselect);
    return  date("d-m-y", $dateselect);
  endif;
}
function pres($ar1, $ar2)
{
  if ((!empty($ar1)) && (!empty($ar2))) :
    $pres = 7;
  else :
    $pres = 5;
  endif;
  return $pres;
}

function Cart_period($rs)
{

  foreach ($rs as $key => $val):
    $cart[] = $val;
  endforeach;

  $cart_period = $cart;
  $chk_num = 0;
  $chk_st = 0;
  $j = 1;

  for ($i = 0; $i < (count($cart)); $i++):
    $time_i = explode(":", $cart[$i]['time_active']);
    $time_j = explode(":", $cart[$j]['time_active']);
    $subtime = (string)(($time_j[0] . "." . $time_j[1]) - ($time_i[0] . "." . $time_i[1]));
    $cart_period[$i]['amount'] = 0;

    if (($cart[$j]['arena_id'] == $cart[$i]['arena_id']) && ($cart[$j]['arena_id2'] == $cart[$i]['arena_id2']) && (($subtime == 0.3) || ($subtime == 0.7)) && (($cart[$j]['price']) == ($cart[$i]['price']))):
      $chk_num += 1; //จำนวนลูปซ้ำ
      if ($chk_num == 1):
        $chk_st = $i; // จุดเริ่มต้นลูป
      endif;
    else:
      if ($i == 0 || $chk_num == 0):
        $cart_period[$i]['amount'] = 1;
        if ($i == (count($cart) - 2)):
          $cart_period[1]['amount'] = 1;
        endif;
      else:
        $cart_period[$chk_st]['amount'] = $chk_num + 1;
        $chk_num = 0;
      endif;
    endif;
    $j++;
  endfor;

  $i = 0;
  foreach ($cart_period as $key => $val):
    if ($val['amount'] == 0):
      unset($cart_period[$i]);
    else:
      $time_list = explode(":", $val['time_active']);
      if ($time_list[1] == 30):
        $cart_period[$i]['time_start'] = $time_list[0] . ":30";
        $chkS = 1;
      else:
        $cart_period[$i]['time_start'] = $time_list[0] . ":00";
        $chkS = 0;
      endif;

      $divUnt = floor((3 * ($val['amount'] + $chkS)) / 6);

      if (((3 * ($val['amount'] + $chkS)) % 6) != 0) {
        $divUnt = (($val['time_active'] * 1) + $divUnt) . ":30";
      } else {
        $divUnt = (($val['time_active'] * 1) + $divUnt) . ":00";
      }

      $cart_period[$i]['time_end'] = $divUnt;
      $cart_period[$i]['price'] /= 2;

      // Sort a-z
      $key_sort[$i] = $time_list[0] . $time_list[1];
    endif;
    $i++;
  endforeach;

  if (!empty($key_sort)) {
    natsort($key_sort);
    $i = 0;
    foreach ($key_sort as $key => $val) {
      $sort_cart_period[$i] = $cart_period[$key];
      $i++;
    }
    return $sort_cart_period;
  }
  return $cart_period;
}

function DateDiff($strDate1, $strDate2)
{
  return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);
}


//echo numberofhour("2010-03-25 14:47:16","2010-03-25 18:03:16");

function checkmedia($fullname, $size, $maxsize)
{
  $parts = explode(".", $fullname);
  $type_ext = end($parts);
  $file_ext = false;

  switch (strtolower($type_ext)) {
    case "avi":
      $file_ext = ".avi";
      break;
    case "wmv":
      $file_ext = ".wmv";
      break;
    case "asf":
      $file_ext = ".asf";
      break;
    case "wma":
      $file_ext = ".wma";
      break;
    case "wax":
      $file_ext = ".wax";
      break;
    case "wmd":
      $file_ext = ".wmd";
      break;
    case "wvx":
      $file_ext = ".wvx";
      break;
    case "wm":
      $file_ext = ".wm";
      break;
    case "wmz":
      $file_ext = ".wmz";
      break;
    case "swf":
      $file_ext = ".swf";
      break;
    case "mpg":
    case "mpeg":
      $file_ext = ".mpg";
      break;
    case "flv":
      $file_ext = ".flv";
      break;
    case "mov":
      $file_ext = ".mov";
      break;
    default:
      return false;
  }

  if ($size > $maxsize) return false;
  return $file_ext;
}

function encodePath($sIn)
{
  $abfrom = "";
  for ($x = 0; $x <= 25; $x++) $abfrom .= chr(65 + $x);
  for ($x = 0; $x <= 25; $x++) $abfrom .= chr(97 + $x);
  for ($x = 0; $x <= 9; $x++)  $abfrom .= $x;

  $abto = substr($abfrom, 13) . substr($abfrom, 0, 13);
  $encode = "";
  for ($x = 0; $x < strlen($sIn); $x++) {
    $char = substr($sIn, $x, 1);
    $y = strpos($abfrom, $char);
    if ($y === false) {
      $encode .= $char;
    } else {
      $encode .= substr($abto, $y, 1);
    }
  }
  return $encode;
}
function decodePath($sIn)
{
  for ($x = 0; $x <= 25; $x++):
    $abfrom .= chr(65 + $x);
  endfor;
  for ($x = 0; $x <= 25; $x++):
    $abfrom .= chr(97 + $x);
  endfor;
  for ($x = 0; $x <= 9; $x++):
    $abfrom .= $x;
  endfor;
  $abto = substr($abfrom, 13, strlen($abfrom) - 13) . substr($abfrom, 0, 13);
  for ($x = 0; $x <= strlen($sIn); $x++):
    $y = strpos($abto, substr($sIn, $x, 1));
    if ($y == "0" || $y == 0):
      $decode .= substr($sIn, $x, 1);
    else:
      $decode .= substr($abfrom, $y, 1);
    endif;
  endfor;
  return $decode;
}
function getThaiMonth($m)
{
  $m *= 1;
  $month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
  return $month[$m];
}

function getThaiDay($d)
{
  $day = array("", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์");
  return $day[$d];
}

function housebystatus($status)
{
  if ($status == "one") return "ใหม่";
  if ($status == "two") return "มือสอง";
  return "";
}

function getpvn($pvn)
{
  global $db;
  $SQLpvn = "SELECT Province FROM asset_regionprovinces WHERE ProvinceID = '$pvn'";
  $rspvn = $db->CacheExecute($SQLpvn);
  return $rspvn->fields['Province'];
}

function getAmphurs($rgn, $pvn, $amp)
{
  global $db;
  $rs = $db->CacheExecute("SELECT Amphur FROM asset_provinceamphurs WHERE RegionID='$rgn' AND PRovinceID='$pvn' AND AmphurID='$amp'");
  return $rs->fields['Amphur'];
}

function getCorpType($type)
{
  switch ($type) {
    case "1":
      return "นิติบุคคล";
    case "2":
      return "ทะเบียนพาณิชย์";
    case "3":
      return "บุคคลธรรมดา";
    case "4":
      return "เจ้าหน้าที่";
    default:
      return "";
  }
}
function getNextId($table, $amphurid, $provinceid, $ownertype, $postby)
{
  global $db;
  if ($table == "asset_forrents"):
    $pmy = "forrentid";
  else:
    $pmy = "forsellid";
  endif;
  $SQL = "SELECT id FROM " . $table . " WHERE statusshow!='0' AND amphurid='" . $amphurid . "' AND provinceid='" . $provinceid . "' ORDER BY " . $pmy . " DESC LIMIT 0,1";
  $rs = $db->Execute($SQL);
  if ($rs->RecordCount() != 0):
    //$rest = substr("abcdef", 2, -1);  // returns "cde" // 10 46 9 0001 1  substr($rs->fields['id'],4 ,-2); (for 10 digit)
    //$text = str_replace($find, $replace, $text); PHP 5.3 compatible
    $rs->fields['id'] = @str_replace('-', '', $rs->fields['id']); // old asset id convert
    $max =  substr($rs->fields['id'], 5, -1);
    $max  = $max * 1; // convert to number
    if ($max == 9999):
      $max = 1;
    else:
      $max += 1;
    endif;
  else:
    $max = 1;
  endif;
  $getnextid = sprintf("%02d", $provinceid) . sprintf("%02d", $amphurid) . $ownertype . sprintf("%04d", $max) . $postby;
  return $getnextid;
}

function tis2utf8($tis)
{
  return $tis; // Logic needs implementation if actually translating
}
