<?php
	require ("curl.php");
	require ("reniec.php");

	$persona = new Reniec();
	$dni="00000000";

	print_r( $persona->search($dni) );
?>
