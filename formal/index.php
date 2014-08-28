<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Rafael Velez</title>
<meta name="viewport" content="initial-scale=1.0,width=device-width" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50387757-1', 'rafaelvelez.us');
  ga('send', 'pageview');

</script>
/head>
<body>

<!--STICKER-->
<div id="sticker"></div>

<div id="wrapper">
<?php 
//THE FOLLOWING SECTIONS ARE
//BROKEN UP INTO SEPARATE FILES
//YOU CAN REARRANGE THEM HERE
include('sections/bio.php');
include('sections/skills.php');
include('sections/experience.php');
include('sections/education.php');
include('sections/honors_awards.php');
//include('sections/as_seen_on.php');
//include('sections/recommendations.php');
include('sections/contact.php');
?>
</div><!--end wrapper-->

<!--COPYRIGHT-->
<div id="copyright">&copy; <?php echo date('Y');?> - Rafael Velez - Template provided by The Molitor</div>

<!--SCRIPTS-->
<script src="js/jquery.js"></script>
<script src="js/prettyPhoto.js"></script>
<script src="js/backPosition.js"></script>
<script src="js/custom.js"></script>

</body>
</html>