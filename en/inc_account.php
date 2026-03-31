<?php
require_once "common.inc.php";
require_once DIR."library/config/sessionstart.php";
require_once DIR."library/adodb5/adodb.inc.php";
require_once DIR."library/adodb5/adodb-active-record.inc.php";
require_once DIR."library/class/class.GenericEasyPagination.php";
require_once DIR."library/config/config.php";
require_once DIR."library/config/connect.php";
require_once DIR."library/extension/extension.php";
require_once DIR."library/extension/utility.php";
require_once DIR."library/extension/lang.php";
require_once DIR."library/config/rewrite.php";
require_once DIR."library/Savant3.php";
?>
<?php
global $db;
?>
<div class="box-member-left ">
<ul class="mn-account">
<li class="account"> <img src="images/profile.png" width="50" height="50"  alt=""/><?php echo $_SESSION['member_name']?></li>
<li><a href="member.php" id="mn_account1">Account Details</a></li>
<li><a href="member_address.php"  id="mn_account2">Shipping Addresses</a></li>
<li><a href="member_order.php"  id="mn_account3">Order History</a></li>
<li><a href="member_wishlist.php"  id="mn_account4">My Wishlist</a></li>
<!-- <li><a href="member_notifer.php"  id="mn_account5">Notify Money Transfer</a></li>  -->

</ul>
</div>