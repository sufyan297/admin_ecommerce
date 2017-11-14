(function() {
    
        var app = angular.module("krerum");
    
        app.controller("ViewMenuController", ['$scope', '$http','growl', function($scope, $http, growl) {
            console.log("ViewMenuController");
    

            $scope.savePriority = function(item_id)
            {
                var priority_val = document.getElementById('priority_'+item_id).value;
                console.log("item_id: ",item_id);
                console.log("Priority:",priority_val);
                var params = {
                    method: 'POST',
                    url: baseUrl + 'menus/save_priority',
                    data: {
                        menu_id: item_id,
                        priority: priority_val
                    }
                };
    
                $http(params)
                     .then(function successCallback(res) {
                        console.log("Response: ",res);
                        if (res.data.status === "success") {
                            growl.success(res.data.message);
                        } else {
                            growl.error(res.data.message);
                        }
    
                     }, function errorCallback(response) {
                        console.log("Error: ",response);
                        growl.error("Something went wrong. Please try again later.");
                    });
    
            };


        }]);
    
    })();
    