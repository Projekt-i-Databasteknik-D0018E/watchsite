<?php
    $connection = new mysqli("localhost", "root", "123", "watchDB");
	if ($connection -> connect_errorno) {
	echo "Failed to connect to MySQL: " . $connection->connect_error;
	exit();
	}?>
