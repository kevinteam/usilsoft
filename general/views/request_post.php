<?php
    $base_inicial  = $base_general."/inicial";

	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
        header("Location: ".$base_inicial."/views/index.php");
		exit();	
	}
?>