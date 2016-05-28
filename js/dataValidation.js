function validar() {
	var email = document.forms["loginForm"]["userEmail"].value;
	var pass = document.forms["loginForm"]["userPassword"].value;

	if ((email == "") || (pass == "")) {
		alert("Completa los dos campos");
		return false;
	}

	return true;
}
