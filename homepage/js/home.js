window.onload = Search;
function Search(){
	input = document.getElementById("searchTerm");
	button = document.getElementById("btnSearch");
	button.onclick = function (){
		if (input.value=="") {
			return false;
		}else{
			return true;
		}
	}
}