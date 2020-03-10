<?php
$vote =6;
if(!isset($_COOKIE['adresa'])){
$vote = $_REQUEST['vote'];

$ip = '';
    if($_SERVER['REMOTE_ADDR'])
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = 'none';
        setcookie(
  "adresa",
  "$ip",
  time() + (10 * 365 * 24 * 60 * 60)
);

}
//get content of textfile
$filename = "poll_result.txt";
$content = file($filename);

//put content in array
$array = explode("||", $content[0]);
$mercedes = $array[0];
$bmw = $array[1];
$tesla = $array[2];
$volkswagen = $array[3];

if ($vote == 0) {
  $mercedes = $mercedes + 1;
}
if ($vote == 1) {
  $bmw = $bmw + 1;
}
if ($vote == 2) {
  $tesla = $tesla + 1;
}

if ($vote == 3) {
  $volkswagen = $volkswagen + 1;
}



//insert votes to txt file
$insertvote = $mercedes."||".$bmw."||".$tesla."||".$volkswagen;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>
<h4 style="color:#d6d3d3;">Results:</h4>
<table align="center">
<tr>
<td>Mercedes:</td>
<td>
<img src="image/line.png"
width='<?php echo(100*round($mercedes/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>'
height='20'>
<?php echo(100*round($mercedes/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>%
</td>
</tr>
<tr>
<td>BMW:</td>
<td>
<img src="image/line.png"
width='<?php echo(100*round($bmw/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>'
height='20'>
<?php echo(100*round($bmw/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>%
</td>
</tr>
<tr>
<td>Tesla:</td>
<td>
<img src="image/line.png"
width='<?php echo(100*round($tesla/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>'
height='20'>
<?php echo(100*round($tesla/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>%
</td>
</tr>
<tr>
<td>Volkswagen:</td>
<td>
<img src="image/line.png"
width='<?php echo(100*round($volkswagen/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>'
height='20'>
<?php echo(100*round($volkswagen/($mercedes+$bmw+$tesla+$volkswagen),4)); ?>%
</td>
</tr>
</table>