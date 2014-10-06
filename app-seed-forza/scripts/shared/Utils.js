'use strict'
angular.module('utils', [])
        .factory('utils', function () {
            return{
                compareStr: function (stra, strb) {
                    if (stra === null || strb === null)
                        return false;
                    stra = ("" + stra).toLowerCase();
                    strb = ("" + strb).toLowerCase();
                    return stra.indexOf(strb) !== -1;
                }
            };
        });

angular.module('filters', ['utils'])
        .filter('searchRecipe', function (utils) {
            return function (input, query, queryBy) {
                if (!query)
                    return input;
                //For precaution, if the query by is empty search all
                if (queryBy.length === 0)
                    queryBy = ['Name', 'Ingredient', 'Preparation', 'Mealtime'];
                var result = [];
                //For Performance first get the booleans instead of query everytime
                var queryName = (queryBy.indexOf("Name")>-1);
                var queryPrep = (queryBy.indexOf("Preparation")>-1);
                var queryMealtime = (queryBy.indexOf("Mealtime")>-1);
                var queryIng = (queryBy.indexOf("Ingredient")>-1);
                angular.forEach(input, function (recipe) {
                    var found = false;
                    if (!found && queryName) 
                        found = utils.compareStr(recipe.name, query);
                    if (!found && queryPrep) 
                        found = utils.compareStr(recipe.preparation, query);
                    if (!found && queryMealtime) 
                        found = utils.compareStr(recipe.mealtime, query);
                    if (!found && queryIng) 
                        found = utils.compareStr(recipe.ingredients_str, query);
                    if (found)
                        result.push(recipe);
                });
                return result;
            };
        });
