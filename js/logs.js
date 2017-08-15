$(document).ready(function () {
	
	getEmp();

	$('#slctSrchEmp').select2();

	$('#btnSearch').click(function () {
		$('#loader').modal({ backdrop: 'static', keyboard: false });
		var ntid = $('#slctSrchEmp').val();
		var dtFrom = $('#inDtFrom').val();
		var dtTo = $('#inDtTo').val();

		var myData = [ntid, dtFrom, dtTo];

		$.ajax({
			type: 'POST',
			url: 'class/logsClass.php',
			data: {action: 'getLogs', myData: myData},
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#tblLogs').show();
				$('#tblLogs').bootstrapTable('destroy');
				$('#tblLogs').bootstrapTable({
					data: data
				});

				setTimeout(function () {
		            $('#loader').modal('hide');
		        }, 2000);
			},
			error: function (response) {
				console.log(response.responseText);
			}
		});
	});
});

function getEmp() {
	$('#loader').modal({ backdrop: 'static', keyboard: false });
	$.ajax({
		type: 'POST',
		url: 'class/logsClass.php',
		data: {action: 'getEmp'},
		dataType: 'json',
		success: function (data) {
			// console.log(data);
			var arr = [];
			$('#slctSrchEmp').empty();
			$.each(data, function(idx, val) {
				$('#slctSrchEmp').append(
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