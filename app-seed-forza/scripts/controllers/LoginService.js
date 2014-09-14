'use strict';
app.factory('LoginService',function($http, $location, SessionService){
	return{
		login:function(data,scope){
			//var $promise=$http.post('data/user.php',data); //send data to user.php
                        var $promise=$http.post('api/v1/login',data); //send data to user.php
			$promise.then(function(msg){
				var uid=msg.data;
				if(uid.session){
					//scope.msgtxt='Correct information';
					SessionService.set('uid',uid.session);
					$location.path('/');
				}	       
				else  {
                                    scope.response = { 
                                        show: true,
                                        type: 'error', 
                                        msg: 'Incorrect information' 
                                    };
					//scope.msgtxt='Incorrect information';
					$location.path('/login');
				}				   
			});
		},
                register:function(data,scope){
			//var $promise=$http.post('data/user.php',data); //send data to user.php
                        var $promise=$http.post('api/v1/register',data); //send data to user.php
			$promise.then(function(msg){
				var resp=msg.data;
				scope.msgtxt=resp.message;
                                scope.newUser.name = "";
                                scope.newUser.email = "";
                                scope.newUser.password = "";
			});
		},
		logout:function(){
			SessionService.destroy('uid');
			$location.path('/login');
		},
		islogged:function(){
			var $checkSessionServer=$http.post('api/v1/check_session');
			return $checkSessionServer;
			/*
			if(sessionService.get('user')) return true;
			else return false;
			*/
		}
	}

});