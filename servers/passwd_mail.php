<?php 

	// PARSEC WEB INTERFACE
	// Password reminder script ($Revision: 1.5 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	include 'config.php';
	include 'std_header.php';
	include 'global_menu.php';

	function SendPasswordNotificationMail( $name, $email, $passwd, $type )
	{
		//printf( "Sending email to $email, with content: $name, $passwd\n" );

		$subject = "Your Parsec password request";
				
		$body  = "You have requested the password of a Parsec $type.\n\n";
		$body .= "Name: $name\n";
		$body .= "Password: $passwd\n\n";
		
		$rc = mail( $email, $subject, $body, $parsec_mail_headers );
		
		if ( $rc == TRUE ) {
			printf( "An email with the password of $type '$name' has been sent to $email." );
		} else {
			printf( "Could not send confirmation e-mail, please try again later." );
		}
	}

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	ConnectMySQL();

	if ( $serverid ) {
	
		$query = "SELECT name, passwd, admin FROM servers WHERE serverid=$serverid";
		$result = mysql_query( $query );
		$row = mysql_fetch_array( $result );
	
		$name = $row['name'];
		$passwd = $row['passwd'];
		$email = $row['admin'];
		$type = 'server';
		
	} else if ( $fedid ) {
	
		$query = "SELECT name, passwd, owner FROM federations WHERE fedid=$fedid";
		$result = mysql_query( $query );
		$row = mysql_fetch_array( $result );
	
		$name = $row['name'];
		$passwd = $row['passwd'];
		$email = $row['owner'];
		$type = 'federation';
	
	} else if ( $playerid ) {
	
		$query = "SELECT name, passwd, email FROM players WHERE playerid=$playerid";
		$result = mysql_query( $query );
		$row = mysql_fetch_array( $result );
	
		$name = $row['name'];
		$passwd = $row['passwd'];
		$email = $row['email'];
		$type = 'player';
	}

	if ( $name && $email && $passwd && $type ) {
		SendPasswordNotificationMail( $name, $email, $passwd, $type );
	} else {
		printf( "Invalid request.\n" );
	}

	include 'std_footer.php';
?>