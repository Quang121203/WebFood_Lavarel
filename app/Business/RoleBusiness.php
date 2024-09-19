<?php

namespace App\Business;

use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\User;

class RoleBusiness
{
    public static function getById($id){
        return Role::find($id);
    }

    public static function getRoleUser($id)
    {
        $user = UserBusiness::getList(1);
        $role_user = UserBusiness::getByRoleId($id,1)->toArray();
        $roleUserId = array_column($role_user, 'id');
        foreach ($user as $item) {
            $item['check'] = in_array($item['id'], $roleUserId);
        }
        $sorted = $user->sortByDesc('check');
        return $sorted->values()->all();
    }

    public static function getList()
    {
        $returnVal = Role::where("id","!=", 1)->orderBy("created_at", 'desc')->get();
        return $returnVal;
    }

    public static function validateInput($aInput)
    {
        $ruleValidate = [
            'name' => [
                "required",
                "max:255"
            ]
        ];

        $messages = [
            'name.required' => 'You have not entered a name.',
            'name.max' => 'Name must not exceed 255 characters.',
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
        $role = $id == 0 ? new Role() : Role::find($id);
        $role->fill($aInput);
        $role->save();
        return ["success" => true, "msg" => "Saved successfully"];
    }

    public static function delete($id)
    {
        $user = User::where("role_id", "=", $id)->first();
        if (isset($user)) {
            return ["success" => false, "msg" => "The remaining users in the role cannot be deleted"];
        }
        $role = self::getById($id);
        if ($role) {
            $role->delete();
            return ["success" => true, "msg" => "Deleted successfully"];
        } else {
            return ["success" => false, "msg" => "Role does not exist!"];
        }
    }
}