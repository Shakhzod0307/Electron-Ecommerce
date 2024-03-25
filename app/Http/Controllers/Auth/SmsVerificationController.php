<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class SmsVerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

//    public function showRegistrationForm()
//    {
//        return view('auth.register');
//    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, create new user
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ];
//        $user = $request->all();
        $code = mt_rand(100000,999999);
//        dd(trim($user['phone']));
            session()->put('user',$user);
            session()->put('code',$code);
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MTI0MjMwNjEsImlhdCI6MTcwOTgzMTA2MSwicm9sZSI6InRlc3QiLCJzaWduIjoiYWE3MDU1MDllYzRkYThkZjYwMzY5MjAwNjc5NzkyMGM4NjY0OTJhMWU2NzZmODg5MmYxMDA0N2M1ZmE4Y2JjMyIsInN1YiI6IjUxMTgifQ.Q85Cm28Oct3aoySlzcuYok8ar5RN8smIy4fl2GfvZic';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'notify.eskiz.uz/api/message/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('mobile_phone' => trim($user['phone']),'message' => 'Your verification code '.$code,'from' => '4546','callback_url' => 'http://0000.uz/test.php'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
//        echo $response;
        // Auth::login($user);

        // Redirect the user after successful registration
        return view('Auth.sms-verify');
    }

    public function verify(Request $request)
    {
        $verificationcode = trim($request->code);
        $user = session()->get('user');
        $code = trim(session()->get('code'));
//        dd($code,$verificationcode,$user);
        try {
            if($code === $verificationcode){
                $newuser = new User();
                $newuser->name = $user['name'];
                $newuser->email = $user['email'];
                $newuser->phone = $user['phone'];
                $newuser->password = $user['password'];
                $newuser->save();
                Auth::login($newuser);
                return redirect()->to('/');
            }
        }catch (Exception $e){
            Log::error($e->getMessage());
            return redirect()->to('/register');
        }

    }
}
