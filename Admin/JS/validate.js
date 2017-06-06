function isPositiveInt(str) {
	return /^\+?(0|[1-9]\d*)$/.test(str);
}//end isPositiveInt()


function isPositiveFloat(str) {
	return /^\d+(.\d{1,2})?$/.test(str);
}//end isPositiveFloat()

function manageItemsV() {
	if (!isPositiveInt(document.getElementById("itemQuantityToAdd").value)) {
		alert("Item Quantity should be positive integer.");
		return false;	
	}
	else if (!isPositiveFloat(document.getElementById("itemPrice").value)) {
		alert("Price should be positive number.");
		return false;
	}
	
	return true;	
}

function manageBooksV() {
	if (!isPositiveInt(document.getElementById("bookQuantityToAdd").value)) {
		alert("Book Quantity should be positive integer.");
		return false;	
	}
	else if (!isPositiveFloat(document.getElementById("bookPrice").value)) {
		alert("Book should be positive number.");
		return false;
	}
	
	return true;	
}




