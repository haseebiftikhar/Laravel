<?php

namespace Chatty\Http\Middleware;

use Closure;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;

class SessionLoader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $storage = new NativeSessionStorage(array('cookie_lifetime'=>600000,'gc_maxlifetime'=>60000), new NativeFileSessionHandler());
        $session = new Session($storage);

        app()->instance('Symfony\Component\HttpFoundation\Session\Session', $session);

        $session->start();
        return $next($request);
    }
}
