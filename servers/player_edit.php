<?php 

	// PARSEC WEB INTERFACE
	// Server list page ($Revision: 1.7 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$page_type = "players";
	
	include 'config.php';
	include 'std_header.php';
	include 'global_menu.php';

	function CreateNewPlayerEntry( $name, $email, $country )
	{
		global $PHP_SELF;
	
		if ( $name == "" ) {
			printf( "You have to choose your nick name.<br>" );
			$error = TRUE;
		}

		if ( $email == "" ) {
			printf( "You have to specify your email address.<br>" );
			$error = TRUE;
		}
	
		if ( $country == -1 ) {
			printf( "You have to select a valid country!<br>" );
			$error = TRUE;
		}
	
		if ( $error ) {
			printf( "<br><a href=\"player_edit.php\">Go back</a> and enter the missing information in the form!<br>" );
			return;
		}

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
		
		$query = "INSERT INTO players VALUES ( NULL, '$name', '$email', '$country', '$passwd', '$confirm', 0, NULL )";
		$result = mysql_query( $query );
		
		$playerid = mysql_insert_id();

		$url = "http://www.openparsec.com/$PHP_SELF?playerid=$playerid&confirm=$confirm";
		
		$subject = "Parsec player registration confirmation required";
				
		$body  = "A Parsec player was registered, and this e-mail address was specified.\n\n";
		$body .= "Player name: $name\n";
		$body .= "Default password: $passwd\n\n";
		$body .= "If you did not register as a Parsec player, you can safely ignore this e-mail.\n\n";
		$body .= "Otherwise you can confirm your registration by visiting this URL:\n";
		$body .= "$url\n\n";
		$body .= "You might want to keep this e-mail as a reference.\n";
		
		$rc = mail( $email, $subject, $body, $parsec_mail_headers );
		
		if ( $rc == TRUE ) {

			printf( "Player information has been submitted, you should receive an email at $email, with a request for confirmation.<br>" );
	
			if ( $parsec_testing ) {
				printf( "Confirmation url: <a href=\"%s\">%s</a><br>", $url, $url );
			}
			
		} else {
		
			printf( "Could not send confirmation e-mail, please try again later." );

			// remove database entries again
			$query = "DELETE FROM players WHERE playerid=$playerid";
			$result = mysql_query( $query );
		}
	}


	function EditExistingPlayerEntry( $playerid, $name, $email, $country, $passwd )
	{
		if ( $name == "" ) {
			printf( "You have to choose your nick name.<br>" );
			$error = TRUE;
		}

		if ( $email == "" ) {
			printf( "You have to specify your email address.<br>" );
			$error = TRUE;
		}
	
		if ( $country == -1 ) {
			printf( "You have to select a valid country!<br>" );
			$error = TRUE;
		}

		if ( !$error ) {
			$query = "SELECT passwd FROM players WHERE playerid=$playerid";
			$result = mysql_query( $query );
			$row = mysql_fetch_row( $result );
	
			if ( $row[0] == $passwd ) {
		
				$query = "UPDATE players SET name='$name', email='$email', country='$country' WHERE playerid=$playerid";
				$result = mysql_query( $query );
	
				if ( $result ) {
					printf( "Player information has been submitted." );
				} else {
					printf( "Database error." );
				}
				
			} else {
	
				printf( "Password was incorrect.<br>" );			
				$error = TRUE;
			}
		}
		
		if ( $error ) {
			printf( "<br><a href=\"fed_edit.php\">Go back</a> and enter the required information correctly.<br>" );
			return;
		}
	}
	
	
	function DeletePlayerEntry( $playerid, $passwd )
	{
		$query = "SELECT passwd FROM players WHERE playerid=$playerid";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );

		if ( $row[0] == $passwd ) {
	
			$query = "DELETE FROM players WHERE playerid=$playerid";
			$result = mysql_query( $query );

			printf( "The player has been deleted." );
			
		} else {

			printf( "Password was incorrect.<br>" );
		}
	}
	
	
	function ConfirmPlayerEntry( $playerid, $confirm )
	{
		$query = "SELECT playerid FROM players WHERE playerid=$playerid AND confirmkey='$confirm'";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		
		if ( $row[0] ) {
			$query = "UPDATE players SET confirmkey='' WHERE playerid=$row[0]";
			$result = mysql_query( $query );
			
			printf( "Player information for id $row[0] has been confirmed." );
			
		} else {
		
			printf( "Player confirmation key was invalid." );		
		}
	}

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	ConnectMySQL();

	if ( $submit == 'Update' && $playerid ) {
	
		// update properties for existing player table entry
		EditExistingPlayerEntry( $playerid, $name, $email, $country, $passwd );
		
	} else if ( $submit == 'Register' ) {
		
		// create new player table entry
		CreateNewPlayerEntry( $name, $email, $country );
		
	} else if ( $confirm && $playerid ) {

		// confirm an already existing player table entry
		ConfirmPlayerEntry( $playerid, $confirm );

	} else if ( $submit == 'Delete' && $playerid ) {
	
		if ( $passwd ) {
	
			DeletePlayerEntry( $playerid, $passwd );
			
		} else {
		
			?>
			Confirm the deletion of this player with your password:<br>
			
			<form method="get" action="<?php echo $PHP_SELF ?>">
			<input type=hidden name="playerid" value="<?php echo $playerid ?>">
			<table>
			<tr>
			<td>Password: </td><td><input type="password" name="passwd" size=16>  
			<a href="passwd_mail.php?playerid=<?php echo $playerid ?>">Forgot Password?</a></td>
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

		// nothing submitted, present user interface

		if ( $playerid ) {
		
			$query = "SELECT * FROM players WHERE playerid=$playerid";
			$result = mysql_query( $query );
			$row = mysql_fetch_array( $result );
			
		?>

		<form method="get" action="<?php echo $PHP_SELF ?>">
		
			<input type=hidden name="playerid" value="<?php echo $row['playerid'] ?>">
			<table>
			<tr>
			<td>Player Nick: </td><td><input type="Text" name="name" value="<?php echo $row['name'] ?>" size=32></td>
			</tr><tr>
			<td>Player Email Address: </td><td><input type="Text" name="email" value="<?php echo $row['email'] ?>" size=32></td>
			</tr><tr>
			<td>Player Country: </td><td><select name="country">
			<option value="-1">-- Select your country --</option>
			<?php

				$countryname = $row['country'];

				// get all countries for popup menu
				$query = "SELECT * FROM countries";
				$result = mysql_query( $query );
				while( $row = mysql_fetch_array( $result ) ) {
				
					if ( $row['name'] == $countryname ) {
						printf( "<option selected value=\"%s\">%s</option>", $row['name'], $row['name'] );
					} else {
						printf( "<option value=\"%s\">%s</option>", $row['name'], $row['name'] );
					}
				}
			?>
			</select></td>
			</tr><tr>
			<td>Password: </td><td><input type="password" name="passwd" size=16>   
			<a href="passwd_mail.php?playerid=<?php echo $playerid ?>">Forgot Password?</a></td>
			</tr>
			</table>
			<p>
			
			<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td width="2%">
			<input type="Submit" name="submit" value="Update">
			</td>
			
			<form method="get" action="passwd_chg.php">
			<td width="2%">
			<input type=hidden name="playerid" value="<?php echo $playerid ?>">
			<input type="Submit" name="submit" value="Change Password">
			</td>
			</form>
			
			<form method="get" action="player_edit.php">
			<td>
			<input type=hidden name="playerid" value="<?php echo $playerid ?>">
			<input type="Submit" name="submit" value="Delete">
			</td>
			</form>

			</tr></table>
	
		</form>
		
		<?php
		
		} else {

		?>
		
		<form method="get" action="<?php echo $PHP_SELF ?>">
		
			<table><tr>
			<td>Player Nick: </td><td><input type="Text" name="name" size=32></td>
			</tr><tr>
			<td>Player Email Address: </td><td><input type="Text" name="email" size=32></td>
			</tr><tr>
			<td>Player Country: </td><td><select name="country">
			<option value="-1">-- Select your country --</option>
			<?php

				// get all countries for popup menu
				$query = "SELECT * FROM countries";
				$result = mysql_query( $query );
				while( $row = mysql_fetch_array( $result ) ) {
				
					printf( "<option value=\"%s\">%s</option>", $row['name'], $row['name'] );
				}
			?>
			</select></td>
			</tr>
			</table>
			<p>
			
			<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td>
			<input type="Submit" name="submit" value="Register">
			</td>
			</tr></table>
	
		</form>
		<p>
		
		<?php
		
		}
	}
	
	include 'std_footer.php';
?>
