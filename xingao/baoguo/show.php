<?php
/*
软件著作权：=====================================================
软件名称：兴奥国际物流转运网站管理系统(简称：兴奥转运系统)V7.0
著作权人：广西兴奥网络科技有限责任公司
软件登记号：2016SR041223
网址：www.xingaowl.com
本系统已在中华人民共和国国家版权局注册，著作权受法律及国际公约保护！
版权所有，未购买严禁使用，未经书面许可严禁开发衍生品，违反将追究法律责任！
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/public/config_top.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/public/html.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/public/function.php');
$pervar='baoguo_se';require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/session.php');

if(!$off_baoguo){exit ("<script>alert('包裹系统已关闭！');goBack();</script>");}

//获取,处理
$bgid=par($_GET['bgid']);
if(!$bgid)
{
	exit ("<script>alert('bgid{$LG['pptError']}');goBack();</script>");
}

$rs=FeData('baoguo','*',"bgid='{$bgid}'");

warehouse_per('ts',$zhi=$rs['warehouse']);//验证可管理的仓库

if(!$rs['bgid']){exit(XAts('checked'));}


$headtitle=cadd($rs['bgydh'])." 包裹信息";$alonepage=1;//单页形式
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/head.php');

require($_SERVER['DOCUMENT_ROOT'].'/xingao/baoguo/call/show.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/foot.php');
?>
