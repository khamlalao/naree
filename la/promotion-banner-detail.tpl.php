<!doctype html>
<html lang="en">
<head>
<meta http-equiv="content-type" charset="utf-8">
<title><?php echo $this->item->subject_la?></title>
<meta name="title" content="<?php echo $this->item->subject_la?>">
<meta name="keywords" content="shopping, Silk Bags,LEATHER BAGS,Cotton Bags,Bags,Laos brand, handbags, Lao PDR,goddess,woman,modern women,Register">
<!--<meta name="description" content="<?//=$this->item->description_la?>">
-->
<meta property="og:title" content="<?php echo $this->item->subject_la?>" />
<!--<meta property="og:description" content="<?//=$this->item->description_la?>" />
--><meta property="og:image" content="http://naree.co/img_promotion/banner/<?php echo $this->item->image?>" />
<meta property="og:url" content="http://naree.co/la/promotion-banner-detail.php?id=<?php echo $this->id?>" />
<meta property="og:type" content="website" />


<link rel="stylesheet" type="text/css" href="js/flexslider/flexslider.css">
<?php include('inc_css.php');?>
<script>

function popup(url,name,windowWidth,windowHeight){      

	myleft=(screen.width)?(screen.width-windowWidth)/2:100;   

	mytop=(screen.height)?(screen.height-windowHeight)/2:100;     

	properties = "width="+windowWidth+",height="+windowHeight;  

	properties +=",scrollbars=yes, top="+mytop+",left="+myleft;     

	window.open(url,name,properties);  

}

</script>
 </head>



<body onLoad="getMN(3);">

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

  <div id="Containner"  >

    <div class="content" style="min-height:500px;"> 

      <!--nav--> 
   
      <div class="nav post"> <a href="index.php" class="home">ໜ້າຫຼັກ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="promotion-all.php">ໂປຣໂມຊັ່ນ</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>ໂປຣໂມຊັ່ນລວມ</span> </div>

      <!--end nav--> 

      

      <!--New-->

      <div class="product_model post">

      

         <!--page--> 

     <div id="page" style="width:100%; margin:0 0 10px 0">

   		<ul>

        	 <li><a href="promotion-banner.php" class="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">

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

      

       	<div class="news-cover cover-promo">
        
          <img src="../img_promotion/banner/<?php echo $this->item->image?>"  alt=""/> 
 
          
        </div>

        <div class="news-detail">

        	 

            <!--detial-->

            <div class="box-news-detail">

           <!--   <div class="date"> Promotion Date</div>-->

<p class="topic-news"><strong><?php echo $this->item->subject_la?></strong></p>
<?php echo $this->item->description_la?>


<div class="news-btn">

               	  <ul>
					<?php if($this->item->file_doc != null){?>
				   <li class="promo-btn"><a href="../img_promotion/document/<?php echo $this->item->file_doc?>" target="_blank"><img src="images/icon/i_pdf.png" alt=""/> Download File </a></li>
                   <?php } ?>

                    <li class="promo-btn"><a href="javascript:popup('https://www.facebook.com/sharer.php?u=http://naree.co/la/promotion-banner-detail.php?id=<?php echo $this->id?>','',500,400)"><img src="images/icon-share.jpg" alt=""/> Share Facebook</a></li>

                      <div class="clear"></div>

              	  </ul>

                </div>
</div>

 <!--//detial-->



        </div>

        <div class="clear"></div>

            </div>

       <div class="clear"></div>

      <!--<div class="box-message">

    <img src="images/logo_coming.png" width="99" height="78"  alt=""/>

<h1> <span>How & Where to Buy</span></h1>

      	Coming Soon !

      </div>-->

   		

                 

      </div>

      <!--Model--> 

      

    </div>

 

  <!--end content--> 

  

  <!--footer-->

  <div id="footer" >

    <?php include('inc_footer.php');?>

  </div>

  <!--end footer--> 

  

</div>
<script src="js/flexslider/jquery.flexslider-min.js"></script>

 <script type="text/javascript">

 // Can also be used with $(document).ready()

$(window).load(function() {

  $('.flexslider').flexslider({

    animation: "slide"

  });

});

 </script>

 
 

 </body>

</html>

