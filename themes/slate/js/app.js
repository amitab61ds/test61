var app = angular.module('app', [
    'ngRoute',      //$routeProvider
    'mgcrea.ngStrap', //bs-navbar, data-match-route directives
	'controllers'   
]);

app.config(['$routeProvider', '$httpProvider',
    function($routeProvider, $httpProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'themes/slate/partials/index.html'
            }).
            when('/about', {
                templateUrl: 'themes/slate/partials/about.html'
            }).
            when('/contact', {
                templateUrl: 'themes/slate/partials/contact.html',
				controller: 'ContactController'
            }).
            when('/dashboard', {
                templateUrl: 'themes/slate/partials/dashboard.html',
                controller: 'DashboardController'
            }).			
            when('/login', {
                templateUrl: 'themes/slate/partials/login.html',
				controller: 'LoginController'
            }).
            otherwise({
                templateUrl: 'themes/slate/partials/404.html'
            });
			$httpProvider.interceptors.push('authInterceptor');
    }
]);


app.factory('authInterceptor', function ($q, $window, $location) {
	return {
		request: function (config) {
			if ($window.sessionStorage.access_token) {				
				//HttpBearerAuth
				config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;
			}
			return config;
		},
		responseError: function (rejection) {
			if (rejection.status === 401) {
				$location.path('/login').replace();
			}
			return $q.reject(rejection);
		}
	};
});