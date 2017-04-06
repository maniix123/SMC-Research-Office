<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\notify;
use App\User;
use Auth;
use App\post;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $unreadNotificationsCount = notify::where('is_read', 'false')->orderBy('created_at', 'desc')->get();
        $notificationsBody = notify::orderBy('created_at', 'desc')->get();
        $pendingUsers = User::where('pending_status', 'pending')->orderBy('created_at', 'desc')->get();
        view()->share(['unreadNotificationsCount' => $unreadNotificationsCount, 'pendingUsers' => $pendingUsers, 'notificationsBody' => $notificationsBody]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
