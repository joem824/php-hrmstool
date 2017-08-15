$(document).ready(function () {
	loadUsers();

	$('#btnSave').click(function () {
		var remarks = $('#taRemarks').val();
		var empNum = $('#inEmpNum').val();
		var ntid = $('#inNTID').val();
		var empName = $('#inEmpName').val();
		var empLevel = $('#inEmpLevel').val();
		var leavePTO = $('#inLeavePTO').val();
		var leaveCTO = $('#inLeaveCTO').val();
		var jobDesc = $('#inJobDesc').val();
		var deptCode = $('#inDeptCode').val();
		var deptName = $('#inDeptName').val();
		var mngrID = $('#inMngrID').val();
		var mngrNTID = $('#inMngrNTID').val();
		var mngrName = $('#inMngrName').val();
		var bu = $('#inBU').val();
		var buHead = $('#inBUHead').val();

		var user = $('#lblUser').attr('data-id');

		var myData = [empNum, ntid, empName, empLevel, leavePTO, leaveCTO,
		jobDesc, deptCode, deptName, mngrID, mngrNTID, mngrName, bu, buHead,
		remarks, user];

		if (remarks == '') {
			alert('Please fill up the "Remarks" Field!');
		} else {
			$('#loader').modal({ backdrop: 'static', keyboard: false });
			$.ajax({
				type: 'POST',
				url: 'class/usersClass.php',
				data: {action: 'editUser', myData: myData},
				success: function (data) {
					alert(data);
					$('#modalEdit').modal('hide');

					setTimeout(function () {
			            $('#loader').modal('hide');
			        }, 2000);
			        
					loadUsers();
				},
				error: function (response) {
					console.log(response.responseText);
				}
			});
		}
	});

	$('#btnAdd').click(function () {
		$('#modalAdd').modal({ backdrop: 'static', keyboard: false });

		getIS();

		$('#slctAddIS').select2();
	});

	$('#btnAddUser').click(function () {
		var empid = $('#inAddEmpID').val();
		var ntid = $('#inAddNTID').val();
		var ln = $('#inAddLN').val();
		var fn = $('#inAddFN').val();
		var mn = $('#inAddMN').val();
		var gender = $('#slctAddGender').val();
		var datejoined = $('#inAddDateJoined').val();
		var emplvl = $('#slctAddEmpLvl').val();
		var jd = $('#inAddJD').val();
		var is = $('#slctAddIS').val();

		var user = $('#lblUser').attr('data-id');

		var myData = [empid, ntid, ln, fn, mn, gender, datejoined, emplvl, jd, is];

		$.ajax({
			type: 'POST',
			url: 'class/usersClass.php',
			data: {action: 'addUser', myData: myData, user: user},
			success: function(data) {
				alert(data);

				$('#modalAdd').modal('hide');

				loadUsers();
			},
			error: function(response) {
				console.log(response.responseText);
			}
		});
	});
});

function getIS() {
	$('#loader').modal({ backdrop: 'static', keyboard: false });
	$.ajax({
		type: 'POST',
		url: 'class/usersClass.php',
		data: {action: 'getIS'},
		dataType: 'json',
		success: function (data) {
			// console.log(data);
			$('#slctAddIS').empty();
			$.each(data, function(idx, val) {
				$('#slctAddIS').append(
					'<option value="' + val.NTID + '">' + val.EmpName + '</option>'
				);
			});
			
			setTimeout(function () {
	            $('#loader').modal('hide');
	        }, 2000);
		},
		error: function (response) {
			console.log(response.responseText);
		}
	});
}

function loadUsers() {
	$('#loader').modal({ backdrop: 'static', keyboard: false });

	$.ajax({
		type: 'POST',
		url: 'class/usersClass.php',
		data: {action: 'getUsers'},
		dataType: 'json',
		success: function (data) {
			// console.log(data);
			$('#tblUsers').bootstrapTable('destroy');
			$('#tblUsers').bootstrapTable({
				data: data
			})

			setTimeout(function () {
	            $('#loader').modal('hide');
	        }, 2000);
		},
		error: function (response) {
			console.log("Error: ");
			console.log(response.responseText);
		}
	});
}

function del(val) {
	$('#loader').modal({ backdrop: 'static', keyboard: false });
	var empId = $(val).attr('data-id');

	var user = $('#lblUser').attr('data-id');

	var myData = [empId, user]

	$.ajax({
		type: 'POST',
		url: 'class/usersClass.php',
		data: {action: 'deleteUser', myData: myData},
		success: function (data) {
			alert(data);

			loadUsers();
		},
		error: function (response) {
			console.log(response.responseText);
		}
	});
}

// function edit(val) {
// 	var id = $(val).attr('data-id');

// 	var user = $('#lblUser').attr('data-id');

// 	var myData = [id, user];

// 	$.ajax({
// 		type: 'POST',
// 		url: 'class/usersClass.php',
// 		data: {action: 'editUsers', myData: myData},
// 		dataType: 'json',
// 		success: function (data) {
// 			console.log(data);
// 		},
// 		error: function (response) {
// 			console.log(response.responseText);
// 		}
// 	});
// }

function action(val) {
	var edt = '<button class="btn btn-sm btn-default" data-id="' + val + '" onclick="editUser(this);"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>';
	var del = '<button class="btn btn-sm btn-default" data-id="' + val + '" onclick="del(this);"><i class="fa fa-trash"></i>&nbsp;Delete</button>';
	return edt + del;
}

function editUser(val) {
	$('#modalEdit').modal({ backdrop: 'static', keyboard: false });

	var empId = $(val).attr('data-id');
	
	$.ajax({
		type: 'POST',
		url: 'class/usersClass.php',
		data: {action: 'getUsers', empId: empId},
		dataType: 'json',
		success: function (data) {
			$('#inEmpNum').val(data[0].EmpID);
			$('#inNTID').val(data[0].NTID);
			$('#inEmpName').val(data[0].EmpName);
			$('#inEmpLevel').val(data[0].EmpLevel);
			$('#inLeavePTO').val(data[0].LeaveBal);
			$('#inLeaveCTO').val(data[0].LeaveBalCTO);
			$('#inJobDesc').val(data[0].JobDesc);
			$('#inDeptCode').val(data[0].DeptCode);
			$('#inDeptName').val(data[0].DeptName);
			$('#inMngrID').val(data[0].MngrID);
			$('#inMngrNTID').val(data[0].MngrNTID);
			$('#inMngrName').val(data[0].MngrName);
			$('#inBU').val(data[0].BusinessUnit);
			$('#inBUHead').val(data[0].BusinessUnitHead);
		},
		error: function (response) {
			console.log(response.responseText);
		}
	})
}

