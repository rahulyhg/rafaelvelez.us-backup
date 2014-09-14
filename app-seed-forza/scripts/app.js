'use strict';
var app= angular.module('themesApp', [
    'easypiechart',
    'toggle-switch',
    'ui.bootstrap',
    'ui.tree',
    'ui.select2',
    'ngGrid',
    'xeditable',
    'flow',
    'theme.services',
    'theme.directives',
    'theme.navigation-controller',
    'theme.notifications-controller',
    'theme.messages-controller',
    'theme.colorpicker-controller',
    'theme.layout-horizontal',
    'theme.layout-boxed',
    'theme.vector_maps',
    'theme.google_maps',
    'theme.calendars',
    'theme.gallery',
    'theme.tasks',
    'theme.ui-tables-basic',
    'theme.ui-panels',
    'theme.ui-ratings',
    'theme.ui-modals',
    'theme.ui-tiles',
    'theme.ui-alerts',
    'theme.ui-sliders',
    'theme.ui-progressbars',
    'theme.ui-paginations',
    'theme.ui-carousel',
    'theme.ui-tabs',
    'theme.ui-nestable',
    'theme.form-components',
    'theme.form-directives',
    'theme.form-validation',
    'theme.form-inline',
    'theme.form-image-crop',
    'theme.form-uploads',
    'theme.tables-ng-grid',
    'theme.tables-editable',
    'theme.charts-flot',
    'theme.charts-canvas',
    'theme.charts-svg',
    'theme.charts-inline',
    'theme.pages-controllers',
    'theme.dashboard',
    'theme.templates',
    'theme.template-overrides',
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngRoute',
    'ngAnimate'
]);


app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
      .when('/', {templateUrl: 'views/index.html',controller: 'HomeController',auth: true})
      .when('/login', {templateUrl: 'views/login.html', controller: 'LoginController',auth: false})
      .when('/signup', {templateUrl: 'views/signup.html', controller: 'SignupController',auth: false})
      .when('/:templateFile', {templateUrl: function (param) { return 'views/'+param.templateFile+'.html' },auth: true})
      .otherwise({redirectTo: '/'});
}]);

//app.run(function($rootScope, $location, LoginService,progressLoader){
//	var routespermission=['/'];  //route that require login
//	
//        $rootScope.$on('$routeChangeStart', function(){
//            if( routespermission.indexOf($location.path()) !=-1)
//            {
//		var connected=LoginService.islogged();
//		connected.then(function(msg){
//			if(msg.data.error===true) $location.path('/login');
//                });
//            }
//            // console.log('start: ', $location.path());
//            progressLoader.start();
//            progressLoader.set(50);
//	}); 
//        
//        $rootScope.$on('$routeChangeSuccess', function (e) {
//            // console.log('success: ', $location.path());
//            progressLoader.end();
//        });
//});
