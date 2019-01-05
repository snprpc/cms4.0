<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\View;
use app\index\model\Article;
use app\index\model\Category;

class CategoryEdit extends Controller
{


    public function cp_category_edit (Request $request)
    {
        $category = Category::getCategoryById($request->param('id'));
        return view('cp_category_edit', ['category' => $category]);
    }

    public function edit_cate (Request $request) {
        $res = Category::updateCategoryById($request->param());
        if ($res == 0) {
            return $this->error('修改失败');
        } else {
            return $this->success('修改成功');
        }
    }

    public function cp_category_del (Request $request) {
        $res = Category::deleteCategoryById($request->param('id'));
        if ($res == 0) {
            return $this->error('删除失败');
        } else {
            return $this->success('删除成功');
        }
    }
    public function add_category () {
        return view();
    }
    public function create_category (Request $request) {
        $res = Category::createCategoryByRequest($request->param());
        if ($res == 0) {
            return $this->error('创建失败');
        } else {
            return $this->success('创建成功');
        }
    }

}