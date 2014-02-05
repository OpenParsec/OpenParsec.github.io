<?php 

	// PARSEC WEB INTERFACE
	// Password changing script ($Revision: 1.2 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	include 'config.php';
	include 'std_header.php';
	include 'global_menu.php';

	function ChangePassword( $idtype, $id, $dbname, $passwd, $oldpasswd )
	{
		$query = "SELECT passwd FROM $dbname WHERE $idtype=$id";
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );

		if ( $row[0] == $oldpasswd ) {
	
			if ( $passwd=="" ) {
			
				printf( "You have to specify a new password." );
			
			} else {
					
				$query = "UPDATE $dbname SET passwd='$passwd' WHERE $idtype=$id";
				$result = mysql_query( $query );
	
				printf( "Your password has been changed." );
			}		
				
		} else {

			printf( "Old password was incorrect" );			
		}
	}

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	ConnectMySQL();

	if ( $serverid ) {
	
		$dbname = 'servers';
		$idtype = 'serverid';
		$id = $serverid;
	
	} else if ( $fedid ) {
	
		$dbname = 'federations';
		$idtype = 'fedid';
		$id = $fedid;
	
	} else if ( $playerid ) {
	
		$dbname = 'players';
		$idtype = 'playerid';
		$id = $playerid;
		
	} else {
	
		printf( "No valid entity selected for password change.\n" );
		exit();
	}

	if ( $submit == 'Change Password' && $passwd && $oldpasswd ) {
		
		ChangePassword( $idtype, $id, $dbname, $passwd, $oldpasswd );
		
	} else {

		?>
		Please enter your old and new passwords:<p>
		
		<form method="get" action="<?php echo $PHP_SELF ?>">
		<input type=hidden name="<?php echo $idtype ?>" value="<?php echo $id ?>">
		<table>
		<tr>
		<td>Old Password: </td><td><input type="password" name="oldpasswd" size=16>  
		<a href="passwd_mail.php?<?php echo $idtype ?>=<?php echo $id ?>">Forgot Password?</a></td>
		</tr>
		<tr>
		<td>New Password: </td><td><input type="password" name="passwd" size=16>  
		</td>
		</tr>
		</table>
		<p>
		<table bgcolor="<?php echo $parsec_table_bgcolor ?>" width="100%"><tr><td>
		<input type="Submit" name="submit" value="Change Password">
		</td></tr></table>

		</form>
		<?php
	}

	include 'std_footer.php';
?>

