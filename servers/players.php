<?php 

	// PARSEC WEB INTERFACE
	// Player list page ($Revision: 1.7 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$page_type = "players";
	
	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	include 'config.php';

	$list_length = $parsec_default_list_length;

	$length_stored = FALSE;
	
	// check for user-specified list length, and store it in a cookie
	if ( $length > 0 ) {

		$list_length = $length;
		
		setcookie ("parsec_list_length", $length);
		
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
		$sort = "playerid";
	}

	if ( $playerid ) {

		$query = "SELECT * FROM players WHERE confirmkey='' AND playerid=$playerid";
		
	} else {
	
		if ( $sort ) {
		
			$query = "SELECT * FROM players WHERE confirmkey='' ORDER BY $sort LIMIT $offset,$list_length";
			
		} else {
		
			$query = "SELECT * FROM players WHERE confirmkey='' LIMIT $offset,$list_length";
		}

		$count_query = "SELECT COUNT(*) FROM players WHERE confirmkey=''"; 
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
		printf( "Nick</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=name\">Nick</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "playerid" ) {
		printf( "Player ID</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=playerid\">Player ID</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "email" ) {
		printf( "Email</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=email\">Email</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "country" ) {
		printf( "Country</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=country\">Country</a></td>\n" );
	}
	
	printf( "<td bgcolor=$parsec_table_bgcolor>" );

	if ( $sort == "ranking" ) {
		printf( "Ranking</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=ranking\">Ranking</a></td>\n" );
	}
	
	printf( "</tr>\n" );

	while( $row = mysql_fetch_array( $result ) ) {

		printf( "<tr><td align=center>[<a href=\"player_edit.php?playerid=%s\">Edit</a>]</td>\n", $row['playerid'] );
		printf( "    <td><a href=\"$PHP_SELF?playerid=%s\">%s</a></td>\n", $row['playerid'], $row['name'] );
		printf( "	 <td><a href=\"$PHP_SELF?playerid=%s\">%s</a></td>\n", $row['playerid'], $row['playerid'] );
		printf( "    <td>%s</td>\n", str_replace( "@", "(at)", $row['email'] ) );
		printf( "	 <td>%s</td>\n", $row['country'] );
		printf( "	 <td>%s</td>\n", $row['ranking'] );

		printf( "</tr>\n" );
	}

	printf( "</table>\n" );

	if ( $count ) {

		printf( "<table cellpadding=3 cellspacing=0 width=95%%>\n" );

		$page_count = $count / $list_length;
		
		$current_page = (int) $offset / $list_length;
		
		printf( "<tr><td bgcolor=$parsec_table_bgcolor colspan=6>Page: " );
		
		for ( $i = 0; $i < $page_count; $i++ ) {
		
			if ( $i == $current_page ) {
				
				printf( " [%d] ", $i + 1 );
	
			} else {
		
				printf( "[<a href=\"$PHP_SELF?offset=%d\">%d</a>] ", $i * $list_length, $i + 1 );
			}
		}
		printf( "(Total results: %d)", $count );
		printf( "</td>" );
		printf( "<form>" );
		printf( "<td bgcolor=$parsec_table_bgcolor valign=middle align=right>" );
		printf( "Show <input type=\"Text\" name=\"length\" size=4> results <input type=\"Submit\" name=\"submit\" value=\"Change\"></td>" );
		printf( "</form>" );
		printf( "</tr>" );
		printf( "</table>\n" );

	}

	printf( "</center>\n" );
?>

	<p>
	<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%">
	<tr><td>
	[<a href="player_edit.php">Register New Player</a>] 
	<?php 
		if ($playerid) { 
			echo "[<a href=\"player_edit.php?playerid=$playerid\">Update Player Information</a>]"; 
		}
	?>
	</td></tr>
	</table>
	</p>

<?php
	include 'std_footer.php';
?>