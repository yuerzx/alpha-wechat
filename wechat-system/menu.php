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
				array('name'=>"中介入口",
					'sub_button'=> array(
						array('type' =>'click', 'name'=>'Agent Login','key'=>'Agent_Login'),
						array('type' =>'click', 'name'=>'Subagent Apply', 'key'=>'Subagent_Apply'),
						)),
				array('name'=>'购置房产', 
					'sub_button'=> array(
						array('type' =>'click', 'name'=>'!!六月特惠房源!!', 'key'=>'Special_property'),
						array('type' =>'click', 'name'=>'公寓项目','key'=>'Buy_property'),
						array('type' =>'click', 'name'=>'别墅项目', 'key'=>'Sell_property'),
						array('type' =>'click', 'name'=>'联排别墅', 'key'=>'Rent_property'),
						)),
				array('name'=>'购房工具',
					'sub_button'=>array(
						array('type' =>'click', 'name'=>'贷款计算器', 'key'=>'Mortgage_Cal'),
						array('type' =>'click', 'name'=>'贷款利率',   'key'=>'Mortgage_Rate'),
						array('type' =>'click', 'name'=>'购房流程',   'key'=>'Process'),
						array('type' =>'view', 'name'=>'联系团队',   'url'=>'http://app.alphalynx.com.au/team-members')
					 )),
		));
$result = $weObj->createMenu($newmenu);
var_dump($result);
