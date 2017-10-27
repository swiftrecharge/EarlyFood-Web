function phoneDigits(id){
				var value = document.getElementById(id).value;
				var digits = value.length;
				if (digits!=10 && !isNaN(value)) {
					alert("Phone Number must be 10 Digits.");
					document.getElementById(id).value="";
				}
			}
function digitsNumerals(id){
	var value = document.getElementById(id).value;
	if(isNaN(value)){
		alert("Phone number can't be an alphabet.");
		document.getElementById(id).value="";
	}
}