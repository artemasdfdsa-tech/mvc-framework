<?php

namespace Core;

abstract class Middleware
{
    /**
     * Handle the middleware.
     *
     * @param \Closure $next
     * @return mixed
     */
    abstract public function handle($request, $next);
}