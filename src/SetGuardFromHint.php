<?php

namespace IAMProperty\MultiAuth;

use Closure;

class SetGuardFromHint
{
    /** @var AuthManager */
    private $authManager;
    /** @var HintStore */
    private $hintStore;

    public function __construct(AuthManager $authManager, HintStore $hintStore)
    {
        $this->authManager = $authManager;
        $this->hintStore = $hintStore;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $guard = $this->hintStore->getHint();
        $this->authManager->shouldUse($guard);

        return $next($request);
    }
}
