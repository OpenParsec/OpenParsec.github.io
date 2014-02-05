<?php 

	// PARSEC WEB INTERFACE
	// Starmap viewer ($Revision: 1.6 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	include 'config.php';

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];

	if ( $res ) {
	
		// store map size in cookie
		setcookie( "parsec_map_size", $res );
		
	} else {
	
		if ( $_COOKIE["parsec_map_size"] ) {
			$res = $_COOKIE["parsec_map_size"];
		}
	}

	include 'std_header.php';	

	if ( $res ) {
	
		switch( $res ) {
	
			case 1:
				$resx = 320;
				$resy = 320;

				printf( "<script language=javascript>\n" );
				printf( "window.resizeTo( 508, 465 );\n" );
				printf( "</script>\n" );					

				break;

			case 2:
				$resx = 512;
				$resy = 512;

				printf( "<script language=javascript>\n" );
				printf( "window.resizeTo( 700, 580 );\n" );
				printf( "</script>\n" );					

				break;

			case 3:
				$resx = 768;
				$resy = 768;

				printf( "<script language=javascript>\n" );
				printf( "window.resizeTo( 940, 830 );\n" );
				printf( "</script>\n" );					
				
				//printf( "<script language=javascript>\n" );
				//printf( "top.frames[1].innerHeight = 500;" );
				//printf( "top.frames[1].resizeTo( top.frames[1].innerWidth, 500 );" );
				//printf( "top.document.body.rows=\"*,500\";\n" );
				//printf( "parent.map.outerHeight = 500;\n" );
				//printf( "</script>\n" );					

				break;
		}
		
	} else {
		$res = 2;
	}

	if ( !$resx ) {
		$resx = $parsec_map_width;
	}

	if ( !$resy ) {
		$resy = $parsec_map_height;
	}

	if ( $center_x && $center_y ) {
	
		$map_hwidth  = round( $width / 2 );
		$map_hheight = round( $height / 2 );
		$map_centerx = (int) $resx / 2;
		$map_centery = (int) $resy / 2;
	
		$originx += (int) ( $map_hwidth * ( $center_x - $map_centerx ) / $map_centerx ); 
		$originy -= (int) ( $map_hheight * ( $center_y - $map_centery ) / $map_centery ); 
	
	}
	
	$img_url = "map.php?resx=$resx&resy=$resy&originx=$originx&originy=$originy&width=$width&height=$height";

	$hide_options = "";

	if ( $hide_details ) {
	
		$hide_options .= "&hide_details=on";
	}

	if ( $hide_servers ) {
	
		$hide_options .= "&hide_servers=on";
	}

	if ( $hide_bg ) {
	
		$hide_options .= "&hide_bg=on";
	}

	if ( $hide_grid ) {
	
		$hide_options .= "&hide_grid=on";
	}

	$img_url .= $hide_options;

	//printf( $img_url );
?>

<center>
<table border=0 cellpadding=0 cellspacing=5>
<tr>
<td>
<?php
	printf( "<form action=\"%s\">\n", $PHP_SELF );
	printf( "<input type=\"image\" name=\"center\" src=\"%s\" width=%d height=%d>\n", $img_url, $resx, $resy );
	printf( "<input type=\"hidden\" name=\"resx\" value=\"%d\">\n", $resx );
	printf( "<input type=\"hidden\" name=\"resy\" value=\"%d\">\n", $resy );
	printf( "<input type=\"hidden\" name=\"originx\" value=\"%d\">\n", $originx );
	printf( "<input type=\"hidden\" name=\"originy\" value=\"%d\">\n", $originy );
	printf( "<input type=\"hidden\" name=\"width\" value=\"%d\">\n", $width );
	printf( "<input type=\"hidden\" name=\"height\" value=\"%d\">\n", $height );
	printf( "<input type=\"hidden\" name=\"hide_bg\" value=\"%s\">\n", $hide_bg );
	printf( "<input type=\"hidden\" name=\"hide_servers\" value=\"%s\">\n", $hide_servers );
	printf( "<input type=\"hidden\" name=\"hide_details\" value=\"%s\">\n", $hide_details );
	printf( "<input type=\"hidden\" name=\"hide_grid\" value=\"%s\">\n", $hide_grid );
	printf( "</form>\n" );
	printf( "</center>\n" );
	
?>
</td>
<td align="left">

