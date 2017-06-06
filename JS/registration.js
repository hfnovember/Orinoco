function validatePasswordFields() {
	var password = document.getElementById("txt_reg_password").value;
	var passwordC = document.getElementById("txt_reg_confirmPass").value;
	
	if (password != passwordC) {
		alert('Passwords do not match!');
		return false;	
	}//end if not pass match
	
}//end validatePasswordFields()

function avoidSpaces(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32) return false;
}//end avoidSpaces()