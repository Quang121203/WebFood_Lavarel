<?php

namespace App\Business;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderBusiness
{
    public static function getById($id)
    {
        return Order::find($id);
    }

    public static function validateInput($aInput)
    {
        $ruleValidate = [
            'name' => [
                "required",
                "max:255"
            ],
            'phone' => [
                "required",
                "max:11"
            ],
            'email' => [
                "required",
                "max:255"
            ],
            'address' => [
                "required",
                "max:255"
            ],
            'total' => [
                "required",
                'gt:0'
            ]
        ];

        $messages = [
            'name.required' => 'You have not entered a name.',
            'name.max' => 'Name must not exceed 255 characters.',
            'phone.required' => 'You have not entered a phone number.',
            'phone.max' => 'Phone number must not exceed 11 characters.',
            'email.required' => 'You have not entered an email address.',
            'email.max' => 'Email address must not exceed 255 characters.',
            'address.required' => 'You have not entered an address.',
            'address.max' => 'Address must not exceed 255 characters.',
            'total.gt' => 'The cart is empty.'
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

    public static function create($aInput)
    {
        $validateRs = self::validateInput($aInput);
        if (!$validateRs["success"]) {
            return $validateRs;
        }
        $order = new Order();
        $order->fill($aInput);
        $order->save();
        return ["success" => true, "msg" => "Order placed successfully.", "id" => $order->id];
    }
}