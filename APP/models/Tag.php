<?php
class TagModel extends Orm_Base{
	public $table = 'tags';
	public $field = array(
		'id' => array('type' => "int(11) unsigned", 'comment' => '主键'),
		'tag' => array('type' => "varchar(50)", 'comment' => '标签'),
		'createtime' => array('type' => "timestamp", 'comment' => '创建时间'),
		'delflag' => array('type' => "tinyint(1) unsigned", 'comment' => '删除标志位')
	);
	public $pk = 'id';
}