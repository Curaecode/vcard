var app = angular.module('myApp', ["ngRoute"]);
var api_url="http://localhost/common3/api/";
app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "pages/login.html",
		controller : "login"
    })
    .when("/red", {
        templateUrl : "red.htm"
    })
    .when("/green", {
        templateUrl : "green.htm"
    })
    .when("/blue", {
        templateUrl : "blue.htm"
    });
});
app.controller('common', function($scope, $http) {
	$http.get(api_url+"admin/login/index")
    .then(function (response) {
		if(response.data.return){
			window.location.href="index.html";
		}
		else{
			$scope.data=response.data;
		}
	});
})
app.controller('login', function($scope, $http) {
	// $http.get(api_url+"admin/login/check")
    // .then(function (response) {
		// console.log(response.data);
		// $scope.data = response.data;
	// });
});