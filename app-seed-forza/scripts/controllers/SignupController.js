'use strict';

app.controller('SignupController', ['$scope','LoginService','$global','$modal', function ($scope,LoginService,$global,$modal) {
	$global.set('title',"Signup");
        //Alerts for server responses;
        $scope.alerts = [];
        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
        
        //Agreement Dialog
        $scope.openAgreement = function (size) {
            var modalInstance = $modal.open({
                templateUrl: 'agreement.html',
                controller: function ($scope, $modalInstance) {
                    $scope.close = function () {
                        $modalInstance.dismiss('close');
                    };
                },
                size: size,
            });
        }
        
        $scope.defUser = {
            name: "Rafael Velez",
            email: "rafa@rafafa.com",
            password: "password",
            password_confirm: "password",
            agreement: false
        };
        
        $scope.user = $scope.defUser;

        $scope.signup=function(data){
		LoginService.signup(data,$scope); //call login service
	};
        
        $scope.isValidForm=function(data){
            if ($scope.form4.$invalid) return false;
            if (data.password_confirm !== data.password) return false;
            if (data.agreement === false) return false;
            return true;
        };
        
        
        
        $global.set('fullscreen', true);

        $scope.$on('$destroy', function () {
            $global.set('fullscreen', false);
        });
}]);