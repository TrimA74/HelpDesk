helpdesk.controller("testController", [
	"$scope","$http","$rootScope","$cookies","$location",
	function($scope,$http,$rootScope,$cookies,$location){
		$scope.class={
			test1 : "danger",
			test2 : "danger"};
		$scope.text = { "test1" : "Test échoué",
		"test2" : "Test échoué" };
		/*
		* TEST INSERTION TICKET + REDIRECTION 1 SEUL EMPLOYE A LA SPECIALITE
		*/
		$http.get("model/createTicket.php", { params : {
				id_user : 2,
				statut_user : "client",
				emergency_status : 41,
				computer_number : "S1-P1",
				issue_type : "materiel",
				issue_type_specification : 21,
				ticket_description : "description ticket :)",
				test : true
			}})
			.success(function(result){
            	console.log(result);
			});
			$http.get("model/redirectTicket.php", { params : {
				id_user : 2,
				test : true
			}})
			.success(function(result){
            	console.log(result);
            	if(result.test==1){
            		$scope.class.test1="success";
            		$scope.text.test1 = "Test réussi";
            	}
            	$scope.test2();
			});
		/*
		* TEST INSERTION TICKET + REDIRECTION 2 EMPLOYES ONT LA COMPETENCE
		*/
		$scope.test2 = function () {
		$http.get("model/createTicket.php", { params : {
				id_user : 4,
				statut_user : "client",
				emergency_status : 42,
				computer_number : "S1-P1",
				issue_type : "logiciel",
				issue_type_specification : 25,
				ticket_description : "description ticket :)",
				test : true
			}})
			.success(function(result){
            	console.log(result);
			});
			$http.get("model/redirectTicket.php", { params : {
				id_user : 4,
				test : true
			}})
			.success(function(result){
            	console.log(result);
            	if(result.test==1){
            		$scope.class.test2="success";
            		$scope.text.test2 = "Test réussi";
            	}
			});

		};
   
}]);