<?php
		
	// zoom in button
	$new_width = $width + 10;
	$new_height = (int) ( $new_width * $parsec_map_aspect_ratio );
	
	printf( "<a href=\"$PHP_SELF?resx=$resx&resy=$resy&originx=$originx&originy=$originy&width=%d&height=%d%s\">", $new_width, $new_height, $hide_options );
	printf( "<img src=\"images/zoomout.png\" border=0 width=64 height=64>" );
	printf( "</a><br>" );

	$num_bars = 14;

	// quick zoom bars
	for ( $i = 1; $i < ($num_bars + 1); $i++ ) {

		$new_width = ( $num_bars - $i ) * 10 + 5;
		$new_height = (int) ( $new_width * $parsec_map_aspect_ratio );
	
		printf( "<a href=\"$PHP_SELF?resx=$resx&resy=$resy&originx=$originx&originy=$originy&width=%d&height=%d%s\">", $new_width, $new_height, $hide_options );
		
		if ( $new_width == $width ) {
			printf( "<img src=\"images/linestart_active.png\" border=0 width=3 height=8>" );
			printf( "<img src=\"images/line_active.png\" border=0 width=%d height=8>", (int) ($i * 64/$num_bars) );
		} else {
			printf( "<img src=\"images/linestart.png\" border=0 width=3 height=8>" );
			printf( "<img src=\"images/line.png\" border=0 width=%d height=8>", (int) ($i * 64/$num_bars) );
		}
		printf( "</a><br>" );
	}

	
	// zoom out button
	$new_width = $width - 10;
	$new_height = (int) ( $new_width * $parsec_map_aspect_ratio );

	if ( $new_width < 5 ) {
		$new_width = 5;
	}

	if ( $new_height < 5 ) {
		$new_height= 5;
	}
	
	printf( "<a href=\"$PHP_SELF?resx=$resx&resy=$resy&originx=$originx&originy=$originy&width=%d&height=%d%s\">", $new_width, $new_height, $hide_options );
	printf( "<img src=\"images/zoomin.png\" border=0 width=64 height=64>" );
	printf( "</a><br>" );


?>

<form action="map_viewer.php" method="GET">

<?php  
	if ( $hide_servers ) {
		printf( "<input type=\"checkbox\" name=\"hide_servers\" id=\"hide_servers_checkbox\" checked=\"checked\">\n" );
	} else {
		printf( "<input type=\"checkbox\" name=\"hide_servers\" id=\"hide_servers_checkbox\">\n" );		
	}

	printf( "<label for=\"hide_servers_checkbox\">Hide Servers</label><br>\n" );

	if ( $hide_details ) {
		printf( "<input type=\"checkbox\" name=\"hide_details\" id=\"hide_details_checkbox\" checked=\"checked\">\n" );
	} else {
		printf( "<input type=\"checkbox\" name=\"hide_details\" id=\"hide_details_checkbox\">\n" );		
	}

	printf( "<label for=\"hide_details_checkbox\">Hide Details</label><br>\n" );

	if ( $hide_bg ) {
		printf( "<input type=\"checkbox\" name=\"hide_bg\" id=\"hide_bg_checkbox\" checked=\"checked\">\n" );
	} else {
		printf( "<input type=\"checkbox\" name=\"hide_bg\" id=\"hide_bg_checkbox\">\n" );		
	}

	printf( "<label for=\"hide_bg_checkbox\">Hide Background</label><br>\n" );

	if ( $hide_grid ) {
		printf( "<input type=\"checkbox\" name=\"hide_grid\" id=\"hide_grid_checkbox\" checked=\"checked\">\n" );
	} else {
		printf( "<input type=\"checkbox\" name=\"hide_grid\" id=\"hide_grid_checkbox\">\n" );		
	}

	printf( "<label for=\"hide_grid_checkbox\">Hide Grid</label><br>\n" );
	printf( "<br>" );

	printf( "Select Map Size:<br>\n" );
	printf( "<select name=\"res\" value=\"2\" size=\"0\">\n" );
	if ( $res == 1 ) {
		printf( "<option selected value=\"1\">small (320x320)</option>\n" );
	} else {
		printf( "<option value=\"1\">small (320x320)</option>\n" );
	}

	if ( $res == 2 ) {
		printf( "<option selected value=\"2\">medium (512x512)</option>\n" );
	} else {
		printf( "<option value=\"2\">medium (512x512)</option>\n" );
	}

	if ( $res == 3 ) {
		printf( "<option selected value=\"3\">large (768x768)</option>\n" );
	} else {
		printf( "<option value=\"3\">large (768x768)</option>\n" );
	}
	
	printf( "</select><br><br>\n" );

	printf( "<input type=\"submit\" name=\"Submit\" value=\"Apply\">\n" );

//	printf( "<input type=\"hidden\" name=\"resx\" value=\"%d\">\n", $resx );
//	printf( "<input type=\"hidden\" name=\"resy\" value=\"%d\">\n", $resy );

	printf( "<input type=\"hidden\" name=\"originx\" value=\"%d\">\n", $originx );
	printf( "<input type=\"hidden\" name=\"originy\" value=\"%d\">\n", $originy );
	printf( "<input type=\"hidden\" name=\"width\" value=\"%d\">\n", $width );
	printf( "<input type=\"hidden\" name=\"height\" value=\"%d\">\n", $height );
?>

</form>
</td>
</tr>
</table>
</center>

<?php
	include 'std_footer.php';
?>