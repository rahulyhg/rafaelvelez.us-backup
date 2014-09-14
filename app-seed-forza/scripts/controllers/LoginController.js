'use strict';

app.controller('LoginController', ['$scope','LoginService','$global', function ($scope,LoginService,$global) {
	//$scope.msgtxt='Probando';
        $scope.response = { 
            show: false,
            type: '', 
            msg: '' 
        };
        
        $scope.defUser = {
              email: "",
              password: ""
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