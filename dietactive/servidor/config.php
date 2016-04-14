<?php
//Base de Datos
$servidor="localhost";
$usuario="root";
$password="1234";
$bbdd="dietactive";
//$c = new MySQLi($servidor,$usuario,$password,$bbdd);
//$c->set_charset("utf8");
//Fin Base de Datos

//Funciones
function genera_random($longitud){  
    $exp_reg="[^A-Z0-9]";  
    return substr(preg_replace($exp_reg, "", md5(rand())) .  
       preg_replace($exp_reg, "", md5(rand())) .  
       preg_replace($exp_reg, "", md5(rand())),  
       0, $longitud);  
}
//Fin Funciones
?>