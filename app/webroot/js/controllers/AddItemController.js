(function() {

    var app = angular.module("krerum");

    app.controller("AddItemController", ['$scope', '$http','growl', function($scope, $http, growl) {
        console.log("AddItemController");

        $scope.obj = {
            categories: [],
            category_id: '',
            sub_categories: [],
            sub_category_id: null
        };

        function getItemCategories()
        {
            var req = {
                method: 'POST',
                url: baseUrl + 'item_category/getCategories',
                data: {}
            };

            $http(req)
            .then(function successCallback(resp) {
                //Success
                if (resp.data.status == 'success') {
                    console.log("RESPONSE:",resp);
                    growl.info('Item categories fetched.');
                    $scope.obj.categories = resp.data.data;

                    addSelect2();
                } else {
                    growl.error(resp.data.message);
                }
            }, function errorCallback(response) {
                console.log(response);
            });

        }


        $scope.getSubCategories = function getSubCategories()
        {
            var req = {
                method: 'POST',
                url: baseUrl + 'item_sub_category/getSubCategories',
                data: {
                    category_id: $scope.obj.category_id
                }
            };

            $http(req)
            .then(function successCallback(resp) {
                //Success
                if (resp.data.status == 'success') {
                    console.log("RESPONSE:",resp);
                    growl.info('Item categories fetched.');
                    $scope.obj.sub_categories = resp.data.data;

                    document.getElementById('inputCategoryId').value = $scope.obj.category_id;

                    addSelect2();
                } else {
                    growl.error(resp.data.message);
                }
            }, function errorCallback(response) {
                console.log(response);
            });

        };


        $scope.changeSubCategory = function changeSubCategory()
        {
            console.log("changeSubCategory()");
            document.getElementById('inputSubCategoryId').value = $scope.obj.sub_category_id;
        };
        //Callbacks
        getItemCategories();
        //----------------------------

        //Extras
        //-=-=--=-=-=-=-=
        function addSelect2()
        {
            setTimeout(function() {
                $('.select2').select2();
            },10);
        }

    }]);

})();
