<div class="allcontain">
	<div class="feturedsection">
		<h1 class="text-center"><span class="bdots">&bullet;</span>R E G I S T E R<span class="carstxt">&bullet;</span></h1>
	</div>
							<form method="post" action="php/register.php" name="form" enctype="multipart/form-data" >	
								<input type="text" class="form-control name-form" placeholder="Name and Surname" id="imeprezime" name="imeprezime" onkeyup="proveraKontakt()">
								<input type="text" class="form-control email-form" placeholder="E-mail" id="email" name="email" onkeyup="proveraKontakt()">
								<input type="text" class="form-control subject-form" placeholder="Username" name="kime" id="kime" onkeyup="proveraKontakt()">
								<input type="password" class="form-control subject-form" placeholder="Password" id="sifra" name="sifra" onkeyup="proveraKontakt()">
								<button type="submit" class="btn btn-default btn-submit" id="salji" name="salji">Register</button>
							</form>
	</div>
