<?php
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
    mysql_select_db($db) or die(mysql_error());
?>