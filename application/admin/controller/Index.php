<?php
namespace app\admin\controller;

use think\Request;
use think\View;
use app\index\model\Article;
use app\index\model\Category;

class Index
{
    public function index()
    {
        return view('index');
    }

    public function cp_index() {
        return view();
    }

    public function article_edit(Request $request) {
        if ( !array_key_exists('status', $request->param())) {
            $articles = Article::getAllArticles();
            return view('article_edit', ['articles' => $articles]);
        } else {
            $status = $request->param('status');
            $articles = Article::getArticlesByStatus($status);
            return view('article_edit', ['articles' => $articles]);
        }
    }

    public function cp_article(Request $request) {
        if ( !array_key_exists('a_col', $request->param()) ||
            $a_col = $request->param('a_col') == "所有栏目") {

            $articles = Article::getAllArticles();
            return view('cp_article', [
                'articles' => $articles,
                'a_col'   => '所有栏目'
            ]);
        } else {
            $a_col = $request->param('a_col');
            $articles = Article::getArticlesByCol($a_col);
            return view('cp_article', [
                'articles' => $articles,
                'a_col'   => $a_col
            ]);
        }
    }

    public function search_article (Request $request) {
        $key = $request->param('search');
        $articles = Article::getArticlesByKey($key);
        return view('cp_article', [
            'articles' => $articles,
            'a_col'   => '所有栏目'
        ]);
    }

    public function cp_category_admin() {
        $categories = Category::getCategories();

        return view('cp_category_admin', ['categories' => $categories]);
    }

}
