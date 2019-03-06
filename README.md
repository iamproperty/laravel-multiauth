# Laravel Multi-Auth

This will help automatically assigning the correct guard so that when you call `Request::user()` or `Auth::user()` there is no need to specify the guard.

## Installation

Install the package using Composer.

```
composer install iamproperty/laravel-multiauth
```

Register the guard map:
```
class AuthServiceProvider
{
    public function boot()
    {
        // ...
        
        SetGuardHint::guardMap([
            'agent' => \MoveButler\Agent::class,
        ]);
    }
}
```

Register the login listener:

```
class EventServiceProvider
{
    protected $listen = [
        // ...
        \Illuminate\Auth\Events\Login::class => [
            \IAMProperty\MultiAuth\SetGuardHint::class,
        ],
        // ...
```

Register the middleware:
```
class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\StartSession::class,
        // Add after the session is started
            \IAMProperty\MultiAuth\SetGuardFromHint::class,
        // ...
```

## Configuration

There is no need to configure anything manually, but if you want to you can publish the config file.

```
php artisan vendor:publish --provider="IAMProperty\MultiAuth\MultiAuthServiceProvider"
```
