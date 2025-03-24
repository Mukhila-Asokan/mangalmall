<?php

use Ezyang\HTMLPurifier\HTMLPurifier;
use Ezyang\HTMLPurifier\Config as HTMLPurifier_Config;
use Modules\Venue\Models\ModuleAccess;
use Modules\Venue\Models\Menu;

if (! function_exists('purify')) {
    function purify($html)
    {
        $config = HTMLPurifier_Config::createDefault(); 
        print_r($config);exit();
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($html);
    }
}

if (!function_exists('hasMenuAccess')) {
    function hasMenuAccess($roleId, $menuName){
        $menu = Menu::where('menuname', $menuName)->first();
        if (!$menu) {
            return false;
        }
        return ModuleAccess::where('role_id', $roleId)
            ->where('menu_id', $menu->id)
            ->exists();
    }
}
?>  