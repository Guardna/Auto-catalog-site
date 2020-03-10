<?php
session_start();
if(isset($_POST['btnLogin'])){
	$ime=$_POST['tbIme'];
	$lozinka=$_POST['tbLozinka'];
	
	$errors=[];
	$reime="/^[\S]{2,}$/";
	$relozinka="/^[\S]{2,}$/";
	
	if(!preg_match($reime,$ime)){
		$errors[]="greska sa imenom";
	}
	if(!preg_match($relozinka,$lozinka)){
		$errors[]="greska sa imenom";
	}
	if(count($errors)>0){
		$_SESSION['greske']=$errors;
		header("Location:../index.php");
	}else{
		require_once "konekcija.php";
		$lozinka = md5($lozinka);
		
		$upit="SELECT * FROM korisnik k INNER JOIN uloga u ON k.uloga_id=u.id WHERE username=:ime AND lozinka=:password";
		
		$stmt=$konekcija->prepare($upit);
		$stmt->bindParam(":ime",$ime);
		$stmt->bindParam(":password",$lozinka);
		
		$stmt->execute();
		$user=$stmt->fetch();
		
		if($user){
			$_SESSION['korisnik']=$user;
			header("Location:../index.php");
		}else{
			$_SESSION['greske']="pogresan user ili pass";
			header("Location:../index.php");
		}
	}
}