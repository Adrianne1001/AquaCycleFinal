<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                // ->subject('Aquacycle Registration')
                // ->line('Click the button below to verify your email address.')
                // ->action('Verify Email, Ka-Tata!', $url);
                ->view('auth.verify-custom',[
                    'user' => $notifiable,
                    'url' => $url,
                ]);
        });
    }
}
