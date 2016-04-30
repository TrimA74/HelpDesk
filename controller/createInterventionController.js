helpdesk.controller("createInterventionController", [
	"$scope","$http","$rootScope","$routeParams","$location",
	function ($scope,$http,$rootScope,$routeParams,$location) {
	$(function () {
            $('#dateTicket').datepicker({
        		trueodayBtn:"true",
				format:"dd-mm-yy", 
				autoclose:"true",
				pickerPosition:"bottom-left",
				startView:"year",
				minView:"month",
				language:"fr"
            });
        });
		console.log("createInterventionController");
		$scope.idTicket = $routeParams.id;
		$scope.createIntervention = function() {
			$http.get("model/createIntervention.php", { params : {
				id_user : $rootScope.user.id,
				statut_user : $rootScope.user.statut,
				intervention_date : $scope.interventionDate,
				id_ticket : $scope.idTicket
			}})
			.success(function(result){
            	console.log(result);
			});
		};
	}
]);