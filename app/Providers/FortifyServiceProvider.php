<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\StatefulGuard;
use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\Controllers\AdminController;
use Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when([AdminController::class,  AttemptToAuthenticate::class, RedirectIfTwoFactorAuthenticatable::class])
        ->needs(StatefulGuard::class)
        ->give(function(){
            return Auth::guard('admin');
            // قبل ما اكتب اي سطر ثاني هنا في ال register() في عندي سؤال وهو انا سجلت ال guard صحيح ولكن هيك انا اصبحفي عندي تعارض بينو وبين ال guard('web') فيجب ان اقول لل provider انو ما يستخدم الاشي الجديد الي ضفتو انا وايضا ايش بدو هلأشي الجديد من classes علشان يتكامل استخدامو 
            // class from AuthenticatedSessionController
    
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
