(function() {

    var app = angular.module("krerum");

    app.controller("EditItemController", ['$scope', '$http', function($scope, $http) {
        console.log("EditItemController");


        //---------------------------------------------------------------------------
        //First Variant
        $scope.variants = [
            {
                id: null,
                sub_variants: [
                    {
                        variant_id: '',
                        variant_property_id: '',
                        all_properties: [],
                    },
                ],
                price: '',
                discount_price: ''
            }
        ];

        $scope.all_variants = [];
        //---------------------------------------------------------------------------


        $scope.addChildItem = function addChildItem()
        {
            //New Variant
            $scope.variants.push(
                {
                    id: null,
                    sub_variants: [
                        {
                            variant_id: '',
                            variant_property_id: '',
                            all_properties: []
                        }
                    ],
                    price: '',
                    discount_price: ''
                }
            );
            //---------------------
            addSelect2();
        };

        $scope.addSubVariant = function addSubVariant(var_idx, sub_var_idx)
        {
            console.log("[Add] Variant Idx:",var_idx);
            console.log("[Add] SUB Variant Idx: ", sub_var_idx);

            $scope.variants[var_idx].sub_variants.push(
                {
                    variant_id: '',
                    variant_property_id: '',
                    all_properties: []
                }
            );
        };

        $scope.removeSubVariant = function addSubVariant(var_idx, sub_var_idx)
        {
            console.log("[Remove] Variant Idx:",var_idx);
            console.log("[Remove] SUB Variant Idx: ", sub_var_idx);

            $scope.variants[var_idx].sub_variants.splice(sub_var_idx, 1);
        };


        //---------------------
        //Getters
        //--------------------
        $scope.getVariants = function getVariants()
        {
            var req = {
    		    method: 'POST',
    		    url: baseUrl + 'items/getAllVariants'
            };

            $http(req)
    		.then(function successCallback(resp) {
                //Success
                if(resp.data.status == 'success')
                {
                    console.log("SUCCESS",resp);
                    $scope.all_variants = resp.data.data;

                    addSelect2();
                }
                else {
                    console.log("Failed!!");
                    // console.log(response);
                    $scope.all_variants = [];
                }
    		}, function errorCallback(response) {
    		    console.log(response);
    		});
        };

        $scope.getVariantProperties = function getVariantProperties(var_idx, sub_var_idx, _variant_id)
        {
            console.log("SELECTED VARIANT:", _variant_id);
            var req = {
                method: 'POST',
                url: baseUrl + 'items/getAllProperties',
                data: {
                    variant_id: _variant_id
                }
            };

            $http(req)
            .then(function successCallback(resp) {
                //Success
                if(resp.data.status == 'success')
                {
                    console.log("SUCCESS",resp);
                    $scope.variants[var_idx].sub_variants[sub_var_idx].all_properties = resp.data.data;

                    addSelect2();
                }
                else {
                    console.log("Failed!!");
                    // console.log(response);
                    $scope.all_variants = [];
                }
            }, function errorCallback(response) {
                console.log(response);
            });


        };


        //Extras
        //-=-=--=-=-=-=-=
        function addSelect2()
        {
            setTimeout(function() {
                $('.select2').select2();
            },10);
        }

        //CallBacks

        $scope.getVariants();
    }]);

})();
