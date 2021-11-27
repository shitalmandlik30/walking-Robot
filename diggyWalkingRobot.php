<?php

/** Get Input from CMD */

$xaxis = $argv[1];
$yaxis = $argv[2];

if(!is_numeric($xaxis) || !is_numeric($yaxis)){
	die("\nInvalid Co-ordinates. Co-ordinates Should be Integer\n");
}

// Define Dierctions No
$direction = [ 1 => "NORTH", 2 => "EAST", 3 => "SOUTH", 4 => "WEST"];

$currentDirection = trim(strtoupper($argv[3]));

//Validate Current Direction
if($currentDirection != 'NORTH' && $currentDirection != 'SOUTH' && $currentDirection != 'EAST' && $currentDirection != 'WEST'){
	 die("\nWrong Direction\n");
}

//Define Direction Constants
define("NORTH", 1);
define("EAST", 2);
define("SOUTH", 3);
define("WEST", 4);

//Set Directionswise Multiplier
define("SET_MULTIPLIER_1",1);      
define("SET_MULTIPLIER_2",1);
define("SET_MULTIPLIER_3",-1);
define("SET_MULTIPLIER_4",-1);

$currentDirectionNo = constant($currentDirection);
$path = $argv[4];

for($i = 0; $i < strlen($path); $i++ ){
	switch($path[$i]){
		case 'R':
			if($currentDirectionNo == 4){
				$currentDirectionNo = 1;
			} else {
				$currentDirectionNo++;
			}
			break;
        case 'L':
            if($currentDirectionNo == 1){
                $currentDirectionNo = 4;
            } else {
                $currentDirectionNo--;
            }
            break;
        case 'W':
			if($currentDirectionNo % 2 == 0){
                //Facing direction of robot is parallel to X axis
				$xaxis += ($path[$i+1] * constant("SET_MULTIPLIER_".$currentDirectionNo) );
			} else {
                //Facing direction of robot is parallel to Y axis
				$yaxis += ($path[$i+1] * constant("SET_MULTIPLIER_".$currentDirectionNo) );
			}
			$i++;
            break;
		default:
			if(is_numeric($path[$i])){
				echo "\nNumber should be associated with 'W' walk ranging from 0 - 9 Only\n";
			} else {
				echo "\n".$path[$i]."Character Value not allowed\n";
			}
			break;
	}

}

echo $xaxis." ".$yaxis." ".strtoupper($direction[$currentDirectionNo])."\n";

?>