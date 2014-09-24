'use strict';

app.controller('ForgotPwController', ['$scope','LoginService','$global', function ($scope,LoginService,$global) {
	$global.set('title',"Forgot Password");
        //Alerts for server responses;
        $scope.alerts = [];
        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
        
        $scope.defUser = {
              email: "rafael.velez.c@gmail.com",
        };
        
        $scope.user = $scope.defUser;
        
        $scope.send=function(data){
		LoginService.forgot(data,$scope); //call login service
	};
       
        
        $global.set('fullscreen', true);
        $scope.$on('$destroy', function () {
            $global.set('fullscreen', false);
        });
}]);