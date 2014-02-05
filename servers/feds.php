<?php 

	// PARSEC WEB INTERFACE
	// Federation list page ($Revision: 1.7 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$page_type = "feds";
	
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
		$sort = "fedid";
	}

	if ( $fedid ) {

		$query = "SELECT * FROM federations WHERE confirmkey='' AND fedid=$fedid";
		
	} else {
	
		if ( $sort ) {
		
			$query = "SELECT * FROM federations WHERE confirmkey='' ORDER BY $sort LIMIT $offset,$list_length";
			
		} else {
		
			$query = "SELECT * FROM federations WHERE confirmkey='' LIMIT $offset,$list_length";
		}
	
		$count_query = "SELECT COUNT(*) FROM federations WHERE confirmkey=''"; 
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
		printf( "Federation Name</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=name\">Federation Name</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );
	
	if ( $sort == "fedid" ) {
		printf( "Federation ID</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=fedid\">Federation ID</a></td>\n" );
	}

	printf( "<td bgcolor=$parsec_table_bgcolor>" );
	
	if ( $sort == "owner" ) {
		printf( "Owner</td>\n" );
	} else {
		printf( "<a href=\"$PHP_SELF?sort=owner\">Owner</a></td>\n" );
	}
		

	printf( "<td bgcolor=$parsec_table_bgcolor>Number of Members</td>\n" );
	printf( "</tr>\n" );

	while( $row = mysql_fetch_array( $result ) ) {

		printf( "<tr><td align=center>[<a href=\"fed_edit.php?fedid=%s\">Edit</a>]/[<a href=\"fed_join.php?fedid=%s\">Join</a>]</td>", $row['fedid'], $row['fedid'] );
		printf( "    <td><a href=\"$PHP_SELF?fedid=%s\">%s</a></td>", $row['fedid'], $row['name'] );
		printf( "	 <td><a href=\"$PHP_SELF?fedid=%s\">%s</a></td>", $row['fedid'], $row['fedid'] );

		printf( "<td>%s</td>\n", str_replace( "@", "(at)", $row['owner'] ) );
					 
		$query2 = sprintf( "SELECT COUNT(*) FROM servers WHERE fedid=%s AND confirmkey=''", $row['fedid'] );
		$result2 = mysql_query( $query2 );
		
		$row2 = mysql_fetch_row( $result2 );

		$num_members = $row2[0];

		printf( "<td>%d", $num_members );
		if ( $num_members > 0 ) {
			printf( " [<a href=\"servers.php?fedid=%s\">Show</a>]", $row['fedid'] );
		}
		printf( "</td>" );
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
	[<a href="fed_edit.php">Register New Federation</a>] 
	<?php 
		if ($fedid) { 
			echo "[<a href=\"fed_edit.php?fedid=$fedid\">Update Federation Information</a>] "; 
			echo "[<a href=\"fed_join.php?fedid=$fedid\">Join Federation</a>]"; 
		}
	?>
	</td></tr>
	</table>
	</p>
	
<?php
	include 'std_footer.php';
?>