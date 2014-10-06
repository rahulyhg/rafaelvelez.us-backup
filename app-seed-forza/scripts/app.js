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
    'ngAnimate',
    'filters',
]);


app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
      .when('/', {templateUrl: 'views/index.html',controller: 'HomeController',auth: true})
      .when('/login', {templateUrl: 'views/login.html', controller: 'LoginController',auth: false})
      .when('/signup', {templateUrl: 'views/signup.html', controller: 'SignupController',auth: false})
      .when('/forgot_pw', {templateUrl: 'views/forgot-pw.html', controller:'ForgotPwController',auth:false})
      .when('/reset_pw/:reset_code', {templateUrl: 'views/reset-pw.html', controller:'ResetPwController',auth:false})
      .when('/activate_account/:activation_code', {templateUrl: 'views/activate-account.html', controller:'ActivateAccController',auth:false})
      .when('/recipe_view/:recipe_id', {templateUrl: 'views/recipe-view.html', controller:'RecipeController',auth:true})
      .when('/recipe_view', {templateUrl: 'views/recipe-view.html', controller:'RecipeController',auth:true})
      .when('/:templateFile', {templateUrl: function (param) { return 'views/'+param.templateFile+'.html' },auth: true})
      .otherwise({redirectTo: '/'});
}]);



