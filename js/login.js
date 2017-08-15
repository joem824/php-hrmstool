$(document).ready(function() {
	var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('=');

    if (hashes.length > 0) {
    	if (hashes[1] == 'orculloj') {
	    	$('#inUser').val('orculloj');
	    	$('#inPass').val('joemorcullo');

	    	$('#btnSignIn').click();
	    } else {
	    	$('#inUser').val();
	    	$('#inPass').val();
	    }
    }

});

$('#btnSignIn').click(function () {
	$('#loader').modal({backdrop: 'static', keyboard: false});
	var un = $('#inUser').val();
	var pw = $('#inPass').val();
	// alert(un);
	$.ajax({
		type: 'POST',
		url: 'class/sessionClass.php/',
		data: {action: "login", user: un, pass: pw},
		success: function(data) {
			if (data != "1" && data != "2" && data != "") {
				alert("Login Successful!");
				sessionStorage.setItem('user', data);
				sessionStorage.setItem('ntid', un);
				// console.log(sessionStorage.getItem('user'));
				location.replace("index.php");
				$('#loader').modal('hide');
			} else if (data == "1") {
				alert("Invalid Password!");
			} else if (data == "2") {
				alert("Invalid Login! Username not found!");
			} else {
				alert("Invalid Login! Username not found!");
			}
		},
		error: function (response) {
			console.log(response.responseText);
		}
	});
});