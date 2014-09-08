'use strict';

app.controller('homeCtrl', ['$scope','$rootScope','loginService', function($scope,$rootScope,loginService){
	$scope.txt='Page Home';
        $scope.page='home';
        $rootScope.bodyClass="body-home";
        $rootScope.title="Home";
        $scope.logout=function(){
		loginService.logout();
	};
}]);