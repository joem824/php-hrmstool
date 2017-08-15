$(document).ready(function () {
	if (sessionStorage.getItem('user') != '' && sessionStorage.getItem('user') != null) {
		$('#lblUser span').html(sessionStorage.getItem('user'));
		$('#lblUser').attr('data-id', sessionStorage.getItem('ntid'));
	} else {
		alert('Login Error!');
		location.replace("login.php");	
	}
});

$('#btnSignOut').click(function () {
	$('#loader').modal({backdrop: 'static', keyboard: false});
	sessionStorage.clear();
	location.replace("login.php");
	$('#loader').modal('hide');
});