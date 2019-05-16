<?php
namespace app\index\model;
use think\Model;
class User extends Model
{
  /**
   * 读取 birthday属性值 自动执行
   * @param  [type] $birthday [传入的属性值]
   */
  protected function getBirthdayAttr($birthday)
  {
    return date('Y-m-d',$birthday);
  }
  /**
   * 定义读取数据表中 不存在的属性
   * @param  [type] $value [description]
   * @param  [type] $data  [传入所有的属性数据]
   */
  protected function getUserBirthdayAttr($value,$data)
  {
    return date('Y-m-d' , $data['birthday']);
  }
}

?>

<?php
namespace app\index\controller;
use app\index\model\User as UserModel;
class User
{
  public function read($id='')
  {
    $user = UserModel::get($id);
    echo $user->birthday.'<br/>';
    echo $user->user_birthday;
  }
}
