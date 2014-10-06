'use strict';
app.factory('DataService', function ($http, $location, SessionService) {
    return{
        recipe: function () {
            var $promise = $http.get('api/v1/recipe', {
                headers: {'Authorization': SessionService.get('apiKey')}
            });
            return $promise;  //Promise implementation on controller
        },
        
    }

});