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
$pervar='member_le';require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/session.php');
$headtitle="站内信管理";
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/head.php');

//搜索
$where="1=1";
$so=(int)$_GET['so'];
if($so==1)
{
	$key=par($_GET['key']);
	$my=(int)$_GET['my'];
	$issys=par($_GET['issys']);
	$status=par($_GET['status']);
	
	if($key){$where.=" and (title like '%{$key}%' or content like '%{$key}%' or userid='".CheckNumber($key,-1)."' or username='{$key}' or from_userid='".CheckNumber($key,-1)."' or from_username='{$key}')";}
	
	if(CheckEmpty($issys)){$where.=" and issys='{$issys}'";	}
	if(CheckEmpty($status)){$where.=" and status='{$status}'";}
	if($my)
	{
		$from_userid=$Xuserid;
		$where.=" and from_userid='{$from_userid}'";
	}
	$search.="&so={$so}&key={$key}&issys={$issys}&status={$status}&from_userid={$from_userid}";
}

$order=' order by id desc';//默认排序
include($_SERVER['DOCUMENT_ROOT'].'/public/orderby.php');//排序处理页


//echo $search;exit();
$query="select * from msg where {$where} {$order}";

//分页处理
//$line=20;$page_line=15;//$line=-1则不分页(不设置则默认)
include($_SERVER['DOCUMENT_ROOT'].'/public/page.php');
?>

<div class="page_ny"> 
  <!-- BEGIN PAGE HEADER-->
	<div class="row"><!--单页时去掉 class="row",不然会有横滚动条,并且form 加 style="margin:20px;"-->
		<div class="col-md-12"> 
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <a href="javascript:void(0)" onClick="javascript:window.location.href=window.location.href;" title="<?=$LG['refresh']?>" class="gray">
        <?=$headtitle?>
        </a> </h3>
      <ul class="page-breadcrumb breadcrumb">
        <button type="button" class="btn btn-info" onClick="window.open('../member/send.php');"><i class="icon-plus"></i> 发信息 </button>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  
  <!-- BEGIN PAGE CONTENT-->
  <div class="tabbable tabbable-custom boxless">
   <ul class="nav nav-tabs" style="margin-top:10px;">
        <li class="<?=$my?'':'active';?>"><a href="?">全部信息</a></li>
        <li class="<?=$my?'active':'';?>"><a href="?so=1&my=1">我负责的信息</a></li>
    </ul>
    
    <div class="tab-content" style="padding:10px;"> 
      <!--搜索-->
      <div class="navbar navbar-default" role="navigation">
        
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <form class="navbar-form navbar-left"  method="get" action="?">
            <input name="so" type="hidden" value="1">
            <input name="my" type="hidden" value="<?=$my?>">
            <div class="form-group">
              <input type="text" name="key" class="form-control input-msmall popovers" data-trigger="hover" data-placement="right"  data-content="标题/会员ID/会员名/内容/负责人ID/负责人名 (可留空)" value="<?=$key?>">
            </div>
            <div class="form-group">
              <div class="col-md-0">
                <select  class="form-control input-small select2me" name="status" data-placeholder="状态">
                  <option></option>
                  <?=MsgStatus($status,1)?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-0">
                <select  class="form-control input-small select2me" name="issys" data-placeholder="发送方式">
                  <option></option>
                  <option value="0"  <?=$issys=='0'?' selected':''?>>人工发送</option>
                  <option value="1"  <?=$issys=='1'?' selected':''?>>系统发送</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-info"><i class="icon-search"></i> <?=$LG['search']//搜索?></button>
          </form>
        </div>
      </div>
      <form action="save.php" method="post" name="XingAoForm">
        <input name="lx" type="hidden">
        <table class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th align="center" class="table-checkbox"> <input type="checkbox"  id="aAll" onClick="chkAll(this)"  title="全选/取消"/>
              </th>
              <th align="left"><a href="?<?=$search?>&orderby=title&orderlx=" class="<?=orac('title')?>">标题</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=username&orderlx=" class="<?=orac('username')?>">会员</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=from_username&orderlx=" class="<?=orac('from_username')?>">负责人</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=edittime&orderlx=" class="<?=orac('edittime')?>" title="按修改时间排序">修改</a>
               / 
              <a href="?<?=$search?>&orderby=addtime&orderlx=" class="<?=orac('addtime')?>" title="按添加时间排序">添加</a>
              
              </th>
              <th align="center"><a href="?<?=$search?>&orderby=status&orderlx=" class="<?=orac('status')?>"><?=$LG['status']//状态?></a></th>
              <th align="center">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php
while($rs=$sql->fetch_array())
{
?>
            <tr class="odd gradeX">
              <td align="center" valign="middle"><input type="checkbox" id="a" onClick="chkColor(this);" name="id[]" value="<?=$rs['id']?>" /></td>
              <td align="left" valign="middle">
              
               <?php if($rs['new']){?>
               <div class="label label-sm label-warning" title="未读信息"><i class="icon-bell"></i></div>
               <?php }?>
               <?php if(!$rs['issys']){?>
               <div class="label label-sm label-default" title="人工发送"><i class="icon-male"></i></div>
               <?php }?>
               
			   <?php if($rs['popup']){?><span class="label label-sm label-default" title="自动弹出">弹出</span><?php }?>

              <a href="show.php?id=<?=$rs['id']?>" target="_blank"  title="<?=cadd($rs['title'])?>">
                <?=leng($rs['title'],50,"...")?>
                </a> <br><font class="gray2" title="<?=cadd($rs['content'])?>">
                <?=leng($rs['content'],50,"...")?>
                </font></td>
              <td align="center" valign="middle">
<!--显示会员账号-->                            
<?=showUsername($rs['username'],$rs['userid'])?>                           
              </td>
              <td align="center" valign="middle"><?=cadd($rs['from_username'])?><br>
                <font class="gray2">
                <?=$rs['from_userid']?>
                </font></td>
              <td align="center" valign="middle">
             
                <font class="gray" title="修改时间">
                <?=DateYmd($rs['edittime'],1)?>
                </font>
                 <br>
                <font class="gray2" title="添加时间">
                <?=DateYmd($rs['addtime'],1)?>
                </font>
                </td>
              <td align="center" valign="middle"><?=MsgStatus(spr($rs['status']))?></td>
              <td align="center" valign="middle"><a href="save.php?lx=del&id=<?=$rs['id']?>" class="btn btn-xs btn-danger"  onClick="return confirm('删除后会员也将看不到该信息，确认要删除所选吗?此操作不可恢复! ');"><i class="icon-remove"></i> <?=$LG['del']?></a></td>
            </tr>
            <?php
}
?>
          </tbody>
        </table>				
			
            
<!--底部操作按钮固定--> 

<style>body{margin-bottom:50px !important;}</style><!--后台不用隐藏,增高底部高度-->
<div align="right" class="fixed_btn" id="Autohidden">


<!--btn-danger--><button type="submit" class="btn btn-grey" onClick="
  document.XingAoForm.lx.value='del';
  return confirm('删除后会员也将看不到该信息，确认要删除所选吗?此操作不可恢复! ');
  "><i class="icon-signin"></i> <?=$LG['delSelect']//删除所选?></button>
        </div>
        <div class="row">
          <?=$listpage?>
        </div>
      </form>
    </div>
    <!--表格内容结束--> 
    
  </div>
</div>
<?php
$sql->free(); //释放资源
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/foot.php');
?>
