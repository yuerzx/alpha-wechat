<?php
include "wechat.class.php";
$options = array(
		'token'=>'yuerzx', //填写你设定的key
		'appid'=>'wxb5f3236813dba18d', //填写高级调用功能的app id
 		'appsecret'=>'6a87d1b4eb1ba3d26010d4f457544560' //填写高级调用功能的密钥
	);
$weObj = new Wechat($options);
//$weObj->valid();
$newmenu =  array(
		"button"=>
			array(
				array('name'=>"\ue157 中介入口",
					'sub_button'=> array(
						array('type' =>'click', 'name'=>'Agent Login','key'=>'Agent_Login'),
						array('type' =>'click', 'name'=>'Subagent Apply', 'key'=>'Subagent_Apply'),
						array('type' =>'click', 'name'=>'操作指令', 'key'=>'Guide'),
						)),
				
				array('name'=>'业务服务', 
					'sub_button'=> array(
						array('type' =>'click', 'name'=>'!!特惠房源!!', 'key'=>'Special_property'),
						array('type' =>'click', 'name'=>'购置房产','key'=>'Buy_property'),
						array('type' =>'click', 'name'=>'出售房产', 'key'=>'Sell_property'),
						array('type' =>'click', 'name'=>'房屋租赁', 'key'=>'Rent_property'),
						array('type' =>'click', 'name'=>'房屋出租', 'key'=>'Rent_out_property'),

						)),
				array('type'=>'view','name'=>'联系团队','url'=>'http://www.maifang.com.au/projects/alphalynx/?page_id=12'),
				)
		);
$result = $weObj->createMenu($newmenu);
var_dump($result);
