'use strict';

app.controller('loginCtrl', ['$scope','$rootScope','loginService', function ($scope,$rootScope,loginService) {
	$rootScope.bodyClass="body-login";
        $rootScope.title="Login";
        $scope.msgtxt='';
        $scope.page='login';
        $scope.defNewUser = {
              name: "Rafafa",
              email: "rafa@rafafa.com",
              password: "password"
        };
        
        $scope.defUser = {
              email: "",
              password: ""
        };
        
        $scope.user = $scope.defUser;
        $scope.newUser = $scope.defNewUser;
        
        $scope.login=function(data){
		loginService.login(data,$scope); //call login service
                
	};
        $scope.register=function(data){
		loginService.register(data,$scope); //call login service
                
	};
}]);