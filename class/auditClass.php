<?php
	class Audit {

		public function auditTrail($event, $usr, $myData, $remarks, $table) {

			include("../connection.php");

			if ($event == "add") {
				if ($table == "master") {

					$strData = implode(",", $myData);

					$date = date('Y-m-d H:i:s');

					$sql = "insert into tbl_HRMSTool_Audit (ntid, date, new_data, remarks) values(?, ?, ?, ?)";

					$values = array($usr, $date, $strData, $remarks);
					
					// return $sql . " - " . json_encode($values);

					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						die( print_r( sqlsrv_errors(), true) );
					}

				} elseif ($table == "schedule") {

				} elseif ($table == "activity") {
					
				}
			} elseif ($event == "delete") {
				if ($table == "master") {
					$sql = "select AccessLevel from tbl_HRMS_EmployeeMaster where AccessLevel is not null and EmpID = '" . $myData . "'";

					$result = sqlsrv_query($conn, $sql);
					$prevData = "";
					if ($result) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
							$prevData = $row["AccessLevel"];
						}
					} else {
						die(print_r(sqlsrv_errors(), true));
					}

					$date = date('Y-m-d H:i:s');

					$sql = "insert into tbl_HRMSTool_Audit (ntid, date, prev_data, new_data, remarks) values(?, ?, ?, ?, ?)";

					$values = array($usr, $date, $prevData, "0", $remarks);
					
					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						die( print_r( sqlsrv_errors(), true) );
					}

				} elseif ($table == "schedule") {

					$seriesid = implode(",", $myData);

					$sql = "select SeriesId, LoginID, SchedDate, SchedType, SchedIN, SchedOUT, Break1, Lunch, Break2, UploadedBy, DateUploaded, EditedBy, DateEdited from tbl_HRMS_Employee_Schedule where SeriesId in (" . $seriesid . ") ";

					$result = sqlsrv_query($conn, $sql);
					$myArr = array();
					if ($result) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

							$seriesid = is_null($row["SeriesId"]) ? "NULL" : $row["SeriesId"];
							$loginid = is_null($row["LoginID"]) ? "NULL" : $row["LoginID"];
							$scheddate = is_null($row["SchedDate"]) ? "NULL" : date_format($row["SchedDate"], "m/d/Y");
							$schedtype = is_null($row["SchedType"]) ? "NULL" : $row["SchedType"];
							$schedin = is_null($row["SchedIN"]) ? "NULL" : date_format($row["SchedIN"], "m/d/Y H:i:s");
							$schedout = is_null($row["SchedOUT"]) ? "NULL" : date_format($row["SchedOUT"], "m/d/Y H:i:s");
							$break1 = is_null($row["Break1"]) ? "NULL" : date_format($row["Break1"], "m/d/Y H:i:s");
							$lunch = is_null($row["Lunch"]) ? "NULL" : date_format($row["Lunch"], "m/d/Y H:i:s");
							$break2 = is_null($row["Break2"]) ? "NULL" : date_format($row["Break2"], "m/d/Y H:i:s");
							$uploadedby = is_null($row["UploadedBy"]) ? "NULL" : trim($row["UploadedBy"]);
							$dateupload = is_null($row["DateUploaded"]) ? "NULL" : date_format($row["DateUploaded"], "m/d/Y H:i:s");
							$editedby = is_null($row["EditedBy"]) ? "NULL" : trim($row["EditedBy"]);
							$dateedit = is_null($row["DateEdited"]) ? "NULL" : date_format($row["DateEdited"], "m/d/Y H:i:s");

							$myArr[] = array("SeriesId" => $seriesid,
											"LoginID" => $loginid,
											"SchedDate" => $scheddate,
											"SchedType" => $schedtype,
											"SchedIN" => $schedin,
											"SchedOUT" => $schedout,
											"Break1" => $break1,
											"Lunch" => $lunch,
											"Break2" => $break2,
											"UploadedBy" => $uploadedby,
											"DateUploaded" => $dateupload,
											"EditedBy" => $editedby,
											"DateEdited" => $dateedit
											);
						}
					} else {
						die(print_r(sqlsrv_errors(), true));
					}

					$strArr = "";
					foreach ($myArr as $key => $value) {
						$strArr .= implode(",", $value) . ",";
					}				

					$strData = implode(",", $myData);

					$date = date('Y-m-d H:i:s');

					$sql = "insert into tbl_HRMSTool_Audit (ntid, date, prev_data, new_data, remarks) values(?, ?, ?, ?, ?)";

					$values = array($usr, $date, $strArr, $strData, $remarks);
					
					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						die( print_r( sqlsrv_errors(), true) );
					} else {
						// echo $strArr;
					}

				} elseif ($table == "activity") {
					$seriesid = implode(",", $myData);

					$sql = "select * from tbl_HRMS_Employee_Activity where SeriesId in (" . $seriesid . ") ";

					$result = sqlsrv_query($conn, $sql);
					$myArr = array();
					if ($result) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

							$seriesid = is_null($row["SeriesID"]) ? "NULL" : $row["SeriesID"];
							$loginid = is_null($row["LoginID"]) ? "NULL" : trim($row["LoginID"]);
							$starttime = is_null($row["Start_Time"]) ? "NULL" : date_format($row["Start_Time"], "m/d/Y H:i:s A");
							$endtime = is_null($row["End_Time"]) ? "NULL" : date_format($row["End_Time"], "m/d/Y H:i:s A");
							$reasonid = is_null($row["ReasonID"]) ? "NULL" : $row["ReasonID"];
							$scheddate = is_null($row["SchedDate"]) ? "NULL" : date_format($row["SchedDate"], "m/d/Y");
							$ispaid = is_null($row["IsPaid"]) ? "NULL" : trim($row["IsPaid"]);
							$totaltimemin = is_null($row["TotalTimeMin"]) ? "NULL" : $row["TotalTimeMin"];
							$totaltimehour = is_null($row["TotalTimeHour"]) ? "NULL" : $row["TotalTimeHour"];
							$approvedtime = is_null($row["Approved_Time"]) ? "NULL" : date_format($row["Approved_Time"], "m/d/Y H:i:s A");
							$activitystatus = is_null($row["Activity_Status"]) ? "NULL" : trim($row["Activity_Status"]);
							$activitytag = is_null($row["Activity_Tag"]) ? "NULL" : trim($row["Activity_Tag"]);
							$seriesadjusted = is_null($row["Series_Adjusted"]) ? "NULL" : $row["Series_Adjusted"];
							$addedby = is_null($row["AddedBy"]) ? "NULL" : trim($row["AddedBy"]);
							$dateadded = is_null($row["DateAdded"]) ? "NULL" : date_format($row["DateAdded"], "m/d/Y H:i:s A");
							$reason = is_null($row["Reason"]) ? "NULL" : trim($row["Reason"]);
							$approvedby = is_null($row["ApprovedBy"]) ? "NULL" : trim($row["ApprovedBy"]);
							$eeapproval = is_null($row["EEApproval"]) ? "NULL" : trim($row["EEApproval"]);
							$eeapprovaldate = is_null($row["EEApprovalDate"]) ? "NULL" : date_format($row["EEApprovalDate"], "m/d/Y H:i:s A");
							$sortkey = is_null($row["EEApproval"]) ? "NULL" : $row["SortKey"];

							$myArr[] = array("SeriesID" => $seriesid,
											"LoginID" => $loginid,
											"Start_Time" => $starttime,
											"End_Time" => $endtime,
											"ReasonID" => $reasonid,
											"SchedDate" => $scheddate,
											"IsPaid" => $ispaid,
											"TotalTimeMin" => $totaltimemin,
											"TotalTimeHour" => $totaltimehour,
											"Approved_Time" => $approvedtime,
											"Activity_Status" => $activitystatus,
											"Activity_Tag" => $activitytag,
											"Series_Adjusted" => $seriesadjusted,
											"AddedBy" => $addedby,
											"DateAdded" => $dateadded,
											"Reason" => $reason,
											"ApprovedBy" => $approvedby,
											"EEApproval" => $eeapproval,
											"EEApprovalDate" => $eeapprovaldate,
											"SortKey" => $sortkey
											);
						}
					} else {
						die(print_r(sqlsrv_errors(), true));
					}

					$strArr = "";
					foreach ($myArr as $key => $value) {
						$strArr .= implode(",", $value) . ",";
					}				

					$strData = implode(",", $myData);

					$date = date('Y-m-d H:i:s');

					$sql = "insert into tbl_HRMSTool_Audit (ntid, date, prev_data, new_data, remarks) values(?, ?, ?, ?, ?)";

					$values = array($usr, $date, $strArr, $strData, $remarks);
					
					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						die( print_r( sqlsrv_errors(), true) );
					} else {
						// echo $strArr;
						// echo print_r(array_values($myArr));
					}
				}
			} elseif ($event == "update") {
				if ($table == "master") {
					
					$sql = "select EmpID, NTID, EmpName, EmpLevel, LeaveBal, LeaveBalCTO, JobDesc, DeptCode, DeptName, MngrID, MngrNTID, MngrName, BusinessUnit, BusinessUnitHead from tbl_HRMS_EmployeeMaster where AccessLevel is not null and EmpID = '" . $myData[0] . "'";

					$result = sqlsrv_query($conn, $sql);
					$myArr = array();
					if ($result) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
							$myArr[] = array("EmpID" => $row["EmpID"],
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
										"BusinessUnitHead" => $row["BusinessUnitHead"]);
						}
					} else {
						die(print_r(sqlsrv_errors(), true));
					}		

					$strArr = "";
					foreach ($myArr as $key => $value) {
						$strArr = implode(",", $value);
					}

					$strData = implode(",", $myData);

					$date = date('Y-m-d H:i:s');

					$sql = "insert into tbl_HRMSTool_Audit (ntid, date, prev_data, new_data, remarks) values(?, ?, ?, ?, ?)";

					$values = array($usr, $date, $strArr, $strData, $remarks);
					
					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						die( print_r( sqlsrv_errors(), true) );
					}
					
					// return "Insert Successful!";
				} elseif ($table == "schedule") {
					$sql = "select SeriesID, LoginID, SchedDate, SchedIN, SchedOUT, Break1, Lunch, Break2, SchedType, UploadedBy, DateUploaded, EditedBy, DateEdited from tbl_HRMS_Employee_Schedule where SeriesId = " . $myData[0];

					$result = sqlsrv_query($conn, $sql);
					$myArr = array();
					if ($result) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

							$seriesid = is_null($row["SeriesID"]) ? "NULL" : $row["SeriesID"];
							$loginid = is_null($row["LoginID"]) ? "NULL" : trim($row["LoginID"]);
							$scheddate = is_null($row["SchedDate"]) ? "NULL" : date_format($row["SchedDate"], "m/d/Y");
							$schedin = is_null($row["SchedIN"]) ? "NULL" : date_format($row["SchedIN"], "m/d/Y h:i:s A");
							$schedout = is_null($row["SchedOUT"]) ? "NULL" : date_format($row["SchedOUT"], "m/d/Y h:i:s A");
							$break1 = is_null($row["Break1"]) ? "NULL" : date_format($row["Break1"], "m/d/Y h:i:s A");
							$lunch = is_null($row["Lunch"]) ? "NULL" : date_format($row["Lunch"], "m/d/Y h:i:s A");
							$break2 = is_null($row["Break2"]) ? "NULL" : date_format($row["Break2"], "m/d/Y h:i:s A");
							$schedtype = is_null($row["SchedType"]) ? "NULL" : $row["SchedType"];
							$uploadedby = is_null($row["UploadedBy"]) ? "NULL" : trim($row["UploadedBy"]);
							$dateuploaded = is_null($row["DateUploaded"]) ? "NULL" : date_format($row["DateUploaded"], "m/d/Y h:i:s A");
							$editedby = is_null($row["EditedBy"]) ? "NULL" : trim($row["EditedBy"]);
							$dateedited = is_null($row["DateEdited"]) ? "NULL" : date_format($row["DateEdited"], "m/d/Y h:i:s A");

							$myArr[] = array("SeriesID" => $seriesid,
											"SchedDate" => $scheddate,
											"SchedIN" => $schedin,
											"SchedOUT" => $schedout,
											"Break1" => $break1,
											"Lunch" => $lunch,
											"Break2" => $break2,
											"SchedType" => $schedtype,
											"UploadedBy" => $uploadedby,
											"DateUploaded" => $dateuploaded,
											"EditedBy" => $editedby,
											"DateEdited" => $dateedited
											);
						}
					} else {
						die(print_r(sqlsrv_errors(), true));
					}		

					$strArr = "";
					foreach ($myArr as $key => $value) {
						$strArr .= implode(",", $value);
					}

					$strData = implode(",", $myData);

					// echo $strData;

					$date = date('Y-m-d H:i:s');

					$sql = "insert into tbl_HRMSTool_Audit (ntid, date, prev_data, new_data, remarks) values(?, ?, ?, ?, ?)";

					$values = array($usr, $date, $strArr, $strData, $remarks);
					
					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						die( print_r( sqlsrv_errors(), true) );
					}
				} elseif ($table == "activity") {
					$sql = "select * from tbl_HRMS_Employee_Activity where SeriesId = " . $myData[0];

					$result = sqlsrv_query($conn, $sql);
					$myArr = array();
					if ($result) {
						while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

							$seriesid = is_null($row["SeriesID"]) ? "NULL" : $row["SeriesID"];
							$loginid = is_null($row["LoginID"]) ? "NULL" : trim($row["LoginID"]);
							$starttime = is_null($row["Start_Time"]) ? "NULL" : date_format($row["Start_Time"], "m/d/Y H:i:s A");
							$endtime = is_null($row["End_Time"]) ? "NULL" : date_format($row["End_Time"], "m/d/Y H:i:s A");
							$reasonid = is_null($row["ReasonID"]) ? "NULL" : $row["ReasonID"];
							$scheddate = is_null($row["SchedDate"]) ? "NULL" : date_format($row["SchedDate"], "m/d/Y");
							$ispaid = is_null($row["IsPaid"]) ? "NULL" : trim($row["IsPaid"]);
							$totaltimemin = is_null($row["TotalTimeMin"]) ? "NULL" : $row["TotalTimeMin"];
							$totaltimehour = is_null($row["TotalTimeHour"]) ? "NULL" : $row["TotalTimeHour"];
							$approvedtime = is_null($row["Approved_Time"]) ? "NULL" : date_format($row["Approved_Time"], "m/d/Y H:i:s A");
							$activitystatus = is_null($row["Activity_Status"]) ? "NULL" : trim($row["Activity_Status"]);
							$activitytag = is_null($row["Activity_Tag"]) ? "NULL" : trim($row["Activity_Tag"]);
							$seriesadjusted = is_null($row["Series_Adjusted"]) ? "NULL" : $row["Series_Adjusted"];
							$addedby = is_null($row["AddedBy"]) ? "NULL" : trim($row["AddedBy"]);
							$dateadded = is_null($row["DateAdded"]) ? "NULL" : date_format($row["DateAdded"], "m/d/Y H:i:s A");
							$reason = is_null($row["Reason"]) ? "NULL" : trim($row["Reason"]);
							$approvedby = is_null($row["ApprovedBy"]) ? "NULL" : trim($row["ApprovedBy"]);
							$eeapproval = is_null($row["EEApproval"]) ? "NULL" : trim($row["EEApproval"]);
							$eeapprovaldate = is_null($row["EEApprovalDate"]) ? "NULL" : date_format($row["EEApprovalDate"], "m/d/Y H:i:s A");
							$sortkey = is_null($row["EEApproval"]) ? "NULL" : $row["SortKey"];

							$myArr[] = array("SeriesID" => $seriesid,
											"LoginID" => $loginid,
											"Start_Time" => $starttime,
											"End_Time" => $endtime,
											"ReasonID" => $reasonid,
											"SchedDate" => $scheddate,
											"IsPaid" => $ispaid,
											"TotalTimeMin" => $totaltimemin,
											"TotalTimeHour" => $totaltimehour,
											"Approved_Time" => $approvedtime,
											"Activity_Status" => $activitystatus,
											"Activity_Tag" => $activitytag,
											"Series_Adjusted" => $seriesadjusted,
											"AddedBy" => $addedby,
											"DateAdded" => $dateadded,
											"Reason" => $reason,
											"ApprovedBy" => $approvedby,
											"EEApproval" => $eeapproval,
											"EEApprovalDate" => $eeapprovaldate,
											"SortKey" => $sortkey
											);
						}
					} else {
						die(print_r(sqlsrv_errors(), true));
					}

					$strArr = "";
					foreach ($myArr as $key => $value) {
						$strArr .= implode(",", $value);
					}

					$strData = implode(",", $myData);

					$date = date('Y-m-d H:i:s');

					$sql = "insert into tbl_HRMSTool_Audit (ntid, date, prev_data, new_data, remarks) values(?, ?, ?, ?, ?)";

					$values = array($usr, $date, $strArr, $strData, $remarks);
					
					$result = sqlsrv_query($conn, $sql, $values);

					if (!$result) {
						die( print_r( sqlsrv_errors(), true) );
					}
				}
			}
		}
	}

	// $myData = array("364594", "05-03-2017", "IN", "05/03/2017 9:00AM", "05/03/2017 6:00PM", "--", "--", "--");

	// $audit = new Audit();

	// echo $audit->auditTrail('update', get_current_user(), $myData, 'REMARKS', 'schedule');
	
?>