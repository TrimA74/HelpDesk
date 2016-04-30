helpdesk.controller("loginController", [
	"$scope","$http","$rootScope","$location","$cookies",
	function($scope,$http,$rootScope,$location,$cookies){

    $scope.error=0;
    $scope.showLoginForm = false;
    /*Suppression du cookie*/
    $scope.user = {
      mdp : "",
      login : ""
    };
		$rootScope.user="";
		$scope.users=[]; 
		$rootScope.isLogged = false;
    $rootScope.testcookie={};

		$scope.login = function(){
      $rootScope.isClient = false;
      $rootScope.isOpe = false;
      $rootScope.isResp = false;
     $http.get("model/login.php",{ params : 
          { login_user : $scope.user.login, 
            mdp_user : $scope.user.mdp
          }})
      .success(function(clients){
          console.log(clients);
          if(clients.length ==1){
              $rootScope.user = clients[0];
              $rootScope.isLogged = true;
              $rootScope.fixStatus($rootScope.user);
              $location.path('/home');
              /*initialisation du cookie*/
              $cookies.putObject('user', $rootScope.user);
              $rootScope.testcookie =  JSON.parse($cookies.get('user'));
          }else{
              $scope.error = "Login ou mot de passe invalide";
              var ajustDiv = angular.element(document.getElementsByClassName("Absolute-Center is-Responsive"));
              ajustDiv.css('height' , '300px');
          }
      });
    };
}]);
