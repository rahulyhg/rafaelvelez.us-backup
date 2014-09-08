<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!doctype html>
<html lang="en" ng-app="myApp">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{title}}</title>
    <!-- Mobile viewport optimized -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap CSS -->
    <!-- <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="includes/css/styles.css"> -->
    <link rel="stylesheet" href="css/app.css">
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    
    
</head>
<body ng-class="bodyClass">
  <div ng-view></div>
  <!-- Bootstrap JS -->
  <!-- <script src="lib/bootstrap/js/bootstrap.min.js"></script> -->

  <!-- In production use:
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
  -->
  <script src="lib/angular/angular.js"></script>
  <script src="lib/angular/angular-route.js"></script>
  <script src="lib/angularui/ui-bootstrap-tpls-0.11.0.min.js" type="text/javascript"></script>
  <script src="js/app.js"></script>
  

  

  <script src="js/controllers/loginCtrl.js"></script>
  <script src="js/controllers/homeCtrl.js"></script>
  
  <script src="js/services/loginService.js"></script>
  <script src="js/services/sessionService.js"></script>
</body>
</html>
