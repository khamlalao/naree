<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
 <title>News  | NAREE : Blending traditional craftsmanship with modern style</title>
<meta name="title" content="News  | NAREE : Blending traditional craftsmanship with modern style">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women">
<meta name="description" content="News on website naree.co">

<?php include('inc_css.php');?>

</head>



<body onLoad="getMN(4);">

<?php include('inc_cart_left.php')?>

<div id="wrapper"> 

  <!--Header-->

  <div id="header"  >

    <!--Header-->

    <?php if(isset($_SESSION['member_id'])){ ?>

    <?php include('inc_header_login.php')?>

    <?php }else{?>

    <?php include('inc_header.php')?>

    <?php } ?>

    <!--End Header-->  </div>

  <!--//header--> 

  

  <!--content-->

  <div id="Containner">

    <div class="content"> 

      <!--nav-->

      <div class="nav post"> <a href="index.php" class="home">Home</a>   <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>News</span> </div>

      <!--end nav--> 

      

       

      <!--New-->

      <div class="product_model">

        <ul class="news-list">

         <?php $i =0; ?>

        <?php foreach ($this->itemList as $val) { ?>     

        <?php $i++; ?>

          <li class="post">

          <div class="box-news">

        <a href="news_detail.php?id=<?php echo $val['id']?>"><img src="../img_news/<?php echo $val['image']?>"  alt=""/>

        <div class="date"><?php echo $val['date_show']?><?php //= ($val['created_date'] != null) ? date('d.m.Y', strtotime($val['created_date'])) : '' ?>
		<?php if($val['status_new'] == 'Y'){?><div class="icon_new">UPDATE </div><?php } ?></div>

        <p class="topic-news"><?php echo $val['subject_en']?></p>

        </a>

        </div>

           </li>

      

          <?php if($i%4 == 0){?><div class="clear"></div><?php } ?>

         <?php } ?>

          

        </ul>

      </div>

      <!--Model--> 

      <div class="clear"></div>

        <!--page--> 

       <?php if ($this->maxpage > 1){ ?>

      <div id="page">

   		<ul>
			<?php echo paginate_three($this->Pagereload, $this->page, $this->maxpage, '2');?>
             <div class="clear"></div>
	    </ul>

      </div>

      <?php } ?>

        <div class="clear"></div>

      <!--//page--> 

      

    </div>

  </div>

  <!--end content--> 

  

  <!--footer-->

  <div id="footer" >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

</div>



</html>

