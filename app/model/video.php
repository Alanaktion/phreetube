<?php
namespace Model;

class Video extends \Model
{

    function ago()
    {
        $time = strtotime($this->date_added);

        $periods = array("second", "minute", "hour", "day", "week", "month", "year");
        $lengths = array(60, 60, 24, 7, 4.35, 12);
 
        $now = time();
 
        $difference = $now - $time;
        $tense = "ago";
 
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
 
        $difference = round($difference);
 
        if($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] $tense";
    }

}
