<?php

namespace App\Business;

use App\Models\Menu;
use App\Models\RoleMenu;

class MenuBusiness
{
    public static function getById($id)
    {
        $returnVal = Menu::find($id);
        return $returnVal;
    }

    public static function getListByLevel($level)
    {
        $returnVal = Menu::where('level', $level)->orderBy("name", 'asc')->get();
        return $returnVal;
    }

    public static function getListByParent($id_parent)
    {
        $returnVal = Menu::where('id_parent', $id_parent)->orderBy("name", 'asc')->get();
        return $returnVal;
    }

    public static function getRoleMenu($role_id)
    {
        $role_menu = RoleMenu::where('role_id', $role_id)->get()->toArray();
        $role_menu_id = array_column($role_menu, 'menu_id');
        $menus = MenuBusiness::getListByLevel(0);
        foreach ($menus as $menu) {
            $menu['check']=false;
            $submenus = MenuBusiness::getListByParent($menu['id']);
            $menu['submenu'] = $submenus;
            foreach ($submenus as $submenu) {
                $submenu['check'] = in_array($submenu['id'], $role_menu_id);
                if($submenu['check']){
                    $menu['check']=true;
                }
            }
        }
        return $menus;
    }

    public static function saveBulkMenuRole($aInput)
    {
        $role_menus = RoleMenu::where('role_id', $aInput['role_id'])->get();
        foreach ($role_menus as $role_menu) {
            $role_menu->delete();
        }

        $valuesOn = array_filter($aInput, function ($value) {
            return $value === "on";
        });
        $data = [];
        foreach ($valuesOn as $key => $id) {
            $data[] = ['role_id' => $aInput['role_id'], 'menu_id' => $key];
        }

        RoleMenu::insert($data);
        return ["success" => true, "msg" => "Saved successfully"];
    }
}
