<?php 

	// PARSEC WEB INTERFACE
	// Search page ($Revision: 1.4 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	include 'config.php';
	include 'std_header.php';
	include 'global_menu.php';

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	ConnectMySQL();

	if ( $search != '' ) {
	
		printf( "Search results:<p>\n" );		

		$result_count = 0;

		if ( $search_type == 'servers' ) {

			$query = "SELECT * FROM servers WHERE name LIKE '%$search%' AND confirmkey=''";

			$result = mysql_query( $query );

			while( $row = mysql_fetch_array( $result ) ) {
				printf( "<a href=\"servers.php?serverid=%d\">%s (id: %s)</a><br>\n", $row['serverid'], $row['name'], $row['serverid'] );
				$lastid = $row['serverid'];
				$result_count++;
			}
			
			if ( $result_count == 1 ) {
				printf( "<script type=\"text/javascript\">\n" );
				printf( "window.location.href = \"servers.php?serverid=%d\";\n", $lastid );
				printf( "</script>\n" );
			}

		} else if ( $search_type == 'federations' ) {

			$query = "SELECT * FROM federations WHERE name LIKE '%$search%' AND confirmkey=''";

			$result = mysql_query( $query );

			while( $row = mysql_fetch_array( $result ) ) {
				printf( "<a href=\"feds.php?fedid=%d\">%s (id: %s)</a><br>\n", $row['fedid'], $row['name'], $row['fedid'] );
				$lastid = $row['fedid'];
				$result_count++;
			}

			if ( $result_count == 1 ) {
				printf( "<script type=\"text/javascript\">\n" );
				printf( "window.location.href = \"feds.php?fedid=%d\";\n", $lastid );
				printf( "</script>\n" );
			}

		} else if ( $search_type == 'players' ) {

			$query = "SELECT * FROM players WHERE name LIKE '%$search%' AND confirmkey=''";

			$result = mysql_query( $query );

			while( $row = mysql_fetch_array( $result ) ) {
				printf( "<a href=\"players.php?playerid=%d\">%s (id: %s)</a><br>\n", $row['playerid'], $row['name'], $row['playerid'] );
				$lastid = $row['playerid'];
				$result_count++;
			}
			
			if ( $result_count == 1 ) {
				printf( "<script type=\"text/javascript\">\n" );
				printf( "window.location.href = \"players.php?playerid=%d\";\n", $lastid );
				printf( "</script>\n" );
			}			
		}
	}

	include 'std_footer.php';
?>