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
$pervar='yundan_ex';require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/session.php');

$lx=par($_REQUEST['lx']);
$callFrom=par($_POST['call_lx']);
$ex_tem=par($_POST['ex_tem']);
$path='/upxingao/export/manage/'.$Xuserid.'/';//保存目录

if ($lx=='del')
{
	DelAllFile($path);//删除文件
	exit("<script>goBack('c');</script>");
}

if (!$ex_tem){exit ("<script>alert('请选择报表类型！');goBack('c');</script>");}

//此页面支持会员操作
if($callFrom=='member')
{
	$id_name='ydid';
}else{
	$id_name='Xydid';
}

$ydid=par(ToStr($_GET['ydid']));
if(!$ydid||is_array($_GET['ydid'])){$ydid=$_SESSION[$id_name];}//如果是数组,说明是从底部点击的按钮,要用_SESSION才能获取分页里的勾选

//获取及验证条件---------------------------------
if($lx=='tj')
{
	require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/yundan/call/where_save.php');//输出:$where
}elseif($lx=='sm'){
	$ydid='';
	$query="select ydid from yundan_export_temp where userid='{$Xuserid}' ".whereCS()."  order by epid asc";
	$sql=$xingao->query($query);
	while($rs=$sql->fetch_array()){$ydid.=$rs['ydid'].',';}
	
	$ydid=DelStr($ydid);
	if (!$ydid){exit ("<script>alert('请选添加要导出的运单！');goBack('c');</script>");}
	if($ydid){$where=" and ydid in ({$ydid})";$order=" order by find_in_set(ydid,'{$ydid}')";}
	
}else{
	if (!$ydid){exit ("<script>alert('请勾选要导出的运单！');goBack('c');</script>");}
	$where=" and ydid in ({$ydid})";
}


$fileNameArr='';
$success=0;
$excel_i=0;

if(!$order){$order='order by ydh asc';}



//调用其他系统-导出模板----------------------------------------------------------------------
if($ex_tem=='gd_mosuda')
{
	$gdid='';
	$query="select * from yundan where 1=1  {$where} ".whereCS()."   {$Xwh} {$order}";
	$sql=$xingao->query($query);
	while($rs=$sql->fetch_array())
	{
		$gdid.=yundan_gdid($rs['ydid']).',';
	}
	$gdid=DelStr($gdid);
	$gdid=array_unique(ToArr($gdid));//删除重复数组
	$gdid=ToStr($gdid);
	if($gdid)
	{
		$where=" and gdid in ({$gdid}) and record='1'";
		$order=" order by name asc";
		require($_SERVER['DOCUMENT_ROOT'].'/xingao/gd_mosuda/excelExport/tem/record.php'); 
	}
}

//运单通用-导出模板----------------------------------------------------------------------
else
{
	require($_SERVER['DOCUMENT_ROOT'].'/xingao/yundan/excelExport/tem/'.$ex_tem.'.php'); 
}









if($success)
{
?>
<meta charset="utf-8">
<link href="/bootstrap/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<br><br><br><br>

<div class="alert alert-block alert-info fade in alert_cs col-md-9">
  <h4 class="alert-heading">导出成功: 共导出约有<?=$excel_i?>条</h4>
	<?php if($fileNameArr){?>
	<p>
	<form action="/xingao/yundan/zip_export.php" method="post">
	<input type="hidden" name="fileNameArr" value="<?=DelStr($fileNameArr,',',1)?>">
	<button type="submit" class="btn btn-primary"> <i class="icon-ok"></i> 下载身份证 (Excel文件下载完后再点击) </button>
	</form>
	</p>
	<p>如果身份证文件名有乱码,请把浏览器默认编码改为GBK</p>
	<?php }?>
	
	<p><br></p>
	<p><a class="btn btn-danger" href="?lx=del">删除服务器上文件并关闭页面 (防止他人下载,下载完后请删除)</a></p>
	<p>注意:导出时会删除之前的文件，因此如果之前文件没下载完，请下载完本次导出文件后再重新导出之前的信息!</p>
	
	
</div>
<?php
	echo '<script language=javascript>';
	echo 'location.href="'.$path.$xaname.'";';
	echo '</script>';
	XAtsto($path.$xaname);

}else{
	exit ("<script>alert('没有符合条件的运单可导出!\\n请检查是否选择正确并且是否对该仓库有操作权限');goBack('c');</script>");
}
//$_SESSION[$id_name]='';
?>

