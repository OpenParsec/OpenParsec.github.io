<?php 

	// PARSEC WEB INTERFACE
	// Federation join page ($Revision: 1.7 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$page_type = "feds";
	
	include 'config.php';
	include 'std_header.php';
	include 'global_menu.php';

	function CreateNewJoinRequest( $fedid, $serverid, $passwd )
	{
		global $PHP_SELF;
	
		if ( $serverid == -1 ) {
			printf( "You have to select the server that should join the federation!<br>" );
			$error = TRUE;
		} 

		if ( $passwd == "" ) {
			printf( "The server password was invalid.<br>" );
			$error = TRUE;
		}

		if ( $error ) {
			printf( "<br><a href=\"fed_join.php?fedid=$fedid\">Go back</a> and enter the missing information in the form!<br>" );
			return;
		}
	
		$query = "SELECT passwd, name FROM servers WHERE serverid=$serverid";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );

		if ( $row[0] == $passwd ) {

			$servername = $row[1];
			
			mt_srand( time() );
			
			for ( $i = 0; $i < 10; $i++ ) {
			
				switch( mt_rand( 1, 3 ) ) {
				
					case 1:
						$confirm = sprintf( "%s%s", $confirm, chr( mt_rand( 65, 90 ) ) ); 
						break;
						
					case 2:
						$confirm = sprintf( "%s%s", $confirm, chr( mt_rand( 97, 121 ) ) ); 
						break;
						
					case 3:
						$confirm = sprintf( "%s%s", $confirm, chr( mt_rand( 48, 57 ) ) ); 
						break;
				}
			}

			$query = "INSERT INTO joinrequests VALUES( NULL, $fedid, $serverid, '$confirm', NULL )";

			$result = mysql_query( $query );
		
			$requestid = mysql_insert_id();
		
			$url = "http://localhost$PHP_SELF?requestid=$requestid&confirm=$confirm";
			
			$subject = "Server \"$servername\" wants to join your Parsec federation";
					
			$body  = "You're getting this message, because this e-mail is specified as the owner\n";
			$body .= "of the Parsec federation named \"$fedname\".\n\n";
			$body .= "If you do not own this Parsec federation, you can safely ignore this e-mail.\n\n";
			$body .= "Otherwise you can confirm the join request of \"$servername\" by visiting this URL:\n";
			$body .= "$url\n\n";
			$body .= "If you do not want the server to join your federation, ignore this e-mail, and the join request ";
			$body .= "will be rejected.\n\n";
			$body .= "If you want to prevent the server from making another join request, use this URL:\n";
			$body .= "<to be implemented>\n\n";
			$body .= "You might want to keep this e-mail as a reference.\n";
			
			$rc = mail( $owner, $subject, $body, $parsec_mail_headers );

			if ( $rc == TRUE ) {
			
				printf( "Owner of federation $fedid has been notified, he will have to confirm your join request.<br>" );
	
				if ( $parsec_testing ) {
					
					printf( "Confirmation url: <a href=\"%s\">%s</a><br>", $url, $url );
				}
				
			} else {

				printf( "Could not send notification e-mail, please try again later." );

				// remove database entries again
				$query = "DELETE FROM joinrequests WHERE requestid=$requestid";
				$result = mysql_query( $query );
			}
		} else {

			printf( "Password was incorrect" );			
		}
	}
	
	
	function ConfirmJoinRequest( $requestid, $confirm ) 
	{
		$query = "SELECT fedid, serverid FROM joinrequests WHERE requestid=$requestid AND confirmkey='$confirm'";
		$result = mysql_query( $query );
		
		$row = mysql_fetch_row( $result );

		if ( $row ) {
			$fedid = $row[0];
			$serverid = $row[1];
	
			$query = "UPDATE servers SET fedid=$fedid WHERE serverid=$serverid";
			$result = mysql_query( $query );
	
			printf( "Server with id $serverid has joined federation with id $fedid.<br>" );

			$query = "DELETE FROM joinrequests WHERE requestid=$requestid";
			$result = mysql_query( $query );
			
		} else {
		
			printf( "Confirmation key invalid.<br>" );
		}
	}
	

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	ConnectMySQL();

	// get name of federation to join and display on top of page
	if ( $fedid ) {
	
		$query = "SELECT name, owner FROM federations WHERE fedid=$fedid";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		
		$fedname = $row[0];
		$owner = $row[1];
		
		printf( "Join Federation \"%s\" (federation id: %d)<p>", $fedname, $fedid );
	}

	if ( $submit == 'Submit' && $fedid && $serverid ) {

		// add new join request
		CreateNewJoinRequest( $fedid, $serverid, $passwd );

	} else if ( $requestid && $confirm ) {

		// confirm a pending join request
		ConfirmJoinRequest( $requestid, $confirm );

	} else {
	
	// nothing was submitted, present user interface
?>

	<form method="get" action="<?php echo $PHP_SELF ?>">

		<table><tr>
		<td>Server: </td><td><select name="serverid" size="1">
		<option value="-1">-- Select your server --</option>
		<?php

			$query = "SELECT serverid, name FROM servers";
			$result = mysql_query( $query );
			while( $row = mysql_fetch_array( $result ) ) {
			
				printf( "<option value=\"%s\">%s (server id %s)</option>", $row['serverid'], $row['name'], $row['serverid'] );
			}
		?>
		</select></td>
		</tr><tr>
		<td>Server Password: </td><td><input type="password" name="passwd"></td>
		</tr>
		</table>
		<p>
		
		<input type=hidden name="fedid" value="<?php echo $fedid ?>">
		<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td>
		<input type="Submit" name="submit" value="Submit">
		</td></tr></table>

	</form>
	<p>

<?php
	}

	include 'std_footer.php';
?>