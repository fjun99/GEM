<?php
class QTrelationModel extends Orm_Base{
	public $table = 'q_t_relations';
	public $field = array(
		'id' => array('type' => "int(11) unsigned", 'comment' => '主键'),
		'qid' => array('type' => "int(11) unsigned", 'comment' => '引语id'),
		'tid' => array('type' => "int(11) unsigned", 'comment' => '标签id'),
		'createtime' => array('type' => "timestamp", 'comment' => '创建时间')
	);
	public $pk = 'id';
}