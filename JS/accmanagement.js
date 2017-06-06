function validatePasswordFields() {
	var password = document.getElementById("chg_password").value;
	var passwordC = document.getElementById("chg_confirmPassword").value;
	
	if (password != passwordC) {
		alert('Passwords do not match!');
		return false;	
	}//end if not pass match
	
}//end validatePasswordFields()

function avoidSpaces(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32) return false;
}//end avoidSpaces()