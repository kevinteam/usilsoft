<?php
	
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		header('Location: ../views/index.php');
		exit();	
	}
?>