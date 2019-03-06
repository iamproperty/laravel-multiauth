<?php

namespace IAMProperty\MultiAuth;

class AuthManager extends \Illuminate\Auth\AuthManager
{
    /**
     * @inheritdoc
     */
    public function shouldUse($name)
    {
        $name = $this->hasGuard($name) ? $name : null;

        parent::shouldUse($name);
    }

    /**
     * Is the guard configured?
     *
     * @param string $name
     *
     * @return bool
     */
    protected function hasGuard($name)
    {
        return $this->getConfig($name) !== null;
    }
}
