<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
<link rel="stylesheet" type="text/css" href="css/naree.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<link rel="stylesheet" type="text/css" href="font-face/stylesheet.css">
<link rel="stylesheet" type="text/css" href="css/dropdown.css">
<script type="text/javascript" src="../js/jquery-1.8.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@300;700;900&family=Noto+Serif+Lao&display=swap"
  rel="stylesheet" />
<!--scroll-effects content-->
<link rel="stylesheet" type="text/css" href="js/scroll-effects/animate.css" />
<!--end-->

<script type="text/javascript" src="js/jquery-1.8.1.min.js"></script>


<script src="js/functions.js"></script>
<script src="js/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<link rel="stylesheet" type="text/css" href="js/perfect-scrollbar/css/perfect-scrollbar.css">








<script type="text/javascript">
  jQuery(function() {
    jQuery(".dim").hide();
    jQuery("#addCart, #mycart").click(function() {
      jQuery("#box-cart-app").animate({
        right: '0'
      }, 300);
      jQuery(".dim").fadeIn();
      jQuery("body").addClass('has-active-menu');
      // jQuery(".menu").slideUp();

    });

    jQuery(".dim, #close-cart").click(function() {
      jQuery("#box-cart-app").animate({
        right: '-344px'
      }, 300);
      jQuery(".dim").fadeOut();
      jQuery("body").removeClass('has-active-menu');
      // jQuery('#mn-mobile').show();
      //jQuery('#mn-mobile-close').hide();
      //$('#mn-mobile').show();
      //$('#mn-mobile-close').hide();
    });



  });
</script>

<!-- Add jQuery library -->
<!--<script type="text/javascript" src="js/lightbox/lib/jquery-latest.min.js"></script>-->

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="js/lightbox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="js/lightbox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/lightbox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<!--<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>-->
<script language="javascript" type="text/javascript">
  $(document).ready(function() {
    //				  $('#num-item').val('5');

  });
</script>






<link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" href="favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="favicons/manifest.json">
<link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#000000">
<meta name="theme-color" content="#ffffff">


<script>
  (function(i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function() {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
      m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
  })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

  ga('create', 'UA-98110655-1', 'auto');
  ga('send', 'pageview');
</script>