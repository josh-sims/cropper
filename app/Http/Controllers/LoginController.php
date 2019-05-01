<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Adldap\AdldapInterface;
use Adldap\Laravel\Facades\Adldap;
use App\user_roles;
use App\MarketingCampaign;
use App\WebcastBrief;
use App\ChangeRequest;
use App\preset;

class LoginController extends Controller
{
    public function __construct()
    {
        /**
         * This is a super user list, if they are here they have access to everything. Period. Including RW
         * @var array
         */
         $this->admin_list = array(
           'testuser@test.com'
         );
    }
    public function index()
    {
        $admin_list = $this->admin_list;
        $_SESSION = session()->all(); // Grab session data so we can check if they are already logged in
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {  
            $presets = preset::all()->where('user', Session()->get('email'));
            return view('cropper', compact('presets'));
        } else {
            session([
                'loggedIn' => false
            ]);
            return view('welcome');
        }

    }


    public function logout()
    {
        session([
            'loggedIn' => false,
            'email' => ''
        ]);

        return view('welcome');
    }

    public function doLogin()
    {
        try {
			$email = strtolower(Input::get('email'));
            $admin_list = $this->admin_list;
            $current_user_roles = user_roles::where('email','like',$email)->value('page_role');
            // $current_role = user_roles::where('email','LIKE',\Session::get('email'))->value('page_role');
            $current_role = explode(" ", $current_user_roles);

            if (Adldap::auth()->attempt($email, Input::get('password'), $bindAsUser = true)) {
                if (in_array($email, $admin_list)) {
                    session([
                        'admin' => true
                    ]);
                } else {
                    session([
                        'admin' => false
                    ]);
                }
                session([
                    'email' => $email,
                    'loggedIn' => true,
                    'formFilledOut' => false
                ]);
                foreach ($current_role as $key => $value) {
                    $role = substr($value, strpos($value, '|') + 1 );
                    Session([
                        $role => substr($value, 0, strpos($value, "|".$role))
                    ]);
                }
                $_SESSION = session()->all();

                return $this->index();

            } else {
                // Credentials were incorrect.
                return Redirect::to('/')->withErrors('Username/Password Incorrect');
            }
        } catch (\Exception $e) {
            dd($e);
            //dd('IT Password change. Contact conrad.grant@realpage.com regarding fixing this');
        } catch (\Adldap\Auth\UsernameRequiredException $e) {
            // The user didn't supply a username.
        } catch (\Adldap\Auth\PasswordRequiredException $e) {
            // The user didn't supply a password.
        }
    }
}
