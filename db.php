<?php

include_once('settings.php');

function db_connection(){
	$connect = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
		or die(mysqli_error($connect));
	return $connect;
}

$connect = db_connection();
