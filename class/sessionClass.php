<?php

	class Session {

		public function getLogin($usr, $pass) {
			require_once("../connection.php");

			$sql = "select * from tbl_HRMSTool_Users where username = '" . $usr . "'";
			$result = sqlsrv_query($conn, $sql);
			
			if ($result) {
				$numrows = sqlsrv_has_rows($result);
				if ($numrows) {
					while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
						if ($usr == $row["username"] && $pass != $row["password"]) {
							return "1";
						} else if ($usr == $row["username"] && $pass == $row["password"]) {
							return $row["first_name"] . " " . substr($row["middle_name"], 0, 1) . ". " . $row["last_name"];
						}
					}
					// if (sqlsrv_num_rows($result) > 0) {
					// 	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
					// 		if ($usr == $row["username"] && $pass != $row["password"]) {
					// 			return "1";
					// 		} else if ($usr == $row["username"] && $pass == $row["password"]) {
					// 			return $row["first_name"] . " " . substr($row["middle_name"], 0, 1) . ". " . $row["last_name"];
					// 		}
					// 	}
					// 	return var_dump($result);
					// } else {
					// 	return var_dump(sqlsrv_num_rows($result));
					// }
				} else {
					return "2";
				}
			} else {
				die( print_r( sqlsrv_errors(), true) );
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close( $conn);
		}

		public function register($myData) {
			// return json_encode($myData);
			require_once("../connection.php");

			$sql = "select * from tbl_HRMSTool_Users where username = '" . get_current_user() . "';";
			$result = sqlsrv_query($conn, $sql);

			if ($result !== false) {
				if (sqlsrv_num_rows($result) > 0) {
					return "User already exists!";
				} else {
					$sql = "insert into tbl_HRMSTool_Users (username, password, first_name, middle_name, last_name, email) values (?, ?, ?, ?, ?, ?)";

					$values = array(get_current_user(), $myData[4], $myData[0], $myData[1], $myData[2], $myData[3]);
					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						sqlsrv_free_stmt($result);
						sqlsrv_close( $conn);
						die( print_r( sqlsrv_errors(), true) );
					} else {
						sqlsrv_free_stmt($result);
						sqlsrv_close( $conn);
						return "1";
					}
				}
			} else {
				sqlsrv_free_stmt($result);
				sqlsrv_close( $conn);
				die( print_r( sqlsrv_errors(), true) );
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close( $conn);
		}

	}

	if (isset($_POST['action'])){
		if ($_POST['action'] == 'login') {
			$usr = $_POST['user'];
			$pass = $_POST['pass'];

			$session = new Session();

			echo $session->getLogin($usr, $pass);
		} else if ($_POST['action'] == 'register') {
			$myData = $_POST['myData'];

			$session = new Session();

			echo $session->register($myData);
		}
	} else {
		// $usr = "admin";
		// $pass = "admin";

		$session = new Session();

		echo $session->getLogin('orculloj', 'joemorcullo');
	}	
	
?>