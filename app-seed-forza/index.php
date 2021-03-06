<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en" 
      ng-app="themesApp"
      ng-controller="MainController">
<head>
  <meta charset="utf-8">
  <title>{{info_title || 'Rali'}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Rali-Software Time Saver App">
  <meta name="author" content="Rali-Software">

  <link rel="icon" type="image/png" href="favicon.png">

  <!-- prochtml:remove:dist -->
  <link href="assets/less/styles.less" rel="stylesheet/less" media="all"> 
  <!-- /prochtml -->

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link href='assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher'> 
        
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
  <!--[if lt IE 9]>
    <link rel="stylesheet" href="assets/css/ie8.css">
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
    <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
    <script type='text/javascript' src='assets/plugins/misc/placeholdr.js'></script>
  <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->

    <!-- build:css assets/css/vendor.css -->
    <!-- bower:css -->
    <link rel="stylesheet" href="bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" />
    <link rel="stylesheet" href="bower_components/angular-ui-tree/dist/angular-ui-tree.min.css" />
    <link rel="stylesheet" href="bower_components/angular-toggle-switch/angular-toggle-switch.css" />
    <link rel="stylesheet" href="bower_components/ng-grid/ng-grid.css" />
    <link rel="stylesheet" href="bower_components/angular-xeditable/dist/css/xeditable.css" />
    <link rel="stylesheet" href="bower_components/select2/select2.css" />
    <link rel="stylesheet" href="bower_components/jScrollPane/style/jquery.jscrollpane.css" />
    <!-- endbower -->
    <link rel='stylesheet' type='text/css' href='assets/fonts/glyphicons/css/glyphicons.min.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/icheck/all.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/form-multiselect/css/multi-select.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/form-fseditor/fseditor.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/form-tokenfield/bootstrap-tokenfield.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/datepaginator/bootstrap-datepaginator.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/jquery-fileupload/css/jquery.fileupload-ui.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/bootstro.js/bootstro.min.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/progress-skylo/skylo.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/jcrop/css/jquery.Jcrop.min.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/form-daterangepicker/daterangepicker-bs3.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/form-markdown/css/bootstrap-markdown.min.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/pines-notify/jquery.pnotify.default.css' /> 
    <link rel='stylesheet' type='text/css' href='assets/plugins/codeprettifier/prettify.css' />
    <link rel='stylesheet' type='text/css' href='assets/plugins/form-select2/select2.css' />
    <link rel='stylesheet' type='text/css' href='assets/plugins/fullcalendar/fullcalendar.css' />
    <!-- endbuild -->

    <!-- build:css({.tmp,app}) assets/css/main.css -->
      <link rel="stylesheet" href="assets/css/main.css">
      <link rel="stylesheet" href="assets/css/styles.css">
    <!-- endbuild -->

    <!-- prochtml:remove:dist -->
    <script type="text/javascript">less = {}; less.env = 'development';</script>
    <script type="text/javascript" src="assets/plugins/misc/less.js"></script>
    <!-- /prochtml -->

<style type="text/css">
[ng-cloak] {
  display: none;
}
.topNegative1000 {
  top: -1000px !important;
}
.topZero {
  top: 0 !important;
}
  
.mainview-animation {
  position: relative;
}
.mainview-animation.ng-enter {
  -webkit-transition: .3s linear all; /* Safari/Chrome */
  -moz-transition: .3s linear all; /* Firefox */
  -o-transition: .3s linear all; /* Opera */
  transition: .3s linear all; /* IE10+ and Future Browsers */
}

/**
 * Pre animation -> enter
 */
.mainview-animation.ng-enter{
  /* The animation preparation code */
  opacity: 0;
}

/**
 * Post animation -> enter
 */
.mainview-animation.ng-enter.ng-enter-active { 
  /* The animation code itself */
  opacity: 1;
}

.angular-google-map-container { height: 300px; }
.navbar.navbar-default.ng-hide {
  display: none;
}
#page-rightbar .jspHorizontalBar {
  /*display: none !important;*/
}
.fc-grid .fc-day-number {
  padding: 5px 6px;
}
</style>
</head>

<body class=""
  
  ng-class="{
              'static-header': !style_fixedHeader,
              'focusedform': style_fullscreen,
              'layout-horizontal': style_layoutHorizontal,
              'fixed-layout': style_layoutBoxed,
              'collapse-leftbar': style_leftbarCollapsed && !style_leftbarShown,
              'show-rightbar': style_rightbarCollapsed,
              'show-leftbar': style_leftbarShown
            }"
  ng-cloak
