// Pépito
helpdesk.controller("displayTicketsController", [
	"$scope","$http","$rootScope","$location","$cookies",
	function($scope,$http,$rootScope,$location,$cookies){
		$scope.tickets=[];
		$scope.ticketsSearch=[];
		/*tri*/
		$scope.predicate = 'id';
		$scope.reverse = true;
		$scope.order = function(predicate) {
		$scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
		$scope.predicate = predicate;
		};
		$scope.init = function(){
			$http.get("model/displayTickets.php", { params : {
				id_user : $rootScope.user.id,
				statut_user : $rootScope.user.statut
			}})
			.success(function(allTickets){
			  for (i = 0; i < allTickets.length; i++) {
				    $scope.tickets.push(allTickets[i]);
				    $scope.ticketsSearch.push(allTickets[i]);
				}
				console.log($scope.tickets);
			});
		};
		$scope.redirectOnTicket = function(id){
			$location.path('/redirectionTicket/'+id);
		};
		//  Recherche des tickets
		$scope.searchTicket = function(){
			console.log("Recherche du ticket en cour");
			for (i = 0; i < $scope.ticketsSearch.length; i++) {
				    $scope.tickets[i] =  $scope.ticketsSearch[i];
				}

			//check de la priorité/urgence
			if($scope.searchTicketPriority != null && $scope.searchTicketPriority != ""){
				for (i = 0; i < $scope.tickets.length; i++) {
				    if($scope.tickets[i].urgence != $scope.searchTicketPriority)
						delete $scope.tickets[i];
				}
				$scope.tickets = $scope.tickets.filter( function(val){return val !== null} );
			}
			//check de l'état
			if($scope.searchStateEtat != null && $scope.searchStateEtat != ""){
				for (i = 0; i < $scope.tickets.length; i++) {
				    if($scope.tickets[i].libelle_etat != $scope.searchStateEtat.toLowerCase())
						delete $scope.tickets[i];
				}
				$scope.tickets = $scope.tickets.filter( function(val){return val !== null} );
			}
			//check du type
			if($scope.searchTicketType != null && $scope.searchTicketType != ""){
				for (i = 0; i < $scope.tickets.length; i++) {
				    if($scope.tickets[i].pb != $scope.searchTicketType.toLowerCase())
						delete $scope.tickets[i];
				}
				$scope.tickets = $scope.tickets.filter( function(val){return val !== null} );
			}
			//check du statut
			if($scope.searchTicketStatus != null && $scope.searchTicketStatus != ""){
				for (i = 0; i < $scope.tickets.length; i++) {
				    if($scope.tickets[i].statut_ticket != $scope.searchTicketStatus)
						delete $scope.tickets[i];
				}
				$scope.tickets = $scope.tickets.filter( function(val){return val !== null} );
			}
			//recherche du numéro de ticket
			if($scope.searchTicketNumber != null && $scope.searchTicketNumber != ""){
				for (i = 0; i < $scope.tickets.length; i++) {
				    if($scope.tickets[i].id_ticket != $scope.searchTicketNumber)
						delete $scope.tickets[i];
				}
				$scope.tickets = $scope.tickets.filter( function(val){return val !== null} );
			}
			//recherche du nom d'utilisateur
			if($scope.searchUserName != null && $scope.searchUserName != ""){
				for (i = 0; i < $scope.tickets.length; i++) {
				    if($scope.tickets[i].nom_client.toLowerCase() != $scope.searchUserName.toLowerCase())
						delete $scope.tickets[i];
				}
				$scope.tickets = $scope.tickets.filter( function(val){return val !== null} );
			}
			//recherche de la date
			if($scope.dateSearch != null && $scope.dateSearch != ""){
				for (i = 0; i < $scope.tickets.length; i++) {
				    if($scope.tickets[i].date_rez_prevue.toString() != $scope.dateSearch.toString())
						delete $scope.tickets[i];
				}
				$scope.tickets = $scope.tickets.filter( function(val){return val !== null} );
			}

		};
}]);