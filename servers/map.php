<?php

	// PARSEC WEB INTERFACE
	// Starmap image generator ($Revision: 1.9 $)
	//
	// Copyright (c) Andreas Varga 2002-2003
	// All Rights Reserved.

	header( "Content-type: image/png" );

	include 'config.php';

	extract( $_GET );
	$PHP_SELF = $_SERVER["PHP_SELF"];
	
	// resx: x resolution of final image
	// resy: y resolution of final image
	// originx: map x position at center of image
	// originy: map y position at center of image
	// width: map width represented by image
	// height: map height represented by image
	
	$image = @ImageCreateTrueColor( $resx, $resy )
		or die ("Cannot create image!");

	$black     = ImageColorAllocate( $image, 0x00, 0x00, 0x00 );
	$white     = ImageColorAllocate( $image, 0xff, 0xff, 0xff );
	$red       = ImageColorAllocate( $image, 0xc0, 0x00, 0x20 );
	$green     = ImageColorAllocate( $image, 0x00, 0xa3, 0x0b );
	$darkgreen = ImageColorAllocate( $image, 0x00, 0x20, 0x00 );
	$lightblue = ImageColorAllocate( $image, 0x66, 0x66, 0x99 );
	$grey	   = ImageColorAllocate( $image, 0x40, 0x40, 0x40 );

	$font = 2;
	$star_radius = 5;

	$map_centerx = (int) $resx / 2;
	$map_centery = (int) $resy / 2;
	
	if ( $width > 140 ) {
		$width = 140;
	}

	if ( $height > 140 ) {
		$height = 140;
	}

	if ( $width > 75 ) {
	
		$font = 1;
		
	} else if ( $width < 20 ) {
	
		$font = 4;
	}
	
	if ( $width > 120 ) {
	
		$hide_details = TRUE;
	
	}


	$map_hwidth  = round( $width / 2 );
	$map_hheight = round( $height / 2 );
	
	$map_left   = $originx - $map_hwidth;
	$map_right  = $originx + $map_hwidth;
	$map_top    = - $originy + $map_hheight;
	$map_bottom = - $originy - $map_hheight;

	ConnectMySQL();

	// draw map objects
	if ( !$hide_bg ) {
	
		$query = "SELECT * FROM mapobjects";
		$result = mysql_query( $query );
	
		while( $row = mysql_fetch_array( $result ) ) {
		
			// cull offscreen objects
			if ( $row['xpos'] + $row['width'] < $map_left || $row['xpos'] > $map_right ) {
				continue;
			}
	
			if ( $row['ypos'] - $row['height'] > $map_top || $row['ypos'] < $map_bottom ) {
				continue;
			}
		
			$url = sprintf( "http://localhost/images/%s", $row['filename'] );
			$obj = @ImageCreateFromPNG( $url );
		
			if ( !$obj ) {
				continue;
			}
		
			$xpos = $resx * ( (int) $row['xpos'] - $map_left ) / $width;
			$ypos = $resy * ( - $map_bottom  - (int) $row['ypos'] ) / $height;
		
			$w = $resx * $row['width'] / $width;
			$h = $resy * $row['height'] / $height;
		
			ImageCopyResized( $image, $obj, $xpos, $ypos, 0, 0, $w, $h, 256, 256 );
	
			//ImageLine( $image, $xpos, $ypos, $xpos + $w, $ypos, $white );
			//ImageLine( $image, $xpos, $ypos, $xpos, $ypos + $h, $white );
		
		}
	}

	// draw grid
	if ( !$hide_grid ) {
	
		for ( $xc = 0 ; $xc < $width ; $xc++  ) {
	
			$xpos = $map_left + $xc;
			
			if ( ( $xpos % 5 ) == 0 ) {
			
				$xpos_pix = $resx * $xc / $width;
	
				ImageLine( $image, $xpos_pix, 0, $xpos_pix, $resy, ( $xpos == 0 ) ? $green : $darkgreen );
				
				ImageString( $image, $font, $xpos_pix + 3, 2, (string) $xpos, $green );
			}
		}
	
		for ( $yc = 0 ; $yc < $height ; $yc++  ) {
	
			$ypos = - $map_bottom - $yc;
	
			if ( ( $ypos % 5 ) == 0 ) {
			
				$ypos_pix = $resy * $yc / $height;
			
				ImageLine( $image, 0, $ypos_pix, $resx, $ypos_pix, ( $ypos == 0 ) ? $green : $darkgreen );
	
				ImageString( $image, $font, 2, $ypos_pix - imagefontheight( $font ) - 1, (string) $ypos, $green );
			}
		}
	}
	
	// draw server locations
	
	if ( !$hide_servers ) {
	
		$query = "SELECT * FROM locations";
	
		$result = mysql_query( $query );
	
		while( $row = mysql_fetch_array( $result ) ) {
		
			if ( $row['xpos'] > $map_right || $row['ypos'] > map_bottom ) {
				continue;
			}
	
			$xpos = $resx * ( (int) $row['xpos'] - $map_left ) / $width;
			$ypos = $resy * ( - $map_bottom  - (int) $row['ypos'] ) / $height;
		
			$color = ( $row['serverid'] != -1 ) ? $white : $grey;
		
			ImageLine( $image, $xpos - 5, $ypos, $xpos + 5, $ypos, $color );
			ImageLine( $image, $xpos, $ypos - 5, $xpos, $ypos + 5, $color );
	
			ImageArc( $image, $xpos, $ypos, 2 * $star_radius, 2 * $star_radius, 0, 360, $color );
	
			$pos = sprintf( "(%d:%d) reg:%d", $row['xpos'], $row['ypos'], $row['region'] );

			// lookup server at this location
			if ( $row['serverid'] != "-1" ) {
			
				$query2 = sprintf( "SELECT name FROM servers WHERE serverid=%s AND confirmkey=''", $row['serverid'] );
				$result2 = mysql_query( $query2 );
				$row2 = mysql_fetch_row( $result2 );
				
				if ( $row2 ) {
				
					if ( $hide_details ) {
						$name = sprintf( "%s", $row2[0] );
					} else {
						$name = sprintf( "%s [id:%d]", $row2[0], $row['serverid'] );
					}
				
					ImageString( $image, $font, $xpos + 7, $ypos - imagefontheight( $font ) - 1, $name, $white );
					if ( !$hide_details ) {
						ImageString( $image, $font, $xpos + 7, $ypos - 2, $pos, $white );
					}
					
				} else {
				
					ImageString( $image, $font, $xpos + 7, $ypos - imagefontheight( $font ) - 1, "<claimed>", $grey );
					if ( !$hide_details ) {
						ImageString( $image, $font, $xpos + 7, $ypos - 2, $pos, $grey );
					}
				}
				
			} else {
			
				ImageString( $image, $font, $xpos + 7, $ypos - imagefontheight( $font ) - 1, "<unexplored>", $grey );
				if ( !$hide_details ) {
					ImageString( $image, $font, $xpos + 7, $ypos - 2, $pos, $grey );
				}
			}
			
		}
	}

	// output image to stream
	ImagePNG( $image );

?>
