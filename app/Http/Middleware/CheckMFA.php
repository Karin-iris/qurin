<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckMFA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ユーザーがログインしているか確認
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            // MFAが有効であり、まだ検証されていない場合
            if ($admin->mfa_enabled && !$request->session()->get('mfa_verified', false)) {
                // MFA検証ページへリダイレクト
                return redirect()->route('mfa.showVerifyForm');
            }
        }

        // MFA検証が不要、または完了している場合、次のリクエストへ進む
        return $next($request);
    }
}
