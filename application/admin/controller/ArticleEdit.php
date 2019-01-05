<?php
namespace app\admin\controller;

use think\Controller;
use think\Exception;
use think\Request;
use think\View;
use app\index\model\Article;
use app\index\model\Category;

class ArticleEdit extends Controller
{
    public function con_status(Request $request) {
        $id = $request->param('id');
        $res = Article::updateConStatusById($id);

        if ($res == 0) {
            return $this->error('发布失败');
        } else {
            return $this->success('发布成功');
        }

    }
    public function can_status(Request $request) {
        $id = $request->param('id');
        $res = Article::updateCanStatusById($id);
        if ($res == 0) {
            return $this->error('取消发布失败');
        } else {
            return $this->success('取消发布成功');
        }
    }
    public function cp_article_edit (Request $request) {
        $categories = Category::getCategories();
        $article = Article::getArticleById($request->param('id'));
        return view('cp_article_edit',
            ['categories' => $categories,
                'article' => $article]);

    }

    public function store_article (Request $request) {
        $file = $request->file('a_picture');
        if($file) {
            $info = $file->rule('uniqid')->move('upload/image');
            if ($info) {
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $request = $request->post();
                $request['a_picture'] = $info->getSaveName();
            } else {
                throw new Exception('上传失败');
            }
        }
        $res = Article::updateArticleByRequest($request);
        if ($res == 0) {
            return $this->error('修改失败');
        } else {
            return $this->success('修改成功');
        }
    }

    public function del_article (Request $request) {
        $res = Article::deleteArticleById($request->param('id'));
        if ($res == 0) {
            return $this->error('删除失败');
        } else {
            return $this->success('删除成功');
        }
    }

    public function cp_article_edit_2 (){
        $categories = Category::getCategories();
        return view('cp_article_edit_2', ['categories' => $categories]);
    }
    public function create_article (Request $request) {
        $file = $request->file('a_picture');
        if($file) {
            $info = $file->rule('uniqid')->move('upload/image');
            if ($info) {
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $request = $request->post();
                $request['a_picture'] = $info->getSaveName();
            } else {
                throw new Exception('上传失败');
            }
        }
        $res = Article::createArticleByRequest($request);
        if ($res == 0) {
            return $this->error('创建失败');
        } else {
            return $this->success('创建成功');
        }
    }





}