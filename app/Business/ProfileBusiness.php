<?php

namespace App\Business;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileBusiness
{
    public static function validateInput($aInput)
    {
        $ruleValidate = [
            'name' => [
                "required"
            ],
            'address' => [
                "required"
            ],
            'phone' => [
                "required"
            ]
        ];

        $messages = [
            'name.required' => 'You have not entered a name.',
            'address.required' => 'You have not entered a address.',
            'phone.required' => 'You have not entered a phone.',
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

    public static function save($request)
    {
        $aInput = $request->all();
        $validateRs = self::validateInput($aInput);
        if (!$validateRs["success"]) {
            return $validateRs;
        }

        if (isset($aInput['img'])) {
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $fileName = time() . $aInput["img"];
                Storage::disk('public')->put("users/" . $fileName, file_get_contents($file));
                $aInput["img"] = $fileName;
            }
        }

        $id = $aInput['id'] ?? 0;
        $user = User::find($id);
        $path = "users/" . $user->img;

        if (isset($user->img) && Storage::disk('public')->exists($path) && $aInput['img'] != $user->img) {
            Storage::disk('public')->delete($path);
        }

        $user->fill($aInput);
        $user->save();
        return ["success" => true, "msg" => "Saved successfully","user" => $user];
    }
}