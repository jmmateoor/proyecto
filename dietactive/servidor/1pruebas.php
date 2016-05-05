<?php
$alimentos=$_POST["alimentos"];
$cantidad=$_POST["cantidad"];

for($i=0;$i<count($alimentos);$i++)
{
	echo $alimentos[$i]." ".$cantidad[$i];
}
?>