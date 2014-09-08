'use strict';

app.controller('loginCtrl', ['$scope','$rootScope','loginService', function ($scope,$rootScope,loginService) {
	$scope.msgtxt='';
        $scope.page='login';
        $rootScope.bodyClass="body-login";
        $rootScope.title="Login";
        $scope.login=function(data){
		loginService.login(data,$scope); //call login service
	};
}]);