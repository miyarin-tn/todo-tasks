<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Docker Task</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
</head>
<body>
	<div ng-app="myApp">
		<div class="task-box" ng-controller="ctrlTask">
			<h1>todos</h1>
			<form ng-submit="createTask()">
				<div class="f-task">
					<input type="text" class="input-task" placeholder="What needs to be done?" ng-model="nameTask">
					<ul class="list-task" ng-class="{show: tasks.length > 0}">
						<li ng-repeat="task in tasks">
							<label>
								<input type="checkbox" ng-model="status" ng-checked="{{task.status}}" ng-click="changeChecked(task.id, task.status)">
								<em>{{task.name}}</em>
								<span class="check-task"></span>
							</label>
							<span ng-click="deleteTask(task.id)">×</span>
						</li>
					</ul>
					<div class="classify-task clearfix" ng-class="{show: tasks.length > 0}">
						<span class="quantity-task">{{l_task}} item left</span>
						<div ng-view></div>
						<span class="clear-task" ng-class="{show: clear == true}" ng-click="deleteComplete()">Clear Complete</span>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="js/script.js"></script>
</body>
</html>