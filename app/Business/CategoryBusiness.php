<?php

namespace App\Business;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CategoryBusiness
{
    public static function getById($id)
    {
        return Category::find($id);
    }

    public static function getList()
    {
        $returnVal = Category::orderBy("created_at", 'desc')->get();
        return $returnVal;
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
        ];

        $messages = [
            'name.required' => 'You have not entered a name.',
            'name.max' => 'Name must not exceed 255 characters.',
            'img.required' => 'You have not entered a image.',
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
                Storage::disk('public')->put("categories/" . $fileName, file_get_contents($file));
                $aInput["img"] = $fileName;
            }
        }

        $id = $aInput['id'] ?? 0;
        $category = $id == 0 ? new Category() : Category::find($id);
        $path = "categories/" . $category->img;
        if ($id > 0 && $request->hasFile('avatar')) {
            Storage::disk('public')->delete($path);
        }

        $category->fill($aInput);
        $category->save();
        return ["success" => true, "msg" => "Saved successfully"];
    }

    public static function delete($id)
    {
        $product = Product::where("category_id", "=", $id)->first();
        if (isset($product)) {
            return ["success" => false, "msg" => "The remaining products in the category cannot be deleted"];
        }
        $category = self::getById($id);
        if ($category) {
            Storage::disk('public')->delete("categories/" . $category->img);
            $category->delete();
            return ["success" => true, "msg" => "Deleted successfully"];
        } else {
            return ["success" => false, "msg" => "Category does not exist!"];
        }
    }
}
