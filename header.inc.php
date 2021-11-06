<html>
	<head>
		<title><?=$view->config->appname?></title>
	        <link rel="stylesheet" href="/css/load_all_css.php" type="text/css" />
        	<script type="text/javascript" src="/js/load_all_js.php"></script>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />

	</head>
	<body>
	<div id="LtBox" style="display: none;"><div id="btn_Close">x</div><div id="LB_Content"></div></div>
	<div id="LB_Overlay" style="display: none;"></div>
    <table border="0" cellpadding="0" cellspacing="2" width="100%">
      <tr>
        <td>
          <div align="left">
            <img height="70" width="523" src="/images/dogma.jpg" alt="THERE IS NO SAFE DISTANCE"></div>
        </td>
        <td width="169">
          <div align="right">
            <a href="https://www.openparsec.com/"><img height="83" width="240" src="/images/logo_anim.gif" alt="parsec logo" border="0"></a></div>
        </td>
      </tr>
    </table>
  <div class="parsecMenu">
   <script language="Javascript"><!--
   
hilite = new MakeImgArray( 13 )
normal = new MakeImgArray( 13 )

normal[  1 ].src = "/images/home.jpg"
normal[  2 ].src = "/images/about.jpg"
normal[  3 ].src = "/images/news.jpg"
normal[  4 ].src = "/images/screenshots.jpg"
normal[  5 ].src = "/images/gallery.jpg"
normal[  6 ].src = "/images/features.jpg"
normal[  7 ].src = "/images/download.jpg"
normal[  8 ].src = "/images/history.jpg"
normal[  9 ].src = "/images/faq.jpg"
normal[ 10 ].src = "/images/forum.jpg"
normal[ 11 ].src = "/images/lists.jpg"
normal[ 12 ].src = "/images/links.jpg"
normal[ 13 ].src = "/images/contact.jpg"

hilite[  1 ].src = "/images/home_s.jpg"
hilite[  2 ].src = "/images/about_s.jpg"
hilite[  3 ].src = "/images/news_s.jpg"
hilite[  4 ].src = "/images/screenshots_s.jpg"
hilite[  5 ].src = "/images/gallery_s.jpg"
hilite[  6 ].src = "/images/features_s.jpg"
hilite[  7 ].src = "/images/download_s.jpg"
hilite[  8 ].src = "/images/history_s.jpg"
hilite[  9 ].src = "/images/faq_s.jpg"
hilite[ 10 ].src = "/images/forum_s.jpg"
hilite[ 11 ].src = "/images/lists_s.jpg"
hilite[ 12 ].src = "/images/links_s.jpg"
hilite[ 13 ].src = "/images/contact_s.jpg"


function MakeImgArray( n )
{
	this.length = n;
	for ( var i = 1; i <= n; i++ ) {
		this[ i ] = new Image();
	}
	
	return this;
}

function msover( num )
{
	for ( var i = 0; i < document.images.length; i++ ) {
		if ( document.images[ i ].src == normal[ num ].src )
			document.images[ i ].src = hilite[ num ].src;
	}
}

function msout( num )
{
	for ( var i = 0; i < document.images.length; i++ ) {
		if ( document.images[ i ].src == hilite[ num ].src)
			document.images[ i ].src = normal[ num ].src;
	}

}
// -->
   </script>
			<table class="parsecMenu" cellpadding="0" cellspacing="0">
    <tr class="parsecMenu">
     <td class="parsecMenu"><img height="124" width="170" src="/images/menu_top.jpg"></td>
    </tr>
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="/" onmouseover="msover(1)" onmouseout="msout(1)"><img height="28" width="170" src="/images/home.jpg" border="0" alt="home"></a></td>
    </tr>
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="/about.php" onmouseover="msover(2)" onmouseout="msout(2)"><img height="27" width="170" src="/images/about.jpg" border="0" alt="about"></a></td>
    </tr>
<!--    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="http://www.openparsec.com/news.php" onmouseover="msover(3)" onmouseout="msout(3)"><img height="23" width="170" src="/images/news.jpg" border="0" alt="news"></a></td>
    </tr>
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="http://www.openparsec.com/screenshots.html" onmouseover="msover(4)" onmouseout="msout(4)"><img height="24" width="170" src="/images/screenshots.jpg" border="0" alt="screenshots"></a></td>
    </tr>
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="http://www.openparsec.com/gallery.html" onmouseover="msover(5)" onmouseout="msout(5)"><img height="27" width="170" src="/images/gallery.jpg" border="0" alt="gallery"></a></td>
    </tr>
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="http://www.openparsec.com/features.html" onmouseover="msover(6)" onmouseout="msout(6)"><img height="23" width="170" src="/images/features.jpg" border="0" alt="features"></a></td>
    </tr>-->
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="https://sourceforge.net/projects/openparsec/files/" onmouseover="msover(7)" onmouseout="msout(7)"><img height="25" width="170" src="/images/download.jpg" border="0" alt="download"></a></td>
    </tr>
    <tr class="parsecMenu">
	<td class="parsecMenu"><a href="/history.php" onmouseover="msover(8)" onmouseout="msout(8)"><img height="27" width="170" src="/images/history.jpg" border="0" alt="history"></a></td>
    </tr>
    <tr class="parsecMenu">
	<td class="parsecMenu"><a href="/faq.php" onmouseover="msover(9)" onmouseout="msout(9)"><img height="24" width="170" src="/images/faq.jpg" border="0" alt="faq"></a></td>
    </tr>
    <!--<tr class="parsecMenu">
     <td class="parsecMenu"><a href="http://sourceforge.net/projects/openparsec/forums/" onmouseover="msover(10)" onmouseout="msout(10)"><img height="23" width="170" src="/images/forum.jpg" border="0" alt="forum"></a></td>
    </tr>-->
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="/lists.php" onmouseover="msover(11)" onmouseout="msout(11)"><img height="26" width="170" src="/images/lists.jpg" border="0" alt="lists"></a></td>
    </tr>
    <!--<tr class="parsecMenu">
     <td class="parsecMenu"><a href="http://www.openparsec.com/links.html" onmouseover="msover(12)" onmouseout="msout(12)"><img height="26" width="170" src="/images/links.jpg" border="0" alt="links"></a></td>
    </tr>-->
    <tr class="parsecMenu">
     <td class="parsecMenu"><a href="/contact.php" onmouseover="msover(13)" onmouseout="msout(13)"><img height="26" width="170" src="/images/contact.jpg" border="0" alt="contact"></a></td>
    </tr>
    <tr class="parsecMenu">
     <td class="parsecMenu"><img height="26" width="170" src="/images/menu_bottom.jpg"></td>
    </tr>
   </table>
	<div id="logo"><a href="http://sourceforge.net/projects/openparsec" target="_top"><img src="https://sflogo.sourceforge.net/sflogo.php?group_id=77590&amp;type=11" width="120" height="30" alt="Get Parsec at SourceForge.net. Fast, secure and Free Open Source software downloads" /></a></div>
		</div>
	<div class="mainContent">
