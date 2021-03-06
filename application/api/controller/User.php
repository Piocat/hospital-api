<?php
namespace app\api\controller;

use think\Db;

class User extends Common {
	public function add_user(){
		$data = $this->params;
		$res = db('user')->insertGetId($data);
		if($res){
			$this->return_msg(200,'新增用户成功',$res);
		}else{
			$this->return_msg(400,'新增用户失败');
		}
	}
	
	public function select_user(){
		$data = $this->params['user_id'];
		$res = db('user')->where('user_id',$data)->find();
		if($res){
			$this->return_msg(200,'查询用户成功',$res);
		}else{
			$this->return_msg(400,'查询用户失败',$res);
		}
	}
	
	public function update_user(){
		$data = $this->params;
		$res = db('user')->where('user_id',$data['user_id'])->update($data);
		if($res){
			$this->return_msg(200,'更新用户成功',$res);
		}else{
			$this->return_msg(400,'更新用户失败',$res);
		}
	}
	
	public function delete_user(){
		$data = $this->params;
		$res = db('user')->delete($data['user_id']);
		if($res){
			$this->return_msg(200,'删除用户成功',$res);
		}else{
			$this->return_msg(400,'删除用户失败',$res);
		}
	}

	//以下皆为网页管理后端的api
	public function select_user_list_admin(){
		$data = $this->params;
		$sql = $this->turn_sql($data,'user');
		// echo $sql;
		$res = Db::query($sql);
		if(count($res) >= 0){
		
			$this->return_msg(200,'查询用户成功',$res,count($res));
		}else{
			$this->return_msg(400,'查询用户失败',$res);
		}
	}
}
