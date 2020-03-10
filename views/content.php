<div class="allcontain">
<div class="feturedsection">
		<h1 class="text-center"><span class="bdots">&bullet;</span>S U R V E Y<span class="carstxt">&bullet;</span></h1>
</div>
	<div class="grid">
		<div class="row">
			<div class="bottomlogo">
				<div class="txthover">
					<div id="poll">
							<?php if(!isset($_COOKIE['adresa'])):;?>
							<h4 style="color:#d6d3d3;">Favorite Brand</h4>
							<table align="center">
							<tr>
							<td>Mercedes:</td>
							<td><input type="radio" name="vote" value="0" onclick="getVote(this.value)"></td></tr>
							<tr>
							<td>BMW:</td>
							<td><input type="radio" name="vote" value="1" onclick="getVote(this.value)"></td></tr>
							<tr>
							<td>Tesla:</td>
							<td><input type="radio" name="vote" value="2" onclick="getVote(this.value)"></td></tr>
							<tr>
							<td>Volkswagen:</td>
							<td><input type="radio" name="vote" value="3" onclick="getVote(this.value)"></td></tr>
							</table>
							<?php else: include "poll_vote.php";?>
							<?php endif;?>
					</div>
				</div>	 
			</div>
		</div>
	</div>
		<br>
		<br>
		<br>
	<br>
<div class="latestcars">
	<h1 class="text-center">&bullet; LATEST   CARS &bullet;</h1>
</div>
<br>
<br>
	<div class="grid">
		<div class="row">
			<?php
			  $upit="SELECT * FROM vozila h INNER JOIN slika s ON h.id=s.id ORDER BY s.id DESC";
              $hott=$konekcija->query($upit)->fetchAll();
              ?>
			  <?php
					if(count($hott)>0):
					$i=0;					
					foreach($hott as $hot):
					if ($i < 8):
					$i++
				?>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="txthover">
					<img src="<?= $hot->putanja?>" alt="<?= $hot->alt?>">
						<div class="txtcontent">
							<div class="stars">
							</div>
							<div class="simpletxt">
								<h3 class="name"><?= $hot->naziv?></h3>
	 							<h4 class="price"><?= $hot->cena?>&euro;</h4>
							</div>
							<div class="stars2">
							</div>
						</div>
				</div>	 
			</div>
			<?php endif;?>
			<?php endforeach;?>
			<?php endif;?>
		</div>
	</div>
</div>