>
    <!--
    <div id="headerbar" ng-class="{topNegative1000: style_headerBarHidden, topZero: !style_headerBarHidden}">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-brown">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-pencil"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Create Post
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-grape">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-group"></i></div>
                            <div class="pull-right"><span class="badge">2</span></div>
                        </div>
                        <div class="tiles-footer">
                            Contacts
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-primary">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-envelope-o"></i></div>
                            <div class="pull-right"><span class="badge">10</span></div>
                        </div>
                        <div class="tiles-footer">
                            Messages
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-inverse">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-camera"></i></div>
                            <div class="pull-right"><span class="badge">3</span></div>
                        </div>
                        <div class="tiles-footer">
                            Gallery
                        </div>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-midnightblue">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-cog"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Settings
                        </div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="#" class="shortcut-tiles tiles-orange">
                        <div class="tiles-body">
                            <div class="pull-left"><i class="fa fa-wrench"></i></div>
                        </div>
                        <div class="tiles-footer">
                            Plugins
                        </div>
                    </a>
                </div>
                            
            </div>
        </div>
    </div>
    -->

    <header class="navbar navbar-inverse" ng-class="{'navbar-fixed-top': style_fixedHeader, 'navbar-static-top': !style_fixedHeader}" role="banner">
        <a id="leftmenu-trigger" tooltip-placement="right" tooltip="Toggle Sidebar" ng-click="toggleLeftBar()"></a>
        <!-- <a id="rightmenu-trigger" tooltip-placement="left" tooltip="Toggle Infobar" ng-click="toggleRightBar()"></a> -->

        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="#/">Rali</a>
        </div>

        <ul class="nav navbar-nav pull-right toolbar">
          <li class="dropdown" ng-show="!isLoggedIn">
            <a href="#/login" style="font-size: 14px"><i class="fa fa-sign-in"></i> Log in</a>
          </li>
          <li class="dropdown" ng-show="isLoggedIn">
            <a href="#" class="dropdown-toggle username"><span class="hidden-xs">{{info_name_user || 'User'}}</span><img ng-src="assets/img/avatar/{{info_avatar || 'default-avatar.gif'}}" alt="{{info_name_user || 'User'}}" /></a>
            <ul class="dropdown-menu userinfo arrow">
              <li class="userlinks">
                <ul class="dropdown-menu">
                 <!-- <li><a href="#">Edit Profile <i class="pull-right fa fa-fw fa-pencil"></i></a></li>
                  <li><a href="#">Account <i class="pull-right fa fa-fw fa-user"></i></a></li>
                  <li><a href="#">Settings <i class="pull-right fa fa-fw fa-cog"></i></a></li>
                  <li class="divider"></li>
                  <li><a href="#">Earnings <i class="pull-right fa fa-fw fa-dollar"></i></a></li>
                  <li><a href="#">Statement <i class="pull-right fa fa-fw fa-bars"></i></a></li>
                  <li><a href="#">Withdrawals <i class="pull-right fa fa-fw fa-credit-card"></i></a></li>
                  <li class="divider"></li> -->
                  <li><a href="" class="text-right" ng-click="logOut()">Sign Out</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <!--
          <li class="dropdown" ng-controller="MessagesController" ng-show="isLoggedIn"
            data-bootstro
            data-bootstro-step="2"
            data-bootstro-placement='bottom'
            data-bootstro-content="Click to mark messages as read."
            >
            <a href="#" class="dropdown-toggle">
              <i class="fa fa-envelope"></i><span class="badge badge-danger" ng-if="unseenCount>0" ng-bind="unseenCount"></span>
            </a>
            <ul class="dropdown-menu messages arrow">
              <li class="dd-header">
                <span>You have {{unseenCount}} new message(s)</span>
                <span><a href="#" ng-click="setReadAll($event)">Mark all Read</a></span>
              </li>
                  <div class="scrollthis" jscrollpane="{autoReinitialise:true, autoReinitialiseDelay: 20}">
                    <li ng-repeat="item in messages">
                      <a href="#/extras-chatroom" ng-class="{active: !item.read}">
                        <button tooltip-placement="top" tooltip-append-to-body="true" tooltip="Mark Read" class="btn-mark-read" ng-if="!item.read" ng-click="setRead(item, $event)"><i class="fa fa-circle"></i></button>
                        <button tooltip-placement="top" tooltip-append-to-body="true" tooltip="Mark Unread" class="btn-mark-unread" ng-if="item.read" ng-click="setUnread(item, $event)"><i class="fa fa-circle-thin"></i></button>
                        <span class="time">{{item.time}}</span>
                        <img ng-src="{{item.thumb}}" alt="avatar" />
                        <div>
                          <span class="name">{{item.name}}</span>
                          <span class="msg">{{item.message}}</span>
                        </div>
                      </a>
                    </li>
                  </div>
              <li class="dd-footer"><a href="#">View All Messages</a></li>
            </ul>
          </li>
          <li class="dropdown" ng-controller="NotificationsController" ng-show="isLoggedIn"
            data-bootstro
            data-bootstro-step="1"
            data-bootstro-placement='bottom'
            data-bootstro-content="Click here to check out the dynamic notifications section. You can mark items as read and see the changes in real time."
            >
            <a href="#" class="dropdown-toggle">
              <i class="fa fa-bell"></i><span class="badge badge-orange" ng-if="unseenCount>0" ng-bind="unseenCount"></span>
            </a>
            <ul class="dropdown-menu notifications arrow">
              <li class="dd-header">
                <span>You have {{unseenCount}} new notification(s)</span>
                <span><a href="javascript:;" ng-click="setSeenAll($event)">Mark all Seen</a></span>
              </li>
                    <div class="scrollthis" jscrollpane="{autoReinitialise:true, autoReinitialiseDelay: 20}">
                <li ng-repeat="item in notifications">
                  <a href="#" class="{{item.class}}" ng-class="{active: !item.seen}">
                    <button tooltip-placement="top" tooltip-append-to-body="true" tooltip="Mark Seen" class="btn-mark-read" ng-if="!item.seen" ng-click="setSeen(item, $event)"><i class="fa fa-circle"></i></button>
                    <button tooltip-placement="top" tooltip-append-to-body="true" tooltip="Mark Unseen" class="btn-mark-unread" ng-if="item.seen" ng-click="setUnseen(item, $event)"><i class="fa fa-circle-thin"></i></button>
                    <span class="time">{{item.time}}</span>
                    <i class="{{item.iconClasses}}"></i>
                    <span class="msg">{{item.text}}</span>
                  </a>
                </li>
                    </div>
              <li class="dd-footer"><a href="#">View All Notifications</a></li>
            </ul>
          </li>
            <li ng-click="showHeaderBar($event)">
                <a href="" id="headerbardropdown"><span><i class="fa fa-level-down"></i></span></a>
            </li>
            <li class="dropdown demodrop" ng-controller="ColorPickerController" data-pulsate="{glow:false, repeat: 3}">
                <a href="#" class="dropdown-toggle tooltips"><i class="fa fa-cog"></i></a>

                <ul class="dropdown-menu arrow dropdown-menu-form" id="demo-dropdown">
                    <li>
                        <label for="demo-header-variations" class="control-label">Header Colors</label>

                        <ul class="list-inline demo-color-variation" id="demo-header-variations">
                            <li><a class="color-dark"       href="javascript:;" ng-click="setHeaderStyle('default.css', $event)"></a></li>
                            <li><a class="color-black"      href="javascript:;" ng-click="setHeaderStyle('header-black.css', $event)"></a></li>
                            <li><a class="color-inverse"    href="javascript:;" ng-click="setHeaderStyle('header-inverse.css', $event)"></a></li>
                            <li><a class="color-default"    href="javascript:;" ng-click="setHeaderStyle('header-midnightblue.css', $event)"></a></li>
                            <li><a class="color-dangerdark" href="javascript:;" ng-click="setHeaderStyle('header-dangerdark.css', $event)"></a></li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <label for="demo-color-variations" class="control-label">Sidebar Colors</label>
                        <ul class="list-inline demo-color-variation">
                            <li><a class="color-default"    href="javascript:;" ng-click="setSidebarStyle('default.css', $event)"></a></li>
                            <li><a class="color-inverse"    href="javascript:;" ng-click="setSidebarStyle('sidebar-inverse.css', $event)"></a></li>
                            <li><a class="color-primary"    href="javascript:;" ng-click="setSidebarStyle('sidebar-primary.css', $event)"></a></li>
                            <li><a class="color-gray"       href="javascript:;" ng-click="setSidebarStyle('sidebar-gray.css', $event)"></a></li>
                            <li><a class="color-indigo"     href="javascript:;" ng-click="setSidebarStyle('sidebar-indigo.css', $event)"></a></li>
                            <li><a class="color-dangerdark" href="javascript:;" ng-click="setSidebarStyle('sidebar-dangerdark.css', $event)"></a></li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <label for="fixedheader">Fixed Header</label>
                        <div ng-click="$event.stopPropagation()">
                          <toggle-switch model="headerFixed" class="success"></toggle-switch>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <label for="boxedlayout"><a href="#/layout-fixed">Boxed Layout</a></label>
                        <div ng-click="$event.stopPropagation()">
                          <toggle-switch model="layoutFixed" class="success"></toggle-switch>
                        </div>
                    </li>
                </ul>
                <link rel="stylesheet" type="text/css" ng-href="assets/demo/variations/{{headerStylesheet}}">
                <link rel="stylesheet" type="text/css" ng-href="assets/demo/variations/{{sidebarStylesheet}}">
            </li>
          -->
    </ul>
    </header>
    <!--
    <nav class="navbar navbar-default ng-hide" role="navigation" ng-show="style_layoutHorizontal">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <i class="fa fa-reorder"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" ng-class="{'large-icons-nav': style_layoutHorizontalLargeIcons}" id="horizontal-navbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#/index"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li><a href="#/index"><i class="fa fa-columns"></i> <span>Layout</span></a></li>
                <li><a href="#/index"><i class="fa fa-group"></i> <span>Members</span></a></li>
                <li><a href="#/index"><i class="fa fa-pencil"></i> <span>Components</span></a></li>
                <li><a href="#/index"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
            </ul>
        </div>
    </nav>
    -->
    <div id="page-container" class="clearfix">

        <!-- BEGIN SIDEBAR -->
        <nav id="page-leftbar" role="navigation">

            <div>
              <ul ng-controller="NavigationController" id="sidebar" sticky-scroll="40">
                  <li id="search" ng-class="{'keep-open':style_showSearchCollapsed}">
                      <a href=""
                        ng-class="{blockImportant:style_leftbarCollapsed && !style_showSearchCollapsed}"
                        ng-click="showSearchBar($event)"
                      ><i class="fa fa-search opacity-control"></i></a>
                       <form ng-show="!style_leftbarCollapsed || style_showSearchCollapsed"
                        ng-style="{display: style_showSearchCollapsed? 'block':''}"
                        ng-click="$event.stopPropagation()"
                        ng-submit="goToSearch()"
                       >
                          <input type="text" ng-model="searchQuery" class="search-query" placeholder="Search..."
                            ng-style="{width: style_showSearchCollapsed? 'auto':''}"
                          >
                          <button type="submit" ng-click="goToSearch()"><i class="fa fa-search"></i></button>
                      </form>
                  </li>
                  <li ng-repeat="item in menu"
                      ng-class="{ hasChild: (item.children!==undefined),
                                    active: item.selected,
                                      open: (item.children!==undefined) && item.open }"
                      ng-include="'templates/nav_renderer.html'"
                    ></li>
              </ul>
            </div>
            <!-- END SIDEBAR MENU -->
        </nav>

        
        <!-- BEGIN RIGHTBAR -->
        <!--
        <div id="page-rightbar" sticky-scroll="40" rightbar-right-position="style_layoutBoxed" style="">
          <div jscrollpane="{autoReinitialise:true, autoReinitialiseDelay: 100}" style="height: 100%;padding-bottom:40px">
              <accordion close-others="rightbarAccordionsShowOne">
                <accordion-group is-open="rightbarAccordions[0].open" ng-class="{open:rightbarAccordions[0].open}">
                  <accordion-heading>Account Summary</accordion-heading>

                  <div class="widget-block mt0" style="background: #7dcc93;">
                      <div class="pull-left">
                          <small>Current Balance</small>
                          <h5>$71,182</h5>
                      </div>
                      <div class="pull-right"><div id="currentbalance">
                        <span sparklines="{
                              type: 'bar',
                              barColor: '#67a879',
                              height: '41',
                              barWidth: 5.5}" data-data="[12700,8573,10145,21077,15380,14399,19158,23911,15401,16793,13115,12315]"></span>
                      </div></div>
                  </div>
                  <div class="widget-block mt10 mb0" style="background: #4f5259;">
                      <div class="pull-left">
                          <small>Total Sales</small>
                          <h5>$185,603</h5>
                      </div>
                      <div class="pull-right"><div id="totalsales">
                        <span sparklines="{
                              type: 'bar',
                              barColor: '#787d87',
                              height: '41',
                              barWidth: 5.5}" data-data="[27543,58573,43145,75077,37281,24389,69158,73911,45451,11393,48815,15626]"></span>
                      </div></div>
                  </div>

                </accordion-group>

                <accordion-group is-open="rightbarAccordions[1].open" ng-class="{open:rightbarAccordions[1].open}">
                  <accordion-heading>
                    Pending Tasks <small>(5)</small>
                  </accordion-heading>
                  
                  <progressbar contextual="true" value="25" heading="Backend Development" type="info"></progressbar>
                  <progressbar contextual="true" value="77" heading="Bug Fix" type="primary"></progressbar>
                  <progressbar contextual="true" value="70" heading="Javascript Code" type="success"></progressbar>
                  <progressbar contextual="true" value="55" heading="Preparing Documentation" type="danger"></progressbar>
                  <progressbar contextual="true" value="25" heading="Mobile App" type="orange"></progressbar>
                  
                  <span class="more"><a href="#/ui-progressbars">View all Pending</a></span>


                </accordion-group>
                <accordion-group is-open="rightbarAccordions[2].open" ng-class="{open:rightbarAccordions[2].open}" id="chatbar">
                  <accordion-heading>
                    Online Contacts
                  </accordion-heading>
                  <ul class="chat-users">
                    <li data-stats="online"><a href="#/extras-chatroom"><img src="assets/demo/avatar/potter.png" alt=""><span>Jeremy Potter</span></a></li>
                    <li data-stats="online"><a href="#/extras-chatroom"><img src="assets/demo/avatar/tennant.png" alt=""><span>David Tennant</span></a></li>
                    <li data-stats="online"><a href="#/extras-chatroom"><img src="assets/demo/avatar/johansson.png" alt=""><span>Anna Johansson</span></a></li>
                    <li data-stats="busy"><a href="#/extras-chatroom"><img src="assets/demo/avatar/jackson.png" alt=""><span>Eric Jackson</span></a></li>
                    <li data-stats="away"><a href="#/extras-chatroom"><img src="assets/demo/avatar/jobs.png" alt=""><span>Howard Jobs</span></a></li>
                    <li data-stats="online"><a href="#/extras-chatroom"><img src="assets/demo/avatar/potter.png" alt=""><span>Jeremy Potter</span></a></li>
                    <li data-stats="online"><a href="#/extras-chatroom"><img src="assets/demo/avatar/tennant.png" alt=""><span>David Tennant</span></a></li>
                    <li data-stats="online"><a href="#/extras-chatroom"><img src="assets/demo/avatar/johansson.png" alt=""><span>Anna Johansson</span></a></li>
                    <li data-stats="busy"><a href="#/extras-chatroom"><img src="assets/demo/avatar/jackson.png" alt=""><span>Eric Jackson</span></a></li>
                    <li data-stats="away"><a href="#/extras-chatroom"><img src="assets/demo/avatar/jobs.png" alt=""><span>Howard Jobs</span></a></li>
                </ul>
                <span class="more"><a href="#/extras-chatroom">See all</a></span>

                </accordion-group>
                <accordion-group is-open="rightbarAccordions[3].open" ng-class="{open:rightbarAccordions[3].open}">
                  <accordion-heading>
                    Storage Space
                  </accordion-heading>

                  <div class="clearfix" style="margin-bottom: 5px;margin-top:10px;">
                      <div class="progress-title pull-left">1.31 GB of 1.50 GB used</div>
                      <div class="progress-percentage pull-right">87.3%</div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar progress-bar-success" style="width: 50%"></div>
                      <div class="progress-bar progress-bar-warning" style="width: 25%"></div>
                      <div class="progress-bar progress-bar-danger" style="width: 12.3%"></div>
                  </div>
                </accordion-group>



              </accordion>
        </div>
      </div> 
      -->
      <!-- END RIGHTBAR -->
    <div id="page-content" class="clearfix" fit-height>
        <div id="wrap" ng-view="" class="mainview-animation">
        </div> <!--wrap -->
    </div> <!-- page-content -->

    <footer role="contentinfo">
        <div class="clearfix">
            <ul class="list-unstyled list-inline pull-left">
                <li>RALI &copy; 2014</li>
            </ul>
            <button class="pull-right btn btn-default btn-xs hidden-print" back-to-top style="padding: 1px 10px;"><i class="fa fa-angle-up"></i></button>
        </div>
    </footer>

