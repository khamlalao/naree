<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NAREE</title>
<?php include('inc_css.php');?>
</head>

<body onLoad="get_account(5);">
<?php include('inc_cart_left.php')?>
<div id="wrapper"> 
  <!--Header-->
  <div id="header"  >
    <?php include('inc_header_login.php');?>
  </div>
  <!--//header--> 
  
  <!--content-->
  <div id="Containner">
    <div class="content"> 
      <!--nav-->
      <div class="nav post"> <a href="index.php" class="home">Home</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <a href="member.php">Member</a> <img src="images/icon/i_av.png" width="20" height="12"  alt=""/> <span>Notify Money Transfer</span> </div>
      <!--end nav--> 
      
      <!--Model-->
      <div class="product_model post">
        <?php include('inc_account.php');?>
        <div class="box-member-right ">
          <div class="box-content">
            <h1><span>Notify Money Transfer</span></h1>
            If the transfer is complete. Let me know
       <div class="box-login" style="width:100%">
              <ul class="form-all">
                <li>
                  <label>Order Number <span>*</span></label>
                  <select>
                    <option>NR20160405-001: 142 USD</option>
                    <option>NR20160405-002: 142 USD</option>
                  </select>
                </li>
                <li>
                  <label>Back Transfer <span>*</span></label>
                  <select>
                    <option>BANK LAO  Account No. 12345678</option>
                    <option>BANK LAO  Account No. 12345679</option>
                  </select>
                </li>
                <li>
                  <label>Transfer Total </label>
                  <input type="text">
                </li>
                <li>
                  <label>Time of Transfer<span>*</span></label>
                  <input type="text">
                </li>
                <li style="position:relative;">
                  <label>Date of Transfer<span>*</span></label>
                  <input type="text" id="datepicker">
                  <i class="fa fa-calendar" aria-hidden="true" style="position:absolute; right:10px; top:36px;"></i> </li>
                <li>
                  <label>Attach file </label>
                  <input type="file">
                </li>
                <li>
                  <label>Message </label>
                  <textarea name="" rows="4" ></textarea>
                </li>
                <li>
                  <input type="button" class="btn-login" value="SUBMIT">
                </li>
                <li style="text-align:center">or Reset</li>
              </ul>
            </div>
          </div>
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


    
     <link rel="stylesheet" href="js/datepicker/jquery-ui.css">
  <script src="js/datepicker/jquery-1.10.2.js"></script>
  <script src="js/datepicker/jquery-ui.js"></script>
   <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
  </script>

    </body>
</html>
