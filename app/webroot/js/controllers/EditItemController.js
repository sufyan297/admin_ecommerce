(function() {

    var app = angular.module("krerum");

    app.controller("EditItemController", ['$scope', '$http','growl', function($scope, $http, growl) {
        console.log("EditItemController");

        $scope.obj = {
            categories: [],
            category_id: '',
            sub_categories: [],
            sub_category_id: null
        };
        var fetch_flag_cat = 0, fetch_flag_sub_cat = 0;

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
                    // growl.info('Item categories fetched.');

                    $scope.obj.categories = resp.data.data;

                    if (fetch_flag_cat === 0) {
                        $scope.obj.category_id = document.getElementById('inputCategoryId').value ;
                        $scope.getSubCategories();
                        fetch_flag_cat = 1;
                    }
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

                    if (fetch_flag_sub_cat === 0) {
                        $scope.obj.sub_category_id = document.getElementById('inputSubCategoryId').value ;
                        fetch_flag_sub_cat = 1;
                    }

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

        //---------------------------------------------------------------------------
        //First Variant
        $scope.variants = [
            {
                id: null, //ChildItemID
                sellers: [
                    {
                        id: null,
                        price: 0.00,
                        discount_price: 0.00,
                        seller_item_id: null,
                        seller_sku_code: null
                    }
                ],
                item_photos: [],
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
        $scope.all_sellers = [];
        $scope.item_id = document.getElementById('data_item_id').value;
        //---------------------------------------------------------------------------


        $scope.addChildItem = function addChildItem()
        {
            //New Variant
            $scope.variants.push(
                {
                    id: null, //ChildItemID
                    sellers: [
                        {
                            id: null,
                            price: 0.00,
                            discount_price: 0.00,
                            seller_item_id: null,
                            seller_sku_code: null
                        }
                    ],
                    item_photos: [],                
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

        $scope.addSeller = function addSeller(var_idx, sub_var_idx)
        {
            console.log("[Add] Variant Idx:",var_idx);
            console.log("[Add] SUB Variant Idx: ", sub_var_idx);

            $scope.variants[var_idx].sellers.push(
                {
                    id: null,
                    price: 0.00,
                    discount_price: 0.00,
                    seller_item_id: null,
                    seller_sku_code: null            
                }
            );
        };

        $scope.removeSubVariant = function removeSubVariant(var_idx, sub_var_idx)
        {
            console.log("[Remove] Variant Idx:",var_idx);
            console.log("[Remove] SUB Variant Idx: ", sub_var_idx);

            $scope.variants[var_idx].sub_variants.splice(sub_var_idx, 1);
        };


        $scope.removeSeller = function removeSeller(var_idx, sub_var_idx)
        {
            console.log("[Remove] Seller Idx:",var_idx);
            console.log("[Remove] SUB Seller Idx: ", sub_var_idx);

            $scope.variants[var_idx].sellers.splice(sub_var_idx, 1);
        };

        //--------------------------------
        //  Setters
        //---------------
        $scope.addChildItem_DB = function addChildItem_DB(_variant)
        {
            // console.log("[POST] ChildItem: ", _variant);
            var req = {
                method: 'POST',
                url: baseUrl + 'items/addChildItem',
                data: {
                    variant: _variant,
                    item_id: $scope.item_id
                }
            };

            console.log("[POST] Request: ", req);

            $http(req)
    		.then(function successCallback(resp) {
                //Success
                if (resp.data.status == 'success') {
                    console.log("RESPONSE:",resp);
                    growl.success('Child Item successfully added.');
                    window.location.reload();
                } else {
                    growl.error(resp.data.message);
                }
            }, function errorCallback(response) {
    		    console.log(response);
    		});
        };

        $scope.removeChildItem_DB = function removeChildItem_DB(_variant)
        {
            console.log("Variant: ", _variant);
            if (confirm("Are you sure you want to delete this child item? \n This action won't be rollback.")) {
                var req = {
                    method: 'POST',
                    url: baseUrl + 'items/removeChildItem',
                    data: {
                        child_item_id: _variant.id, //ChildItemId (Actual Child we wants to delete)
                        item_id: $scope.item_id//ParentItemId (Not needed just sending optional)
                    }
                };

                $http(req)
                .then(function successCallback(resp) {
                    //Success
                    if (resp.data.status === 'success') {
                        growl.error("Child Item successfully removed.");
                        window.location.reload();
                    } else {
                        growl.error(resp.data.message);
                    }
                }, function errorCallback(response) {
                    console.log(response);
                });
            }
        };

        //---------------------
        //Getters
        //--------------------
        $scope.getSellers = function getSellers()
        {
            var req = {
    		    method: 'POST',
    		    url: baseUrl + 'sellers/getAllSellers'
            };

            $http(req)
    		.then(function successCallback(resp) {
                //Success
                if(resp.data.status == 'success')
                {
                    console.log("SUCCESS",resp);
                    $scope.all_sellers = resp.data.data;

                    addSelect2();
                }
                else {
                    console.log("Failed!!");
                    // console.log(response);
                    $scope.all_sellers = [];
                }
    		}, function errorCallback(response) {
    		    console.log(response);
    		});
        };

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

        function variantIsAlreadySelected(var_idx, sub_var_idx, _variant_id)
        {
            var flg = false;

            // console.log("Variant IDX:",var_idx);
            // console.log("Sub Variant IDX:",sub_var_idx);
            var idx = 0;

            // console.log("VARIANTS: ", $scope.variants[var_idx].sub_variants);
            $scope.variants[var_idx].sub_variants.forEach(function(row) {
                if (row.variant_id === _variant_id) {
                    console.log("Row:- ",row);
                    idx++;
                }
            });

            if (idx === 2) {
                flg = true;
                // console.log("BREAK_IT");
            }

            return flg;
        }

        $scope.getVariantProperties = function getVariantProperties(var_idx, sub_var_idx, _variant_id, old_variant_id)
        {
            // console.log("[getVariantProperties]:", _variant_id);

            //First check: This Variant is already selected before or not. if Yes restrict it.
            var chk = variantIsAlreadySelected(var_idx, sub_var_idx, _variant_id);

            if (chk === true) {
                // console.log("New Variant:", _variant_id);
                // console.log("Old Variant: ", old_variant_id);
                $scope.variants[var_idx].sub_variants[sub_var_idx].variant_id = old_variant_id;
                return growl.error("Oops! That variant is already selected for this child item.");
            }

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

        function sellerIsAlreadySelected(var_idx, sub_var_idx, _seller_id)
        {
            var flg = false;
            var idx = 0;
            $scope.variants[var_idx].sellers.forEach(function(row) {
                if (row.id === _seller_id) {
                    console.log("Row:- ",row);
                    idx++;
                }
            });

            if (idx === 2) {
                flg = true;
            }
            return flg;
        }
        //Seller Check
        //One Child Item should not have same seller for more than once.
        $scope.checkSellers = function checkSellers(var_idx, sub_var_idx, _seller_id, old_seller_id)
        {
            //First check: This Seller is already selected before or not. if Yes restrict it.
            var chk = sellerIsAlreadySelected(var_idx, sub_var_idx, _seller_id);

            if (chk === true) {
                $scope.variants[var_idx].sellers[sub_var_idx].id = old_seller_id;
                return growl.error("Oops! That seller is already selected for this child item.");
            }

        };


        //Save Priority For Item Photo
        $scope.savePhotoPriority = function savePhotoPriority(photo)
        {   
            console.log("Photo: ", photo);
            var photo_priority = document.getElementById('photo_priority_'+photo.id).value;
            console.log("Photo Priority: ", photo_priority);

            var req = {
                method: 'POST',
                url: baseUrl + 'items/savePhotoPriority',
                data: {
                    id: photo.id,
                    priority: photo_priority
                }
            };

            $http(req)
            .then(function successCallback(resp) {
                //Success
                if(resp.data.status == 'success')
                {
                    console.log("SUCCESS",resp);
                    growl.success(resp.data.message);
                    
                }
                else {
                    console.log("Failed!!",resp);
                    // console.log(response);
                    growl.error(resp.data.message);                    
                }
            }, function errorCallback(response) {
                console.log(response);
            });
        };


        //Delete Item Photo By Id
        $scope.deleteItemPhoto = function deleteItemPhoto(photo,var_idx, sub_photo_idx)
        {   
            console.log("Photo: ", photo);

            if (confirm("Are you sure you want to delete this child item? \n This action won't be rollback.")) {      
                var req = {
                    method: 'POST',
                    url: baseUrl + 'items/deleteItemPhoto',
                    data: {
                        id: photo.id
                    }
                };
    
                $http(req)
                .then(function successCallback(resp) {
                    //Success
                    if(resp.data.status == 'success')
                    {
                        console.log("SUCCESS",resp);
                        growl.success(resp.data.message);
                        $scope.variants[var_idx].item_photos.splice(sub_photo_idx, 1);   
                    }
                    else {
                        console.log("Failed!!",resp);
                        // console.log(response);
                        growl.error(resp.data.message);                    
                    }
                }, function errorCallback(response) {
                    console.log(response);
                });
            }
        };
        //------------------------------
        //get Variant
        function getChildItems()
        {
            console.log("getChildItems()");
            var req = {
                method: 'POST',
                url: baseUrl + 'items/getAllChildItems',
                data: {
                    item_id: $scope.item_id
                }
            };

            $http(req)
            .then(function successCallback(resp) {
                //Success
                if(resp.data.status == 'success')
                {
                    console.log("[getChildItems] SUCCESS",resp.data);
                    $scope.variants = resp.data.data;
                }
                else {
                    console.log("Failed!!");
                    // console.log(response);
                }
            }, function errorCallback(response) {
                console.log(response);
            });
        }

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
        $scope.getSellers();
        getChildItems();
    }]);

})();
