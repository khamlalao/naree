<?php
require_once "common.inc.php";
require_once DIR."library/adodb5/adodb.inc.php";
require_once DIR."library/adodb5/adodb-active-record.inc.php";
require_once DIR."library/class/class.GenericEasyPagination.php";
require_once DIR."library/config/config.php";
require_once DIR."library/config/connect.php";
require_once DIR."library/extension/extension.php";
require_once DIR."library/extension/utility.php";
require_once DIR."library/extension/lang.php";
require_once DIR."library/config/rewrite.php";
?>
<?php
global $db;
#$db->debug=1;
#print_r($_SESSION);

ADOdb_Active_Record::SetDatabaseAdapter($db);
// status 1 = 'la' , 2 = 'en' , 3 = 'all'
$sql = "SELECT * FROM product_categories m WHERE 1 = 1 AND (m.status = '1' OR  m.status = '3') ORDER BY m.sequence ASC";
$stmt = $db->Prepare($sql);
$rs = $db->Execute($stmt);
$itemList = $rs->GetAssoc();
$itemListCount = $rs->maxRecordCount();
?>
             <script>
        setInterval(function(){
//			alert("OK");
	//	 $('#yourcart-items').html("3");
				$.get('order_alert.php', {
				session : '<?php echo $_SESSION['session_login']?>',
				time : new Date().getTime()
				}, function(data) {
				//	alert(data);
				  $('#yourcart-items').html(data);
			  });
			  	
		}, 3000);
		</script>

<div class="content">
  <div class="logo"><a href="index.php"><img src="images/logo_naree.png" alt=""/></a></div>
  <div class="header_left"> 
    <!--mene top-->
    <ul class="menu_top">
      <li><a href="<?php echo str_replace('/la/', '/en/', $_SERVER['REQUEST_URI']) ?>" style="  text-align:center">Language: EN</a></li>
      <li><a href="#nogo" id="mycart" >
         <span id="yourcart-items"></span>

 <!-- // Amount No of Order -->
        <img src="images/icon/i_cart.png"   alt=""/> </a></li>
      <li><a href="register.php" class="txt-hover" id="nav_top4"><img src="images/icon/i_regis.png" alt=""/> Register</a></li>
      <li><a href="member_login.php" class="txt-hover" id="nav_top3"><img src="images/icon/i_account.png"   alt=""/> Log in</a></li>
      <li><a href="shop.php" class="txt-hover" id="nav_top2"><img src="images/icon/i_map.png"   alt=""/> Shop</a></li>
      <li><a href="where-to-buy.php" class="txt-hover" id="nav_top1"><img src="images/icon/i_how.png"   alt=""/> How to buy online</a></li>
    </ul>
    <!--//memu top-->
    <div class="clear"></div>
    <!--menu-->
    <div class="menu">
      <ul  class="dropdown">
        <li><a href="index.php" id="mn7">Home</a></li>
        <li><a href="naree_story.php" id="mn1">naree story</a></li>
        <li><a href="products.php"  id="mn2">products</a>
          <ul>
            <li><a href="products.php">All</a></li>
			<?php $i = 0; ?>
           <?php foreach ($itemList as $val) { ?> 
            <li><a href="products.php?parent_id=<?php echo $val['id']?>"><?php echo $val['title_en']?></a></li>
           <?php } ?>
          </ul>
        </li>
        <li><a href="promotion.php"  id="mn3">Promotion</a></li>
        <li><a href="news.php"  id="mn4">news</a></li>
        <li><a href="lookbook.php"  id="mn5">look book</a></li>
        <li><a href="contact.php"  id="mn6">contact us</a></li>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
</div>
