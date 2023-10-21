<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;
use App\Models\Choosetherapist;
class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        view()->composer('Panel.therapist.header', function ($view) {
            // You can retrieve the $notcount variable here or calculate it as needed
           // Retrieve or calculate the value
           
            $notcount=Notifications::where('therapist_id',Auth::user()->id)->where('Mark_read','unread')->latest()->count();
            $not=Notifications::where('therapist_id',Auth::user()->id)->latest('created_at')->take($notcount)->get();
            $newclient=Choosetherapist::where('therapist_id',Auth::user()->id)->where('application_status','pending')->latest('created_at')->count();
            // ->where('Mark_read','unread')->latest()->count(); 
            // $notcount=1;
            if($notcount<=0){
                $notcount=0;
            }

            $view->with([
                'notcount'=> $notcount,
                'not'=>$not,
               'newclient'=> $newclient
                 ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
