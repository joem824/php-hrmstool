<?php
	$server = "dav8dbhsnd01\\";
	$un = "mis414";
	$pw = "juchUt4a";
	$db = "MIS_MLA_UAT";
	$connInfo = array("Database"=>"$db", "UID"=>"$un", "PWD"=>"$pw", "CharacterSet"=>"UTF-8");
	$conn = sqlsrv_connect($server, $connInfo);

	if($conn) {
     	// echo "Connection established.<br />";
	} else {
	    // echo "Connection could not be established.<br />";
	    die( print_r( sqlsrv_errors(), true));
	}
?>