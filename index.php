<?php
define('DIR_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR);
define('WIDTH', 640);
define('HEIGHT', 360);

$merge = new SimpleGifMerge(DIR_PATH);
$merge->clear();
$l = 100;
for ($i=0; $i < $l; $i++) { 
	$theta = sin($i/$l*pi())*2;
	$image = new Dm_Image(WIDTH,HEIGHT,0xFF000000);
	draw();
	$count = sprintf('%05d', $i);
	$image->saveTo(DIR_PATH.$count.'.gif','gif');
}
$merge->merge();

function draw()
{
	global $image;
	
	$image->graphics
		->lineStyle(1,0xFFFFFFFF)
		->moveTo(WIDTH/2, HEIGHT)
		->lineTo(WIDTH/2, HEIGHT-120);
	$h = 120;
	branch($h,-M_PI/2,WIDTH/2,HEIGHT-120);
}

function branch($h,$rotate,$x,$y)
{
	global $image,$theta;
	if($h<2)return;
	
	$h *= 0.66;
	
	$movedX = cos($rotate+$theta)*$h + $x;
	$movedY = sin($rotate+$theta)*$h + $y;
	$image->graphics
		->moveTo($x, $y)
		->lineTo($movedX, $movedY);
	branch($h,$rotate+$theta,$movedX,$movedY);
	
	$movedX = cos($rotate-$theta)*$h + $x;
	$movedY = sin($rotate-$theta)*$h + $y;
	$image->graphics
		->moveTo($x, $y)
		->lineTo($movedX, $movedY);
	branch($h,$rotate-$theta,$movedX,$movedY);
	
}
