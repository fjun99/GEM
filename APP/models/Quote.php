<?php
class QuoteModel extends Orm_Base{
	public $table = 'quotes';
	public $field = array(
		'id' => array('type' => "int(11) unsigned", 'comment' => '主键'),
		'quote' => array('type' => "varchar(255)", 'comment' => '引语'),
		'author' => array('type' => "varchar(100)", 'comment' => '作者'),
		'description' => array('type' => "varchar(255)", 'comment' => '描述'),
		'link' => array('type' => "varchar(100)", 'comment' => '链接'),
		'createtime' => array('type' => "timestamp", 'comment' => '创建时间'),
		'delflag' => array('type' => "tinyint(1) unsigned", 'comment' => '删除标志位')
	);
	public $pk = 'id';
}