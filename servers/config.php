<?php

	// PARSEC WEB INTERFACE
	// Configuration options ($Revision: 1.3 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	$parsec_table_bgcolor 		= "#0e2568";
	$parsec_css_file	  		= "parsec.css";

	$parsec_mysql_host			= "localhost";
	$parsec_mysql_user			= "openparsec";
	$parsec_mysql_db			= "openparsec";
	$parsec_mysql_password			= "op3nth3d00r";

	$parsec_default_list_length = 20; //10 //20

	$parsec_testing				= TRUE;

	$parsec_mail_headers 		= "From: master_of_the_universe@openparsec.com\r\n"
								. "Reply-To: admin@openparsec.com\r\n";
	
	$parsec_map_width			= 512;
	$parsec_map_height			= 512;
	$parsec_map_aspect_ratio	= 1;
	
	function ConnectMySQL()
	{
		global $parsec_mysql_host;
		global $parsec_mysql_user;
		global $parsec_mysql_password;
		global $parsec_mysql_db;
	
		$db = mysql_connect( $parsec_mysql_host, $parsec_mysql_user, $parsec_mysql_password); 
	
		mysql_select_db( $parsec_mysql_db, $db);
	}
	
	
?>
