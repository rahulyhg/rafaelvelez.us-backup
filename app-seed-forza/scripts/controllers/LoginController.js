'use strict';

app.controller('LoginController', ['$scope','LoginService','$global','$location', function ($scope,LoginService,$global,$location) {
	$global.set('title',"Login");
        //Alerts for server responses;
        $scope.alerts = [];
        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
        
        $scope.defUser = {
              email: "rafael.velez.c@gmail.com",
              password: "Pl4t1num"
        };
        
        $scope.user = $scope.defUser;
        
        $scope.login=function(data){
		LoginService.login(data,$scope); //call login service 
	};
        
        $global.set('fullscreen', true);

        $scope.$on('$destroy', function () {
            $global.set('fullscreen', false);
        });
}]);