<?php
namespace app\index\model;
use think\Model;
class User extends Model
{
  /**
   * 属性值转换时间戳格式
   * @param [type] $value [属性值]
   */
  protected function setBirthdayAttr($value)
  {
    return strtotime($value);
  }
}

?>


public function add()
{
  $user = new UserModel;
  $user->birthday = '1970-1-1';
  $user->save();
}
