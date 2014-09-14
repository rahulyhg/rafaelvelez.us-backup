'use strict';

app.factory('SessionService', ['$http', function($http){
	return{
		set:function(key,value){
			return sessionStorage.setItem(key,value);
		},
		get:function(key){
			return sessionStorage.getItem(key);
		},
		destroy:function(key){
			//$http.post('data/destroy_session.php');
                        $http.post('api/v1/logout');
			return sessionStorage.removeItem(key);
		}
	};
}])