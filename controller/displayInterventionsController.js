helpdesk.controller("displayInterventionsController", [
	"$scope","$http","$rootScope","$location","$cookies",
	function($scope,$http,$rootScope,$location,$cookies){
       $scope.init = function(){
			$scope.interventions=[];
			$scope.interventionsSearch=[];
		 	$http.get("model/displayInterventions.php", { params : {
				id_user :  $rootScope.user.id
			}})
			.success(function(data){
				console.log(data);
				for (i = 0; i < data.length; i++) {
				    $scope.interventions.push(data[i]);
				    $scope.interventionsSearch.push(data[i]);
				}
		 	});
	   }
	   $scope.redirectOnIntervention = function(id){
			$location.path('/redirectionTicket/'+id);
	   };

   		$scope.searchIntervention = function(){
		console.log("Recherche du ticket en cour");
		for (i = 0; i < $scope.interventionsSearch.length; i++) {
			    $scope.interventions[i] =  $scope.interventionsSearch[i];
			}
		//check du statut
		if($scope.searchTicketStatus != null && $scope.searchTicketStatus != ""){
			for (i = 0; i < $scope.interventions.length; i++) {
			    if($scope.interventions[i].libelle_int != $scope.searchTicketStatus)
					delete $scope.interventions[i];
			}
			$scope.interventions = $scope.interventions.filter( function(val){return val !== null} );
		}
		//check du nom du demandeur
		if($scope.searchUserName != null && $scope.searchUserName != ""){
			for (i = 0; i < $scope.interventions.length; i++) {
			    if($scope.interventions[i].nom_client.toLowerCase() != $scope.searchUserName.toLowerCase())
					delete $scope.interventions[i];
			}
			$scope.interventions = $scope.interventions.filter( function(val){return val !== null} );
		}

		//recherche du num intervention
		if($scope.searchInterventionNumber != null && $scope.searchInterventionNumber != ""){
			for (i = 0; i < $scope.interventions.length; i++) {
			    if($scope.interventions[i].id_intervention != $scope.searchInterventionNumber)
					delete $scope.interventions[i];
			}
			$scope.interventions = $scope.interventions.filter( function(val){return val !== null} );
		}

		//recherche du num ticket
		if($scope.searchTickeNumber != null && $scope.searchTickeNumber != ""){
			for (i = 0; i < $scope.interventions.length; i++) {
			    if($scope.interventions[i].id_ticket != $scope.searchTickeNumber)
					delete $scope.interventions[i];
			}
			$scope.interventions = $scope.interventions.filter( function(val){return val !== null} );
		}
		//recherche de la date de  la dernière intervention
		if($scope.dateSearch != null && $scope.dateSearch != ""){
			for (i = 0; i < $scope.interventions.length; i++) {
			    if($scope.interventions[i].date_interv.toString() != $scope.dateSearch.toString())
					delete $scope.interventions[i];
			}
			$scope.interventions = $scope.interventions.filter( function(val){return val !== null} );
		}



	};
}]);