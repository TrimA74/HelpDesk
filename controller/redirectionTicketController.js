helpdesk.controller("redirectionTicketController", [
	"$scope","$http","$rootScope",
	function ($scope,$http,$rootScope) {
		$scope.init = function(){
			$http.get("model/redirectionTicket.php", { params : {
				id_user : $rootScope.user.id
			}})
			.success(function(tickets){
				console.log(tickets);
				$scope.ticket = tickets;
			});
		};

	}]);