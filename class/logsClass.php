<?php
	class Logs {

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

		public function getLogs($myData) {
			require_once("../connection.php");

			$sql = "select a.EmpName, CONVERT(varchar, b.SchedDate, 107) [SchedDate], b.SchedType, CONVERT(varchar, b.SchedIN, 100) [SchedIn], CONVERT(varchar, b.SchedOUT, 100) [SchedOut], CONVERT(varchar, c.Start_Time, 100) [Start_Time], CONVERT(varchar, c.End_Time, 100) [End_Time], d.ReasonDesc from tbl_HRMS_EmployeeMaster a join tbl_HRMS_Employee_Schedule b on a.NTID = b.LoginID join tbl_HRMS_Employee_Activity c on a.NTID = c.LoginID and b.SchedDate = c.SchedDate join tbl_HRMS_PAY_Reason d on c.ReasonID = d.ReasonID where a.NTID = '" . $myData[0] . "' and b.SchedDate between '" . $myData[1] . "' and '" . $myData[2] . "' order by a.EmpName, b.SchedDate, CAST(Left(c.Start_Time,20) as datetime), c.SeriesID";

			$result = sqlsrv_query($conn, $sql);

			$myArr = array();
			if ($result != false) {
				while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
					$myArr[] = array("EmpName" => $row["EmpName"], 
									"SchedDate" => $row["SchedDate"],
									"SchedType" => $row["SchedType"],
									"SchedIn" => $row["SchedIn"],
									"SchedOut" => $row["SchedOut"],
									"Start_Time" => $row["Start_Time"],
									"End_Time" => $row["End_Time"],
									"ReasonDesc" => $row["ReasonDesc"]);
				}
			} else {
				die(print_r(sqlsrv_error(), true));
			}

			sqlsrv_free_stmt($result);
			sqlsrv_close($conn);

			return json_encode($myArr);
		}

		public function getDisputes($myData) {
			require_once("../connection.php");

			$where = "";

			if ($myData[0] == "read") {
				$sql = "select SeriesID, CONVERT(varchar, SchedDate, 101) [SchedDate], CONVERT(varchar, CAST(SchedIN as date), 101) + '   ' + CONVERT(varchar, CAST(SchedIN as time), 100) [SchedIN], CONVERT(varchar, CAST(SchedOUT as date), 101) + '   ' + CONVERT(varchar, CAST(SchedOUT as time), 100) [SchedOUT], CONVERT(varchar, CAST(Break1 as date), 101) + '   ' + CONVERT(varchar, CAST(Break1 as time), 100) [Break1], CONVERT(varchar, CAST(Lunch as date), 101) + '   ' + CONVERT(varchar, CAST(Lunch as time), 100) [Lunch], CONVERT(varchar, CAST(Break2 as date), 101) + '   ' + CONVERT(varchar, CAST(Break2 as time), 100) [Break2], CASE WHEN b.LeaveDate is not null THEN (CASE WHEN b.isHalfDay = 1 THEN LTRIM(RTRIM(b.LeaveType)) + ' - Half Day' ELSE LTRIM(RTRIM(b.LeaveType)) END) ELSE SchedType END [SchedType], UploadedBy, CONVERT(varchar, CAST(DateUploaded as date), 101) + '   ' + CONVERT(varchar, CAST(DateUploaded as time), 100) [DateUploaded], EditedBy, CONVERT(varchar, CAST(DateEdited as date), 101) + '   ' + CONVERT(varchar, CAST(DateEdited as time), 100) [DateEdited] from tbl_HRMS_Employee_Schedule a outer apply (select * from tbl_HRMS_LeaveMaster where EmpID = a.LoginID and LeaveDate = a.SchedDate) b where LoginID = '" . $myData[1] . "' and SchedDate between '" . $myData[2] . "' and '" . $myData[3] . "' order by SchedDate;";

				$result = sqlsrv_query($conn, $sql);

				$myArr1 = array();
				if ($result != false) {
					while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
						$myArr1[] = array("SeriesID"=>$row["SeriesID"],
										"SchedDate"=>$row["SchedDate"], 
										"SchedType"=>$row["SchedType"],
										"SchedIN"=>$row["SchedIN"],
										"SchedOUT"=>$row["SchedOUT"],
										"Break1"=>$row["Break1"],
										"Lunch"=>$row["Lunch"],
										"Break2"=>$row["Break2"],
										"UploadedBy"=>$row["UploadedBy"],
										"DateUploaded"=>$row["DateUploaded"],
										"EditedBy"=>$row["EditedBy"],
										"DateEdited"=>$row["DateEdited"]);
					}
				} else {
					die(print_r(sqlsrv_error(), true));
				}

				sqlsrv_free_stmt($result);

				$sql = "select SeriesID, CONVERT(varchar, SchedDate, 101) [SchedDate], CONVERT(varchar, CAST(Start_Time as date), 101) + ' ' + CONVERT(varchar, CAST(Start_Time as time), 100) [Start_Time], CONVERT(varchar, CAST(End_Time as date), 101) + ' ' + CONVERT(varchar, CAST(End_Time as time), 100) [End_Time], CASE WHEN CAST(TotalTimeHour as decimal(10,2)) is null THEN 0.0 ELSE CAST(TotalTimeHour as decimal(10,2)) END [TotalTimeHour], ReasonDesc from tbl_HRMS_Employee_Activity a join tbl_HRMS_PAY_Reason b on a.ReasonID = b.ReasonID where LoginID = '" . $myData[1] . "' and SchedDate between '" . $myData[2] . "' and '" . $myData[3] . "' order by CAST(Left(Start_Time,20) as datetime);";

				$result = sqlsrv_query($conn, $sql);

				$myArr2 = array();
				if ($result != false) {
					while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
						$myArr2[] = array("SeriesID"=>$row["SeriesID"],
										"SchedDate"=>$row["SchedDate"],
										"Start_Time"=>$row["Start_Time"],
										"End_Time"=>$row["End_Time"],
										"TotalTimeHour"=>number_format($row["TotalTimeHour"], 2, ".", "."),
										"ReasonDesc"=>$row["ReasonDesc"]);
					}
				} else {
					die(print_r(sqlsrv_error(), true));
				}

				sqlsrv_free_stmt($result);
				sqlsrv_close($conn);

				$json = array();
				$json[] = array($myArr1, $myArr2);

				return json_encode($json);
			} else {
				if ($myData[5] == "Sched") {
					$sql = "select SeriesID, CONVERT(varchar, SchedDate, 101) [SchedDate], CASE WHEN SchedIN is not null THEN CONVERT(varchar, CAST(SchedIN as date), 101) + ' ' + CONVERT(varchar, CAST(SchedIN as time), 100) ELSE '--' END [SchedIN], CASE WHEN SchedOUT is not null THEN CONVERT(varchar, CAST(SchedOUT as date), 101) + ' ' + CONVERT(varchar, CAST(SchedOUT as time), 100) ELSE '--' END [SchedOUT], CASE WHEN Break1 is not null THEN CONVERT(varchar, CAST(Break1 as date), 101) + ' ' + CONVERT(varchar, CAST(Break1 as time), 100) ELSE '--' END [Break1], CASE WHEN Lunch is not null THEN CONVERT(varchar, CAST(Lunch as date), 101) + ' ' + CONVERT(varchar, CAST(Lunch as time), 100) ELSE '--' END [Lunch], CASE WHEN Break2 is not null THEN CONVERT(varchar, CAST(Break2 as date), 101) + ' ' + CONVERT(varchar, CAST(Break2 as time), 100) ELSE '--' END [Break2], CASE WHEN b.LeaveDate is not null THEN (CASE WHEN b.isHalfDay = 1 THEN LTRIM(RTRIM(b.LeaveType)) + ' - Half Day' ELSE LTRIM(RTRIM(b.LeaveType)) END) ELSE SchedType END [SchedType], CASE WHEN UploadedBy is not null THEN UploadedBy ELSE '--' END [UploadedBy], CASE WHEN DateUploaded is not null THEN CONVERT(varchar, CAST(DateUploaded as date), 101) + ' ' + CONVERT(varchar, CAST(DateUploaded as time), 100) ELSE '--' END [DateUploaded], CASE WHEN EditedBy is not null THEN EditedBy ELSE '--' END [EditedBy], CASE WHEN DateEdited is not null THEN CONVERT(varchar, CAST(DateEdited as date), 101) + ' ' + CONVERT(varchar, CAST(DateEdited as time), 100) ELSE '--' END [DateEdited] from tbl_HRMS_Employee_Schedule a outer apply (select * from tbl_HRMS_LeaveMaster where EmpID = a.LoginID and LeaveDate = a.SchedDate) b where LoginID = '" . $myData[1] . "' and SchedDate between '" . $myData[2] . "' and '" . $myData[3] . "' and SeriesID = " . $myData[4] . " order by SchedDate;";

					$result = sqlsrv_query($conn, $sql);

					$myArr1 = array();
					if ($result != false) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
							$myArr1[] = array("SeriesID"=>$row["SeriesID"],
											"SchedDate"=>$row["SchedDate"], 
											"SchedType"=>$row["SchedType"],
											"SchedIN"=>$row["SchedIN"],
											"SchedOUT"=>$row["SchedOUT"],
											"Break1"=>$row["Break1"],
											"Lunch"=>$row["Lunch"],
											"Break2"=>$row["Break2"],
											"UploadedBy"=>$row["UploadedBy"],
											"DateUploaded"=>$row["DateUploaded"],
											"EditedBy"=>$row["EditedBy"],
											"DateEdited"=>$row["DateEdited"]);
						}
					} else {
						die(print_r(sqlsrv_error(), true));
					}

					sqlsrv_free_stmt($result);
					sqlsrv_close($conn);
					// echo $sql;
					return json_encode($myArr1);
				} else {
					$sql = "select SeriesID, CASE WHEN SchedDate is not null THEN CONVERT(varchar, SchedDate, 101) ELSE '--' END [SchedDate], CASE WHEN Start_Time is not null THEN CONVERT(varchar, CAST(Start_Time as date), 101) + ' ' + CONVERT(varchar, CAST(Start_Time as time), 100) ELSE '--' END [Start_Time], CASE WHEN End_Time is not null THEN CONVERT(varchar, CAST(End_Time as date), 101) + ' ' + CONVERT(varchar, CAST(End_Time as time), 100) ELSE '--' END [End_Time], ReasonDesc from tbl_HRMS_Employee_Activity a join tbl_HRMS_PAY_Reason b on a.ReasonID = b.ReasonID where LoginID = '" . $myData[1] . "' and SchedDate between '" . $myData[2] . "' and '" . $myData[3] . "' and SeriesID = " . $myData[4] . " order by CAST(Left(Start_Time,20) as datetime);";

					$result = sqlsrv_query($conn, $sql);

					$myArr2 = array();
					if ($result != false) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
							$myArr2[] = array("SeriesID"=>$row["SeriesID"],
											"SchedDate"=>$row["SchedDate"],
											"Start_Time"=>$row["Start_Time"],
											"End_Time"=>$row["End_Time"],
											"ReasonDesc"=>$row["ReasonDesc"]);
						}
					} else {
						die(print_r(sqlsrv_error(), true));
					}

					sqlsrv_free_stmt($result);
					sqlsrv_close($conn);
					// echo $sql;
					return json_encode($myArr2);
				}
			}
		}

		public function delSched($myData) {
			require_once("../connection.php");

			include("auditClass.php");

			$audit = new Audit();

			echo $audit->auditTrail("delete", $myData[2], $myData[0], "Delete Schedule: " . $myData[1], "schedule");

			$sql = "delete from tbl_HRMS_Employee_Schedule where SeriesID in (" . implode(",", $myData[0]) . ")";
			
			$result = sqlsrv_query($conn, $sql);

			if (!$result) {
				die( print_r( sqlsrv_errors(), true) );
			} else {
				return "Record Deleted!";
			}
		}

		public function delAct($myData) {
			require_once("../connection.php");

			include("auditClass.php");

			$audit = new Audit();

			echo $audit->auditTrail("delete", $myData[2], $myData[0], "Delete Activity: " . $myData[1], "activity");

			$sql = "delete from tbl_HRMS_Employee_Activity where SeriesID in (" . implode(",", $myData[0]) . ")";
			
			$result = sqlsrv_query($conn, $sql);

			if (!$result) {
				die( print_r( sqlsrv_errors(), true) );
			} else {
				return "Record Deleted!";
			}
		}

		public function upDispute($myData) {
			require_once("../connection.php");

			include("auditClass.php");

			$audit = new Audit();

			if ($myData[0] == "sched") {
				// echo json_encode($myData);
				echo $audit->auditTrail("update", $myData[3], $myData[2], "Update Schedule: " . $myData[1], "schedule");

				$scheddate = ($myData[2][1] == "--") ? "NULL" : "'" . $myData[2][1] . "'";
				$schedtype = ($myData[2][2] == "--") ? "NULL" : "'" . $myData[2][2] . "'";
				$schedin = ($myData[2][3] == "--") ? "NULL" : "'" . $myData[2][3] . "'";
				$schedout = ($myData[2][4] == "--") ? "NULL" : "'" . $myData[2][4] . "'";
				$break1 = ($myData[2][5] == "--") ? "NULL" : "'" . $myData[2][5] . "'";
				$lunch = ($myData[2][6] == "--") ? "NULL" : "'" . $myData[2][6] . "'";
				$break2 = ($myData[2][7] == "--") ? "NULL" : "'" . $myData[2][7] . "'";
				

				$sql = "update tbl_HRMS_Employee_Schedule set SchedDate = " . $scheddate . ", SchedIN = " . $schedin . ", SchedOUT = " . $schedout . ", Break1 = " . $break1 . ", Lunch = " . $lunch . ", Break2 = " . $break2 . ", SchedType = " . $schedtype . ", EditedBy = '" . $myData[3] . "', DateEdited = GETDATE() where SeriesID = " . $myData[2][0];

			} else {
				echo $audit->auditTrail("update", $myData[3], $myData[2], "Update Activity: " . $myData[1], "activity");

				$scheddate = ($myData[2][1] == "--") ? "NULL" : "'" . $myData[2][1] . "'";
				$start = ($myData[2][2] == "--") ? "NULL" : "'" . $myData[2][2] . "'";
				$end = ($myData[2][3] == "--") ? "NULL" : "'" . $myData[2][3] . "'";
				$tag = ($myData[2][4] == "--") ? "NULL" : "'" . $myData[2][4] . "'";

				$sql = "update tbl_HRMS_Employee_Activity set SchedDate = " . $scheddate . ", Start_Time = " . $start . ", End_Time = " . $end . ", ReasonID = (Select ReasonID from tbl_HRMS_PAY_Reason where ReasonDesc = " . $tag . "), IsPaid = CASE WHEN (Select ExcludeonPayment from tbl_HRMS_PAY_Reason where ReasonDesc = " . $tag . ") = 'NO' THEN 'YES' ELSE 'NO' END, TotalTimeMin = CASE WHEN (Select ExcludeonPayment from tbl_HRMS_PAY_Reason where ReasonDesc = " . $tag . ") = 'NO' THEN CAST(DATEDIFF(MI, " . $start . ", " . $end . ") as decimal) ELSE NULL END, TotalTimeHour = CASE WHEN (Select ExcludeonPayment from tbl_HRMS_PAY_Reason where ReasonDesc = " . $tag . ") = 'NO' THEN CAST(DATEDIFF(MI, " . $start . ", " . $end . ") as decimal)/60 ELSE NULL END where SeriesID = " . $myData[2][0];
			}

			$result = sqlsrv_query($conn, $sql);

			if (!$result) {
				
				die( print_r( sqlsrv_errors(), true) );
			} else {
				sqlsrv_free_stmt($result);
				sqlsrv_close( $conn);

				return "Record updated successfully!";
			}
		}

		public function addSchedAct($myData, $type, $user) {
			require_once("../connection.php");

			if ($type == "sched") {

				include("auditClass.php");

				$audit = new Audit();

				echo $audit->auditTrail('add', $user, $myData, 'Insert Schedule', 'schedule');

				$sql = "insert into tbl_HRMS_Employee_Schedule (LoginID, SchedDate, SchedIN, SchedOUT, Logout_Tag, SchedType, UploadedBy, DateUploaded) values ";

				foreach ($myData as $key => $value) {
					$loginid = $value["LoginID"];
					$scheddate = $value["SchedDate"];
					$schedin = $value["SchedIN"];
					$schedout = $value["SchedOUT"];
					$schedtype = $value["SchedType"];

					$sql .= "('" . $loginid . "', '" . $scheddate . "', '" . $schedin . "', '" . $schedout . "', 'NO', '" . $schedtype . "', '" . $user . "', GETDATE()),";
				}

				$sql = rtrim($sql, ",");

				$result = sqlsrv_query($conn, $sql);

				if (!$result) {
					
					die( print_r( sqlsrv_errors(), true) );
				} else {
					sqlsrv_free_stmt($result);
					sqlsrv_close( $conn);

					return "Record added successfully!";
				}

			} else if ($type == "act") {

				include("auditClass.php");

				$audit = new Audit();

				echo $audit->auditTrail('add', $user, $myData, 'Insert Schedule', 'schedule');

				$sql = "insert into tbl_HRMS_Employee_Activity (LoginID, SchedDate, Start_Time, End_Time, ReasonID, IsPaid, TotalTimeMin, TotalTimeHour) values ";

				foreach ($myData as $key => $value) {
					$loginid = $value["LoginID"];
					$scheddate = $value["SchedDate"];
					$starttime = $value["StartTime"];
					$endtime = $value["EndTime"];
					$reasonid = $value["Reason"];
					$ispaid = $totaltimemin = $totaltimehour = "";
					if ($value["Reason"] == "2") {
						$ispaid = "'YES'";
						$totaltimemin = "CAST(DATEDIFF(MI, '" . $starttime . "', '" . $endtime . "') as decimal)";
						$totaltimehour = "CAST(DATEDIFF(MI, '" . $starttime . "', '" . $endtime . "') as decimal)/60";
					} else {
						$ispaid = "NULL";
						$totaltimemin = "NULL";
						$totaltimehour = "NULL";
					}
					
					$totaltimemin = 

					$sql .= "('" . $loginid . "', '" . $scheddate . "', '" . $starttime . "', '" . $endtime . "', '" . $reasonid . "', " . $ispaid . ", " . $totaltimemin . ", " . $totaltimehour . "),";
				}

				$sql = rtrim($sql, ",");

				$result = sqlsrv_query($conn, $sql);

				if (!$result) {
					
					die( print_r( sqlsrv_errors(), true) );
				} else {
					sqlsrv_free_stmt($result);
					sqlsrv_close( $conn);

					return "Record added successfully!";
				}
			}
		}
	}

	if (isset($_POST["action"])) {

		if ($_POST["action"] == "getEmp") {
			$logs = new Logs();

			echo $logs->getEmp();
		} else if ($_POST["action"] == "getLogs") {
			$logs = new Logs();

			echo $logs->getLogs($_POST["myData"]);
		} else if ($_POST["action"] == "getDisputes") {
			$logs = new Logs();

			echo $logs->getDisputes($_POST["myData"]);
		} else if ($_POST["action"] == "delSched") {
			$logs = new Logs();

			echo $logs->delSched($_POST["myData"]);
		} else if ($_POST["action"] == "delAct") {
			$logs = new Logs();

			echo $logs->delAct($_POST["myData"]);
		} else if ($_POST["action"] == "updateDispute") {
			$logs = new Logs();

			echo $logs->upDispute($_POST["myData"]);
		} else if ($_POST["action"] == "addSchedAct") {
			$logs = new Logs();

			echo $logs->addSchedAct($_POST["myData"], $_POST["type"], $_POST["user"]);
		}
	} else {
		// $myData = array("devtest", "05-01-2017", "05-05-2017", "read");
		$values = array("787412", "05-03-2017", "05/03/2017 10:00AM", "05/03/2017 10:00AM", "Log-in");
		$myData = array("act", "REMARKS", $values);
		$logs = new Logs();

		echo $logs->upDispute($myData);
	}
?>