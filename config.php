<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; charset=utf8');

	class database {
		public $hostname = '172.17.0.2', $username = 'root', $password = 'Thinh-1234', $database = 'todotasks', $connect = null;
		public function __construct() {
			$this->connect = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
			if ($this->connect->connect_error) {
				die('Connection failed: ' . $this->connect->connect_error);
			}
			mysqli_set_charset($connect, 'utf8');
		}
		function disconnect() {
			return $connect = $this->connect;
		}
	}

	class tasks extends database {
		function show_tasks() {
			$result = mysqli_query($this->connect, "SELECT * FROM tasks");
			return $result;
		}
		function create_tasks($name) {
			if(isset($_POST) && isset($_POST['action'])) {
				if($_POST['action'] == 'create') {
					$sql = "INSERT INTO tasks (name) VALUES('" . $name . "')";
					mysqli_query($this->connect, $sql);
					$result = mysqli_query($this->connect, "SELECT * FROM tasks");
					return $result;
				}
			}
		}
		function change_tasks($id, $status) {
			if(isset($_POST) && isset($_POST['action'])) {
				if ($_POST['action'] == 'change' && isset($_POST['id'])) {
					$sql = "UPDATE tasks SET status = '" . $status . "' WHERE id=" . $id;
					mysqli_query($this->connect, $sql);
					$result = mysqli_query($this->connect, "SELECT * FROM tasks");
					return $result;
				}
			}
		}
		function delete_tasks($id) {
			if(isset($_POST) && isset($_POST['action'])) {
				if ($_POST['action'] == 'delete' && isset($_POST['id'])) {
					$sql = "DELETE FROM tasks WHERE id=" . $id;
					mysqli_query($this->connect, $sql);
					$result = mysqli_query($this->connect, "SELECT * FROM tasks");
					return $result;
				}
			}
		}
		function remove_tasks() {
			if(isset($_POST) && isset($_POST['action'])) {
				if ($_POST['action'] == 'remove') {
					$sql = "DELETE FROM tasks WHERE status = 1";
					mysqli_query($this->connect, $sql);
					$result = mysqli_query($this->connect, "SELECT * FROM tasks");
					return $result;
				}
			}
		}
		function filter_tasks($status) {
			$result = mysqli_query($this->connect, "SELECT * FROM tasks WHERE status = " . $status);
			return $result;
		}
	}

	$tasks = new tasks;
	$output = '';
	
	if(isset($_POST) && isset($_POST['action'])) {
		if($_POST['action'] == 'create') {
			$result_create = $tasks->create_tasks($_POST['name']);
			while ($row_create = mysqli_fetch_array($result_create, MYSQLI_ASSOC)) {
				if ($output != '') {
					$output .= ', ';
				}
				$output .= '{"id": "' . $row_create["id"] . '", "name": "' . $row_create["name"] . '", "status": "' . $row_create["status"] . '"}';
			}
			mysqli_free_result($result_create);
			echo ('[' . $output . ']');
		}
		elseif ($_POST['action'] == 'change' && isset($_POST['id'])) {
			$result_change = $tasks->change_tasks($_POST['id'], $_POST['status']);
			while ($row_change = mysqli_fetch_array($result_change, MYSQLI_ASSOC)) {
				if ($output != '') {
					$output .= ', ';
				}
				$output .= '{"id": "' . $row_change["id"] . '", "name": "' . $row_change["name"] . '", "status": "' . $row_change["status"] . '"}';
			}
			mysqli_free_result($result_edit);
			echo ('[' . $output . ']');
		}
		elseif ($_POST['action'] == 'delete' && isset($_POST['id'])) {
			$result_delete = $tasks->delete_tasks($_POST['id']);
			while ($row_delete = mysqli_fetch_array($result_delete, MYSQLI_ASSOC)) {
				if ($output != '') {
					$output .= ', ';
				}
				$output .= '{"id": "' . $row_delete["id"] . '", "name": "' . $row_delete["name"] . '", "status": "' . $row_delete["status"] . '"}';
			}
			mysqli_free_result($result_delete);
			echo ('[' . $output . ']');
		}
		elseif ($_POST['action'] == 'remove') {
			$result_remove = $tasks->remove_tasks();
			while ($row_remove = mysqli_fetch_array($result_remove, MYSQLI_ASSOC)) {
				if ($output != '') {
					$output .= ', ';
				}
				$output .= '{"id": "' . $row_remove["id"] . '", "name": "' . $row_remove["name"] . '", "status": "' . $row_remove["status"] . '"}';
			}
			mysqli_free_result($result_remove);
			echo ('[' . $output . ']');
		}
		elseif ($_POST['action'] == 'filter' && isset($_POST['status'])) {
			$result_filter = $tasks->filter_tasks($_POST['status']);
			while ($row_filter = mysqli_fetch_array($result_filter, MYSQLI_ASSOC)) {
				if ($output != '') {
					$output .= ', ';
				}
				$output .= '{"id": "' . $row_filter["id"] . '", "name": "' . $row_filter["name"] . '", "status": "' . $row_filter["status"] . '"}';
			}
			mysqli_free_result($result_filter);
			echo ('[' . $output . ']');
		}
	}
	else {
		$result_show = $tasks->show_tasks();
		while ($row_show = mysqli_fetch_array($result_show, MYSQLI_ASSOC)) {
			if ($output != '') {
				$output .= ', ';
			}
			$output .= '{"id": "' . $row_show["id"] . '", "name": "' . $row_show["name"] . '", "status": "' . $row_show["status"] . '"}';
		}
		mysqli_free_result($result_show);
		echo ('[' . $output . ']');
	}

	$connect = new database;
	$disconnect = $connect->disconnect();
	mysqli_close($disconnect);
?>
