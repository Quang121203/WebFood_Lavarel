<?php

namespace App\Business;

use Illuminate\Support\Facades\Validator;
use App\Business\AuthBusiness;
use App\Models\User;

class UserBusiness
{
    public static function getList($isActive)
    {
        $returnVal = User::where("isActive", $isActive)->orderBy("created_at", 'desc')->get();
        return $returnVal;
    }

    public static function getByRoleId($roleId, $isActive)
    {
        return User::where("role_id", "=", $roleId)->where("isActive", $isActive)->orderBy("created_at", 'desc')->get();
    }

    public static function getById($id)
    {
        return User::find($id);
    }

    public static function validateInput($aInput)
    {
        $ruleValidate = [
            'name' => [
                "required",
                "max:255"
            ],
            'address' => [
                "required",
                "max:255"
            ],
            'phone' => [
                "required",
                "max:11",
            ],
            'email' => [
                "required",
                "max:255"
            ]
        ];

        $messages = [
            'name.required' => 'You have not entered a name.',
            'name.max' => 'Name must not exceed 255 characters.',
            'address.required' => 'You have not entered a address.',
            'address.max' => 'Address must not exceed 255 characters.',
            'phone.required' => 'You have not entered a phone.',
            'phone.max' => 'Phone must not exceed 11 characters.',
            'email.required' => 'You have not entered a email.',
            'email.max' => 'Email must not exceed 255 characters.',
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

    public static function save($aInput)
    {
        $validateRs = self::validateInput($aInput);
        if (!$validateRs["success"]) {
            return $validateRs;
        }
        $id = $aInput['id'] ?? 0;
        $user = $id == 0 ? new User() : User::find($id);
        if ($id == 0) {
            $aInput['password'] ??= "123456";
            AuthBusiness::register($aInput);
        } else {
            unset($aInput['password']);
            $user->fill($aInput);
            $user->save();
        }
    
        return ["success" => true, "msg" => "Saved successfully"];
    }

    public static function delete($id)
    {
        $user = self::getById($id);
        $user->isActive=0;
        $user->save();
        return ["success" => true, "msg" => "Saved successfully"];
    }
}