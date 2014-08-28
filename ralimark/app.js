(function(){
		
	var app = angular.module('ralimark',[]);
	app.controller('RalimarkController', function(){
		this.product = testObject;
	});
	
	var testObject = {
		name: 'Hello 1',
		price: 2.5,
		description: 'Si como no',
	};
	
	
	
})();