<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function redirectUrl()
    {
        $url = Socialite::driver('github')
            ->stateless()
            ->scopes(['user:email'])
            ->redirect()
            ->getTargetUrl();

        return response()->json(['url' => $url]);
    }



    public function callback()
    {
        $frontendUrl = config('app.frontend_url');

        try {
            $githubUser = Socialite::driver('github')->stateless()->scopes(['user:email'])->user();
        } catch (\Throwable $e) {
            return redirect($frontendUrl . '/login?error=github_failed');
        }

        $email = $githubUser->getEmail();
        if (!$email) {
            $email = 'github_' . $githubUser->getId() . '@no-email.local';
        }


        $user = User::where('github_id', $githubUser->getId())->first();

        if (!$user) {
            $user = User::create([
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'email' => $email,
                'github_id' => $githubUser->getId(),
                'password' => Str::random(32),
            ]);
        }

        $tempToken = Str::random(40);
        Cache::put('github_temp_' . $tempToken, $user->id, now()->addSeconds(60));

        return redirect($frontendUrl . '/auth/callback?temp=' . $tempToken);
    }

    // POST, сюда фронт меняет temp-токен на настоящий JWT
    public function exchange(Request $request)
    {
        $request->validate(['temp' => 'required|string']);

        $userId = Cache::pull('github_temp_' . $request->temp); // pull = достать и сразу удалить

        if (!$userId) {
            return response()->json(['message' => 'Invalid or expired token'], 401);
        }

        $user = User::findOrFail($userId);
        $token = Auth::guard('api')->login($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
