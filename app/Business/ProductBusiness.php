<?php

namespace App\Business;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductBusiness
{
    public static function getById($id)
    {
        return Product::find($id);
    }

    public static function getByCategotyId($category_id)
    {
        return Product::where("category_id", "=", $category_id)->orderBy("created_at", 'desc')->get();
    }

    public static function getList()
    {
        $returnVal = Product::orderBy("created_at", 'desc')->get();
        return $returnVal;
    }

    public static function getTopNumberBuy($number)
    {
        $returnVal = Product::orderBy("number_buy", 'desc')->take($number)->get();
        return $returnVal;
    }

    public static function buyProduct($id, $number)
    {
        $product = Product::find($id);
        $product['number_buy'] += $number;
        $product->save();
    }

    public static function validateInput($aInput)
    {
        $ruleValidate = [
            'name' => [
                "required",
                "max:255"
            ],
            'img' => [
                "required"
            ],
            'price' => [
                "required"
            ],
        ];

        $messages = [
            'name.required' => 'You have not entered a name.',
            'name.max' => 'Name must not exceed 255 characters.',
            'img.required' => 'You have not entered a image.',
            'price.required' => 'You have not entered a price.',
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
                Storage::disk('public')->put("products/" . $fileName, file_get_contents($file));
                $aInput["img"] = $fileName;
            }
        }

        $id = $aInput['id'] ?? 0;
        $product = $id == 0 ? new Product() : Product::find($id);
        $path = "products/" . $product->img;
        if ($id > 0 && $request->hasFile('avatar')) {
            Storage::disk('public')->delete($path);
        }
        $product['category_id'] = $aInput['category'];
        $product->fill($aInput);
        $product->save();
        return ["success" => true, "msg" => "Saved successfully"];
    }

    public static function delete($id)
    {
        $product = self::getById($id);
        if ($product) {
            Storage::disk('public')->delete("products/" . $product->img);
            $product->delete();
            return ["success" => true, "msg" => "Deleted successfully"];
        } else {
            return ["success" => false, "msg" => "Product does not exist!"];
        }
    }
}
