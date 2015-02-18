<?php

	
	require "database.php";
	require "data/data_context.php";
	
 
	$actor = $ctx->actor->get_by_key(10);
	$city = $ctx->city->get_by_key(10);
 	 
	
	echo "<pre>";
	var_dump($actor);
	echo "</pre>";

	echo "<pre>";
	var_dump($city);
	echo "</pre>";
	
	$city->city = "Cuiabá!";

	$ctx->city->update($city);

?>


