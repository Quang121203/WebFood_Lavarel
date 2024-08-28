<?php

namespace App\Business;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthBusiness
{
    public static function getByEmail($email)
    {
        return User::where('email', '=', $email)->get();
    }
    public static function validateInput($aInput)
    {
        $ruleValidate = [
            'name' => [
                "required",
                "max:255"
            ],
            'email' => [
                "required",
                "max:255"
            ],
            'phone' => [
                "required",
                "max:11"
            ],
            'password' => [
                "required"
            ],
            'address' => [
                "required",
                "max:255"
            ],
        ];

        $messages = [
            'name.required' => 'You have not entered a name.',
            'name.max' => 'Name must not exceed 255 characters.',
            'email.required' => 'You have not entered a email.',
            'email.max' => 'Email must not exceed 255 characters.',
            'phone.required' => 'You have not entered a phone.',
            'phone.max' => 'Phone must not exceed 11 characters.',
            'password.required' => 'You have not entered a password.',
            'address.required' => 'You have not entered a address.',
            'address.max' => 'Address must not exceed 255 characters.',
        ];

        $validator = Validator::make($aInput, $ruleValidate, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();
            $msg = "<ul>";
            foreach ($errors as $error) {
                foreach ($error as $message) {
                    $msg = $msg . "<li>{$message}</li>";
                }
            }
            $msg = $msg . "</ul>";
            return ["success" => false, "msg" => $msg];
        }
        return ["success" => true];
    }

    public static function register($aInput)
    {
        $validateRs = self::validateInput($aInput);
        if (!$validateRs["success"]) {
            return $validateRs;
        }

        $user = self::getByEmail($aInput['email']);
        if (count($user) > 0) {
            return ["success" => false, "msg" => "Email already exists"];
        }
        User::create([
            'name' => $aInput['name'],
            'email' => $aInput['email'],
            'phone' => $aInput['phone'],
            'address' => $aInput['address'],
            'role_id' => 1,
            'password' => bcrypt($aInput['password']),
        ]);

        return ["success" => true, "msg" => "Register successfully"];
    }
    public static function validateInputLogin($aInput)
    {
        $ruleValidate = [

            'email' => [
                "required",
                "max:255"
            ],
            'password' => [
                "required"
            ]
        ];

        $messages = [
            'email.required' => 'You have not entered a email.',
            'email.max' => 'Email must not exceed 255 characters.',
            'password.required' => 'You have not entered a password.',
        ];

        $validator = Validator::make($aInput, $ruleValidate, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();
            $msg = "<ul>";
            foreach ($errors as $error) {
                foreach ($error as $message) {
                    $msg = $msg . "<li>{$message}</li>";
                }
            }
            $msg = $msg . "</ul>";
            return ["success" => false, "msg" => $msg];
        }
        return ["success" => true];
    }

    public static function login($aInput)
    {
        $validateRs = self::validateInputLogin($aInput);
        if (!$validateRs["success"]) {
            return $validateRs;
        }
    
        if (Auth::attempt($aInput)) {
            return ["success" => true, "msg" => "Login successfully"];
        }
        return ["success" => false, "msg" => 'Invalid credentials. Please try again.'];
    }

    public static function logout()
    {
        Auth::logout();
        return ["success" => true, "msg" => "Logout successfully"];
    }
}
