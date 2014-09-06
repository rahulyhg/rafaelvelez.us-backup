'use strict';

app.controller('homeCtrl', ['$scope','$rootScope','loginService', function($scope,$rootScope,loginService){
	$scope.txt='Page Home';
        $rootScope.title="Home";
        $scope.logout=function(){
		loginService.logout();
	};
}]);