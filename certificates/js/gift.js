window.onload = payment;
function payment(){
	mobileDiv = document.getElementById("mobile_payment");
	credit_cardDiv = document.getElementById("credit_card");
	mobileDiv.style.display = "none";
	credit_cardDiv.style.display = "none";
	var option = document.getElementById("payment").getElementsByTagName("option");
	for (var i = 0; i < option.length; i++) {
		mode = option[i];
		mode.onclick = function(){
		display(this.className, this.value, mobileDiv, credit_cardDiv);
		}
	}
}
	
	$("select").change(function(){
		alert('Hello');
	});
	
function display(div, name, mobileDiv, credit_cardDiv){
	if (div == 'none') {
		mobileDiv.style.display = "none";
		credit_cardDiv.style.display = "none";
	}

	if (div == 'mobile') {
		mobileDiv.style.display = "block";
		document.getElementById("label_1").innerHTML = name + " Number";
		document.getElementById("label_2").innerHTML = name + " Pin";
		credit_cardDiv.style.display= "none";
	};

	if (div == "card") {
		mobileDiv.style.display = "none";
		credit_cardDiv.style.display = "block";
	};
}
