'use strict';
app.factory('LoginService',function($http, $location, SessionService){
	return{
		login:function(data,scope){
                        var $promise=$http.post('api/v1/login',data); //send data to user.php
			$promise.then(function(msg){
				scope.alerts[0]={msg: msg.data.message , type: msg.data.type};
                                if(msg.data.error === false){
                                /*    
                                  Server's response:
                                    $_SESSION['uid']=uniqid('ang_');
                                    $response['session'] = $_SESSION['uid'];
                                    $response["error"] = false;
                                    $response['name'] = $user['name'];
                                    $response['email'] = $user['email'];
                                    $response['apiKey'] = $user['api_key'];
                                    $response['createdAt'] = $user['created_at'];
                                 */
                                    
                                    SessionService.set('uid',msg.data.session);
                                    SessionService.set('name',msg.data.name);
                                    SessionService.set('email',msg.data.email);
                                    SessionService.set('apiKey',msg.data.apiKey);
                                    SessionService.set('avatar',msg.data.avatar);
                                    $location.path('/');
				}	       
				else  {
                                    $location.path('/login');
				}				   
			});
		},
                signup:function(data,scope){
			var $promise=$http.post('api/v1/signup',data); //send data to user.php
			$promise.then(function(msg){
				scope.alerts[0]={msg: msg.data.message + " <a href=\"" + msg.data.URL + "\">Here</a>", type: msg.data.type};
                                scope.user.name = "";
                                scope.user.email = "";
                                scope.user.password = "";
                                scope.user.password_confirm = "";    
                                scope.user.agreement = "";
                                scope.form4.$setPristine();
			});
		},
                forgot:function(data,scope){
			var $promise=$http.post('api/v1/forgot_pw',data); //send data to user.php
			$promise.then(function(msg){
				scope.alerts[0]={msg: msg.data.message + " <a href=\"" + msg.data.URL + "\">Here</a>" , type: msg.data.type};
				scope.user.email = "";
                                scope.form3.$setPristine();
			});
		},
		logout:function(){
			SessionService.destroy('uid');
                        SessionService.destroy('name');
                        SessionService.destroy('email');
                        SessionService.destroy('apiKey');
			$location.path('/login');
		},
		islogged:function(){
			var $checkSessionServer=$http.post('api/v1/check_session');
			return $checkSessionServer;
		},
                isValidPwReq:function(res_code){
			//var $checkPwRequest=$http.post('api/v1/check_pw_request',data);
			var $checkPwRequest = $http({
                            method: "post",
                            url: "api/v1/check_pw_request",
                            data: {
                                reset_code: res_code
                            }
                        });
                        return $checkPwRequest;
		},
                changePw:function(data,scope){
			var $promise=$http.post('api/v1/change_pw',data); //send data to user.php
			$promise.then(function(msg){
				scope.alerts[0]={msg: msg.data.message , type: msg.data.type};
                                if(msg.data.error === false){
                                    $location.path('/login');
				}	       				   
			});
		},
                activateAccount:function(act_code){
			//var $checkPwRequest=$http.post('api/v1/check_pw_request',data);
			var $checkPwRequest = $http({
                            method: "post",
                            url: "api/v1/activate_account",
                            data: {
                                activation_code: act_code
                            }
                        });
                        return $checkPwRequest;
		},
	}

});