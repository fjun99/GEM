<?php
class TagController extends Ctrl_Base {
	
	public function addAction() {
		
		$tMT = new TagModel();
		if('POST' == $_SERVER['REQUEST_METHOD']){
			if($tId = $tMT->save($_POST)){
				$this->showMsg('添加成功');
			}else{
				$this->showMsg('添加失败');
			}
		}
		
	}
	
	public function delAction($id = 0) {
		if($id != 0){
			$tMT = new TagModel();
			if($tMT->where('id='.$id)->update(array('delflag' => 1))){
				$this->showMsg('删除成功');
			}
		}
		$this->showMsg('删除失败');
	}
	
	public function getAction() {
	
	}
	
	public function modifyAction() {
		
	}

}

?>