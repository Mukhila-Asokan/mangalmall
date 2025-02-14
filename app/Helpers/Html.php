<?php

use Ezyang\HTMLPurifier\HTMLPurifier;
use Ezyang\HTMLPurifier\Config as HTMLPurifier_Config;

if (! function_exists('purify')) {
    function purify($html)
    {
        $config = HTMLPurifier_Config::createDefault(); 
        print_r($config);exit();
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($html);

       
    }
}
?>  