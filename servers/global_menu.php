	
<form name="search" method="get" action="search.php">

<table border=0 width="100%" bgcolor="<?php echo $parsec_table_bgcolor ?>">
<tr>
<td valign="middle" align="left">

[<a href="servers.php">Servers</a>] [<a href="feds.php">Federations</a>] [<a href="players.php">Players</a>]

</td>
<td valign="middle" align="right">

Search in <select name="search_type" size="1">
		
<?php

	if ( $page_type == "servers" ) {
		printf( "<option selected value=\"servers\">Servers</option>\n" );
	} else {
		printf( "<option value=\"servers\">Servers</option>\n" );
	}

	if ( $page_type == "feds" ) {
		printf( "<option selected value=\"federations\">Federations</option>\n" );
	} else {
		printf( "<option value=\"federations\">Federations</option>\n" );
	}

	if ( $page_type == "players" ) {
		printf( "<option selected value=\"players\">Players</option>\n" );
	} else {
		printf( "<option value=\"players\">Players</option>\n" );
	}

?>

</select>
for: <input type="Text" name="search">
<input type="Submit" name="submit" value="  Go  ">

</td>
</tr>
</table>
</form>
