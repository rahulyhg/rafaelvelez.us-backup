'use strict';

app.controller('RecipeController', ['$scope', '$global', '$routeParams', 'DataService', function ($scope, $global, $routeParams, DataService) {
        $global.set('title', "Recipes");
        $scope.recipes = {};
        $scope.searchTerm = "";
        //$scope.searchBy = 'name';
        var get_recipe = DataService.recipe();
        get_recipe.then(function (msg) {
            if (msg.data.error === true)
                $location.path('/login');
            else
                $scope.recipes = msg.data.recipe;
        });
        
        $scope.getRandomPic = function(i){
            
            var r = Math.round((Math.random())+1);
            var newImg = ('lunch_0' + r + '.jpg');
            var rec = $scope.recipes[i].mealtime;
            if (rec.indexOf("Lunch or Dinner") !== -1) 
                newImg = ('lunch_0' + r + '.jpg');
            if (rec.indexOf("Lunch") !== -1) 
                newImg = ('lunch_0' + r + '.jpg');
            if (rec.indexOf("Dinner") !== -1) 
                newImg = ('dinner_0' + r + '.jpg');
            if (rec.indexOf("Breakfast") !== -1) 
                newImg = ('breakfast_0' + r + '.jpg');
            $scope.recipes[i].pic='assets/img/recipes/' + newImg;
            return newImg;
        };

        $scope.searchBy = ['Name']
        $scope.searchByOptions = {
            'multiple': true,
            'simple_tags': true,
            'tags': ['Name', 'Ingredient', 'Preparation', 'Mealtime'] // Can be empty list.
        };

        $scope.saveRecipe = function (data, id) {
            //$scope.user not updated yet
            angular.extend(data, {id: id});
            // return $http.post('/saveUser', data);
        };

        // remove user
        $scope.removeRecipe = function (index) {
            $scope.recipes.splice(index, 1);
        };

        // add user
        $scope.addRecipe = function () {

            $scope.inserted = {
                id: $scope.recipes.length + 1,
                name: '',
                ingredients: {},
                preparation: '',
                pic: '',
                mealtime: '',
                points: '',
                notes: ''
            };
            $scope.recipes.push($scope.inserted);
        };

        // add user
        $scope.addIngredient = function (recipe) {

            var new_id = Object.keys($scope.recipes[recipe].ingredients).length + 1;
            $scope.newIngredient = {
                id: new_id,
                ingredient: '',
                department: '',
                islenumber: ''
            };
            $scope.recipes[recipe].ingredients[new_id] = ($scope.newIngredient);
        };


    }]);