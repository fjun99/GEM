<?php
class QuoteController extends Ctrl_Base {
	
	public function addAction() {
		//		$tMB = new BlogModel();
		//		$tMBI = new BloginfoModel();
		//		if('POST' == $_SERVER['REQUEST_METHOD']){
		//			$id && $_POST['id'] = $id;
		//			$id || $_POST['created'] = $_SERVER['REQUEST_TIME'];
		//			# 博客标题
		//			if($tId = $tMB->save($_POST)){
		//				# 博客内容
		//				$tMBI->del($tId);
		//				$tMBI->insert(array('id' => $tId, 'content' => $_POST['content']));
		//			}
		//			$this->showMsg('保存成功');
		//		}
		//		# 博客内容初始化
		//		if($id){
		//			$tBlog = $tMB->fRow($id);
		//			$tBlog['content'] = $tMBI->where("id='$id'")->fOne('content');
		//			$this->assign('blog', $tBlog);
		//		}
		

		$tMQ = new QuoteModel ();
		if ('POST' == $_SERVER ['REQUEST_METHOD']) {
			if ($qId = $tMQ->save ( $_POST )) {
				$this->showMsg ( '添加成功' );
			} else {
				$this->showMsg ( '添加失败' );
			}
		}
	
	}
	
	public function delAction($id = 0) {
		if ($id != 0) {
			$tMQ = new QuoteModel ();
			if ($tMQ->where ( 'id=' . $id )->update ( array ('delflag' => 1 ) )) {
				$this->showMsg ( '删除成功' );
			}
		}
		$this->showMsg ( '删除失败' );
	}
	
	public function getAction() {
	
	}
	
	public function modifyAction() {
	
	}
	
	public function showAction($id = 0) {
		if ($id != 0) {
			$tMQ = new QuoteModel ();
			$tMQ->where ( "delflag=0" );
			$quote = $tMQ->fRow ( $id );
			
			$tMR = new QTrelationModel ();
			$tMR->where ( "qid = " . $quote ['id']." and delflag = 0" );
			$tMR->join ( "tags t", "t.id = tid", "LEFT" );
			$tags = $tMR->fList ();
			
			$quote ['tags'] = $tags;
			
			$this->assign ( "quote", $quote );
		
		}
	}
	
	public function showinAction($id = 0) {
		if ($id != 0) {
			$tMQ = new QuoteModel ();
			$tMQ->where ( "delflag=0" );
			$quote = $tMQ->fRow ( $id );
			
			$tMR = new QTrelationModel ();
			$tMR->where ( "qid = " . $quote ['id']." and delflag = 0" );
			$tMR->join ( "tags t", "t.id = tid", "LEFT" );
			$tags = $tMR->fList ();
			
			$quote ['tags'] = $tags;
			
			$this->assign ( "quote", $quote );
		
		}
	}
	
	public function listAction($tid = 0) {
		
		if ($tid != 0) {
			$tMR = new QTrelationModel ();
			$tMR->join ( "quotes q", "q.id = qid", "LEFT" );
			$tMR->where ( "tid = " . $tid . " and q.delflag = 0" );
			$tMR->order ( "q.id desc" );
			$_quotes = $tMR->fList ();
			
			$tMT = new TagModel ();
			$tMT->where ( "delflag = 0" );
			$tag = $tMT->fRow ( $tid );
			$this->assign ( "tag", $tag );
		} else {
			$tMQ = new QuoteModel ();
			$_quotes = $tMQ->where ( "quotes.delflag=0" )->order ( "quotes.id desc" )->fList ();
		}
		$quotes = array ();
		foreach ( $_quotes as $quote ) {
			
			$tMR = new QTrelationModel ();
			$quote ['tags'] = $tMR->join ( "tags t", "t.id = tid", "LEFT" )->where ( "qid = " . $quote ['id'] . " and delflag = 0" )->order ( 'tid' )->fList ();
			
			$quotes [] = $quote;
		}
		
		//		exit;
		$this->assign ( 'quotes', $quotes );
	}
	
	public function addtagAction() {
		if ('POST' == $_SERVER ['REQUEST_METHOD']) {
			//$tMR = new QTrelationModel();
			//$ids = explode("|", )
			//			var_dump($_POST);
			$result = true;
			if (is_array ( $_POST ['qid'] )) {
				$tMR = new QTrelationModel ();
				foreach ( $_POST ['qid'] as $qid ) {
					if (! $tMR->save ( array ('qid' => intval ( $qid ), 'tid' => intval ( $_POST ['tid'] ) ) )) {
						$result = false;
					}
				}
			} else {
				$result = false;
			}
			if ($result) {
				$this->showMsg ( '添加标签成功' );
			} else {
				$this->showMsg ( '添加标签失败' );
			}
		}
	}
	
	public function deltagAction($qid = 0, $tid = 0) {
		if ($tid != 0 && $qid != 0) {
			$tMR = new QTrelationModel ();
			if ($tMR->where ( "tid = " . $tid . " and qid = " . $qid )->del ()) {
				$this->showMsg ( "删除成功" );
			} else {
				$this->showMsg ( "删除失败" );
			}
		}
	}

}

?>