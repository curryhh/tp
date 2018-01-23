<?php 

namespace Admin\Controller;
use Think\Controller;
class NewsController extends Controller {
	
	//展示新闻列表
    public function showlist(){
    	$model=M('news');

    	// dump($data);die;

		//分页
		$count      = $model->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)  
		$Page->setConfig("prev","上一页");
		$Page->setConfig("next","下一页");

		$show       = $Page->show();// 分页显示输出

		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$data = $model->limit($Page->firstRow,$Page->listRows)->select();
		//dump($data);die; 
		

		$this->assign('data',$data);
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板


		// 全部展示
    	// $data=$model->select();
    	// $this->assign('data',$data);
    	// $this->display();
        
    }

	//添加
	 public function add() {
    	if(IS_POST){

    	}
    	// 输出页面
    	$this->display();

    }
    //修改展示
    public function edit() {
    	// 获取ID
    	$id=I('get.id');
    	// 创建表拿数据
    	$model=M('news');
    	$data=$model->find($id);
    	$this->assign('data',$data);
    	//dump($data);die;
    	// 输出页面
    	$this->display();
    }
    
    //修改保存
    public function editSave() {
    	$post=I('post.');

    	 

    	if($_FILES['file']['name']){
    		$upload = new \Think\Upload();// 实例化上传类
		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->rootPath  ='./Public/Uploads/'; // 设置附件上传根目录
		    // 上传单个文件 
		    //dump($_FILES);die;
		    $info   =   $upload->uploadOne($_FILES['file']);

		    if(!$info) {// 上传错误提示错误信息
		        $this->error($upload->getError());
		    }else{// 上传成功 获取上传文件信息
		    	$post['img']='/Public/Uploads/'.$info['savepath'].$info['savename'];
		    }
    	}
    	
	    //添加时间

	    $post['time']=time();
		//$psot['author']={$Think.session.username};

	    $post['author']=I('session.username',0);

		
	    $model=M('news');
       

        // dump($post); die;

	    $result=$model->save($post);
 

     	if($result){
     		//防止iframe嵌套
     		echo "<script>parent.location.reload();</script>";
     		$this->success('成功！');
     		
     	}else{
     		$this->error('失败');
     	}
    }

	//删除
    public function del() {
    	if (IS_AJAX) {
    		$post=I('post.id');

    		$model=M('news');
		    $result=$model->where('id='.$post)->delete($post);
	

	     	// if($result){
	     	// 	$this->success('成功！');
	     	// }else{
	     	// 	$this->error('失败');
	     	// }

    		// ajax返回结果
    		$this->ajaxReturn($result);
    	}
    }

    //dome
    public function dome() {
    	
    	// 输出页面
    	$this->display();
    }

    // webuploder
     public function webup(){
     	$psot=I('post.');
     	  dump($_FILES);die;

   	  //    		$upload = new \Think\Upload();// 实例化上传类
			   //  $upload->maxSize   =     0 ;// 设置附件上传大小
			   //  $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			   //  $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
			   //  $upload->savePath  =     ''; // 设置附件上传（子）目录
			   //  // 上传文件 
			   //  $info   =   $upload->upload();
			   //  if(!$info) {// 上传错误提示错误信息
			   //      $this->error($upload->getError());
			   //      echo '上传失败';
			   //  }else{// 上传成功
			   //      foreach($info as $file){
			        	
			   //      	  $this->success('上传成功！'); 
				  //         $img=$file['savepath'].$file['savename'];
				  //   }
			    
	     // 	}

     	 $upload = new \Think\Upload();
	        $upload->maxSize   =     0 ;// 设置附件上传大小
	        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		    $upload->savePath  =     ''; // 设置附件上传（子）目录
	        $info   =   $upload->upload();
	        if(!$info) {
	            $this->ajaxReturn($upload->getError());
	        }else{
	            $this->ajaxReturn($info);
        }
     			
    }
    public function addSave(){

    	$post=I('post.');

    	$upload = new \Think\Upload();// 实例化上传类
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  ='./Public/Uploads/'; // 设置附件上传根目录
	    // 上传单个文件 
	    //dump($_FILES);die;
	    $info   =   $upload->uploadOne($_FILES['file']);

	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功 获取上传文件信息
	    	$post['img']='/Public/Uploads/'.$info['savepath'].$info['savename'];
	    }
	    //添加时间

	    $post['time']=time();
		//$psot['author']={$Think.session.username};

	    $post['author']=I('session.username',0);
		
	    $model=M('news');
       

       // dump($post); die;

	    $result=$model ->add($post);


// dump($result); die;

     	if($result){
     		//防止iframe嵌套
     		echo "<script>parent.location.reload();</script>";
     		$this->success('成功！',('showlist'));
     		
     	}else{
     		$this->error('失败');
     	}
   	    
     			
    }
 }   