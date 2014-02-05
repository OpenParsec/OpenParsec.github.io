<?php
header("Content-Type: text/css");

// load up the .css files in this directory, making sure to label them in the output.
$syscssfiles = glob("*.css");
if(@count($syscssfiles) > 0) {
	foreach ($syscssfiles as $syscssfile) {
		echo '/** START ' . $syscssfile . ' **/'."\n";
		echo file_get_contents($syscssfile);
		echo '/** END ' . $syscssfile . ' **/' . "\n\n";
	}
}
// now load up any module .css files.
$modcssfiles = glob('../../system/modules/*/module.css');
if (@count($modcssfiles) > 0) {
	foreach ($modcssfiles as $modcssfile) {
		echo '/** START '.$modcssfile.' */'."\n";
		echo file_get_contents($modcssfile);
		echo '/** END ' . $modcssfile . ' **/'."\n";
	}
}