<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuditLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auditlogEnabled = config('app.auditlog_enabled');
        if ($auditlogEnabled) {
            $log = [];
            $log['request_token'] =  Str::uuid();
            $log['request_url'] = $request->getPathInfo();
            $log['request_method'] = $request->method();
            $log['request_query'] = $request->server('QUERY_STRING') ? $request->server('QUERY_STRING') : null;
            $log['request_payload'] = request()->getContent() ? request()->getContent() : null;
            $log['ip_address'] = $request->ip();
            $log['browser_useragent'] = $request->header('user-agent');
            $log['authorized'] =  Auth::check() ? Auth::user()->id : 1;
            $log['response_code'] = $request->server('REDIRECT_STATUS');
            AuditLog::create($log);
        }
        return $next($request);
    }
}
