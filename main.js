var helpdesk = angular.module("helpdesk",["ngRoute","ngCookies","ngFileUpload","angularCharts"]); /*para angular module = ng-app*/


//-------------------------------------ROUTE
helpdesk.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/home', {
        templateUrl: 'html/home.html',
        controller: 'homeController'
      }).
      when('/displayTickets', {
        templateUrl: 'html/displayTickets.html',
        controller: 'displayTicketsController'
      }).
      when('/login', {
        templateUrl: 'html/login.html',
        controller: 'loginController'
      }).
      when('/createTicket', {
        templateUrl: 'html/createTicket.html',
        controller: 'createTicketController'
      }).
      when('/displayInterventions', {
        templateUrl: 'html/displayInterventions.html',
        controller: 'displayInterventionsController'
      }).
      when('/redirectionTicket', {
        templateUrl: 'html/redirectionTicket.html',
        controller: 'redirectionTicketController'
      }).
      when('/redirectionTicket/:id', {
        templateUrl: 'html/ticket.html',
        controller: 'ticketController'
      }).
      when('/createIntervention/:id', {
        templateUrl: 'html/createIntervention.html',
        controller: 'createInterventionController'
      }).
      when('/test', {
        templateUrl: 'html/test.html',
        controller: 'testController'
      }).
      when('/stats', {
        templateUrl: 'html/stats.html',
        controller: 'statsController'
      }).
      otherwise({
        redirectTo: '/login'
      });
  }]);




helpdesk.controller("mainController", [
	"$scope","$http","$rootScope","$cookies","$location",
	function($scope, $http,$rootScope,$cookies, $location){
    $rootScope.fixStatus = function (user) {
      if(user.statut == 'client'){
            $rootScope.isClient = true;
        }else if(user.statut == 'operateur'){
            $rootScope.isOpe = true;
        }else if(user.statut == 'responsable'){
            $rootScope.isResp = true;
        }
    };
    $scope.logout = function(){
        $scope.isLogged = false;
        $scope.user = {};
        $cookies.remove('user');
        $rootScope.isClient = false;
        $rootScope.isOpe = false;
        $rootScope.isResp = false;
    };
    $rootScope.user = {};
      if( typeof $cookies.get('user') !='undefined'){
        $rootScope.isLogged = true;
        $rootScope.user = JSON.parse($cookies.get('user'));

        $rootScope.isClient = false;
        $rootScope.isOpe = false;
        $rootScope.isResp = false;
        
        /*fonctions qui gèrent l'affichage*/
        $rootScope.fixStatus($rootScope.user);
     } else {
        $location.path('/login');
     }
     console.log($rootScope.isClient);
		
	}
]);





