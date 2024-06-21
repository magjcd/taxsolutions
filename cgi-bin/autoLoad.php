<?php

// This method is Depracated in Upper versions of PHP and does'nt work on Live Servers

// function __autoload($class){
// 	include("controller/".$class.".php");
// }



// Both below methods will work on Live Servers

// function autoloadclass($class){
// 	include('controller/'.$class.'.php');
// }

// spl_autoload_register('autoloadclass');
spl_autoload_register(function($class){
	include('controller/'.$class.'.php');
});

// spl_autoload_register(function($class){
// 	include('model/'.$class.'.php');
// });



?>