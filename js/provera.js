function proveraKontakt(){
	var ime = document.getElementById("imeprezime").value;
	var regIme = /^[A-Z]{1}[a-z]{2,9}(\s[A-Z]{1}[a-z]{2,9})+$/;
	if(regIme.test(ime)){
		document.getElementById("imeprezime").style.borderColor = "green";
	}
	else {
		document.getElementById("imeprezime").style.borderColor = "red";
		
	}
	var email = document.getElementById("email").value;
	var regEmail = /^[a-z0-9]+(\.[a-z0-9]+)*\@[a-z]+(\.[a-z]+)+$/;
	if(regEmail.test(email)){
		document.getElementById("email").style.borderColor = "green";
	}
	else {
		document.getElementById("email").style.borderColor = "red";
		
	}
	var kime = document.getElementById("kime").value;
	var regkime = /^[A-Z]{1}[a-z]{2,9}$/;
	if(regkime.test(kime)){
		document.getElementById("kime").style.borderColor = "green";
	}
	else {
		document.getElementById("kime").style.borderColor = "red";
		
	}
	var password = document.getElementById("sifra").value;
	var regpassword = /^[\w\d\S]+$/;
	if(regpassword.test(password)){
		document.getElementById("sifra").style.borderColor = "green";
	}
	else {
		document.getElementById("sifra").style.borderColor = "red";
		
	}

	
}

