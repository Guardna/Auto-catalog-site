<body>
<!-- Header -->
<div class="allcontain">
	<div class="header">
			<ul class="socialicon">
				<li><a href="facebook.com"><i class="fa fa-facebook"></i></a></li>
				<li><a href="twitter.com"><i class="fa fa-twitter"></i></a></li>
				<li><a href="plus.google.com"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="pinterest.com"><i class="fa fa-pinterest"></i></a></li>
			</ul>
			<ul class="givusacall">
				<li>Auto Garage</li>
			</ul>
			<ul class="logreg">
			<?php	
				if(isset($_SESSION['korisnik']))
				{
					echo "<li>";
					echo "User: ".$_SESSION['korisnik']->username;
					echo "<li>";
				}
			?>
			<?php
				if(!isset($_SESSION['korisnik']))
				{
			?>
				<form action="php/login.php" method="POST">
					<nav>
					  <ul>
						<li id="login">
						  <a id="login-trigger" href="#">
							Login <span>?</span>
						  </a>
						  <div id="login-content">
							<form>
							  <fieldset id="inputs">
								<input id="kkime" type="text" name="tbIme" placeholder="Username">   
								<input id="password" type="password" name="tbLozinka" placeholder="Password">
							  </fieldset>
							  <fieldset id="actions">
								<input type="submit" id="submit" name="btnLogin" value="Log in">
							  </fieldset>
							</form>
						  </div>                     
						</li>
						<li id="signup">
						  <a href="register.php">Register</a>
						</li>
					  </ul>
					</nav>
				</form>
				<?php
					}
				?>
			</ul>
	</div>