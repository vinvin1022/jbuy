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
$pervar='baoguo_ad';require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/session.php');
$headtitle="手工入库";
$alonepage=2;//1单页形式;2框架形式
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/head.php');

if(!$off_baoguo){exit ("<script>alert('包裹系统已关闭！');goBack();</script>");}



//指定物品非必填
$wupin_req_type='0';
$wupin_req_name='0';
$wupin_req_brand='0';
$wupin_req_spec='0';
$wupin_req_price='0';
$wupin_req_unit='0';
$wupin_req_number='0';
$wupin_req_total='0';
$wupin_req_weight='0';

$sm=spr($_GET['sm']);
$callFrom='manage';
?>

<div class="page_ny"> 
  <!-- BEGIN PAGE HEADER-->
	<div><!--单页时去掉 class="row",不然会有横滚动条,并且form 加 style="margin:20px;"-->
		<div class="col-md-12"> 
<h3 class="page-title"> <?php if($alonepage!=1){?>
<a href="javascript:history.go(-1)" title="<?=$LG['back']?>"><i class="icon-reply"></i></a> <a href="list.php?status=ruku" class="gray" target="_parent"><?=$LG['backList']?></a> > <?php }?>

<a href="javascript:void(0)" onClick="javascript:window.location.href=window.location.href;" title="<?=$LG['refresh']?>" class="gray">
        <?=$headtitle?>
        </a> </h3>
    </div>
  </div>
  <!-- END PAGE HEADER--> 

<!-- 保存 ---------------------------------------------------------------- -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/baoguo/call/kuaisu_save.php');?>

<!-- 表单 ---------------------------------------------------------------- -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/baoguo/call/kuaisu_form.php');?>
  
<!-- 列表 ---------------------------------------------------------------- -->
<?php if(!$sm){
	$where="1=1";
	$start =strtotime(date('Y-m-d')." 00:00:00");
	$where.=" and rukutime>=".$start;
	$where.=" and status in (2,3) and ware=0";

	$warehouse=par($_GET['warehouse']);
	if(CheckEmpty($warehouse)){$where.=" and warehouse='{$warehouse}'";}
	
	$order=' order by rukutime desc';//默认排序
	//$line=1;$page_line=15;//不设置则默认
	$listName='今天入库的包裹';
	require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/baoguo/call/small_list.php');
}
?>
 

</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/foot.php');?>
