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

<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title>Naree Story | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="Naree Story |  NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<meta name="description" content="Naree is an ancient Pali/Sanskrit-derived Lao word, meaning woman or goddess. The Naree brand strives to communicate to modern women the value of tradition alongside social development. Naree modern handbags received the highest recognition for outstanding business plan in the World Bank is STEPS Young Entrepreneur Marketplace Competition in 2013. Naree became the first brand of handbags in the Lao PDR, opening its first store in the beginning of 2015 under the name, Naree Laos Brand. ">

<?php include('inc_css.php');?>

</head>

<body onLoad="getMN(1);">
<?php include('inc_cart_left.php')?>
<div id="wrapper"> 

  <!--Header-->

  <div id="header"  >

    <?php if(isset($_SESSION['member_id'])){ ?>

    <?php include('inc_header_login.php')?>

    <?php }else{?>

    <?php include('inc_header.php')?>

    <?php } ?>

  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/><span>Naree Story</span> </div>

      <!--end nav--> 

      

      <!--story-->

      

        <!--topic 1-->

      <div class="post">

      <div class="box-story-caption"> 
            <!--<div class="box-story-caption-L">[</div> -->
            <div class="box-story-caption-C">NAREE : Blending traditional craftsmanship with modern style</div>
            <!--<div class="box-story-caption-R">]</div> -->
          </div>

          
        <div class="box-story " style="margin-top:30px;">
         <?php foreach ($this->itemList as $val) { ?>
         <?php echo $val['detail_en']?>     
         <div class="img-story"> <img src="../img_story/<?php echo $val['file_name']?>" style="width:100%;"   alt="" /></div>
         <?php } ?>
        </div>
      </div>

       <!--//topic 1-->

       

       	  <!--topic 2-->
 

     

    </div>

  </div>

  <!--end content--> 

  

  <!--footer-->

  <div id="footer" >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

</div>



 

</body>

</html>

