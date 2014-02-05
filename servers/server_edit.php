<?php 

	// PARSEC WEB INTERFACE
	// Server edit page ($Revision: 1.9 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$page_type = "servers";
	
	include 'config.php';
	include 'std_header.php';
	include 'global_menu.php';


	function CreateNewServerEntry( $servername, $admin, $region )
	{
		global $PHP_SELF;
		global $parsec_mail_headers;
		global $parsec_testing;
	
		if ( $servername == "" ) {
			printf( "You have to choose a name for your server.<br>" );
			$error = TRUE;
		}

		if ( $admin == "" ) {
			printf( "You have to specify a proper email address of the server admin.<br>" );
			$error = TRUE;
		}
	
		if ( $region == -1 ) {
			printf( "You have to select a valid geographical region for your server!<br>" );
			$error = TRUE;
		} 

		if ( $error ) {
			printf( "<br><a href=\"server_edit.php\">Go back</a> and enter the missing information in the form!<br>" );
			return;
		}
		
		$passwd = "";
		
		mt_srand( time() );
		
		for ( $i = 0; $i < 10; $i++ ) {
		
			switch( mt_rand( 1, 3 ) ) {
			
				case 1:
					$passwd = sprintf( "%s%s", $passwd, chr( mt_rand( 65, 90 ) ) ); 
					break;
					
				case 2:
					$passwd = sprintf( "%s%s", $passwd, chr( mt_rand( 97, 121 ) ) ); 
					break;
					
				case 3:
					$passwd = sprintf( "%s%s", $passwd, chr( mt_rand( 48, 57 ) ) ); 
					break;
			}
		}
	
		$confirm = $passwd;
		
		$query = "INSERT INTO servers VALUES ( NULL, -1, '$servername', '$admin', $region, '$passwd', '$confirm', NULL )";
		$result = mysql_query( $query );
		
		$serverid = mysql_insert_id();
		
		$url = "http://www.openparsec.com/$PHP_SELF?serverid=$serverid&confirm=$confirm";
		
		$subject = "Parsec server registration confirmation required";
				
		$body  = "A Parsec server was registered, and this e-mail address was specified as the admin e-mail address.\n\n";
		$body .= "Name: $servername\n";
		$body .= "Default password: $passwd\n\n";
		$body .= "If you did not register a Parsec server, you can safely ignore this e-mail.\n\n";
		$body .= "Otherwise you can confirm the creation of the server, by visiting this URL:\n";
		$body .= "$url\n\n";
		$body .= "You might want to keep this e-mail as a reference.\n";
		
		$rc = mail( $admin, $subject, $body, $parsec_mail_headers );

		if ( $rc == TRUE ) {
		
			printf( "Server information has been submitted, you should receive an email at $admin, with a request for confirmation.<br>" );
	
			if ( $parsec_testing ) {
				printf( "Confirmation url: <a href=\"%s\">%s</a><br>", $url, $url );
			}
			
		} else {

			printf( "Could not send confirmation e-mail, please try again later." );

			// remove database entries again
			$query = "DELETE FROM servers WHERE serverid=$serverid";
			$result = mysql_query( $query );

			$query = "UPDATE locations SET serverid=-1 WHERE locid=$locid AND serverid != -1";
			$result = mysql_query( $query );
		}
	}


	function EditExistingServerEntry( $serverid, $servername, $admin, $region, $passwd )
	{
		if ( $servername == "" ) {
			printf( "You have to choose a name for your server.<br>" );
			$error = TRUE;
		}

		if ( $admin == "" ) {
			printf( "You have to specify a proper email address of the server admin.<br>" );
			$error = TRUE;
		}
	
		if ( $region == -1 ) {
			printf( "You have to select a valid geographical region for your server!<br>" );
			$error = TRUE;
		} 

		if ( !$error ) {
			$query = "SELECT passwd FROM servers WHERE serverid=$serverid";
			$result = mysql_query( $query );
			$row = mysql_fetch_row( $result );
	
			if ( $row[0] == $passwd ) {
		
				$query = "UPDATE servers SET name='$servername', admin='$admin', region='$region' WHERE serverid=$serverid";
				$result = mysql_query( $query );
	
				printf( "Server information has been submitted." );
				
				// reload map frame
				printf( "<script language=javascript>\n" );
				printf( "top.frames[1].location.reload();" );
				printf( "</script>\n" );					
				
			} else {
	
				printf( "Password was incorrect.<br>" );
				$error = TRUE;
			}
		}
		
		if ( $error ) {
			printf( "<br><a href=\"server_edit.php\">Go back</a> and enter the required information correctly.<br>" );
			return;
		}
	}
	

	function DeleteServerEntry( $serverid, $passwd )
	{
		$query = "SELECT passwd FROM servers WHERE serverid=$serverid";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );

		if ( $row[0] == $passwd ) {
	
			$query = "DELETE FROM servers WHERE serverid=$serverid";
			$result = mysql_query( $query );

			printf( "The server has been deleted." );
			
			// reload map frame
			printf( "<script language=javascript>\n" );
			printf( "top.frames[1].location.reload();" );
			printf( "</script>\n" );					
			
		} else {

			printf( "Password was incorrect.<br>" );
		}
	}
	

	function ConfirmNewServerEntry( $serverid, $confirm )
	{
		global $PHP_SELF;

		$query = "SELECT serverid, region FROM servers WHERE serverid=$serverid AND confirmkey='$confirm'";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		
		if ( $row[0] ) {

			$region = $row[1];
			
			// check for free locations for popup menu
			$query = "SELECT count(*) FROM locations WHERE serverid = -1 AND region=$region";
			$result = mysql_query( $query );
			$row = mysql_fetch_row( $result );

			if ( $row[0] == 0 ) {
			
				printf( "No free server locations left.<br>\n" );
				printf( "Please try confirming your server later.\n" );
				exit();
			}

			?>
			
			<form method="get" action="<?php echo $PHP_SELF ?>">
			
				Select Server Position: <select name="locid" size="1">
				<?php
	
					// get free locations for popup menu
					$query = "SELECT * FROM locations WHERE serverid = -1 AND region=$region";
					$result = mysql_query( $query );
					while( $row = mysql_fetch_array( $result ) ) {
					
						printf( "<option value=\"%s\">%s/%s</option>", $row['locid'], $row['xpos'], $row['ypos'] );
					}
				?>
				</select>
				<br>
	
				<input type="hidden" name="serverid" value="<?php echo $serverid ?>" >
				<input type="hidden" name="confirm" value="<?php echo $confirm ?>" >
				<input type="Submit" name="submit" value="Select">
		
			</form>
			
			<?php

		} else {
		
			printf( "Server confirmation key was invalid." );		
		}
	}
	
	
	function ConfirmServerLocation( $serverid, $confirm, $locid ) 
	{	
		// check if location is still free
		$query = "SELECT serverid FROM locations WHERE locid=$locid";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );

		if ( $row[0] == '-1' ) {

			$query = "UPDATE servers SET confirmkey='' WHERE serverid=$serverid";
			$result = mysql_query( $query );

			// mark location as in use
			$query = "UPDATE locations SET serverid=$serverid WHERE locid=$locid AND serverid = -1";
			$result = mysql_query( $query );

			// reload map frame
			printf( "<script language=javascript>\n" );
			$query = "SELECT xpos, ypos FROM locations WHERE locid=$locid";
			$result = mysql_query( $query );
			$row = mysql_fetch_array( $result );
			printf( "top.frames[1].location = '/parsec_cgi/map_viewer.php?originx=%d&originy=%d&width=30&height=15';\n", $row['xpos'], $row['ypos'] );
			printf( "</script>\n" );
			
			printf( "Server information for id $serverid at location $locid has been confirmed.<p>" );
			printf( "You can now start your Parsec server, with the specified server id.<br>" );
			printf( "Use the <a href=\"server_edit.php?serverid=%d\">server update page</a> to modify your server's password.", $serverid );

		} else {
		
			printf( "The server location has already been claimed, try another location.<br>\n" );
		}
	}
	
	
	function LeaveFederation( $serverid, $passwd )
	{
		$query = "SELECT passwd FROM servers WHERE serverid=$serverid";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );

		if ( $row[0] == $passwd ) {
	
			$query = "UPDATE servers SET fedid=-1 WHERE serverid=$serverid";
			$result = mysql_query( $query );

			printf( "The server with id %d has left the federation.", $serverid );
			
		} else {

			printf( "Password was incorrect." );			
		}

	}
	
	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	ConnectMySQL();

	if ( $submit == 'Update' && $serverid ) {

		// update properties for existing server table entry
		EditExistingServerEntry( $serverid, $servername, $admin, $region, $passwd );
		
	} else if ( $submit == 'Register' ) {

		// create new server table entry
		CreateNewServerEntry( $servername, $admin, $region );
		
	} else if ( $confirm && $serverid ) {

		// confirm an already existing server table entry or location
		
		if ( $submit == 'Select' && $locid ) {
		
			ConfirmServerLocation( $serverid, $confirm, $locid );
			
		} else {
			
			ConfirmNewServerEntry( $serverid, $confirm );
		}

	} else if ( $submit == 'Leave Federation' && $serverid ) {

		if ( $passwd ) {

			LeaveFederation( $serverid, $passwd );
			
		} else {
		
			?>
			Confirm the federation leave with your server password:<p>
			
			<form method="get" action="<?php echo $PHP_SELF ?>">
			<input type=hidden name="serverid" value="<?php echo $serverid ?>">
			<table>
			<tr>
			<td>Password: </td><td><input type="password" name="passwd" size=16>  
			<a href="passwd_mail.php?serverid=<?php echo $serverid ?>">Forgot Password?</a></td>
			</tr>
			</table>
			<p>
			<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td>
			<input type="Submit" name="submit" value="Leave Federation">
			</td></tr></table>

			</form>
			<?php
		}
		
	} else if ( $submit == 'Delete' && $serverid ) {
	
		if ( $passwd ) {
	
			DeleteServerEntry( $serverid, $passwd );
			
		} else {
		
			?>
			Confirm the deletion of this server with your server password:<p>
			
			<form method="get" action="<?php echo $PHP_SELF ?>">
			<input type=hidden name="serverid" value="<?php echo $serverid ?>">
			<table>
			<tr>
			<td>Password: </td><td><input type="password" name="passwd" size=16>  
			<a href="passwd_mail.php?serverid=<?php echo $serverid ?>">Forgot Password?</a></td>
			</tr>
			</table>
			<p>
			<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td>
			<input type="Submit" name="submit" value="Delete">
			</td></tr></table>

			</form>
			<?php		
		}
			
	} else {

		// nothing was submitted, present user interface

		if ( $serverid ) {

			// edit existing server entry
		
			$query = "SELECT * FROM servers WHERE serverid=$serverid";
			$result = mysql_query( $query );
			$row = mysql_fetch_array( $result );
			
			$fedid = $row['fedid'];
		?>

		<form method="get" action="<?php echo $PHP_SELF ?>">
		
			<input type=hidden name="serverid" value="<?php echo $row['serverid'] ?>">
			<table cellpadding="2">
			<tr>
			<td>Server Name: </td><td><input type="Text" name="servername" value="<?php echo $row['name'] ?>" size=32></td>
			</tr><tr>
			<td>Server Admin Email Address: </td><td><input type="Text" name="admin" value="<?php echo $row['admin'] ?>" size=32></td>
			</tr><tr>
			<!--
			<td>Region: </td><td><select name="region" size="1" value="3">
			<option value="-1">-- Select the geographical region of the server --</option>
			<?php
				/*
				$regionid = $row['region'];

				// get all regions for popup menu
				$query = "SELECT * FROM regions";
				$result = mysql_query( $query );
				while( $row = mysql_fetch_array( $result ) ) {
					
					if ( $regionid == $row['regionid'] ) {
						printf( "<option selected value=\"%s\">%s</option>", $row['regionid'], $row['name'] );					
					} else {
						printf( "<option value=\"%s\">%s</option>", $row['regionid'], $row['name'] );
					}
				}
				*/
			?>
			</select></td>
			</tr><tr>
			-->
			<td>Region: </td><td>
			<?php

				$regionid = $row['region'];
				$query = "SELECT name FROM regions WHERE regionid=$regionid";
				$result2 = mysql_query( $query );
				$row2 = mysql_fetch_row( $result2 );
				
				if ( $row2[ 0 ] ) {
					printf( "%s", $row2[ 0 ] );
				}
				
			?>
			</td>
			</tr><tr>

			<td>Federation: </td><td>

			<?php
			
				if ( $fedid == -1 ) {
				
					printf( "none" );
				
				} else {
				
					$result = mysql_query( "SELECT name FROM federations WHERE fedid='$fedid'" );
					$row = mysql_fetch_row( $result );
					
					printf( "<a href=\"feds.php?fedid=%d\">%s</a>", $fedid, $row[0] );
				
				}
			?>
			
			</td>
			</tr><tr>
			<td>Password: </td><td><input type="password" name="passwd" size=16>  
			<a href="passwd_mail.php?serverid=<?php echo $serverid ?>">Forgot Password?</a></td>
			</tr>
			</table>
			<p>
			
			<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td width="2%">
			<input type="Submit" name="submit" value="Update">
			</td>
			
			<?php
			if ( $fedid != -1 ) {
			?>
			
				<form method="get" action="<?php echo $PHP_SELF ?>">
				<td width="2%">
				<input type=hidden name="serverid" value="<?php echo $serverid ?>">
					<input type="Submit" name="submit" value="Leave Federation">
				</td>
				</form>
			<?php
			}
			?>

			<form method="get" action="passwd_chg.php">
			<td width="2%">
			<input type=hidden name="serverid" value="<?php echo $serverid ?>">
				<input type="Submit" name="submit" value="Change Password">
			</td>
			</form>

			<form method="get" action="server_edit.php">
			<td>
			<input type=hidden name="serverid" value="<?php echo $serverid ?>">
				<input type="Submit" name="submit" value="Delete">
			</td>
			</form>
			
			</tr></table>
	
		</form>
		
		<?php
		
		} else {

		?>
		
		<form method="get" action="<?php echo $PHP_SELF ?>">
		
			<table>
			<tr>
			<td>Server Name: </td><td><input type="Text" name="servername" size=32>*</td>
			</tr>
			<tr>
			<td>Server Admin Email Address: </td><td><input type="Text" name="admin" size=32>*</td>
			</tr>
			<tr>
			<td>Region: </td><td><select name="region" size="1">
			<option value="-1">-- Select the geographical region of the server --</option>
			<?php

				// get all regions for popup menu
				$query = "SELECT * FROM regions";
				$result = mysql_query( $query );
				while( $row = mysql_fetch_array( $result ) ) {
				
					printf( "<option value=\"%s\">%s</option>", $row['regionid'], $row['name'] );
				}
			?>
			</select>*</td>
			</tr>
			</table>
			<br>
			Fields marked with * have to be filled in.
			<p>

			<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td>
			<input type="Submit" name="submit" value="Register">
			</td></tr></table>
	
		</form>
		<p>
		
		<?php
		
		}
	}
	
	include 'std_footer.php';
?>
