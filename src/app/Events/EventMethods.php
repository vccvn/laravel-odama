<?php

namespace Odama\Events;

use Closure;

/**
 * các phương thúc với event
 * @method void on(string $event, Closure $closure) lắng nghe sự kiện
 * @method void addEventListener(string $event, Closure $closure) lắng nghe sự kiện
 * @method void trigger(string $event, ...$params) Kích hoạt sự kiện
 * @method void fire(string $event, ...$params) Kích hoạt sự kiện
 * @method static void on(string $event, Closure $closure) lắng nghe sự kiện
 * @method static void addEventListener(string $event, Closure $closure) lắng nghe sự kiện
 * @method static void trigger(string $event, ...$params) Kích hoạt sự kiện
 * @method static void fire(string $event, ...$params) Kích hoạt sự kiện
 * @method static void emit(string $event, ...$params) Kích hoạt sự kiện
 * 
 * 
 */
trait EventMethods
{
    protected static $events = [];

    protected static $eventMethods = [
        'on',
        'addEventListener',
        'trigger',
        'fire',
        'emit',
        'hasEvent',
        'removeEventListener',
    ];

    /**
     * khai báo mảng chứa các event cho class
     *
     * @return void
     */
    public static function makeEventContainerByCurrentClassName()
    {
        $classname = static::class;
        if (!array_key_exists($classname, static::$events)) {
            static::$events[$classname] = [];
        }
    }

    /**
     * lắng nghe sự kiện
     *
     * @param string $event
     * @param \Closure $closure
     * @return bool
     */
    protected static function _on($event, $closure)
    {
        if (is_string($event) && is_callable($closure)) {
            $event = strtolower($event);
            static::makeEventContainerByCurrentClassName();
            if (!array_key_exists($event, static::$events[static::class])) {
                static::$events[static::class][$event] = [];
            }
            static::$events[static::class][$event][] = $closure;
            return true;
        }
        return false;
    }

    /**
     * gọi sự kiện
     *
     * @param string $event
     * @param mixed ...$params
     * @return mixed
     */
    public static function _emit($event, ...$params)
    {
        if (is_string($event)) {
            $event = strtolower($event);
            static::makeEventContainerByCurrentClassName();
            if (array_key_exists($event, static::$events[static::class]) && count(static::$events[static::class][$event])) {
                $arr = [];
                foreach (static::$events[static::class][$event] as $closure) {
                    $arr[] = $closure(...$params);
                }
                return $arr;
            }
        }
        return null;
    }

    public static function _removeEventListener($event = null, $closure = null)
    {
        if (is_string($event)) {
            $event = strtolower($event);
            static::makeEventContainerByCurrentClassName();
            if (array_key_exists($event, static::$events[static::class]) && count(static::$events[static::class][$event])) {
                if($closure){
                    static::$events[static::class][$event] = array_filter(static::$events[static::class][$event], function($item) use ($closure){
                        return $item !== $closure;
                    });
                }else{
                    static::$events[static::class][$event] = [];
                }
            }
        }
        elseif(is_array($event)){
            foreach($event as $e => $c){
                static::_removeEventListener($e, $c);
            }
        }
        elseif(!$event){
            static::$events[static::class] = [];
        }
    }

    /**
     * Kiểm tra event có tồn tại hay chưa
     *
     * @param string $event
     * @return bool
     */
    public static function _eventExists($event)
    {
        if (is_string($event)) {
            $event = strtolower($event);
            static::makeEventContainerByCurrentClassName();
            if (array_key_exists($event, static::$events[static::class]) && count(static::$events[static::class][$event])) {
                return true;
            }
        }
        return false;
    }

    public static function callEventMethod($fn, $params = [])
    {
        static::makeEventContainerByCurrentClassName();
        if (is_string($fn) && is_array($params) && in_array($fn, static::$eventMethods)) {
            // $fn = strtolower($fn);

            switch ($fn) {
                case 'on':
                case 'addEventListener':
                    return static::_on(...$params);
                case 'emit':
                case 'fire':
                case 'trigger':
                case 'dispatchEvent':
                    return static::_emit(...$params);
                case 'hasEvent':
                    return static::eventExists(...$params);
                case 'removeEventListener':
                    return static::_removeEventListener(...$params);
            }
        }
    }

    /**
     * kiểm tra event có tồn tại hay không
     *
     * @param string $event
     * @return boolean
     */
    public function hasEvent($event)
    {
        return static::eventExists($event);
    }

}
