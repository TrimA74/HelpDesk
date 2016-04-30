helpdesk.controller("createTicketController", [
	"$scope","$http","$rootScope","$location","$cookies","Upload","$timeout",
	function($scope,$http,$rootScope,$location,$cookies,Upload,$timeout){
		$scope.emergencyStatus = "42";
		$scope.issueType = 'logiciel';
		$scope.uploadPic = function(file) {
    file.upload = Upload.upload({
      url: 'model/upload.php',
      data: {username: $scope.username, fileToUpload: file},
    });

    file.upload.then(function (response) {
      $timeout(function () {
        file.result = response.data;
      });
    }, function (response) {
      if (response.status > 0)
        $scope.errorMsg = response.status + ': ' + response.data;
    }, function (evt) {
      // Math.min is to fix IE which reports 200% sometimes
      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    });
    }
		$scope.createTicket = function() {
			$http.get("model/createTicket.php", { params : {
				id_user : $rootScope.user.id,
				statut_user : $rootScope.user.statut,
				emergency_status : $scope.emergencyStatus,
				computer_number : $scope.computerNumber,
				issue_type : $scope.issueType,
				issue_type_specification : $scope.issueTypeSpecification.id_specialite,
				ticket_description : $scope.ticketDescription
			}})
			.success(function(result){
            	console.log(result);
            	$http.get("model/redirectTicket.php", { params : {
				id_user : $rootScope.user.id,
				}})
				.success(function(result){
	            	console.log(result);
	            	if(result.message.search('succeed')){
	            		jQuery("form").append("<span class='label label-success'>Ticket créer</span>");
	            	}
				});
			});
			
		};

		$scope.findSpecialites = function() {
			$http.get("model/findSpecialites.php", { params : {
				id_user : $rootScope.user.id,
				statut_user : $rootScope.user.statut,
				issue_type : $scope.issueType
			}})
			.success(function(result) {
				$scope.specialites = result;
				$scope.issueTypeSpecification = $scope.specialites[0];
			});
		};
	}

]);
