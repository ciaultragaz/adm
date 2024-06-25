<?php
require_once('../_config.php');

function AddPlayTime($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    if(is_array($times)){
        foreach ($times as $time) {
            list($hour, $minute) = explode(':', $time);
            $subtract = (substr($hour,0,1)=="-") ? '-':'';
            $minutes += $hour * 60;
            $minutes += $subtract.$minute;
        }
    
        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;
    
        // returns the time already formatted
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
function convertToHour($time){
    //$time = strtotime($time);
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return $hours.":".$minutes;
}
function convertStrTimeToHour($total){
    $hours      = Util::lpad(floor($total/ 60 / 60));
    $minutes    = Util::lpad(round(($total - ($hours * 60 * 60)) / 60));
    return $hours.":".$minutes;
}
function formatHour($hour){
    return substr($hour,0,5);
}
function intervalo($horas){
    $seconds = 0;
     foreach ( $horas as $hora ) {
            list( $g, $i, $s ) = explode( ':', $hora );
            if ($g < 0) {
                $i *= -1;
                $s *= -1;
            }
            $seconds += $g * 3600;
            $seconds += $i * 60;
            $seconds += $s;
        }
            $hours    = floor( $seconds / 3600 );
            $seconds -= $hours * 3600;
            $minutes  = floor( $seconds / 60 );
            $seconds -= $minutes * 60;
            //return "{$hours}:{$minutes}:{$seconds}"; 
            return Util::lpad($hours).":".Util::lpad($minutes); 
 }
require_once($a.'-'.$b.".php");