helpdesk.controller("statsController", [
	"$scope","$http","$rootScope","$cookies","$location",
	function($scope,$http,$rootScope,$cookies,$location){
		$http.get("model/stats.php",{ params : 
          { }})
      .success(function(datas){
      	console.log(datas);
      	    $scope.config = {
    title: 'Tickets',
    tooltips: true,
    labels: false,
    mouseover: function() {},
    mouseout: function() {},
    click: function() {},
    legend: {
      display: true,
      //could be 'left, right'
      position: 'right'
    }
  };
	var datass = [];
	angular.forEach(datas,function(value, key) {
  datass.push({
  	"x" : value.NOM,
  	"y" : [value.tickets]
  });
	});
	console.log(datass);
  $scope.data = {
    series: ['Nombre de ticket'],
    data: datass
  };
      });
}]);