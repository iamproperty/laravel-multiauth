<?php

namespace IAMProperty\MultiAuth;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Auth\Authenticatable;

class SetGuardHint
{
    /** @var HintStore */
    private $hintStore;
    protected static $guardMap = [];

    public function __construct(HintStore $hintStore)
    {
        $this->hintStore = $hintStore;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $guard = $this->getGuardName($event->user);

        $this->hintStore->setHint($guard);
    }

    /**
     * Set or get the guard map.
     *
     * @param  array  $map
     * @param  bool  $merge
     * @return array
     */
    public static function guardMap(array $map, $merge = true)
    {
        static::$guardMap = $merge && static::$guardMap ? $map + static::$guardMap : $map;

        return static::$guardMap;
    }

    /**
     * Get a guard name for a user.
     *
     * @param Authenticatable  $authenticatable
     *
     * @return string|null
     */
    protected function getGuardName(Authenticatable $authenticatable)
    {
        $name = get_class($authenticatable);
        $guard = array_search($name, self::$guardMap, true);

        return $guard ? (string)$guard : null;
    }
}
