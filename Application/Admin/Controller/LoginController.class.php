<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	// 登录
    public function login(){
    		$this->display();
        
    }
    //检验
    public function checklogin(){
    	$post=I('post.');
		$model=M('user');
		$data=$model->where($post)->find();
    	if($data){

    		session('username',$post['username']);

			$this->success('登录成功',U('Index/index'),1);
		}else{
			echo "登录信息有误";
		}	

    } 
    // 登出
    public function logout()
    {
    	session(null);
		$this->success('退出成功',U('Login/login'),1);
    }
} 