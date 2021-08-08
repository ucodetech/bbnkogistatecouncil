<?php 

	$council = 'idah group council';
	$group = explode(' ', $council);
	$take1 = $group[0];
	$tak = $take1;
	$i = $tak[0] . $tak[1] . $tak[3];
	echo  $i;

	echo '<br>';

	$council2 = 'Koto Karfe  group council';
	$group2 = explode(' ', $council2);
	$take2 = $group2[0];
	$tak2 = $take2;
	$i2 = $tak2[0] . $tak2[1] . $tak2[3];
	echo  $i2;

	echo '<br>';

	if (strlen($take2) > 5) {
	$tak3 = $take2;
	$i3 = $tak3[0] . $tak3[1] . $tak3[2];
	echo  strtoupper($i3);
	}
	elseif(strlen($take2) < 5){
	$tak3 = $take2;
	$i3 = $tak3[0] . $tak3[1] . $tak3[3];
	echo  strtoupper($i3);
	}
