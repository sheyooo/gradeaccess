<?php 
require_once("../../includes/functions.inc");

$y = $school->getCurrentSession();
$t = $school->getCurrentTermID();

if($chart = $school->getOverallPerformance($y, $t)){
    $i = 0;
    $bar_array = "["; 


    foreach ($chart as $bar) {
        $avg = round($bar['avg'], 2);

        $bar_array .= "[\"{$bar['short_name']}\", {$avg}]";
        if($i < count($chart) - 1){
            $bar_array .= ",";
        }
        $i++;
    }
    
    $bar_array .= "]";

    echo $bar_array;
}

//echo(json_encode([["Maths", 10], ["English", 93], ["Physics", 4], ["Biology", 100], ["Chemistry", 17]]))

?>