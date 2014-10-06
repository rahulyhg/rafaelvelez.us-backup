'use strict';

app.controller('MainController', ['$scope', '$global', '$timeout', '$location','progressLoader', 'LoginService','SessionService', function($scope, $global, $timeout,$location,progressLoader, LoginService, SessionService) {
        $scope.$on('$routeChangeStart', function(event,next,current) {
            
            if (next.auth)
            {
                var connected = LoginService.islogged();
                connected.then(function(msg) {
                    if (msg.data.error === true)
                       $location.path('/login');
                    else
                        $scope.isLoggedIn = true;
                        $global.set('name_user',SessionService.get('name'));
                        $global.set('avatar',SessionService.get('avatar'));
                       
                });
            }
            // console.log('start: ', $location.path());
            progressLoader.start();
            progressLoader.set(50);
            
        });
        
        
        $scope.style_title = $global.get('title');
        $scope.style_name_user = $global.get('name_user');
        $scope.style_avatar = $global.get('avatar') || "default-avatar.gif";
        $scope.style_fixedHeader = $global.get('fixedHeader');
        //$scope.style_headerBarHidden = $global.get('headerBarHidden');
        $scope.style_layoutBoxed = $global.get('layoutBoxed');
        $scope.style_fullscreen = $global.get('fullscreen');
        $scope.style_leftbarCollapsed = $global.get('leftbarCollapsed');
        $scope.style_leftbarShown = $global.get('leftbarShown');
        $scope.style_rightbarCollapsed = $global.get('rightbarCollapsed');
        $scope.style_isSmallScreen = false;
        $scope.style_showSearchCollapsed = $global.get('showSearchCollapsed');
        
        $scope.hideSearchBar = function() {
            $global.set('showSearchCollapsed', false);
        };

        //$scope.hideHeaderBar = function() {
        //    $global.set('headerBarHidden', true);
        //};

        //$scope.showHeaderBar = function($event) {
        //    $event.stopPropagation();
        //    $global.set('headerBarHidden', false);
        //};

        $scope.toggleLeftBar = function() {
            if ($scope.style_isSmallScreen) {
                return $global.set('leftbarShown', !$scope.style_leftbarShown);
            }
            $global.set('leftbarCollapsed', !$scope.style_leftbarCollapsed);
        };

        $scope.toggleRightBar = function() {
            $global.set('rightbarCollapsed', !$scope.style_rightbarCollapsed);
        };

        $scope.$on('globalStyles:changed', function(event, newVal) {
            $scope['style_' + newVal.key] = newVal.value;
            $scope['info_' + newVal.key] = newVal.value;
        });
        $scope.$on('globalStyles:maxWidth767', function(event, newVal) {
            $timeout(function() {
                $scope.style_isSmallScreen = newVal;
                if (!newVal) {
                    $global.set('leftbarShown', false);
                } else {
                    $global.set('leftbarCollapsed', false);
                }
            });
        });

        $scope.logOut = function() {
            LoginService.logout();
            $scope.isLoggedIn = false;
        };
        $scope.logIn = function() {
            $location.path('/login');
        };

        $scope.rightbarAccordionsShowOne = false;
        $scope.rightbarAccordions = [{open: true}, {open: true}, {open: true}, {open: true}, {open: true}, {open: true}, {open: true}];

        $scope.$on('$routeChangeSuccess', function(e) {
            // console.log('success: ', $location.path());
            progressLoader.end();
        });


    }]);

