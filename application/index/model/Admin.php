<?php
namespace app\index\model;

use think\Db;
use think\Model;

class Admin extends Model
{
    protected $pk = 'id';

    public static function verifyAdmin ($request) {
        $password = Db::name('admin')
            ->where('name', $request['name'])
            ->value("password");

        return ($password == $request['password']) ? true : false;
    }

}