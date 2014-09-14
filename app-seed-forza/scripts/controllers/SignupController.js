'use strict';

app.controller('SignupController', ['$scope','LoginService','$global', function ($scope,LoginService,$global) {
	//$scope.msgtxt='Probando';
        $scope.response = { 
            show: false,
            type: '', 
            msg: '' 
        };
        $scope.defNewUser = {
              name: "Rafafa",
              email: "rafa@rafafa.com",
              password: "password"
        };
        
        $scope.newUser = $scope.defNewUser;

        $scope.register=function(data){
		LoginService.register(data,$scope); //call login service
                
	};
        $global.set('fullscreen', true);

        $scope.$on('$destroy', function () {
            $global.set('fullscreen', false);
        });
}]);