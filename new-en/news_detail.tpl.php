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

<?php  include('inc_cart_left.php')?>

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

      <div class="nav post"> <a href="index.php" class="home">Home</a>   <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span><a href="news.php">News</a></span><img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span><?php echo $this->item->subject_en?></span> </div>

      <!--end nav--> 

      

       

      <!--New-->

      <div class="product_model post">

      

         <!--page--> 

     <div id="page" style="width:100%; margin:0 0 10px 0">

   		<ul>

        	 <li><a href="news.php" class="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><img src="images/icon/arrow_left.png"  alt=""/> </td>

    <td>&nbsp;</td>

    

    <td>BACK</td>

  </tr>

</table>

</a></li>

            

      		  <div class="clear"></div>

            

	    </ul>

      </div>

        <div class="clear"></div>

      <!--//page--> 

      

       	<div class="news-cover">
        <div id="default" class="contentHolder">
        <img src="../img_news/large/<?php echo $this->item->image?>"  alt=""/>
       <?php foreach($this->listImage as $val){ ?>
        <img src="../img_news_gallery/<?php echo $val['file_name']?>" width="100%"   alt=""/>
        <?php } ?>
        </div>
           <p>  * Place mouse over an image and scroll down to see other pictures.</p>
        </div>

        <div class="news-detail">

        	<!--btn ถ้าไม่มีข้อมูลให้หายไป-->

            	<div class="news-btn">

               	  <ul>

				  <?php if($this->listImageCount == 'show'){// close icon gallery?>

                  <?php $i=1;?>

                	  <li>

                      <a class="fancybox" rel="gallery<?php echo $i?>"  href="../img_news/large/<?php echo $this->item->image?>">

                      <img src="images/icon/i_gallery.png"  alt=""/> Gallery</a>

                      <?php foreach($this->listImage as $val){ ?>

                      <a class="fancybox" rel="gallery<?php echo $i?>"  href="../img_news_gallery/<?php echo $val['file_name']?>"></a>

                      <?php } ?>

                      </li>

                   <?php } ?>   

                      <?php if($this->item->file_doc != ''){ ?>

                      <li><a href="../img_news/document/<?php echo $this->item->file_doc?>"><img src="images/icon/i_pdf.png" alt=""/> Document </a></li>

                      <?php } ?>

                      <?php if($this->item->url_youtube != ''){ ?>

                      <li><a class="various fancybox.iframe" href="<?php echo $this->item->url_youtube?>?autoplay=1"><img src="images/icon/i_vdo.png"   alt=""/> VDO</a></li>

                      <?php } ?>

                      <div class="clear"></div>

              	  </ul>

                </div>

            <!--//btn-->

            <!--detial-->

            <div class="box-news-detail">

              <div class="date"><?php echo $this->item->date_show?><?php //= ($this->item->created_date != null) ? date('d.m.Y', strtotime($this->item->created_date)) : '' ?></div>

<p class="topic-news"><strong><?php echo $this->item->subject_en?></strong></p>

<?php echo  convTextFromDB(encodeFromDB($this->item->description_en)) ?> 

</div>

 <!--//detial-->



        </div>

        <div class="clear"></div>

            </div>

      <!--Model--> 

      

        

      

    </div>

  </div>

  <!--end content--> 

  

  <!--footer-->

  <div id="footer" >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

</div>



 

 <script type="text/javascript">

 $(document).ready(function() {

	$(".fancybox").fancybox({

		openEffect	: 'none',

		closeEffect	: 'none'

	});

});



$(document).ready(function() {

	$(".various").fancybox({

		maxWidth	: 800,

		maxHeight	: 600,

		fitToView	: false,

		width		: '70%',

		height		: '70%',

		autoSize	: false,

		closeClick	: false,

		openEffect	: 'none',

		closeEffect	: 'none'

	});

});

</script>
 

</body>

</html>

