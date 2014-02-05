<?php
header('Content-Type: text/javascript');

// load up the .js files in this directory, making sure to label them in the output.
$sysjsfiles = glob("*.js");

if(in_array('jquery.js',$sysjsfiles)) {
	$key = array_search('jquery.js', $sysjsfiles);
	unset($sysjsfiles[$key]);
	echo "/** START jquery.js **/\n";
	echo file_get_contents('jquery.js');
	echo "/** END jquery.js **/\n\n";
}
if (@count($sysjsfiles) > 0) {
	sort($sysjsfiles);
	foreach ($sysjsfiles as $sysjsfile) {
		echo '/** START ' . $sysjsfile . ' **/'."\n";
		echo file_get_contents($sysjsfile);
		echo '/** END ' . $sysjsfile . ' **/' . "\n\n";
	}
}
// now load up any module .js files.
$modjsfiles = glob('../../system/modules/*/module.js');
if (@count($modjsfiles) > 0) {
	foreach ($modjsfiles as $modjsfile) {
		echo '/** START '.$modjsfile.' */'."\n";
		echo file_get_contents($modjsfile);
		echo '/** END ' . $modjsfile . ' **/'."\n";
	}
}
