//Pépito
helpdesk.controller("searchTicketController", [
	"$scope","$http","$rootScope","$location","$cookies",
	function($scope,$http,$rootScope,$location,$cookies){	

		$scope.error=0;
		 $scope.searchTicket = function(){
		 console.log("Recherche du ticket en cour");
	    $http.get("model/searchTicket.php",{ params : 
	    	{
	    		//login_user : $scope.user.login, 
	    		//mdp_user : $scope.user.mdp
	    	}})
	    .success(function(searchTicket){
	    	console.log(searchTicket);
	    	if(searchTicket.length ==1){
	    		$rootScope.user = searchTicket[0];
	    		$rootScope.isLogged = true;
	    		$rootScope.fixStatus($rootScope.user);
	    		$location.path('/home');
	    		$cookies.putObject('user', $rootScope.user);
	    		$rootScope.testcookie =  JSON.parse($cookies.get('user'));
	    	}else{
	    		$scope.error = "Aucun ticket trouvé";
	    		/*
	    		var ajustDiv = angular.element(document.getElementsByClassName("Absolute-Center is-Responsive"));
	    		ajustDiv.css('height' , '300px');*/
	    	}
	    });
	};
}]);