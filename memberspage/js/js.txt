function phoneDigits(){
	var value = document.getElementById('phone').value;
	var digits = value.length;
	if (digits!=10 && !isNaN(value)) {
		alert("Phone Number must be 10 Digits.");
		document.getElementById('phone').value="";
	}
}
function digitsNumerals(){
	var value = document.getElementById('phone').value;
	if(isNaN(value)){
		alert("Phone number can't be an alphabet.");
		document.getElementById('phone').value="";
	}
}
function hide_text(){
	$('.errors_em').hide();
	
}