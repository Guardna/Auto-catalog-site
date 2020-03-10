<div class="allcontain">
<?php
	if(isset($_REQUEST['Search']))
	{
		
		$upit = "SELECT * FROM vozila h INNER JOIN slika s ON h.slika_id=s.id WHERE h.naziv LIKE '%$vrednostPolja%' ORDER BY h.slika_id DESC";
		
		$rez = $konekcija->query($upit)->fetchAll();		
		
		if(count($rez) == 0)
				{
					print "<div class='simpletxt'>";
					print "<p>'Wrong name or we dont have that car!'</p>";
					print "</div>";
				}
			else
	{
		$slike = array();
		$brojslika=count($rez);
		$postrani=8;
				$strane=ceil($brojslika/$postrani);
				if (!isset($_GET['page'])) {
					$page = 1;
					} else {
					$page = $_GET['page'];
						}
						
						$this_page_first_result = ($page-1)*$postrani;
						$upit=$upit .' LIMIT ' . $this_page_first_result . ',' .  $postrani;
						$rez = $konekcija->query($upit)->fetchAll();
						
					$brojslika=count($rez);
					
					print "<div class='grid'>";
					print "<div class='row'>";

				for ($i=0;$i<$brojslika;$i++){
					foreach($rez as $r):	
					$slike[] = $r;
					print "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
					print	"<div class='txthover'>";
					print		"<img src='".$slike[$i]->putanja."' alt=".$slike[$i]->naziv.">";
					print			"<div class='txtcontent'>";
					print 			"<div class='stars'></div>";
					print				"<div class='simpletxt'>";
					print					"<h3 class='name'>".$slike[$i]->naziv."</h3>";
					print					"<h4 class='price'> ".$slike[$i]->cena."&euro;</h4>";
					print				"</div>";
					print 			"<div class='stars2'></div>";
					print			"</div>";
					print	"</div>"	 ;
					print "</div>";
					if (++$i == $brojslika) break;
					endforeach;
				}
					print "</div>";
					print "</div>";
					if($strane>1){
					print "<div class='feturedsection'>";
					print "<h1 class='text-center'>&nbsp&nbsp";
					for ($page=1;$page<=$strane;$page++) {
						echo '<a href="pretraga.php?'.$vrednostPolja.'&page=' . $page . '" >' . $page . '</a>';
					}	
					print "</h1>";
					print "</div>";
					}
					print "<br>";
					print "<br>";

			}
		
	}
		if(isset($_REQUEST['page'])){
			if(isset($_COOKIE['pretraga'])){
		$vrednostPolja = $_COOKIE['pretraga'];
			}else $vrednostPolja = "";
		}else if(isset($_REQUEST['Mercedes'])){
			$vrednostPolja = '1';
		}else if(isset($_REQUEST['BMW'])){
			$vrednostPolja = '2';
		}else if(isset($_REQUEST['Tesla'])){
			$vrednostPolja = '3';
		}else if(isset($_REQUEST['Volkswagen'])){
			$vrednostPolja = '4';
		}
		if(isset($_REQUEST['Mercedes']) || isset($_REQUEST['BMW']) || isset($_REQUEST['Tesla']) || isset($_REQUEST['Volkswagen']))
		{
		$upit = "SELECT * FROM vozila h INNER JOIN slika s ON h.slika_id=s.id INNER JOIN marke d ON h.marka_id=d.id_marke WHERE h.marka_id LIKE '%$vrednostPolja%' ORDER BY h.slika_id DESC";
		} else if(isset($_REQUEST['page'])){
			$upit = "SELECT * FROM vozila h INNER JOIN slika s ON h.slika_id=s.id WHERE h.naziv LIKE '%$vrednostPolja%' ORDER BY h.slika_id DESC";
		}
		if(isset($_REQUEST['page']) || isset($_REQUEST['Mercedes']) || isset($_REQUEST['BMW']) || isset($_REQUEST['Tesla']) || isset($_REQUEST['Volkswagen']))
		{
			
		$rez = $konekcija->query($upit)->fetchAll();
		
		if(count($rez) == 0)
				{
					print "<div class='simpletxt'>";
					print "<p>'Wrong name or we dont have that car!'</p>";
					print "</div>";
				}
			else
	{
		$slike = array();
		$brojslika=count($rez);
		$postrani=8;
				$strane=ceil($brojslika/$postrani);
				if (!isset($_GET['page'])) {
					$page = 1;
					} else {
					$page = $_GET['page'];
						}
						
						$this_page_first_result = ($page-1)*$postrani;
						$upit=$upit .' LIMIT ' . $this_page_first_result . ',' .  $postrani;
						$rez = $konekcija->query($upit)->fetchAll();
						
				
					$brojslika=count($rez);
					
					print "<div class='grid'>";
					print "<div class='row'>";
				for ($i=0;$i<$brojslika;$i++){
					foreach($rez as $r):	
					$slike[] = $r;
					print "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
					print	"<div class='txthover'>";
					print		"<img src='".$slike[$i]->putanja."' alt=".$slike[$i]->naziv.">";
					print			"<div class='txtcontent'>";
					print 			"<div class='stars'></div>";
					print				"<div class='simpletxt'>";
					print					"<h3 class='name'>".$slike[$i]->naziv."</h3>";
					print					"<h4 class='price'> ".$slike[$i]->cena."&euro;</h4>";
					print				"</div>";
					print 			"<div class='stars2'></div>";
					print			"</div>";
					print	"</div>"	 ;
					print "</div>";
					if (++$i == $brojslika) break;
					endforeach;
				}
					print "</div>";
					print "</div>";
					if($strane>1){
					print "<div class='feturedsection'>";
					print "<h1 class='text-center'>&nbsp&nbsp";
					for ($page=1;$page<=$strane;$page++) {
						echo '<a href="pretraga.php?'.$vrednostPolja.'&page=' . $page . '" >' . $page . '</a>';
					}	
					print "</h1>";
					print "</div>";
					}
					print "<br>";
					print "<br>";
				
			}
			}
			
	
?>

</div>	