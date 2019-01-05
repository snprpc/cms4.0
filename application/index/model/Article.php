<?php
namespace app\index\model;

use think\Exception;
use think\Model;
use think\Db;

class Article extends Model
{
    protected $pk = 'id';
    protected $isUpdate = true;
    protected $table = 'article';
    protected $field = true;

    public static function getAArticle() {
        return 1;
    }
    public static function getAllArticles() {
        return Db::name('article')->select();
    }
    public static function getArticleById($id) {
        return Db::name('article')->where('id', $id)->find();
    }

    public static function updateConStatusById ($id) {
        return Db::name('article')
            ->where('id', $id)
            ->update(['status'  => '已发布']);
    }
    public static function updateCanStatusById ($id) {
        return Db::name('article')
            ->where('id', $id)
            ->update(['status'  => '待发布']);
    }

    public static function updateArticleById ($id) {
        return Db::name('article')
            ->where('id', $id)
            ->update(['status'  => '已发布']);
    }

    public static function updateArticleByRequest ($request) {
        $article = new Article;
        return $article->allowField(true)->save($request,['id' => $request['id']]);
    }
    public static function deleteArticleById ($id) {
        return Db::name('article')->where('id',$id)->delete();
    }
    public static function createArticleByRequest($request) {
        $request["update_date"] = date('Y-m-d H:i:s');
        return Db::table('article')->insert($request);
    }

    public static function getArticlesByStatus ($status) {
        return Db::name('article')->where('status', $status)->select();
    }
    public static function getArticlesByCol ($a_col) {
        return Db::name('article')->where('a_col', $a_col)->select();
    }
    public static function getArticlesByKey ($key) {
        return Db::name('article')->where('a_title','like',"%".$key."%")->select();
    }



}