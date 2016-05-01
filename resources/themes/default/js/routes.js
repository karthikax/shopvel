shopvel.config(function($routeProvider,$locationProvider) {

	$routeProvider.when('/', {
		templateUrl : 'templates/home.html',
		controller  : 'mainController'
	})

	.when('/shop', {
		templateUrl : 'templates/shop.html',
		controller  : 'shopController'
	})

	.otherwise({
		redirectTo:'/'
	});

	$locationProvider.html5Mode(true);
});