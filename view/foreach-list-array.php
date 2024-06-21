<?php


$emp = [

	[
		'name' => 'Muhammad Haris Ali', 
		'age' => 13, 
		'city' => 'Jacobabd'
	],

	[
		'name' => 'Muhammad Afaan Ali', 
		'age' => 9, 
		'city' => 'Jacobabd'
	],
	
	['name' => 'Muhammad Ayaan Ali', 
	'age' => 8, 
	'city' => 'Jacobabd'
	]
];

foreach ($emp as list('name' => $name,'age' => $age,'city' => $city)) {
	echo $name.' - '.$age.' '.$city;
}
?>