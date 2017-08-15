<?php

	class Roster {

		public function getEmp() {
			require_once("../connection.php");
			
			$sql = "select * from tbl_HRMS_EmployeeMaster where AccessLevel is not null order by EmpName";
			$result = sqlsrv_query($conn, $sql);
			
			$myArr = array();

			if ($result != false) {
				while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
					$myArr[] = array("NTID"=>$row["NTID"], "EmpName"=>$row["EmpName"]);
				}
			} else {
				die(print_r(sqlsrv_error(), true));
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);

			return json_encode($myArr);
		}

		public function getIS() {
			require_once("../connection.php");

			$sql = "select * from tbl_HRMS_EmployeeMaster where EmpLevel <> 'EE' and AccessLevel is not null order by EmpName";
			$result = sqlsrv_query($conn, $sql);

			$myArr = array();
			if ($result != false) {
				while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
					$myArr[] = array("NTID"=>$row["NTID"], "EmpName"=>$row["EmpName"]);
				}
			} else {
				die(print_r(sqlsrv_error(), true));
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);

			return json_encode($myArr);
		}

		public function getDetails($myData) {
			require_once("../connection.php");

			if (count($myData) > 1) {
				$sql = "select a.EmpID, a.NTID, a.EmpName, a.MngrID, a.MngrNTID, a.MngrName, [IS].EmpID [IsEmpID], [IS].NTID [IsNTID], [IS].EmpName [IsEmpName] from tbl_HRMS_EmployeeMaster a outer apply (select EmpID, NTID, EmpName from tbl_HRMS_EmployeeMaster where NTID = '" . $myData[1] . "') [IS] where a.NTID = '" . $myData[0] . "'";

				$result = sqlsrv_query($conn, $sql);

				$myArr = array();
				if ($result != false) {
					while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
						$myArr[] = array("EmpID"=>$row["EmpID"],
										 "NTID"=>$row["NTID"],
										 "EmpName"=>$row["EmpName"],
										 "MngrID"=>$row["MngrID"],
										 "MngrNTID"=>$row["MngrNTID"],
										 "MngrName"=>$row["MngrName"],
										 "IsEmpID"=>$row["IsEmpID"],
										 "IsNTID"=>$row["IsNTID"],
										 "IsEmpName"=>$row["IsEmpName"]);
					}
				} else {
					die(print_r(sqlsrv_error(), true));
				}
			} else {
				$sql = "select a.EmpID, a.NTID, a.EmpName from tbl_HRMS_EmployeeMaster a  where a.NTID = '" . $myData[0] . "'";
				$result = sqlsrv_query($conn, $sql);

				$myArr = array();
				if ($result != false) {
					while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
						$myArr[] = array("EmpID"=>$row["EmpID"],
										 "NTID"=>$row["NTID"],
										 "EmpName"=>$row["EmpName"]);
					}
				} else {
					die(print_r(sqlsrv_error(), true));
				}
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);

			return json_encode($myArr);
		}

		public function editRoster($myData) {
			require_once("../connection.php");

			include("auditClass.php");

			$audit = new Audit();

			echo $audit->auditTrail('update', $myData[10], $myData, $myData[9], 'master');

			$sql = "select DeptCode, DeptName, BusinessUnit, BusinessUnitHead from tbl_HRMS_EmployeeMaster where NTID = '" . $myData[7] . "' and AccessLevel is not null";

			$result = sqlsrv_query($conn, $sql);

			$deptCode = $deptName = $bu = $buhead = "";
			if ($result != false) {
				while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
					$deptCode = $row["DeptCode"];
					$deptName = $row["DeptName"];
					$bu = $row["BusinessUnit"];
					$buhead = $row["BusinessUnitHead"];
				}
			} else {
				die(print_r(sqlsrv_error(), true));
			}

			// sqlsrv_free_stmt($result);
			// sqlsrv_close($conn);

			$sql = "update tbl_HRMS_EmployeeMaster set MngrID = ?, MngrNTID = ?, MngrName = ?, DeptCode = ?, DeptName = ?, BusinessUnit = ?, BusinessUnitHead = ? where EmpID = ? and AccessLevel is not null";

			$values = array($myData[6],$myData[7],$myData[8],$deptCode, $deptName, $bu, $buhead, $myData[0]);
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

		if ($_POST["action"] == "getEmp") {
			$roster = new Roster();

			echo $roster->getEmp();
		} else if ($_POST["action"] == "getIS") {
			$roster = new Roster();

			echo $roster->getIS();
		} else if ($_POST["action"] == "getDetails") {
			$roster = new Roster();

			echo $roster->getDetails($_POST["myData"]);
		} else if ($_POST["action"] == "editRoster") {
			$roster = new Roster();

			echo $roster->editRoster($_POST["myData"]);
		}

	} else {
		$roster = new Roster();

		echo $roster->getEmp();
	}
?>