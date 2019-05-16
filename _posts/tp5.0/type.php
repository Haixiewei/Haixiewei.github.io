<?php
namespace app\index\model;
use think\Model;
class User extends Model
{
  protected $dateFormat = 'Y-m-d';
  protected $type = [
    'birthday' => 'timestamp',
    // 'birthday' => 'timestamp:Y/m/d',
  ];
}
?>

<?php
namespace app\index\model;
use think\Model;
class User extends Model
{
  // 定义时间戳字段名
  protected $createTime = 'create_at';
  protected $updateTime = 'update_at';

  // 如果个别数据表不需要自动写入时间戳字段的话
  // 也可以在模型里面直接关闭
  protected $autoWriteTimestamp = false;

  // 自动完成 自动写入statu字段
  // 定义自动完成的属性 add
  protected $insert = ['status'=>1];

  // 若status属性值不固定
  protected $insert = ['status'];
  // status属性修改器
  protected function setStatusAttr($value,$data)
  {
    return 'n1' == $data['pickname'] ? 1:2;
  }
  // status属性读取器
  protected function getStatusAttr($value)
  {
    $status = [ -1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核' ];
    return $status[$value];
  }


}
?>
