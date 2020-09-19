<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')
             ->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        // check if they're an existing user
        $user = User::firstOrCreate([
            'google_id'       => $googleUser->id
        ], [
            'username'        => $googleUser->name,
            'email'           => $googleUser->email,
            'avatar'          => $googleUser->avatar,
            'avatar_original' => $googleUser->avatar_original,
        ]);

        Auth::login($user, true);

        activity()
            ->performedOn($user)
            ->useLog('login')
            ->log('google');

        return Redirect::to('/');
    }

    function authenticated(Request $request, $user)
    {
        activity()
            ->performedOn($user)
            ->useLog('login')
            ->log('email');
    }

    public function showLoginForm()
    {
        //FIXME!
        $tutoId = App::getLocale() === 'fr_FR' ? 23 : 28;

        return view('auth.login', [
            'tutoStory' => Story::where('id', $tutoId)->first()
        ]);
    }

    public function logout(Request $request)
    {
        $locale =  Session::get('locale');
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request, $locale) ?: redirect('/');
    }

    protected function loggedOut(Request $request, $locale)
    {
        Session::put('locale', $locale);
    }
}