</div> <!-- page-container -->

    <!--[if lt IE 9]>
    <script src="bower_components/es5-shim/es5-shim.js"></script>
    <script src="bower_components/json3/lib/json3.min.js"></script>
    <![endif]-->

    <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true'></script> 

    <!-- build:js scripts/vendor.js -->
    <!-- bower:js -->
    <script src="bower_components/modernizr/modernizr.js"></script>
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/underscore/underscore.js"></script>
    <script src="bower_components/angular/angular.js"></script>
    <script src="bower_components/angular-resource/angular-resource.js"></script>
    <script src="bower_components/angular-cookies/angular-cookies.js"></script>
    <script src="bower_components/angular-sanitize/angular-sanitize.js"></script>
    <script src="bower_components/angular-route/angular-route.js"></script>
    <script src="bower_components/angular-animate/angular-animate.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="bower_components/seiyria-bootstrap-slider/js/bootstrap-slider.js"></script>
    <script src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script src="bower_components/jquery.ui/ui/jquery.ui.core.js"></script>
    <script src="bower_components/jquery.ui/ui/jquery.ui.widget.js"></script>
    <script src="bower_components/jquery.ui/ui/jquery.ui.mouse.js"></script>
    <script src="bower_components/jquery.ui/ui/jquery.ui.draggable.js"></script>
    <script src="bower_components/jquery.slimscroll/jquery.slimscroll.js"></script>
    <script src="bower_components/jquery.easing/js/jquery.easing.min.js"></script>
    <script src="bower_components/flot/jquery.flot.js"></script>
    <script src="bower_components/flot/jquery.flot.stack.js"></script>
    <script src="bower_components/flot/jquery.flot.pie.js"></script>
    <script src="bower_components/flot/jquery.flot.resize.js"></script>
    <script src="bower_components/flot.tooltip/js/jquery.flot.tooltip.js"></script>
    <script src="bower_components/angular-ui-tree/dist/angular-ui-tree.js"></script>
    <script src="bower_components/jqvmap/jqvmap/jquery.vmap.js"></script>
    <script src="bower_components/jqvmap/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="bower_components/jqvmap/jqvmap/data/jquery.vmap.sampledata.js"></script>
    <script src="bower_components/angular-toggle-switch/angular-toggle-switch.min.js"></script>
    <script src="bower_components/ng-grid/build/ng-grid.js"></script>
    <script src="bower_components/angular-xeditable/dist/js/xeditable.js"></script>
    <script src="bower_components/select2/select2.js"></script>
    <script src="bower_components/angular-ui-select2/src/select2.js"></script>
    <script src="bower_components/iCheck/icheck.min.js"></script>
    <script src="bower_components/google-code-prettify/src/prettify.js"></script>
    <script src="bower_components/bootbox.js/bootbox.js"></script>
    <script src="bower_components/jquery-autosize/jquery.autosize.js"></script>
    <script src="bower_components/gmaps/gmaps.js"></script>
    <script src="bower_components/momentjs/moment.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="bower_components/jquery.pulsate/jquery.pulsate.js"></script>
    <script src="bower_components/jquery.knob/js/jquery.knob.js"></script>
    <script src="bower_components/jquery.sparkline/index.js"></script>
    <script src="bower_components/flow.js/dist/flow.js"></script>
    <script src="bower_components/ng-flow/dist/ng-flow.js"></script>
    <script src="bower_components/jScrollPane/script/jquery.mousewheel.js"></script>
    <script src="bower_components/jScrollPane/script/mwheelIntent.js"></script>
    <script src="bower_components/jScrollPane/script/jquery.jscrollpane.min.js"></script>
    <script src="bower_components/enquire/dist/enquire.js"></script>
    <script src="bower_components/shufflejs/dist/jquery.shuffle.js"></script>
    <!-- endbower -->
    <script type='text/javascript' src='assets/plugins/pines-notify/jquery.pnotify.min.js'></script> 

    <script type='text/javascript' src='assets/plugins/form-datepicker/js/bootstrap-datepicker.js'></script>
    <script type='text/javascript' src='assets/plugins/easypiechart/angular.easypiechart.js'></script> 
    <script type='text/javascript' src='assets/plugins/datepaginator/bootstrap-datepaginator.js'></script> 
    <script type='text/javascript' src='assets/plugins/form-multiselect/js/jquery.multi-select.min.js'></script> 
    <script type='text/javascript' src='assets/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js'></script> 
    <script type='text/javascript' src='assets/plugins/form-fseditor/jquery.fseditor-min.js'></script> 
    <script type='text/javascript' src='assets/plugins/form-jasnyupload/fileinput.js'></script> 

    <script type='text/javascript' src='assets/plugins/progress-skylo/skylo.js'></script> 
    
    <script type='text/javascript' src='assets/plugins/bootstro.js/bootstro.min.js'></script> 
    <!-- endbuild -->

      <!-- build:js({.tmp,app}) scripts/scripts.js -->
      <script src="scripts/shared/Services.js"></script>
      <script src="scripts/shared/Directives.js"></script>
      <script src="scripts/shared/Utils.js"></script>
      <script src="scripts/shared/angular-md5.js" type="text/javascript"></script>
      <script src="scripts/maps/VectorMaps.js"></script>
      <script src="scripts/maps/GoogleMaps.js"></script>
      <script src="scripts/calendar/Calendar.js"></script>
      <script src="scripts/gallery/Gallery.js"></script>
      <script src="scripts/task/Tasks.js"></script>
      <script src="scripts/ui-components/Ratings.js"></script>
      <script src="scripts/ui-components/Modals.js"></script>
      <script src="scripts/ui-components/Tiles.js"></script>
      <script src="scripts/ui-components/Alerts.js"></script>
      <script src="scripts/ui-components/Sliders.js"></script>
      <script src="scripts/ui-components/Progressbars.js"></script>
      <script src="scripts/ui-components/Paginations.js"></script>
      <script src="scripts/ui-components/Carousel.js"></script>
      <script src="scripts/ui-components/Tabs.js"></script>
      <script src="scripts/ui-components/Nestable.js"></script>
      <script src="scripts/ui-elements/Tables.js"></script>
      <script src="scripts/ui-elements/Panels.js"></script>
      <script src="scripts/form/Components.js"></script>
      <script src="scripts/form/Directives.js"></script>
      <script src="scripts/form/Validation.js"></script>
      <script src="scripts/form/Inline.js"></script>
      <script src="scripts/form/FileUploads.js"></script>
      <script src="scripts/form/ImageCrop.js"></script>
      <script src="scripts/table/ngGrid.js"></script>
      <script src="scripts/table/Editable.js"></script>
      <script src="scripts/chart/Flot.js"></script>
      <script src="scripts/chart/SVG.js"></script>
      <script src="scripts/chart/Canvas.js"></script>
      <script src="scripts/chart/Inline.js"></script>
      <script src="scripts/layout/Horizontal.js"></script>
      <script src="scripts/layout/Boxed.js"></script>
      <script src="scripts/pages/Controllers.js"></script>
      <script src="scripts/templates/templates.js"></script>
      <script src="scripts/templates/overrides.js"></script>
      <script src="scripts/controllers/Navigation.js"></script>
      <script src="scripts/controllers/Notifications.js"></script>
      <script src="scripts/controllers/Messages.js"></script>
      <script src="scripts/controllers/ColorPicker.js"></script>
      <script src="scripts/controllers/Dashboard.js"></script>
      <script src="scripts/app.js"></script>
      <script src="scripts/controllers/MainController.js"></script>
      <script src="scripts/controllers/HomeController.js"></script>
      <script src="scripts/controllers/LoginController.js"></script>
      <script src="scripts/controllers/SignupController.js"></script>
      <script src="scripts/controllers/ForgotPwController.js"></script>
      <script src="scripts/controllers/ResetPwController.js"></script>
      <script src="scripts/controllers/ActivateAccController.js"></script>
      <script src="scripts/controllers/RecipeController.js"></script>
      <script src="scripts/controllers/LoginService.js"></script>
      <script src="scripts/controllers/SessionService.js"></script>
      <script src="scripts/controllers/DataService.js"></script>
      
      <!-- endbuild -->

</body>
</html>


