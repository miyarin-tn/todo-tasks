angular.module('myApp', ['ngRoute']).config(function($routeProvider, $locationProvider) {
	$routeProvider
	.when('/', {
		templateUrl: 'filter/all.html',
	})
	.when('/active', {
		templateUrl: 'filter/active.html'
	})
	.when('/complete', {
		templateUrl: 'filter/complete.html'
	});
	$locationProvider.html5Mode(true);
}).controller('ctrlTask', function($scope, $http) {
	$http.get('config.php').then(function(response) {
		$scope.tasks = response.data;
		var dotask = 0, comptask = 0;
		for(var i = 0; i < $scope.tasks.length; i++) {
			if($scope.tasks[i].status == 0) {
				dotask++;
			}
		}
		$scope.l_task = dotask;
		comptask = $scope.tasks.length - dotask;
		comptask > 0 ? $scope.clear = true : $scope.clear = false;
	});
	$scope.createTask = function() {
		if($scope.nameTask) {
			$http({
				url: 'config.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'action=create&name=' + $scope.nameTask
			}).then(function(response) {
				$scope.nameTask = '';
				$scope.tasks = response.data;
				var dotask = 0, comptask = 0;
				for(var i = 0; i < $scope.tasks.length; i++) {
					if($scope.tasks[i].status == 0) {
						dotask++;
					}
				}
				$scope.l_task = dotask;
				comptask = $scope.tasks.length - dotask;
				comptask > 0 ? $scope.clear = true : $scope.clear = false;
			});
		}
		else {
			return false;
		}
	};
	$scope.changeChecked = function(id, status) {
		if(status == 0) {
			$http({
				url: 'config.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'action=change&id=' + id + '&status=1'
			}).then(function(response) {
				$scope.tasks = response.data;
				var dotask = 0, comptask = 0;
				for(var i = 0; i < $scope.tasks.length; i++) {
					if($scope.tasks[i].status == 0) {
						dotask++;
					}
				}
				$scope.l_task = dotask;
				comptask = $scope.tasks.length - dotask;
				comptask > 0 ? $scope.clear = true : $scope.clear = false;
			});
		}
		else {
			$http({
				url: 'config.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'action=change&id=' + id + '&status=0'
			}).then(function(response) {
				$scope.tasks = response.data;
				var dotask = 0, comptask = 0;
				for(var i = 0; i < $scope.tasks.length; i++) {
					if($scope.tasks[i].status == 0) {
						dotask++;
					}
				}
				$scope.l_task = dotask;
				comptask = $scope.tasks.length - dotask;
				comptask > 0 ? $scope.clear = true : $scope.clear = false;
			});
		}
	};
	$scope.deleteTask = function(id) {
		$http({
			url: 'config.php',
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'action=delete&id=' + id
		}).then(function(response) {
			$scope.tasks = response.data;
			var dotask = 0, comptask = 0;
			for(var i = 0; i < $scope.tasks.length; i++) {
				if($scope.tasks[i].status == 0) {
					dotask++;
				}
			}
			$scope.l_task = dotask;
			comptask = $scope.tasks.length - dotask;
			comptask > 0 ? $scope.clear = true : $scope.clear = false;
		});
	};
	$scope.deleteComplete = function() {
		$http({
			url: 'config.php',
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			data: 'action=remove'
		}).then(function(response) {
			$scope.tasks = response.data;
			var dotask = 0, comptask = 0;
			for(var i = 0; i < $scope.tasks.length; i++) {
				if($scope.tasks[i].status == 0) {
					dotask++;
				}
			}
			$scope.l_task = dotask;
			comptask = $scope.tasks.length - dotask;
			comptask > 0 ? $scope.clear = true : $scope.clear = false;
		});
	};
	$scope.filterTask = function(status) {
		if (status == 'active') {
			$http({
				url: 'config.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'action=filter&status=0'
			}).then(function(response) {
				$scope.tasks = response.data;
			});
		}
		else if (status == 'complete') {
			$http({
				url: 'config.php',
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				data: 'action=filter&status=1'
			}).then(function(response) {
				$scope.tasks = response.data;
			});
		}
		else {
			$http.get('config.php').then(function(response) {
				$scope.tasks = response.data;
				var dotask = 0, comptask = 0;
				for(var i = 0; i < $scope.tasks.length; i++) {
					if($scope.tasks[i].status == 0) {
						dotask++;
					}
				}
				$scope.l_task = dotask;
				comptask = $scope.tasks.length - dotask;
				comptask > 0 ? $scope.clear = true : $scope.clear = false;
			});
		}
	};
});
