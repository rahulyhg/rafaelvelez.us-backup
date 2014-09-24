'use strict';

app.controller('ResetPwController', ['$scope','LoginService','$global','$routeParams','$filter', function ($scope,LoginService,$global,$routeParams, $filter) {
	$global.set('title',"Reset Password");
        //First check if a request exists, if not redirect
        $scope.validRequest = false; 
        var valid_req = LoginService.isValidPwReq($routeParams.reset_code);
                valid_req.then(function(msg) {
                    $scope.validRequest=!msg.data.error;
                    $scope.alerts[0]={msg: msg.data.message , type: msg.data.type};
                });
        
        
        //Alerts for server responses;
        $scope.alerts = [];
        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
        
        $scope.defNewPassword = {
              reset_code: $routeParams.reset_code,
              password: "password",
              password_confirm: "password",
        };
        
        $scope.newPassword = $scope.defNewPassword;
        
        $scope.changePw=function(data){
		LoginService.changePw(data,$scope); //call login service
	};
       
        
        $global.set('fullscreen', true);
        $scope.$on('$destroy', function () {
            $global.set('fullscreen', false);
        });
        
        $scope.isValidForm=function(data){
            if ($scope.form5.$invalid) return false;
            if (data.password_confirm !== data.password) return false;
            return true;
        };
}]);