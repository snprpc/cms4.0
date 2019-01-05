<?php
namespace app\index\controller;

use app\index\model\Admin;
use think\Controller;
use think\Request;
use think\response\Redirect;
use think\View;
use app\index\model\Article;
use app\index\model\Category;


class Index extends Controller
{
    public function login(Request $request)
    {
        $msg = array_key_exists('msg', $request->param()) ? $request->param('msg') : null;
        return view('login', [
            'msg' => $msg
        ]);
    }
    public function verify (Request $request) {
        $res = Admin::verifyAdmin($request->param());

        if ($res) {
            return $this->redirect('/admin/index/index');
        } else {
            return $this->redirect('/index/index/login', ['msg' => "用户名或密码错误"]);
        }
    }
    public function index()
    {
        $articles = Article::getAllArticles();
        $categories = Category::getCategories();

        return view('index',
            ['categories' => $categories,
                'articles' => $articles]);
    }

    public function show(Request $request) {
        $categories = Category::getCategories();
        $article = Article::getArticleById($request->param('id'));
        return view('show',
            ['categories' => $categories,
                'article' => $article]);
    }

}

