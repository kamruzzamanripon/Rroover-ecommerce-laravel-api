<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class checkForAllScopes {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( Request $request, Closure $next, ...$scopes ) {
        if ( !$request->user() || !$request->user()->token() ) {
            throw new AuthenticationException();
        }

        foreach ( $scopes as $scope ) {
            if ( $request->user()->tokenCan( $scope ) ) {
                //dd( $request->user()->tokenCan( $scope ) );
                return $next( $request );
            }
        }

        return response( array( "message" => "Not Authorized." ), 403 );
    }
}
