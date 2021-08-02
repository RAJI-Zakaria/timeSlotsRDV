<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     * get the emailPersonne of the user
     *
     * @return string
     */
    public function login(Request $request)
    {
        //$input = $request->all();
        $login = filter_var($request->emailPerson,FILTER_VALIDATE_EMAIL) ? 'emailPerson' : 'namePerson';
        $user =  User::where($login,$request->emailPerson)->first();

        if($user){
            if(Hash::check($request->password, $user->getAuthPassword())) {
                Auth::loginUsingId($user->idPerson);


                if($user->guest!=null){

                    session(['guest' => true]);
                    session(['person' => $user]);
                    return redirect()->route('Dashboard-Guest');

                }elseif ($user->admin!=null){
                    session(['admin' => true]);
                    session(['person' => $user]);
                    return redirect()->route('Dashboard-Admin');
                }
            }
        }

        return redirect()->route('login')->with('error','Email or Password are not correct');
    }









//    use AuthenticatesUsers;
//
//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
//
//    public function login(Request $request)
//    {
//        $input = $request->all();
//        $this->validate($request,
//            [
//                'username'=>'required',
//                'password'=>'required'
//            ]);
//        $login = filter_var($request->emailPerson, FILTER_VALIDATE_EMAIL)?'emailPerson' : 'namePerson';
//
//        if(auth()->attempt(array($login => $input['emailPerson'], 'password'=>$input['password']))){
//            return redirect()->route("home");
//        }else{
//            return redirect()->route("login")->with('error','Email-address and password are wrong');
//        }
//
//    }


}
