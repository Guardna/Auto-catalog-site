	<nav class="topnavbar navbar-default topnav">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed toggle-costume" data-toggle="collapse" data-target="#upmenu" aria-expanded="false">
					<span class="sr-only"> Toggle navigaion</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand logo" href="#"><img src="image/logo1.png" alt="logo"></a>
			</div>	 
		</div>
		<div class="collapse navbar-collapse" id="upmenu">
			<ul class="nav navbar-nav" id="navbarontop">
				<?php 
					$upit2="SELECT * FROM meni";
					$hott2=$konekcija->query($upit2)->fetchAll();
					foreach($hott2 as $hot2):
				?>
				<?php 
				if(($hot2->ime)=="Category"):
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle"	data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CATEGORIES <span class="caret"></span></a>
					<ul class="dropdown-menu dropdowncostume">
					<?php 
						$upit3="SELECT * FROM marke";
						$hott3=$konekcija->query($upit3)->fetchAll();
						foreach($hott3 as $hot3):
					?>
						<li><a href="<?= $hot2->putanja ?>?<?= $hot3->naziv_marke ?>"><?= $hot3->naziv_marke ?></a></li>
					<?php endforeach;?>	
					</ul>
				</li>
				<?php else:?>
					<li class="active"><a href="<?= $hot2->putanja ?>"><?= $hot2->ime ?></a> </li>
				<?php endif;?>

				<?php endforeach;?>
				<?php if(isset($_SESSION['korisnik'])):?>
				<?php if(($_SESSION['korisnik']->naziv)=="admin"):?>
				<li><a href="admin.php">Admin Panel</a></li>
				<?php endif;?>
				<li><a href="php/logout.php">Logout</a></li>
				<?php endif;?>
				<?php if(isset($_SESSION['greske'])):
				var_dump($_SESSION['greske']);
				unset($_SESSION['greske']);
				endif;?>
			</ul>
		</div>
	</nav>
</div>