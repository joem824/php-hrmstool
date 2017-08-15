<?php
	class Users {

		public function getUsers($empId) {
			require_once("../connection.php");

			if ($empId != "") {
				$sql = "select * from tbl_HRMS_EmployeeMaster where accesslevel is not null and BusinessSegment = 'Mortgage Services' and EmpId = '$empId' order by empname";
			} else {
				$sql = "select * from tbl_HRMS_EmployeeMaster where accesslevel is not null and BusinessSegment = 'Mortgage Services' order by empname";
			}
			$result = sqlsrv_query($conn, $sql);

			$myArr = array();
			if ($result !== false) {
				while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
				    $myArr[] = array("ID" => $row["ID"],
									"EmpID" => $row["EmpID"],
									"NTID" => $row["NTID"],
									"EmpName" => $row["EmpName"],
									"EmpLevel" => $row["EmpLevel"],
									"LeaveBal" => number_format($row["LeaveBal"], 1, ".", "."),
									"LeaveBalCTO" => number_format($row["LeaveBalCTO"], 1, ".", "."),
									"JobDesc" => $row["JobDesc"],
									"DeptCode" => $row["DeptCode"],
									"DeptName" => $row["DeptName"],
									"MngrID" => $row["MngrID"],
									"MngrName" => $row["MngrName"],
									"MngrNTID" => $row["MngrNTID"],
									"BusinessUnit" => $row["BusinessUnit"],
									"BusinessUnitHead" => $row["BusinessUnitHead"],
									"AccessLevel" => $row["AccessLevel"]);
				}
			} else {
				die( print_r( sqlsrv_errors(), true) );
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close( $conn);
			
			return json_encode($myArr);

		}

		public function getIS() {
			require_once("../connection.php");

			$sql = "select NTID, EmpName from tbl_HRMS_EmployeeMaster where accesslevel is not null and BusinessSegment = 'Mortgage Services' and EmpLevel <> 'EE' order by empname";

			$result = sqlsrv_query($conn, $sql);

			$myArr = array();
			if ($result !== false) {
				while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
				    $myArr[] = array("NTID" => $row["NTID"],
									"EmpName" => $row["EmpName"]);
				}
			} else {
				die( print_r( sqlsrv_errors(), true) );
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close( $conn);
			
			return json_encode($myArr);

		}

		public function addUser($myData, $user) {
			require_once("../connection.php");

			include("auditClass.php");

			$audit = new Audit();

			echo $audit->auditTrail('add', $user, $myData, 'New Entry', 'master');

			$empid = $myData[0];
			$ntid = $myData[1];
			$ln = $myData[2];
			$fn = $myData[3];
			$mn = $myData[4];
			$empname = $ln . "," . $fn . " " . $mn;
			$gender = $myData[5];
			$datejoined = $myData[6];
			$emplvl = $myData[7];
			$jobdesc = $myData[8];
			$deptcode = "(select DeptCode from tbl_HRMS_EmployeeMaster where EmpName = '" . $myData[9] . "')";
			$deptname = "(select DeptName from tbl_HRMS_EmployeeMaster where EmpName = '" . $myData[9] . "')";
			$mngrid = "(select EmpID from tbl_HRMS_EmployeeMaster where EmpName = '" . $myData[9] . "')";
			$mngrntid = "(select NTID from tbl_HRMS_EmployeeMaster where EmpName = '" . $myData[9] . "')";
			$mngrname = $myData[9];
			$bu = "(select BusinessUnit from tbl_HRMS_EmployeeMaster where EmpName = '" . $myData[9] . "')";
			$buhead = "(select BusinessUnitHead from tbl_HRMS_EmployeeMaster where EmpName = '" . $myData[9] . "')";
			$bs = "(select BusinessSegment from tbl_HRMS_EmployeeMaster where EmpName = '" . $myData[9] . "')";
			$accesslvl = "CASE WHEN '" . $myData[7] . "' = 'EE' THEN '1' WHEN '" . $myData[7] . "' = 'TL' THEN '2' WHEN '" . $myData[7] . "' IN ('AM','MGR','SR. MGR') THEN '3' WHEN '" . $myData[7] . "' = 'DIR' THEN '6' END";

			$sql = "insert into tbl_HRMS_EmployeeMaster (EmpID, NTID, EmpName, Gender, DateJoined, EmpLevel, JobDesc, ";
			$sql .= "DeptCode, DeptName, MngrID, MngrNTID, MngrName, BusinessUnit, BusinessUnitHead, BusinessSegment, AccessLevel, First_Name, Middle_Name, Last_Name) values ";
			$sql .= "('" . $empid . "', '" . $ntid . "', '" . $empname . "', '" . $gender . "', '" . $datejoined . "', '" . $emplvl . "', '" . $jobdesc . "',";
			$sql .= $deptcode . "," . $deptname . "," . $mngrid . "," . $mngrntid . ",'" . $mngrname . "'," . $bu . "," . $buhead . "," . $bs . "," . $accesslvl . ",'" . $fn . "', '" . $mn . "', '" . $ln . "')";

			$result = sqlsrv_query($conn, $sql);

			if (!$result) {
				sqlsrv_free_stmt($result);
				sqlsrv_close( $conn);
				die( print_r( sqlsrv_errors(), true) );
			} else {
				sqlsrv_free_stmt($result);
				sqlsrv_close( $conn);
				return "Record Added successfully!";
			}
		}

		public function deleteUser($myData) {
			require_once("../connection.php");

			include("auditClass.php");

			$audit = new Audit();

			echo $audit->auditTrail('delete', $myData[1], $myData[0], 'Removed Access', 'master');

			$sql = "update tbl_HRMS_EmployeeMaster set AccessLevel = null where EmpID = ?";

			$values = array($myData[0]);
			$result = sqlsrv_query($conn, $sql, $values);

			if (!$result) {
				sqlsrv_free_stmt($result);
				sqlsrv_close( $conn);
				die( print_r( sqlsrv_errors(), true) );
			} else {
				sqlsrv_free_stmt($result);
				sqlsrv_close( $conn);
				return "Record deleted successfully!";
			}
		}

		public function editUser($myData) {
			require_once("../connection.php");

			include("auditClass.php");

			$audit = new Audit();

			echo $audit->auditTrail('update', $myData[15], $myData, $myData[14], 'master');

			$sql = "update tbl_HRMS_EmployeeMaster set EmpID = ?, NTID = ?, EmpName = ?, EmpLevel = ?, LeaveBal = ?, LeaveBalCTO = ?, JobDesc = ?, DeptCode = ?, DeptName = ?, MngrID = ?, MngrNTID = ?, MngrName = ?, BusinessUnit = ?, BusinessUnitHead = ? where EmpID = ?";

			$values = array($myData[0], $myData[1], $myData[2], $myData[3], $myData[4], $myData[5], $myData[6], $myData[7], $myData[8], $myData[9], $myData[10], $myData[11], $myData[12], $myData[13], $myData[0]);
			$result = sqlsrv_query($conn, $sql, $values);

			if (!$result) {
				
				die( print_r( sqlsrv_errors(), true) );
			} else {
				sqlsrv_free_stmt($result);
				sqlsrv_close( $conn);

				return "Record updated successfully!";
			}
		}
	}

	if (isset($_POST["action"])) {
		if ($_POST["action"] == "getUsers") {

			if (isset($_POST["empId"])) {
				$users = new Users();

				echo $users->getUsers($_POST["empId"]);
			} else {
				$users = new Users();

				echo $users->getUsers('');
			}

		} 
		else if ($_POST["action"] == "getIS") {
			$users = new Users();

			echo $users->getIS();
		}
		else if ($_POST["action"] == "addUser") {
			$users = new Users();

			echo $users->addUser($_POST["myData"], $_POST["user"]);
		}
		else if ($_POST["action"] == "deleteUser") {
			$users = new Users();

			echo $users->deleteUser($_POST["myData"]);
		} else if ($_POST["action"] == "editUser") {
			$users = new Users();

			echo $users->editUser($_POST["myData"]);
		} 
	} 
?>