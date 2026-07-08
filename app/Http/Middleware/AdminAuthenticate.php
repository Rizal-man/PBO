<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Database\Eloquent\Model;

class AdminAuthenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards): mixed
    {
        $this->authenticate($request, $guards);

        /** @var Model|null $user */
        $user = Filament::auth()->user();

        if ($user instanceof FilamentUser && ! $user->canAccessPanel(Filament::getCurrentOrDefaultPanel())) {
            return redirect('/')->with('error', 'No Access! Only admin accounts can access this panel.');
        }

        if (! $user instanceof FilamentUser && config('app.env') !== 'local') {
            abort(403);
        }

        return $next($request);
    }

    protected function authenticate($request, array $guards): void
    {
        $guard = Filament::auth();

        if (! $guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse(Filament::getAuthGuard());
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }
}
