(function() {

	var app = angular.module("krerum", ['angular-growl']);

    console.log("[BASE] APP JS File.");

	app.config(['growlProvider', function(growlProvider) {
		growlProvider.globalTimeToLive({success: 3000, error: 5000, warning: 3000, info: 5000});
	}]);
    
})();
