$(document).ready(function() {
	getEmp();

	$('#slctSrchEmp').select2();

	$('#btnSearch').click(function () {
		$('#loader').modal({ backdrop: 'static', keyboard: false });
		var ntid = $('#slctSrchEmp').val();
		var dtFrom = $('#inDtFrom').val();
		var dtTo = $('#inDtTo').val();

		var myData = ['read', ntid, dtFrom, dtTo];

		$.ajax({
			type: 'POST',
			url: 'class/logsClass.php',
			data: {action: 'getDisputes', myData: myData},
			dataType: 'json',
			success: function (data) {
				
				$('#divRow').show();

				$('#tblSched').bootstrapTable('destroy');
				$('#tblSched').bootstrapTable({
					data: data[0][0],
					pageSize: 5,
					pageList: ['All',5,10,25,50,100],
					onPageChange: function () {
						//iCheck for checkbox and radio inputs
						$('input[type=checkbox]').iCheck({
							checkboxClass: 'icheckbox_flat-grey',
							radioClass: 'iradio_flat-grey'
						});
					}
					// showExport: true,
					// exportDataType: "all"
				});

				$('#tblSched').bootstrapTable('uncheckAll');

				$('#tblAct').bootstrapTable('destroy');
				$('#tblAct').bootstrapTable({
					data: data[0][1],
					pageSize: 5,
					pageList: ['All',5,10,25,50,100],
					onPageChange: function () {
						//iCheck for checkbox and radio inputs
						$('input[type=checkbox]').iCheck({
							checkboxClass: 'icheckbox_flat-grey',
							radioClass: 'iradio_flat-grey'
						});
					}
					// showExport: true,
					// exportDataType: "all"
				});
				
				$('#tblAct').bootstrapTable('uncheckAll');

				//iCheck for checkbox and radio inputs
				$('input[type=checkbox]').iCheck({
					checkboxClass: 'icheckbox_flat-grey',
					radioClass: 'iradio_flat-grey'
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

	$('#btnAddSched').click(function () {
		$('#modalAdd').modal({ backdrop: 'static', keyboard: false });

		var type = $(this).attr('data-id');

		$('#lblAddType').text(type);

		$('#modalAdd .modal-title').text('Add Schedule');

		$('#divAddSched').show();
		$('#divAddAct').hide();
	});

	$('#btnAddAct').click(function () {
		$('#modalAdd').modal({ backdrop: 'static', keyboard: false });

		var type = $(this).attr('data-id');

		$('#lblAddType').text(type);

		$('#modalAdd .modal-title').text('Add Activity');

		$('#divAddSched').hide();
		$('#divAddAct').show();
	});

	$('#btnAddRowSched').click(function () {

		var tbody = $('#tblAddSched tbody');
		var lastChild = tbody.find('tr:last-child');
		lastChild.clone().appendTo(tbody);

		$('.datepicker').datepicker({
			showInputs: false
		});
		$('.datetimepicker').datetimepicker();

		$('.removeRow').closest('td').show();
	});

	$('#btnAddRowAct').click(function () {

		var tbody = $('#tblAddAct tbody');
		var lastChild = tbody.find('tr:last-child');
		lastChild.clone().appendTo(tbody);

		$('.datepicker').datepicker({
			showInputs: false
		});
		$('.datetimepicker').datetimepicker();

		$('.removeRow').closest('td').show();
	});

	$('#btnSaveSchedAct').click(function () {
		$('#loader').modal({ backdrop: 'static', keyboard: false });
		var type = $('#lblAddType').text();
		var loginid = $('#slctSrchEmp').val();
		var user = $('#lblUser').attr('data-id');

		var arr = [];
		if (type == 'sched') {
			var schedTR = $('#tblAddSched tbody tr');
			
			$.each(schedTR, function(idx, val) {
				var obj = {};

				obj['LoginID'] = loginid;
				obj['SchedDate'] = $(this).find('td:eq(0) input').val();
				obj['SchedIN'] = $(this).find('td:eq(1) input').val();
				obj['SchedOUT'] = $(this).find('td:eq(2) input').val();
				obj['SchedType'] = $(this).find('td:eq(3) select').val();

				arr.push(obj);
			});

			// console.log(arr);

			
		} else if (type == 'act') {
			var actTR = $('#tblAddAct tbody tr');
			$.each(actTR, function(idx, val) {
				var obj = {};

				obj['LoginID'] = loginid;
				obj['SchedDate'] = $(this).find('td:eq(0) input').val();
				obj['StartTime'] = $(this).find('td:eq(1) input').val();
				obj['EndTime'] = $(this).find('td:eq(2) input').val();
				obj['Reason'] = $(this).find('td:eq(3) select').val();

				arr.push(obj);
			});

			// console.log(arr);
		}

		$.ajax({
				type: 'POST',
				url: 'class/logsClass.php',
				data: {action: 'addSchedAct', myData: arr, type: type, user: user},
				success: function(data) {
					alert(data);
					
					$('#modalAdd').modal('hide');
					setTimeout(function () {
			            $('#loader').modal('hide');
			        }, 2000);
				},
				error: function(response) {
					console.log(response.responseText);
				}
			});
	});

	$('.btnDel').click(function () {

		var type = $(this).attr('data-id');

		$('#lblType').text(type);

		if (type == "sched") {
			var seriesId = [];
			$.each($('#tblSched tbody').find('input[type=checkbox]'), function() {
				if ($(this).is(':checked')) {
					seriesId.push($(this).attr('data-id'));
				}
			});

			// alert(seriesId);

			if (seriesId.length > 0) {
				$('#modalReason').modal({ backdrop: 'static', keyboard: false });
			} else {
				alert('Please select a schedule you want to delete.');
			}
		} else {
			var seriesId = [];
			$.each($('#tblAct tbody').find('input[type=checkbox]'), function() {
				if ($(this).is(':checked')) {
					seriesId.push($(this).attr('data-id'));
				}
			});

			if (seriesId.length > 0) {
				$('#modalReason').modal({ backdrop: 'static', keyboard: false });
			} else {
				alert('Please select an activity you want to delete.');
			}
		}
		
	});

	$('#btnDelDispute').click(function () {
		$('#loader').modal({ backdrop: 'static', keyboard: false });
		var type = $('#lblType').text();
		var reason = $('#taReason').val();

		var user = $('#lblUser').attr('data-id');

		if (reason == '') {
			alert('Please fill up the "Remarks" Field!');
		} else {
			if (type == 'sched') {
				var seriesId = [];
				$.each($('#tblSched tbody').find('input[type=checkbox]'), function() {
					if ($(this).is(':checked')) {
						seriesId.push($(this).attr('data-id'));
					}
				});

				var myData = [seriesId, reason, user];

				// console.log(myData);

				$.ajax({
					type: 'POST',
					url: 'class/logsClass.php',
					data: {action: 'delSched', myData: myData},
					success: function (data) {

						$('#modalReason').modal('hide');

						alert(data);

						$('#btnSearch').click();

						setTimeout(function () {
				            $('#loader').modal('hide');
				        }, 2000);
					},
					error: function (response) {
						console.log(response.responseText);
					}
				});

			} else {
				var seriesId = [];
				$.each($('#tblAct tbody').find('input[type=checkbox]'), function() {
					if ($(this).is(':checked')) {
						seriesId.push($(this).attr('data-id'));
					}
				});

				var myData = [seriesId, reason, user];

				console.log(myData);

				$.ajax({
					type: 'POST',
					url: 'class/logsClass.php',
					data: {action: 'delAct', myData: myData},
					success: function (data) {

						$('#modalReason').modal('hide');

						alert(data);

						$('#btnSearch').click();

						setTimeout(function () {
				            $('#loader').modal('hide');
				        }, 2000);
					},
					error: function (response) {
						console.log(response.responseText);
					}
				});
			}
		}
	});

	$('#btnUpdate').click(function () {
		$('#loader').modal({ backdrop: 'static', keyboard: false });
		
		var seriesId = $('#lblSeries').text();
		var title = $('#sTitle').text();
		var reason = $('#taRemarks').val();

		var user = $('#lblUser').attr('data-id');

		var myData = [];

		if (reason == '') {
			alert('Please fill up the "Remarks" Field!');
		} else {
			if (title == "Schedule") {
				var scheddate = $('#inSchedDate1').val();
				var schedtype = $('#inSchedType').val();
				var schedin = $('#inSchedIn').val();
				var schedout = $('#inSchedOut').val();
				var break1 = $('#inBreak1').val();
				var lunch = $('#inLunch').val();
				var break2 = $('#inBreak2').val();

				var values = [seriesId, scheddate, schedtype, schedin, schedout, break1, lunch, break2];

				myData.push('sched')
				myData.push(reason)
				myData.push(values);
				myData.push(user);

			} else {
				var scheddate = $('#inSchedDate2').val();
				var start = $('#inStart').val();
				var end = $('#inEnd').val();
				var tag = $('#inTag').val();

				var values = [seriesId, scheddate, start, end, tag];

				myData.push('act')
				myData.push(reason)
				myData.push(values);
				myData.push(user);
			}

			$.ajax({
				type: 'POST',
				url: 'class/logsClass.php',
				data: {action: 'updateDispute', myData: myData},
				success: function (data) {

					$('#modalEdit').modal('hide');

					alert(data);

					$('#btnSearch').click();

					setTimeout(function () {
			            $('#loader').modal('hide');
			        }, 2000);
				},
				error: function (response) {
					console.log(response.responseText);
				}
			});
		}
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


function actionSched(val) {
	var edt = '<button class="btn btn-sm btn-default" data-id="' + val + '" data-title="Sched" onclick="clickEdit(this);"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>';
	// var del = '<button class="btn btn-sm btn-default" data-id="' + val + '" onclick=""><i class="fa fa-trash"></i>&nbsp;Delete</button>';
	return edt;
}

function actionAct(val) {
	var edt = '<button class="btn btn-sm btn-default" data-id="' + val + '" data-title="Act" onclick="clickEdit(this);"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>';
	// var del = '<button class="btn btn-sm btn-default" data-id="' + val + '" onclick=""><i class="fa fa-trash"></i>&nbsp;Delete</button>';
	return edt;
}

function cbSeriesId(val) {
	return '<input type="checkbox" class="iCheck" data-id="' + val + '" name= />'
}

function clickEdit(val) {
	$('#modalEdit').modal({ backdrop: 'static', keyboard: false });

	var ntid = $('#slctSrchEmp').val();
	var dtFrom = $('#inDtFrom').val();
	var dtTo = $('#inDtTo').val();

	var seriesId = $(val).attr('data-id');
	var title = $(val).attr('data-title');

	$('#lblSeries').text(seriesId);

	if (title == "Sched") {
		$('#sTitle').text('Schedule');
		$('#divSched').show();
		$('#divAct').hide();
	} else {
		$('#sTitle').text('Activity');
		$('#divSched').hide();
		$('#divAct').show();
	}

	var myData = ['update', ntid, dtFrom, dtTo, seriesId, title];

	$.ajax({
		type: 'POST',
		url: 'class/logsClass.php',
		data: {action: 'getDisputes', myData: myData},
		dataType: 'json',
		success: function (data) {
			console.log(data);
			if (title == 'Sched') {
				$('#inSchedDate1').val(data[0].SchedDate);
				$('#inSchedType').val(data[0].SchedType);
				$('#inSchedIn').val(data[0].SchedIN);
				$('#inSchedOut').val(data[0].SchedOUT);
				$('#inBreak1').val(data[0].Break1);
				$('#inLunch').val(data[0].Lunch);
				$('#inBreak2').val(data[0].Break2);
			} else {
				$('#inSchedDate2').val(data[0].SchedDate);
				$('#inStart').val(data[0].Start_Time);
				$('#inEnd').val(data[0].End_Time);
				$('#inTag').val(data[0].ReasonDesc);
			}
		},
		error: function (response) {
			console.log(response.responseText);
		}
	});
}

function removeRow(val) {
	var tbody = $(val).closest('tbody')
	$(val).closest('tr').remove();

	if (tbody.find('tr').length == 1) {
		$('.removeRow').hide();
	}
}