$(document).ready(function () {
	getEmp();
	getIS();

	$('#tblRoster tbody').empty();

	$("#slctUsers").select2({
		placeholder: 'Select Employee',
		closeOnSelect: false
	});

	$("#slctIS").select2({
		placeholder: 'Select Immediate Superior',
	});

	$("#slctIS").on('select2:select', function(e) {
		var mngrid = e.params.data.id;

		var myData = [mngrid];

		$.ajax({
			type: 'POST',
			url: 'class/rosterClass.php',
			data: {action: 'getDetails', myData: myData},
			dataType: 'json',
			success: function (data) {
				console.log(data);
				if($('#tblRoster tbody tr').length > 0) {
					$.each($('#tblRoster tbody tr'), function (idx, val) {
						$(this).find('td:eq(6)').html(data[0].EmpID);
						$(this).find('td:eq(7)').html(data[0].NTID);
						$(this).find('td:eq(8)').html(data[0].EmpName);
					});
				}
			},
			error: function (response) {
				console.log(response.responseText);
			}
		});
	});


	$("#slctUsers").on('select2:select', function(e) {
		var empID = e.params.data.id;
		var superiorID = $('#slctIS').val();
		
		var myData = [empID, superiorID];

		$.ajax({
			type: 'POST',
			url: 'class/rosterClass.php',
			data: {action: 'getDetails', myData: myData},
			dataType: 'json',
			success: function (data) {
				$('#tblRoster tbody').append(
					'<tr>' +
						'<td>' + data[0].EmpID + '</td>' +
						'<td>' + data[0].NTID + '</td>' +
						'<td>' + data[0].EmpName + '</td>' +
						'<td>' + data[0].MngrID + '</td>' +
						'<td>' + data[0].MngrNTID + '</td>' +
						'<td>' + data[0].MngrName + '</td>' +
						'<td>' + data[0].IsEmpID + '</td>' +
						'<td>' + data[0].IsNTID + '</td>' +
						'<td>' + data[0].IsEmpName + '</td>' +
					'</tr>'
				);
			},
			error: function (response) {
				console.log(response.responseText);
			}
		});
	});

	$("#slctUsers").on('select2:unselect', function(e) {
		var ntid = e.params.data.id;		

		var table = $('#tblRoster');
		var row = table.find('tr');

		$.each(row, function(idx, val) {
			var currRow = $(this);
			var tData = currRow.find('td:eq(1)').text();

			if (ntid == tData) {
				currRow.remove();
			}
		});

	});

	$('#btnApply').click(function () {
		$('#loader').modal({ backdrop: 'static', keyboard: false });

		if ($('#tblRoster tbody tr').length > 0) {
			var user = $('#lblUser').attr('data-id');
			var table = $('#tblRoster');
			var row = table.find('tbody tr');

			$.each(row, function(idx, val) {
				var currRow = $(this);
				var tData = currRow.find("td");
				var myData = [];

				$.each(tData, function(idx, val) {
					myData.push(tData[idx].innerText);
				});

				myData.push('Roster Update', user);

				$.ajax({
					type: 'POST',
					url: 'class/rosterClass.php',
					data: {action: 'editRoster', myData: myData},
					success: function (data) {
						console.log(data);
					},
					error: function (response) {
						console.log(response.responseText);
					}
				})
			});

			setTimeout(function () {
	            $('#loader').modal('hide');
	        }, 2000);
		}
	});

	$('#btnClear').click(function () {
		$('#slctUsers').val('').trigger("change");

		$('#tblRoster tbody').empty();
	});
});

function getEmp() {
	$('#loader').modal({ backdrop: 'static', keyboard: false });
	$.ajax({
		type: 'POST',
		url: 'class/rosterClass.php',
		data: {action: 'getEmp'},
		dataType: 'json',
		success: function (data) {
			// console.log(data);
			var arr = [];
			$('#slctUsers').empty();
			$.each(data, function(idx, val) {
				$('#slctUsers').append(
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

function getIS() {
	$('#loader').modal({ backdrop: 'static', keyboard: false });
	$.ajax({
		type: 'POST',
		url: 'class/rosterClass.php',
		data: {action: 'getIS'},
		dataType: 'json',
		success: function (data) {
			// console.log(data);
			var arr = [];
			$('#slctIS').empty();
			$.each(data, function(idx, val) {
				$('#slctIS').append(
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