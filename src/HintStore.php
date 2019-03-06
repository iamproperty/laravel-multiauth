<?php

namespace IAMProperty\MultiAuth;

use Illuminate\Contracts\Session\Session;

class HintStore
{
    /** @var Session */
    private $session;
    /** @var string */
    private $hintName;

    public function __construct(Session $session, string $hintName)
    {
        $this->session = $session;
        $this->hintName = $hintName;
    }

    /**
     * Get the guard hint.
     *
     * @return string|null
     */
    public function getHint()
    {
        return $this->session->get($this->hintName);
    }

    /**
     * Set the guard hint.
     *
     * @param string  $name
     *
     * @return void
     */
    public function setHint($name)
    {
        $this->session->put($this->hintName, $name);
    }
}
