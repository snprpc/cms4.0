<?php

namespace app\index\model;

use app\admin\controller\CategoryEdit;
use think\Model;
use think\Db;

class Category extends Model
{
    protected $pk = 'id';
    protected $field = true;

    public static function getCategories() {
        return Db::name('category')->order('sort')->select();
    }

    public static function getCategoryById ($id) {
        return Db::name('category')->where('id', $id)->find();
    }
    public static function updateCategoryById ($request) {
        $category = new Category;
        return $category->allowField(true)->save($request,['id' => $request['id']]);
    }
    public static function deleteCategoryById($id){
        return Db::name('category')->where('id',$id)->delete();
    }
    public static function createCategoryByRequest ($request) {
        return Db::table('category')->insert($request);
    }

}