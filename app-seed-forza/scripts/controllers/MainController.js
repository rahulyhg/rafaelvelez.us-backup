'use strict';

app.controller('MainController', ['$scope', '$global', '$timeout', '$location','progressLoader', 'LoginService', function($scope, $global, $timeout,$location,progressLoader, LoginService) {
        $scope.$on('$routeChangeStart', function(event,next,current) {
            
            if (next.auth)
            {
                var connected = LoginService.islogged();
                connected.then(function(msg) {
                    if (msg.data.error === true)
                       $location.path('/login');
                    else
                       $scope.isLoggedIn = true; 
                });
            }
            // console.log('start: ', $location.path());
            progressLoader.start();
            progressLoader.set(50);
            
        });
        
        
        
        $scope.style_fixedHeader = $global.get('fixedHeader');
        $scope.style_headerBarHidden = $global.get('headerBarHidden');
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

        $scope.hideHeaderBar = function() {
            $global.set('headerBarHidden', true);
        };

        $scope.showHeaderBar = function($event) {
            $event.stopPropagation();
            $global.set('headerBarHidden', false);
        };

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

        // there are better ways to do this, e.g. using a dedicated service
        // but for the purposes of this demo this will do :P
//        $scope.isLoggedIn = true;
//        $scope.logOut = function () {
//          $scope.isLoggedIn = false;
//        };
//        $scope.logIn = function () {
//          $scope.isLoggedIn = true;
//        };

//        var connected = LoginService.islogged();
//        connected.then(function(msg) {
//            if (msg.data.error === false)
//                $scope.isLoggedIn = true;
//        });
        $scope.logOut = function() {
            LoginService.logout();
            $scope.isLoggedIn = false;
        };
        $scope.logIn = function() {
            $location.path('/login');
        };

        $scope.rightbarAccordionsShowOne = false;
        $scope.rightbarAccordions = [{open: true}, {open: true}, {open: true}, {open: true}, {open: true}, {open: true}, {open: true}];

//        $scope.$on('$routeChangeStart', function(e) {
//            var routespermission = ['/'];  //route that require login
//            if (routespermission.indexOf($location.path()) !== -1)
//            {
//                var connected = LoginService.islogged();
//                connected.then(function(msg) {
//                    if (msg.data.error === true)
//                       $location.path('/login');
//                    else
//                       $scope.isLoggedIn = true; 
//                    progressLoader.start();
//                    progressLoader.set(50);
//                });
//            }
//            // console.log('start: ', $location.path());
//            
//        });
        $scope.$on('$routeChangeSuccess', function(e) {
            // console.log('success: ', $location.path());
            progressLoader.end();
        });


    }]);

