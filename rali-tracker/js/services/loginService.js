'use strict';
app.factory('loginService',function($http, $location, sessionService){
	return{
		login:function(data,scope){
			//var $promise=$http.post('data/user.php',data); //send data to user.php
                        var $promise=$http.post('api/v1/login',data); //send data to user.php
			$promise.then(function(msg){
				var uid=msg.data;
				if(uid.session){
					//scope.msgtxt='Correct information';
					sessionService.set('uid',uid.session);
					$location.path('/home');
				}	       
				else  {
					scope.msgtxt='incorrect information';
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
			sessionService.destroy('uid');
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