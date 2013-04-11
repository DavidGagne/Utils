<?php

namespace Dws\Utils;

/**
 * 
 *
 * @author Juni Samoe <juni.samos@diamondwebservices.com>
 */
class StaticData
{

    public static function daysOfMonth($start=1, $end=31)
    {

        $rtnArray = array();
        $range = range($start, $end);

        foreach ($range as $value) {
            $rtnArray[$value] = $value;
        }

        return $rtnArray;
    }

    public static function years($decend = false, $start=1900, $end=null)
    {
        $rtnArray = array();

        if (!$end) $end = date("Y");
        $range = range($start, $end);

        if ($decend) {
            $range = array_reverse($range);    
        }

        foreach ($range as $value) {
            $rtnArray[$value] = $value;
        }

        return $rtnArray;

    }

    public static function months($fromNow=false)
    {

        $months = array();
        $currentMonth = $fromNow ? (int)date('m') : 1;

        for ($x = $currentMonth; $x < $currentMonth+12; $x++) {            
            $months[$x] = date('F', mktime(0, 0, 0, $x, 1));
        }

        return $months;

    }

    public static function usStates()
    {

        return array(
                    'AL'=>"Alabama",  
                    'AK'=>"Alaska",  
                    'AZ'=>"Arizona",  
                    'AR'=>"Arkansas",  
                    'CA'=>"California",  
                    'CO'=>"Colorado",  
                    'CT'=>"Connecticut",  
                    'DE'=>"Delaware",  
                    'DC'=>"District Of Columbia",  
                    'FL'=>"Florida",  
                    'GA'=>"Georgia",  
                    'HI'=>"Hawaii",  
                    'ID'=>"Idaho",  
                    'IL'=>"Illinois",  
                    'IN'=>"Indiana",  
                    'IA'=>"Iowa",  
                    'KS'=>"Kansas",  
                    'KY'=>"Kentucky",  
                    'LA'=>"Louisiana",  
                    'ME'=>"Maine",  
                    'MD'=>"Maryland",  
                    'MA'=>"Massachusetts",  
                    'MI'=>"Michigan",  
                    'MN'=>"Minnesota",  
                    'MS'=>"Mississippi",  
                    'MO'=>"Missouri",  
                    'MT'=>"Montana",
                    'NE'=>"Nebraska",
                    'NV'=>"Nevada",
                    'NH'=>"New Hampshire",
                    'NJ'=>"New Jersey",
                    'NM'=>"New Mexico",
                    'NY'=>"New York",
                    'NC'=>"North Carolina",
                    'ND'=>"North Dakota",
                    'OH'=>"Ohio",  
                    'OK'=>"Oklahoma",  
                    'OR'=>"Oregon",  
                    'PA'=>"Pennsylvania",  
                    'RI'=>"Rhode Island",  
                    'SC'=>"South Carolina",  
                    'SD'=>"South Dakota",
                    'TN'=>"Tennessee",  
                    'TX'=>"Texas",  
                    'UT'=>"Utah",  
                    'VT'=>"Vermont",  
                    'VA'=>"Virginia",  
                    'WA'=>"Washington",  
                    'WV'=>"West Virginia",  
                    'WI'=>"Wisconsin",  
                    'WY'=>"Wyoming"
        );

    }

}