<?php
$ps = ["4a0","2a0","a0","a1","a2","a3","a4","a5","a6","a7","a8","a9","a10","b0","b1","b2","b3","b4","b5","b6","b7","b8","b9","b10","c0","c1","c2","c3","c4","c5","c6","c7","c8","c9","c10","ra0","ra1","ra2","ra3","ra4","sra0","sra1","sra2","sra3","sra4","letter","half-letter","legal","ledger","tabloid","executive","folio","commercial #10 envelope","catalog #10 1/2 envelope","8.5x11","8.5x14","11x17"];

require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;
use Dompdf\Options;

$image_url = $_POST['imageurl'] ?? NULL;
$topinput = $_POST['topinput'] ?? 0;
$leftinput = $_POST['leftinput'] ?? 0;
$pagesize = in_array($_POST['pagesize'], $ps) ? $_POST['pagesize'] : 'letter';
$orientation = in_array($_POST['orientation'], ['portrait','landscape']) ? $_POST['orientation'] : 'portrait';

$options = new Options();
// $options->set('defaultFont', 'Courier');

$path = 'https://ethx.co/my/ethxco-logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($path));

if($image_url){
	$type1 = pathinfo($image_url, PATHINFO_EXTENSION);
	$base641 = 'data:image/' . $type1 . ';base64,' . base64_encode(file_get_contents($image_url));
}

$dompdf = new Dompdf();


$class = $leftinput==0 ? '' : 'offset-'.$leftinput;
$style = $topinput==0 ? '' : 'padding-top: '.$topinput.'rem !important';

$html = <<<EOD
<html>
<head>
<link type="text/css" href="bootstrap.css" rel="stylesheet" />
</head>
<body>
	<div class="">
	  	<div class='col-md-12 text-center'><img src="$base64"/></div>
		<div class="col-md-2 $class" style="$style"><img width="200" height="200" src="$base641"></div>
	</div>
</body>
</html>
EOD;
// echo $html;die();
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($html);

$dompdf->setPaper($pagesize, $orientation);

$dompdf->render();

$dompdf->set_base_path('bootstrap.css');

$dompdf->stream();