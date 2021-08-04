// for checking if amount tb has dot (decimal)
function hasDot(val){
	console.log(val);
	for(let i = 0; i < (val.length); i++){
		if((val[i]).charCodeAt(0) == 46) return true;
	} 
	return false;
}

function isNumber(evt, val) {
	evt = (evt) ? evt : window.event;	
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	
	
	if (charCode < 48 || charCode > 57) {
		if (charCode == 46 && hasDot(val) == false) return true;
		
		return false;
	}
	return true;
}
