helpdesk.controller("ticketController", [
	"$scope","$http","$rootScope","$routeParams","$location",
	function ($scope,$http,$rootScope,$routeParams,$location) {
		$scope.id = $routeParams.id;
		$scope.init = function(){
		 	$http.get("model/ticket.php", { params : {
				id_ticket : $scope.id
			}})
			.success(function(data){
				console.log(data);
		 	   $scope.ticket = data;
		 	   $scope.nom_cli = data['0'].NOM_CLIENT;
		 	   $scope.pren_cli = data['0'].PRENOM_CLIENT;
		 	   $scope.lib_pos = data['0'].LIBELLE_POSTE;
		 	   $scope.lib_prob = data['0'].LIBELLE_PROBLEME;
		 	   $scope.com_tick = data['0'].COMMENTAIRE_TICKET;
		 	   $scope.des_tick = data['0'].DESCRIPTION_TICKET;
		 	   $scope.statut_tick = data['0'].STATUT_TICKET;
		 	   $scope.libelle_etat = data['0'].LIBELLE_ETAT;
		 	   $scope.date_rez = data['0'].DATE_RESOLUTION_PREVUE_TICKET;
		 	});
		 	$http.get("model/getIntervention.php", { params : {
				id_ticket : $scope.id
			}})
			.success(function(interventions){
                $scope.interventions = interventions;
			});
		 };
		$scope.redirectOnIntervention = function(id){
			$location.path('/createIntervention/'+id);
		};
	}]);