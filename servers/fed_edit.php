<?php 

	// PARSEC WEB INTERFACE
	// Federation edit page ($Revision: 1.8 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$page_type = "feds";
	
	include 'config.php';
	include 'std_header.php';
	include 'global_menu.php';

	function CreateNewFederationEntry( $name, $owner )
	{
		global $PHP_SELF;
		
		if ( $name == "" ) {
			printf( "You have to choose a name for your federation.<br>" );
			$error = TRUE;
		}

		if ( $owner == "" ) {
			printf( "You have to specify a proper email address of the federation owner.<br>" );
			$error = TRUE;
		}
	
		if ( $error ) {
			printf( "<br><a href=\"fed_edit.php\">Go back</a> and enter the missing information in the form!<br>" );
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
		
		$query = "INSERT INTO federations VALUES ( NULL, '$name', '$owner', '$passwd', '$confirm', NULL )";
		$result = mysql_query( $query );
		
		$fedid = mysql_insert_id();

		$url = "http://localhost$PHP_SELF?fedid=$fedid&confirm=$confirm";
		
		$subject = "Parsec federation registration confirmation required";
				
		$body  = "A Parsec federation was registered, and this e-mail address was specified as the owner e-mail address.\n\n";
		$body .= "Federation Name: $name\n";
		$body .= "Default password: $passwd\n\n";
		$body .= "If you did not register a Parsec federation, you can safely ignore this e-mail.\n\n";
		$body .= "Otherwise you can confirm the creation of the federation, by visiting this URL:\n";
		$body .= "$url\n\n";
		$body .= "You might want to keep this e-mail as a reference.\n";
		
		$rc = mail( $owner, $subject, $body, $parsec_mail_headers );

		if ( $rc == TRUE ) {
		
			printf( "Federation information has been submitted, you should receive an email at $owner, with a request for confirmation.<br>" );
	
			if ( $parsec_testing ) {
				printf( "Confirmation url: <a href=\"%s\">%s</a><br>", $url, $url );
			}
			
		} else {

			printf( "Could not send confirmation e-mail, please try again later." );

			// remove database entries again
			$query = "DELETE FROM federations WHERE fedid=$fedid";
			$result = mysql_query( $query );
		}
	}
	
	
	function EditExistingFederationEntry( $fedid, $name, $owner, $passwd )
	{
		if ( $name == "" ) {
			printf( "You have to choose a name for your federation.<br>" );
			$error = TRUE;
		}

		if ( $owner == "" ) {
			printf( "You have to specify a proper email address of the federation owner.<br>" );
			$error = TRUE;
		}
	
		if ( !$error ) {
			$query = "SELECT passwd FROM federations WHERE fedid=$fedid";
			$result = mysql_query( $query );
			$row = mysql_fetch_row( $result );
	
			if ( $row[0] == $passwd ) {
		
				$query = "UPDATE federations SET name='$name', owner='$owner' WHERE fedid=$fedid";
				$result = mysql_query( $query );
	
				printf( "Federation information has been submitted." );
				
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


	function DeleteFederationEntry( $fedid, $passwd )
	{
		$query = "SELECT passwd FROM federations WHERE fedid=$fedid";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );

		if ( $row[0] == $passwd ) {
	
			$query = "DELETE FROM federations WHERE fedid=$fedid";
			$result = mysql_query( $query );

			// remove all servers from this federation
			$query = "UPDATE servers SET fedid=-1 WHERE fedid=$fedid";
			$result = mysql_query( $query );

			printf( "The federation has been deleted." );
			
		} else {

			printf( "Password was incorrect.<br>" );
		}
	}
	

	function ConfirmNewFederationEntry( $fedid, $confirm )
	{
		$query = "SELECT fedid FROM federations WHERE fedid=$fedid AND confirmkey='$confirm'";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		
		if ( $row[0] ) {
			$query = "UPDATE federations SET confirmkey='' WHERE fedid=$row[0]";
			$result = mysql_query( $query );
			
			printf( "Federation information for id $row[0] has been confirmed.<br>" );
			printf( "It is now possible for servers to join this federation, " );
			printf( "by using the <a href=\"fed_join.php?fedid=%d\">federation join page</a>.<br>", $row[0] );
			
		} else {
		
			printf( "Federation confirmation key was invalid." );		
		}
	}


	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	ConnectMySQL();

	if ( $submit == 'Update' && $fedid ) {
	
		// update properties for existing federation table entry
		EditExistingFederationEntry( $fedid, $name, $owner, $passwd );
		
	} else if ( $submit == 'Register' ) {
		
		// create new federation table entry
		CreateNewFederationEntry( $name, $owner );
		
	} else if ( $fedid && $confirm ) {

		// confirm an already existing federation table entry
		ConfirmNewFederationEntry( $fedid, $confirm );
	
	} else if ( $submit == 'Delete' && $fedid ) {
	
		if ( $passwd ) {
	
			DeleteFederationEntry( $fedid, $passwd );
			
		} else {
		
			?>
			Confirm the deletion of this federation with your server password:<br>
			(All servers in the federation will be federation-less!)<p>
			
			<form method="get" action="<?php echo $PHP_SELF ?>">
			<input type=hidden name="fedid" value="<?php echo $fedid ?>">
			<table>
			<tr>
			<td>Password: </td><td><input type="password" name="passwd" size=16>  
			<a href="passwd_mail.php?fedid=<?php echo $fedid ?>">Forgot Password?</a></td>
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

		if ( $fedid ) {
		
			$query = "SELECT * FROM federations WHERE fedid=$fedid";
			$result = mysql_query( $query );
			$row = mysql_fetch_array( $result );
			
		?>

		<form method="get" action="<?php echo $PHP_SELF ?>">
		
			<table><tr>
			<td>Federation Name: </td><td><input type="Text" name="name" value="<?php echo $row['name'] ?>" size=32></td>
			</tr><tr>
			<td>Federation Owner Email Address: </td><td><input type="Text" name="owner" value="<?php echo $row['owner'] ?>" size=32></td>
			</tr><tr>
			<td>Password: </td><td><input type="password" name="passwd" size=16> 
			<a href="passwd_mail.php?fedid=<?php echo $fedid ?>">Forgot Password?</a></td>
			</tr>
			</table>
			<p>
			
			<input type=hidden name="fedid" value="<?php echo $row['fedid'] ?>">
			<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td width="2%">
			<input type="Submit" name="submit" value="Update">
			</td>
	
			<form method="get" action="passwd_chg.php">
			<td width="2%">
			<input type=hidden name="fedid" value="<?php echo $fedid ?>">
			<input type="Submit" name="submit" value="Change Password">
			</td>
			</form>

			<form method="get" action="fed_edit.php">
			<td>
			<input type=hidden name="fedid" value="<?php echo $fedid ?>">
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
			<td>Federation Name: </td><td><input type="Text" name="name" size=32></td>
			</tr><tr>
			<td>Federation Owner Email Address: </td><td><input type="Text" name="owner" size=32></td>
			</tr>
			</table>
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