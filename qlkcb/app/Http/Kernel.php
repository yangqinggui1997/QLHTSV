<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
             \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'UserBSKLogin' => \App\Http\Middleware\UserBSKLoginMiddleware::class,
        'UserTDLogin' => \App\Http\Middleware\UserTDLoginMiddleware::class,
        'UserAdminLogin' => \App\Http\Middleware\UserAdminLoginMiddleware::class,
        'UserKTLogin' => \App\Http\Middleware\UserKTLoginMiddleware::class,
        'UserHCLogin' => \App\Http\Middleware\UserHCLoginMiddleware::class,
        'TCCCAccess' => \App\Http\Middleware\UserTDCCAccessMiddleware::class,
        'TDKBAccess' => \App\Http\Middleware\UserTDKBAccessMiddleware::class,
        'BSCC_Ad_Access' => \App\Http\Middleware\UserBSKCC_Ad_AccessMiddleware::class,
        'BSK_BSCC_Ad_Access' => \App\Http\Middleware\UserBSK_BSCC_Ad_AccessMiddleware::class,
        'BSK_BSCC_PT_Ad_Access' => \App\Http\Middleware\UserBSK_BSCC_PT_Ad_AccessMiddleware::class,
        'BSK_Ad_Access' => \App\Http\Middleware\UserBSK_Ad_AccessMiddleware::class,
        'BSKT_Ad_Access' => \App\Http\Middleware\UserBSKT_Ad_AccessMiddleware::class,
        'HC_Access' => \App\Http\Middleware\UserHCAccessMiddleware::class,
        'QLCK_Access' => \App\Http\Middleware\UserQLCKAccessMiddleware::class,
        
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
