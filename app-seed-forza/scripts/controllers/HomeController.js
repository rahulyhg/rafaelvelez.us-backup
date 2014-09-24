'use strict';

app.controller('HomeController', ['$scope','LoginService','$global', function($scope,LoginService,$global){
        $global.set('title',"Home");
}]);