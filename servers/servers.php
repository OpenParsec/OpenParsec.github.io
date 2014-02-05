<?php 

	// PARSEC WEB INTERFACE
	// Server list page ($Revision: 1.9 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$page_type = "servers";

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	include 'config.php';

	$list_length = $parsec_default_list_length;

	$length_stored = FALSE;
	
	// check for user-specified list length, and store it in a cookie
	if ( $length > 0 ) {

		$list_length = $length;
		
		setcookie( "parsec_list_length", $length );
		
		$length_stored = TRUE;
	}

	// store sort property in cookie
	if ( $sort ) {

		setcookie( "parsec_sort_property", $sort );
	}
	
	// beginning of page output

	include 'std_header.php';
	include 'global_menu.php';

	ConnectMySQL();
	
	if ( !$offset ) {
		$offset = 0;
	}

	// check for the cookies
	if ( $_COOKIE["parsec_list_length"] && !$length_stored ) {
		$list_length = $_COOKIE["parsec_list_length"];
	}

	if ( $_COOKIE["parsec_sort_property"] && !$sort ) {
		$sort = $_COOKIE["parsec_sort_property"];
	}
	
	if ( !$sort ) {
		$sort = "serverid";
	}

	if ( $serverid ) {
	
		$query = "SELECT * FROM servers WHERE confirmkey='' AND serverid=$serverid";
		
	} else if ( $fedid ) {

		if ( $sort ) {
		
			$query = "SELECT * FROM servers WHERE confirmkey='' AND fedid=$fedid ORDER BY $sort LIMIT $offset,$list_length";
			
		} else {
		
			$query = "SELECT * FROM servers WHERE confirmkey='' AND fedid=$fedid LIMIT $offset,$list_length";
		}
			
		$count_query = "SELECT COUNT(*) FROM servers WHERE confirmkey='' AND fedid=$fedid"; 

	} else {

		if ( $sort ) {
		
			$query = "SELECT * FROM servers WHERE confirmkey='' ORDER BY $sort LIMIT $offset,$list_length";
			
		} else {
		
			$query = "SELECT * FROM servers WHERE confirmkey='' LIMIT $offset,$list_length";
		}
			
		$count_query = "SELECT COUNT(*) FROM servers WHERE confirmkey=''"; 

	}


	if ( $count_query ) {
	
		$count_result = mysql_query( $count_query );

		$row = mysql_fetch_row( $count_result );
		
		$count = $row[0];
	}

	$result = mysql_query( $query );

	printf( "<center>\n" );
	printf( "<table cellpadding=3 cellspacing=3 width=95%%>\n" );
	printf( "<tr><td bgcolor=$parsec_table_bgcolor></td>\n" );
	printf( "<td bgcolor=$parsec_table_bgcolor>" );
	
	if ( $sort == "name" ) {
		printf( "Servername</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=name\">Servername</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "serverid" ) {
		printf( "Server ID</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=serverid\">Server ID</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "region" ) {
		printf( "Region</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=region\">Region</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "fedid" ) {
		printf( "Federation</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=fedid\">Federation</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "admin" ) {
		printf( "Server Admin</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=admin\">Server Admin</a></td>\n" );
	}

	printf( "</tr>\n" );

	while( $row = mysql_fetch_array( $result ) ) {

		printf( "<tr><td align=center>[<a href=\"server_edit.php?serverid=%s\">Edit</a>]</td>", $row['serverid'] );
		printf( "	 <td><a href=\"$PHP_SELF?serverid=%s\">%s</a></td>", $row['serverid'], $row['name'] );
		printf( "	 <td><a href=\"$PHP_SELF?serverid=%s\">%s</a></td>", $row['serverid'], $row['serverid'] );
		
		$query2 = sprintf( "SELECT name FROM regions WHERE regionid=%s", $row['region'] );
		$result2 = mysql_query( $query2 );
		$row2 = mysql_fetch_row( $result2 );
		
		printf( "	 <td>%s</td>", $row2[0] );
					
		if ( $row['fedid'] != "-1" ) {
		
			$query2 = sprintf( "SELECT name FROM federations WHERE fedid=%s", $row['fedid'] );
			$result2 = mysql_query( $query2 );
		
			$row2 = mysql_fetch_row( $result2 );
			
			printf( "<td><a href=\"feds.php?fedid=%s\">%s</a></td>", $row['fedid'], $row2[0] );
			printf( "<td>%s</td>\n", str_replace( "@", "(at)", $row['admin'] ) );
			
		} else {
			
			printf( "<td>none</td><td>%s</td>\n", str_replace( "@", "(at)", $row['admin'] ) );
		}

		printf( "</tr>\n" );
	}

	printf( "</table>\n" );

	if ( $count ) {

		printf( "<form name=\"list\" method=\"get\" action=\"servers.php\">" );
		printf( "<table cellpadding=3 cellspacing=0 width=95%%>\n" );

		$page_count = $count / $list_length;
		
		$current_page = (int) $offset / $list_length;
		
		printf( "<tr><td bgcolor=$parsec_table_bgcolor valign=middle align=left>Page: " );
		
		for ( $i = 0; $i < $page_count; $i++ ) {
		
			if ( $i == $current_page ) {
				
				printf( " [%d] ", $i + 1 );
	
			} else {
		
				printf( "[<a href=\"$PHP_SELF?offset=%d&length=%d\">%d</a>] ", $i * $list_length, $list_length, $i + 1 );
			}
		}
		printf( "(Total results: %d)", $count );
		printf( "</td>" );
		printf( "<td bgcolor=$parsec_table_bgcolor valign=middle align=right>" );
		printf( "Show <input type=\"Text\" name=\"length\" size=4> results <input type=\"submit\" name=\"submit\" value=\"Change\">" );
		printf( "</td>" );
		printf( "</tr>" );
		printf( "</table>\n" );
		printf( "</form>" );

	}

	printf( "</center>\n" );

	if ( $serverid ) {
	
		$result = mysql_query( "SELECT t1.*, t2.name as regionname FROM servers as t1, regions as t2 WHERE t1.confirmkey='' AND t1.serverid='$serverid' AND t1.region=t2.regionid" );
		$row = mysql_fetch_array( $result );
	
		printf( "<p>Detailed informations about server %s<p>", $serverid );
		printf( "Name: %s<br>", $row['name'] );
		
		$result2 = mysql_query( "SELECT xpos, ypos FROM locations WHERE serverid='$serverid'" );
		$row2 = mysql_fetch_array( $result2 );

		$resx = $parsec_map_width;
		$resy = $parsec_map_height;
		$originx = $row2['xpos'];
		$originy = $row2['ypos'];
		$width = 35;
		$height = $width * $parsec_map_aspect_ratio;

		$map_url = "map_viewer.php?resx=$resx&resy=$resy&originx=$originx&originy=$originy&width=$width&height=$height";
		
		printf( "Position: %s/%s  [<a href=\"%s\" target=\"map\">Show on Map</a>]<br>", $row2['xpos'], $row2['ypos'], $map_url );
		printf( "Server Admin: %s<br>", str_replace( "@", "(at)", $row['admin'] ) );
		printf( "Region: %s<br>", $row['regionname'] );
		
		if ( $row['fedid'] == -1 ) {
		
			printf( "Not a federation member<br>" );
			
		} else {
		
			$fedid = $row['fedid'];
		
			$result2 = mysql_query( "SELECT name FROM federations WHERE fedid='$fedid'" );
			$row2 = mysql_fetch_row( $result2 );
			
			printf( "Member of federation: <a href=\"feds.php?fedid=%s\">%s</a>  ", $fedid, $row2[0] );
			printf( "[<a href=\"server_edit.php?serverid=%s&submit=Leave+Federation\">Leave</a>]<br>", $serverid );
		}
	}
?>

	<p>
	<table bgcolor=<?php echo $parsec_table_bgcolor ?> width="100%">
	<tr>
	<td>
	[<a href="server_edit.php">Register New Server</a>]
	
	<?php 
		if ($serverid) {
			echo "[<a href=\"server_edit.php?serverid=$serverid\">Update Server Information</a>] ";
		}
	?>
	</td>
	<td align="right">
	[<a onClick="openMap()" href="servers.php">Show Map</a>]	
	
	</td>
	</tr>
	</table>
	</p>

<?php
	include 'std_footer.php';
?>