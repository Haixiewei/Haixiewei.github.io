<?php
namespace app\index\model;
use think\Model;
class User extends Model
{
	protected $table = 'think_user';
	protected $name = 'user';
	protected $connection = [
		'type' => 'mysql',
		'hostname' => 127.0.0.1,
		'database' => 'test',
		'username' => 'root',
		'password' => '',
		'hostport' => '',
		'params' => [],
		'charset' => 'utf-8',
		'prefix' => 'think_',
		'debug' => true,
		];
	protected function initialize()
	{
		parent::initialize();
		//todo
	}
	protected static function init()
	{//todo}
}

$user = User::get(1);
$user = new User;
$user = Loader::model('User');
$user = model('User');

namespace app\index\controller;
use app\index\mdoel\User as UserModel;
class User
{
	public function add()
	{
		$user = new UserModel();
		$user->nickname = 'n1';
		$user['birthday'] = strtotime('1970-01-01');
		
		$arr1 = ['nickname'=>'n1','birthday'=>strtotime('1970-1-1')];
		$arr2 = ['nickname'=>'n2','birthday'=>strtotime('1970-1-2')];

		$user = new UserModel();
		$user->data($arr1);

		$user = new UserModel($arr1);

		$user = new UserModel();
		$list = [$arr1,$arr2];
		$user->saveAll($list);
		
		$user = UserModel::create($arr1);

		$user = model('User');
		$user->data($arr1);

		$user->allowField(true)->save();
		$user->allowField(['nickname'])->save();
		if ($user->save())
		{}else {}
	}
	public function read($id='')
	{
		$user = UserModel::get($id);
		echo date('Y/m/d',$user->birthday);

		$user = userModel::getByPickname('n1');
		$user = UserModel::get(['pickname' => 'n1']);

		// 闭包查询
		$user = UserModel::get(function ($query){
			$query->where('pickname','n1');
		});
		
		$user = new UserModel();
		$user->where('pickname','n1')->find();

		$user = UserModel::where('pickname','n1')->find();
		
		// 多个数据
		$list = UserModel::all(1,2,3);
		$list = UserModel::all([1,2,3]);
		$list = UserModel::all(['status',1]);
		$list = UserModel::all(function ($query){
			$query->where('status',1)->limit(2)->order('id','asc');
		});

		$user = new UserModel();
		$user->where('status',1)
			->limit(11)
			->order('id','desc')
			->select();

		foreach ($list as $key=>$user)
		{}

		UserModel::where('id',1)->value('name');
		UserModel::where('status',1)->colume('name');
		UserModel::where('status',1)->column('name','id');	//以id为索引
		UserModel::Where('status',1)->column('name,id');

		UserModel::chunk(100,function ($users){
			foreach ($users as $user){}
		});
	}
	public function update($id)
	{
		$user = UserModel::get($id);
		$user->name = 'nnn';
		if (false !== $user->save()) 
		{}else{}

		$arr1 = ['nickname'=>'n1','birthday'=>strtotime('1970-1-1')];
		UserModel::update($arr1);

		$user = new UserModel();
		$user->save($arr1,['id'=>1]);
		$user->allowField(true)->save($arr1,['id'=>1]);
		$user->allowField(['pickname'])->save($arr1,['id'=>1]);

		$arr2 = ['nickname'=>'n2','birthday'=>strtotime('1970-1-2')];
		$user = UserModel();
		$list = [$arr1,$arr2,];
		$user->saveAll($list);
		$user->isupdate()->saveAll($list);

		$user = new UserModel();
		$user->where('id',1)->update(['pickname'=>'ooo']);
		$user->update(['id'=>1,'pickname'=>'ooo']);

		UserModel::update(['id'=>1,'pickname'=>'ooo']);
		
		$user = new UserModel();
		$user->save($arr1,function ($query){
			$query->where('status',1)->where('id','>',10);
		});
	}


}
