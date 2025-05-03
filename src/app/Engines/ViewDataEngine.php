<?php
namespace Odama\Engines;

use Odama\Repositories\Html\AreaRepository;
use Odama\Web\HtmlAreaList;
use Odama\Web\Options;
use Odama\Files\Filemanager;
use Odama\Helpers\Arr;

class ViewDataEngine
{
    static $shared = false;

    
    public static function share($name = null, $value=null)
    {
        if(static::$shared) return true;;
        $a = $name?(is_array($name)?$name:(is_string($name)?[$name=>$value]: [])):[];
        view()->share($a);

        static::$shared = true;

        return true;
    }
}
