<?php
namespace app\index\model;
use think\Model;
class User extends Model
{
  protected function scopeEmail($query)
  {
    $query->where('email','baidu.com');
  }
  protected function scopeStatus($query)
  {
    $query->where('status',1);
  }
}
 ?>

 <?php
class Index
{
  public function index()
  {
    $list = UserModel::scope('email,status')->all();
// SELECT * FROM `think_user` WHERE `email` = 'baidu.com' AND `status` = 1
    foreach ($list as $user)
    {}
  }

  public function index1()
  {
    $list = UserModel::scope('email')
    ->scope('status')
    ->scope(function ($query){
        $query->order('id','desc');
    })
    ->all();
//SELECT * FROM `think_user` WHERE `email` = 'thinkphp@qq.com' AND `status` = 1 ORDER BY `id` desc
    foreach ($list as $user)
    {}
  }
}

?>
