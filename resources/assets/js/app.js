var shopvel = angular.module('shopvel', ['ngRoute']).run(function($http,dataFactory,$rootScope) {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "index", false);
	xhr.onload = function (e) {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				$rootScope.data = JSON.parse(xhr.responseText);
				console.log($rootScope.data);
			}
		}
	};
	xhr.send(null);
});

var appBaseUrl = $('base').attr('href');

var xhReq = new XMLHttpRequest();
xhReq.open("GET", "api/csrf", true);
xhReq.send(null);

shopvel.constant("CSRF_TOKEN", xhReq.responseText);

shopvel.run(['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
	$http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
}]);

shopvel.controller('mainController', function(dataFactory,$rootScope,$scope) {
var data = $rootScope.data;

$('.overlay, .loading-img').hide();
});

shopvel.controller('homeController', function(dataFactory,$rootScope,$scope) {
	$('.overlay, .loading-img').hide();
});

shopvel.factory('dataFactory', function($http) {
	var myService = {
		httpRequest: function(url,method,params,dataPost,upload) {
			var passParameters = {};
			passParameters.url = url;

			if (typeof method == 'undefined'){
				passParameters.method = 'GET';
			}else{
				passParameters.method = method;
			}

			if (typeof params != 'undefined'){
				passParameters.params = params;
			}

			if (typeof dataPost != 'undefined'){
				passParameters.data = dataPost;
			}

			if (typeof upload != 'undefined'){
				passParameters.upload = upload;
			}

			var promise = $http(passParameters).then(function (response) {
				if(typeof response.data == 'string' && response.data != 1){
					$.gritter.add({
						title: 'Shopvel',
						text: response.data
					});
					return false;
				}
				if(response.data.jsMessage){
					$.gritter.add({
						title: response.data.jsTitle,
						text: response.data.jsMessage
					});
				}
				return response.data;
			},function(){
				$.gritter.add({
					title: 'Shopvel',
					text: 'An error occured.'
				});
			});
			return promise;
		}
	};
	return myService;
});