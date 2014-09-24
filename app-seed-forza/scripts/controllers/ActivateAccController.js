'use strict';

app.controller('ActivateAccController', ['$scope','LoginService','$global','$routeParams','$filter', function ($scope,LoginService,$global,$routeParams, $filter) {
	$global.set('title',"Activate Account");
        //First check if a request exists, if not redirect
        $scope.validRequest = false; 
        var valid_req = LoginService.activateAccount($routeParams.activation_code);
                valid_req.then(function(msg) {
                    $scope.alerts[0]={msg: msg.data.message , type: msg.data.type};
                });
        
        //Alerts for server responses;
        $scope.alerts = [];
        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
        
        $global.set('fullscreen', true);
        $scope.$on('$destroy', function () {
            $global.set('fullscreen', false);
        });
        
       
}]);