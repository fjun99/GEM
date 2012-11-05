<?php
/**
 * Index 控制器
 */
class IndexController extends Ctrl_Base{
	/**
	 * 首页
	 */
	public function indexAction(){
		$tMQ = new QuoteModel ();
		$_quotes = $tMQ->where("delflag=0")->order ( "id desc" )->fList ();
		$quotes = array ();
		foreach ( $_quotes as $quote ) {
			$tMR = new QTrelationModel ();
			$quote ['tags'] = $tMR->join ( "tags t", "t.id = tid", "LEFT" )->where ( "qid = " . $quote ['id']." and delflag = 0" )->order ( 'tid' )->fList ();
			$quotes [] = $quote;
		}
		$this->assign('quotes', $quotes);
		
		$tMT = new TagModel();
		$tags = $tMT->where("delflag=0")->order("id desc")->fList();
		$this->assign('tags', $tags);
	}
}