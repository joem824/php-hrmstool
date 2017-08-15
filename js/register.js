$('#btnRegister').click(function () {
	var fn = $('#inFirstName').val();
	var mn = $('#inMiddleName').val();
	var ln = $('#inLastName').val();
	var email = $('#inEmail').val();
	var pass = $('#inPassword').val();
	var confirm = $('#inConfirm').val();
	var agree;

	if ($('#cbAgree').is(':checked') == true) {
		agree = true;
	} else {
		agree = false;
	}

	var myData = [fn, mn, ln, email, pass];

	console.log(myData);
	$('#formReg').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			alert("ERROR " + e);
		} else {
			$.ajax({
				type: 'POST',
				url: 'class/sessionClass.php/',
				data: {action: "register", myData: myData},
				success: function(data) {
					
					if (data == '1') {
						alert('Registration Successful! You may now login!');
						location.href = 'login.php';
					} else {
						alert(data);
					}
				},
				error: function (response) {
					alert(response.responseText);
				}
			});
		}
	});
});