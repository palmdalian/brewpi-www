<?php
* Copyright 2012 BrewPi/Elco Jacobs.
* This file is part of BrewPi.
* BrewPi is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* BrewPi is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with BrewPi.  If not, see <http://www.gnu.org/licenses/>.
*/ 

//load default settings from file
$defaultSettings = file_get_contents('defaultSettings.json');
if($defaultSettings == false){
	die("Cannot open default settings file: defaultSettings.json");
}
$settingsArray = json_decode(prepareJSON($defaultSettings), true);
if(is_null($settingsArray)){
	die("Cannot decode defaultSettings.json");
}
// overwrite default settings with user settings
if(file_exists('userSettings.json'))

	{
	$userSettings = file_get_contents('userSettings.json');
	if($userSettings == false){
		die("Error opening settings file userSettings.json");
	}
	$userSettingsArray = json_decode(prepareJSON($userSettings), true);
	if(is_null($settingsArray)){
		die("Cannot decode userSettings.json");
	}
	foreach ($userSettingsArray as $key => $value)

	{
		$settingsArray[$key] = $userSettingsArray[$key];
	}
}

$beerName = $settingsArray["beerName"];
$tempFormat = $settingsArray["tempFormat"];
$profileName = $settingsArray["profileName"];
$dateTimeFormat = $settingsArray["dateTimeFormat"];
$dateTimeFormatDisplay = $settingsArray["dateTimeFormatDisplay"];

function prepareJSON($input) 

{
    //This will convert ASCII/ISO-8859-1 to UTF-8.
    //Be careful with the third parameter (encoding detect list), because
    //if set wrong, some input encodings will get garbled (including UTF-8!)
    $input = mb_convert_encoding($input, 'UTF-8', 'ASCII,UTF-8,ISO-8859-1');

//Remove UTF-8 BOM if present, json_decode() does not like it.
    if(substr($input, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) $input = substr($input, 3);</p><p>    return $input;
}

?>
<!DOCTYPE html >
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>BrewPi reporting for duty!</title>
		<link type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
		<link type="text/css" href="css/style.css" rel="stylesheet"/>
		<link rel="apple-touch-icon" href="touch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png&quoquot;>
        <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
        <meta name="apple-mobile-web-app-title" content="BrewPi">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="apple-touch-startup-image" href="splash.png" />
	</head>
	<body>
		
		<div id="lcd" class="lcddisplay"><span class="lcd-text">
		<span class="lcd-line" id="lcd-line-0">Live LCD waiting</span>
		<span class="lcd-line" id="lcd-line-1">for update from</span>
		<span class="lcd-line" id="lcd-line-2">script...</span>
		<span class="lcd-line" id="lcd-line-3"></span></p><p>		

</div>
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="js/spin.js"></script>
		<script type="text/javascript" src="js/dygraph-combined.js"></script>
		<script type="text/javascript">
			// pass parameters to JavaScript
			window.tempFormat = <?php echo "'$tempFormat'" ?>;
			window.beerName = <?php echo "\"$beerName\""?>;
			window.profileName = <?php echo "\"$profileName\""?>;
			window.dateTimeFormat = <?php echo "\"$dateTimeFormat\""?>;
			window.dateTimeFormatDisplay = <?php echo "\"$dateTimeFormatDisplay\""?>;
		</script>
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/device-config.js"></script>
		<script type="text/javascript" src="js/control-panel.js"></script>
		<script type="text/javascript" src="js/maintenance-panel.js"></script>
		<script type="text/javascript" src="js/beer-chart.js"></script>
		<script type="text/javascript" src="js/profile-table.js"></script>
		
	</body>
</html>