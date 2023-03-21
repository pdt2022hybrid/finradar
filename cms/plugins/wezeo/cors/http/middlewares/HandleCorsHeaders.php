<?php namespace Wezeo\CORS\Http\Middlewares;

class HandleCorsHeaders
{
    public function handle($request, \Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            return response(null, 200, $this->_getHeaders());
        }

        $response = $next($request);
        $response->headers->add($this->_getHeaders());

        return $response;
    }

    protected function _getHeaders()
    {
        return [
            'Access-Control-Allow-Origin'  => config('wezeo.cors::origin'),
            'Access-Control-Allow-Headers' => config('wezeo.cors::headers'),
            'Access-Control-Allow-Methods' => config('wezeo.cors::methods'),
        ];
    }
}
