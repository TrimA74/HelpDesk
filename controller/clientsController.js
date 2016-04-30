helpdesk.controller("clientsController", [
	"$scope","$http",
	function($scope,$http){

		$scope.user="";
		$scope.users=[];
		$http.get("model/client.php",{ params : { }})
			.success(function(data){
				$scope.users = data;
			});

}]);