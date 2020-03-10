<div class="allcontain">

		<form method="POST" action="" name="form" enctype="multipart/form-data">
		<table  width='100%'>
			<tr>
				<td>
					<input type="submit" value="User list" name="listaSvihKorisnika" id="listaSvihKorisnika" /> 
				</td>
				<td>
					<input type="submit" value="Car list" name="listaSvihProizvoda" id="listaSvihProizvoda" /> 
				</td>
				<td>
					<input type="submit" value="Add user" name="dodajKorisnika" id="dodajKorisnika" /> 
				</td>
				<td>
					<input type="submit" value="Add car" name="dodajProizvoda" id="dodajProizvoda" /> 
				</td>
			</tr>			
		</table>
		<?php
			if(($_SESSION['korisnik']->naziv)=="admin")
			{
				echo("<table  width='100%'>");
				
				if(isset($_REQUEST['listaSvihKorisnika']))
				{
					$sviKorisnici = "SELECT *,k.id AS idk FROM korisnik k INNER JOIN uloga u ON k.uloga_id=u.id ORDER BY uloga_id ASC";
					
					$rezKorisnici = $konekcija->query($sviKorisnici)->fetchAll();	

					if(($rezKorisnici) > 0)
					{
						echo("<tr>");
							echo("<th>Username</th>");
							echo("<th>Password</th>");
							echo("<th>Name and Surname</th>");
							echo("<th>Email</th>");
							echo("<th>Role</th>");
							echo("<th>Delete/Change</th>");
						echo("</tr>");
						
						foreach($rezKorisnici as $redKorisnici):
						echo("<tr>");
							echo("<td>".$redKorisnici->username."</td>");
							echo("<td>".$redKorisnici->lozinka."</td>");
							echo("<td>".$redKorisnici->imeprezime."</td>");
							echo("<td>".$redKorisnici->mejl."</td>");
							echo("<td>".$redKorisnici->naziv."</td>");
							echo("<td><input type='checkbox' name='selKorisnici[]' value='".$redKorisnici->idk."' /></td>");
						echo("</tr>");
						endforeach;
						
					}else echo("User does not exist.");
						echo("<tr>");
							echo("<td><input type='submit' name='obrisiKorisnike' value='Delete' /></td>");
							echo("<td><input type='submit' name='menjajKorisnike' value='Change' /></td>");
							echo("<td colspan='4'></td>");
						echo("</tr>");
					
				}else 
					
				if(isset($_REQUEST['listaSvihProizvoda']))
				{
					$sviProizvodi = "SELECT * FROM vozila h INNER JOIN slika s ON h.slika_id=s.id INNER JOIN marke d ON h.marka_id=d.id_marke";
					
					$rezProizvodi = $konekcija->query($sviProizvodi)->fetchall();
					if($rezProizvodi)
					{
						echo("<tr>");
							echo("<th>Category</th>");
							echo("<th>Car name</th>");
							echo("<th>Picture</th>");
							echo("<th>Price</th>");
						echo("</tr>");
						
						foreach($rezProizvodi as $r):
						
						echo("<tr>");
							echo("<td>".$r->naziv_marke."</td>");
							echo("<td>".$r->naziv."</td>");
							echo("<td><img src='".$r->putanja."' width='50px' height='50px' /></td>");
							echo("<td>".$r->cena."</td>");
							echo("<td><input type='checkbox' name='selProizvodi[]' value='".$r->slika_id."'/></td>");
						echo("</tr>");
						endforeach;
						
						
					}else echo("Car does not exist!");
						echo("<tr>");
							echo("<td><input type='submit' name='obrisiProizvod' value='Delete' /></td>");
							echo("<td><input type='submit' name='menjajProizvod' value='Change' /></td>");
							echo("<td colspan='4'></td>");
						echo("</tr>");
				}

				if(isset($_REQUEST['dodajKorisnika']))
				{
						echo("<tr>");
							echo("<th>Username:</th>");
							echo("<td><input type='text' name='korisnickoIme' /></td>");
						echo("</tr>");
	
						echo("<tr>");
							echo("<th>Password:</th>");
							echo("<td><input type='text' name='korisnikLozinka' /></td>");
						echo("</tr>");
						
						echo("<tr>");
							echo("<th>Name and Surname:</th>");
							echo("<td><input type='text' name='korisnikIme' /></td>");
						echo("</tr>");
						
						echo("<tr>");
							echo("<th>Email:</th>");
							echo("<td><input type='text' name='korisnikPrezime' /></td>");
						echo("</tr>");
						
						echo("<tr>");
							echo("<th>Role</th>");
							echo("<td>
									<select name='korisnikUloga'>
										<option value='0'>Choose</option>
										<option value='1'>admin</option>
										<option value='2'>user</option>
									</select>
							</td>");
						echo("</tr>");
							
						echo("<tr>");
							echo("<td><input type='submit' name='dodajKor' value='Add user' /></td>");
							echo("<td><input type='reset' value='Clear' /></td>");
						echo("</tr>");
						
				}

				if(isset($_REQUEST['dodajProizvoda']))
				{
						$upit_sve_kategorije = "SELECT * FROM marke";
						
						$rez_sve_kategorije = $konekcija->query($upit_sve_kategorije)->fetchAll();

						$kategorije ="";
						foreach($rez_sve_kategorije as $red_sve_kategorije):
							$kategorije.="<option value='".$red_sve_kategorije->id_marke."'>".$red_sve_kategorije->naziv_marke."</option>";
						endforeach;
					
					echo("<tr>");
						echo("<th>Category</th>");
						echo("<td>
							<select name='proizvodKategorija'>
								<option value='0'>Choose</option> ");
								echo($kategorije);
							echo("</select>
						</td>");
					echo("</tr>");
					echo("<tr>");
						echo("<th>Car name</th>");
						echo("<td><input type='text' name='proizvodIme' /></td>");						
					echo("</tr>");
					echo("<tr>");
						echo("<th>Picture</th>");
						echo("<td><input type='file' name='proizvodSlika' /></td>");						
					echo("</tr>");
					echo("<tr>");
						echo("<th>Price</th>");
						echo("<td><input type='text' name='proizvodCPK' /></td>");						
					echo("</tr>");
					
					echo("<tr>");
							echo("<td><input type='submit' name='dodajPro' value='Add car' /></td>");
							echo("<td><input type='reset' value='Clear' /></td>");
					echo("</tr>");
				}
				echo("</table>");
				
				if(isset($_REQUEST['obrisiKorisnike']))
				{					
					$korisnici = (empty($_REQUEST['selKorisnici']) ?  null : $_REQUEST['selKorisnici']);
					if($korisnici)
					{
						$deleted="";
						foreach($korisnici as $kor => $val)
						{
								$provera = "SELECT * FROM korisnik WHERE id=".$val;
								$red = $konekcija->query($provera)->fetch(PDO::FETCH_ASSOC);	
								
								$deleted .= $red['imeprezime'].':';
								
								$obrisi = "DELETE FROM korisnik WHERE id=".$val;
								$konekcija->prepare($obrisi)->execute();
						}
						$deleted = explode(':', $deleted);
						for($i=0; $i<count($deleted); $i++)
							if($deleted[$i] != "")
								echo("you deleted ".$deleted[$i].".<br/>");
					}else echo("you didnt choose a user.");
				}
				
				if(isset($_REQUEST['menjajKorisnike']))
				{
					$korisnici = (empty($_REQUEST['selKorisnici']) ?  null :$_REQUEST['selKorisnici']);
					if($korisnici)
					{
					echo("<form method='POST' action='admin.php'>");
					echo("<table>");
						echo("<tr>");
							echo("<th>Username</th>");
							echo("<th>Passowrd</th>");
							echo("<th>Name and Surname</th>");
							echo("<th>Email</th>");
							echo("<th>Role</th>");
						echo("</tr>");

						foreach($korisnici as $kor => $val)
						{
							$provera = "SELECT * FROM korisnik WHERE id= ".$val;
							$r = $konekcija->query($provera)->fetch(PDO::FETCH_ASSOC);	
							
							echo("<tr>");
								echo("<td>
									<input type='hidden' name='id[]' value='".$r['id']."' />
									<input type='text' name='korIme[]' value='".$r['username']."' />
									</td>");
								echo("<td>
									<input type='text' name='lozinka' value='".$r['lozinka']."' />
								</td>");
								echo("<td>
									<input type='text' name='ime[]' value='".$r['imeprezime']."' />
								</td>");
								echo("<td>
									<input type='text' name='prezime[]' value='".$r['mejl']."' />
								</td>");
								echo("<td>
									<input type='text' name='tip[]'  value='".$r['uloga_id']."' />
								</td>");
							echo("</tr>");
							
						}
						echo("<tr>");
							echo("<td colspan='5'><input type='submit' value='Save changes' name='sacuvajKorisnike'</td>");
						echo("</tr>");						
					echo("</form>");
					echo("</table>");						
					}else echo("Nothing is selected.");
				}
	
				if(isset($_REQUEST['sacuvajKorisnike']))
				{
					$id_kor = $_REQUEST['id'];
					$korisnicko_ime = $_REQUEST['korIme'];
					$lozinka = md5($_REQUEST['lozinka']);
					$ime = $_REQUEST['ime'];
					$prezime = $_REQUEST['prezime'];
					$tip = $_REQUEST['tip'];
					
					$i=0;
					foreach($id_kor as $id)
					{
						
							$unapredi = "UPDATE korisnik SET username='".$korisnicko_ime[$i]."', lozinka='".$lozinka."'
							, imeprezime='".$ime[$i]."', mejl='".$prezime[$i]."', uloga_id='".$tip[$i]."' WHERE id=$id";
							$r = $konekcija->prepare($unapredi)->execute();	
							if($r)
								echo("You have changed $ime[$i]<br/>");
							else
								echo("You failed to change $ime[$i]<br/>");
						

						$i++;
					}
				}//sacuvaj
			
				if(isset($_REQUEST['obrisiProizvod']))
				{
					$proizvod = (empty($_REQUEST['selProizvodi']) ?  null : $_REQUEST['selProizvodi']);
					if($proizvod)
					{		
						$deleted="";
						foreach($proizvod as $pro => $val)
						{
								$provera = "SELECT * FROM vozila WHERE slika_id=".$val;
								$provera2 = "SELECT * FROM slika WHERE id=".$val;
								$r = $konekcija->query($provera)->fetch(PDO::FETCH_ASSOC);	
								$r2 = $konekcija->query($provera2)->fetch(PDO::FETCH_ASSOC);								
								
								$deleted .= $r['naziv'].':';
								
								$obrisi = "DELETE FROM vozila WHERE slika_id=".$val;
								$obrisi2 = "DELETE FROM slika WHERE id=".$val;
								$konekcija->prepare($obrisi)->execute();
								$konekcija->prepare($obrisi2)->execute();
						}
						$deleted = explode(':', $deleted);
						for($i=0; $i<count($deleted); $i++)
							if($deleted[$i] != "")
								echo("You have deleted ".$deleted[$i].".<br/>");
					}else echo("No car is selected.");
				}
				
				if(isset($_REQUEST['menjajProizvod']))
				{
					$proizvod = (empty($_REQUEST['selProizvodi']) ?  null : $_REQUEST['selProizvodi']);

					if($proizvod)
					{
						echo("<form method='POST' action='admin.php' enctype='multipart/form-data'>");
						echo("<table>");
							echo("<tr>");
								echo("<th>Kategorija</th>");
								echo("<th>Naziv</th>");
								echo("<th>Slike</th>");
								echo("<th>Cena</th>");
							echo("</tr>");

							foreach($proizvod as $pro => $val)
							{
								$provera = "SELECT * FROM vozila h INNER JOIN slika s ON h.slika_id=s.id WHERE h.slika_id= ".$val;
								$r = $konekcija->query($provera)->fetch(PDO::FETCH_ASSOC);	
								
								
								$kategorije = "SELECT * FROM marke WHERE id_marke= ".$r['marka_id'];
								$re = $konekcija->query($kategorije)->fetch(PDO::FETCH_ASSOC);
								
								echo("<tr>");
									echo("<td>
										<input type='hidden' name='id[]' value='".$r['slika_id']."' />
										<input type='text' name='naziv_kat[]' size='4' value='".$re['naziv_marke']."' />
										</td>");
									echo("<td>
										<input type='text' name='naziv_pro[]' size='15' value='".$r['naziv']."' />
										</td>");
									echo("<td>
										<img src='".$r['putanja']."' width='100px' height='100px' />
										<input type='file' name='slike[]' />
									</td>");
									echo("<td>
										<input type='text' name='cena_po_kol[]' size='2'  value='".$r['cena']."' />
									</td>");
								echo("</tr>");
								
							}
							echo("<tr>");
								echo("<td colspan='5'><input type='submit' value=Save changes' name='sacuvajProizvode'</td>");
							echo("</tr>");						
						echo("</form>");
						echo("</table>");

					}else echo("No car was selected.");
				}//menjajKorisnika
			
				if(isset($_REQUEST['sacuvajProizvode']))
				{
					$id_pro = $_REQUEST['id'];
					$naziv_kat = $_REQUEST['naziv_kat'];
					$naziv_pro = $_REQUEST['naziv_pro'];
					
					
					$imeSlike = $_FILES['slike']['name'];
					$tmp_slike = $_FILES['slike']['tmp_name'];
					
					$cena_po_kol = $_REQUEST['cena_po_kol'];
					
					$i=0;
					$root = "image/";
					foreach($id_pro as $id)
					{
						
						$upit_slika = "SELECT * FROM vozila h INNER join slika s ON h.slika_id=s.id WHERE h.slika_id=".$id."";
						$red_slika = $konekcija->query($upit_slika)->fetch();	

						
						$putanjaSlike = ($tmp_slike[$i] != null)? $root.$imeSlike[$i]: $red_slika->alt;
						echo $putanjaSlike."<br/>";

						if($putanjaSlike != $red_slika->alt)
						{
							$rez = move_uploaded_file($tmp_slike[$i], $putanjaSlike);
							
							$putanjaZaKorisnike = $imeSlike[$i];
						}else $putanjaZaKorisnike = $putanjaSlike;
						
						$upit_id_kategorija = "SELECT * FROM marke WHERE naziv_marke LIKE '".$naziv_kat[$i]."'";
						$red_kat = $konekcija->query($upit_id_kategorija)->fetch();
						
						$upit_update = "UPDATE vozila SET marka_id=".$red_kat->id_marke.", naziv='".$naziv_pro[$i]."', cena='".$cena_po_kol[$i]."' WHERE slika_id=$id";
						$upit_update2 = "UPDATE slika SET putanja='".$putanjaSlike."' WHERE id=$id";
						$r = $konekcija->prepare($upit_update)->execute();
						$r2 = $konekcija->prepare($upit_update2)->execute();
						if($r)
							echo("You have changed $naziv_kat[$i] $naziv_pro[$i]<br/>");
						else
							echo("You have failed to change $naziv_kat[$i] $naziv_pro[$i]<br/>");

						$i++;

					}
				}
		
				if(isset($_REQUEST['dodajKor']))
				{
					$korIme = $_REQUEST['korisnickoIme'];
					$lozinka = md5($_REQUEST['korisnikLozinka']);
					$ime = $_REQUEST['korisnikIme'];
					$prezime = $_REQUEST['korisnikPrezime'];
					$uloga = $_REQUEST['korisnikUloga'];

					$greska_dodaj = false;
					
					if(strlen($korIme) == 0)
						$greska_dodaj = true;
					if(strlen($lozinka) == 0)
						$greska_dodaj = true;
					if(strlen($ime) == 0)
						$greska_dodaj = true;
					if(strlen($prezime) == 0)
						$greska_dodaj = true;
					if($uloga == "0")
						$greska_dodaj = true;
					
					if(!$greska_dodaj)
					{
						switch($uloga)
						{
							case "1": $ulogaString = "1"; break;
							case "2": $ulogaString = "2"; break;
						}
						$upit_dodaj_korisnika = "INSERT INTO korisnik(username, lozinka, imeprezime, mejl, uloga_id) 
						VALUES('".$korIme."', '".$lozinka."', '".$ime."', '".$prezime."', '".$ulogaString."')";
						$r = $konekcija->prepare($upit_dodaj_korisnika)->execute();
						if($r)
							echo("User added!");
						else
							echo("User failed to add!");

					}else echo("Some column is empty!");
				}

				if(isset($_REQUEST['dodajPro']))
				{
					$kategorija = $_REQUEST['proizvodKategorija'];
					$ime = $_REQUEST['proizvodIme'];

					$imeSlike = $_FILES['proizvodSlika']['name'];
					$tmpPozSlike = $_FILES['proizvodSlika']['tmp_name'];

					$cena_po_kol = $_REQUEST['proizvodCPK'];
					
					$greska_dodaj = false;
					
					if(strlen($ime) == 0)
						$greska_dodaj = true;
					if(strlen($imeSlike) == 0)
						$greska_dodaj = true;
					if(strlen($cena_po_kol) == 0)
						$greska_dodaj = true;
					if($kategorija == 0)
						$greska_dodaj = true;
					
					if(!$greska_dodaj)
					{
						$rootZaUploadSlika="image/";
						$rootZaBazu="";
						
						$rootZaUploadSlika.=$imeSlike;
						
						move_uploaded_file($tmpPozSlike, $rootZaUploadSlika);
					
						
						$upit_dodaj2 = "INSERT INTO slika(alt,putanja)
						VALUES('".$ime."','$rootZaUploadSlika')";
						
						$r2 = $konekcija->prepare($upit_dodaj2)->execute();
						
						$ids=$konekcija->lastInsertId();

						$upit_dodaj = "INSERT INTO vozila(marka_id, naziv, slika_id ,cena)
						VALUES(".$kategorija.", '".$ime."', '".$ids."' , ".$cena_po_kol.")";
						
						$r = $konekcija->prepare($upit_dodaj)->execute();
						
						
						if($r)
							echo("New car added!");
						else
							echo("New car failed to add!");						
					}else echo("Some column is empty!");
				}
			}
	   
	   
	   
        ?>
		</form>

</div>	