<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyCategoriesCount
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
        if (Category::where('user_id', Auth::user()->id)->count() < 3) {
            session()->flash('error', 'You have to add at least 3 categories to be able to add a movie');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
