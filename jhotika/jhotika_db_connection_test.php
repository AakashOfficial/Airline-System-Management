<?php
	echo "Jhotika Barta database connection test<br>";

	$jhotika_db_host = 'localhost';
	$jhotika_db_user = 'root';
	$jhotika_db_pass = '';

	if( @mysql_connect($jhotika_db_host,$jhotika_db_user,$jhotika_db_pass) ) {
		echo "MySQL connection successful!<br>";
	} else {
		echo "Error: MySQL connection<br>";
	}

	$jhotika_database_name = 'jhotika_barta';
	if( @mysql_select_db($jhotika_database_name) ) {
		echo $jhotika_database_name." database connection successful!<br>";
	} else {
		echo "Error: database connection<br>";	
	}
?>