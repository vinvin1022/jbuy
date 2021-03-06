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
require_once($_SERVER['DOCUMENT_ROOT'].'/xamember/incluce/session.php');
$headtitle=$LG['name.nav_44'];//积分流水账
require_once($_SERVER['DOCUMENT_ROOT'].'/xamember/incluce/head.php');

//搜索
$where="1=1";
$so=(int)$_GET['so'];
if($so)
{
	$key=par($_GET['key']);
	$stime=par($_GET['stime']);
	$etime=par($_GET['etime']);
	
	if($key){$where.=" and (fromid='".CheckNumber($key,-0.1)."' or title like '%{$key}%')";}
	if($stime){$where.=" and addtime>='".strtotime($stime.' 00:00:00')."'";}
	if($etime){$where.=" and addtime<='".strtotime($etime.' 23:59:59')."'";}

	$search.="&so={$so}&key={$key}&stime={$stime}&etime={$etime}";
}

$timequerycall=1;$timequeryshow=0;
$field="addtime";
include($_SERVER['DOCUMENT_ROOT'].'/public/timequery.php');//按时间快速查询


$order=' order by addtime desc';//默认排序
include($_SERVER['DOCUMENT_ROOT'].'/public/orderby.php');//排序处理页


$query="select * from 
(
	select 'cz' as flag,id,userid,username,fromtable,fromid,integral,type,title,content,remain,operator,addtime from integral_czbak
UNION ALL
	select 'kf' as flag,id,userid,username,fromtable,fromid,integral,type,title,content,remain,operator,addtime from integral_kfbak
) 
	a where {$where} {$Mmy} {$order}
";

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
        </a> 
		</h3>
      
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  
  <!-- BEGIN PAGE CONTENT-->
  <div class="portlet tabbable">
    <div class="portlet-body" style="padding:10px;"> 
      <!--搜索-->
      <div class="navbar navbar-default" role="navigation">
        
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <form class="navbar-form navbar-left"  method="get" action="?">
            <input name="so" type="hidden" value="1">
            <div class="form-group">
              <input type="text" class="form-control" name="key" placeholder="<?=$LG['money.money_bak_1'];//使用说明?>" value="<?=$key?>">
            </div>
			
            <div class="form-group">
                <div class="col-md-0">
                  <div class="input-group input-xmedium date-picker input-daterange" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control input-small" name="stime" value="<?=$stime?>" placeholder="<?=$LG['integral.integral_bak_2'];//时间-起?>">
                    <span class="input-group-addon">-</span>
                    <input type="text" class="form-control input-small" name="etime" value="<?=$etime?>" placeholder="<?=$LG['integral.integral_bak_4'];//时间-止?>">
                  </div>
                 </div>
              </div>
            
            <button type="submit"  class="btn btn-info"><i class="icon-search"></i> <?=$LG['search'];//搜索?></button>
          </form>
        </div>
        
        <?php
		$timequerycall=0;$timequeryshow=1;
		$searchtime="&so={$so}&key={$key}";
		include($_SERVER['DOCUMENT_ROOT'].'/public/timequery.php');//按时间快速查询
		?>
      </div>
      <form action="?<?=$search?>" method="post" name="XingAoForm">
        <input name="lx" type="hidden">
        <table class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th align="center"><a href="?<?=$search?>&orderby=type&orderlx=" class="<?=orac('type')?>"><?=$LG['integral.integral_bak_5'];//类型?></a></th>
  
               <th align="center"><a href="?<?=$search?>&orderby=fromtable&orderlx=" class="<?=orac('fromtable')?>"><?=$LG['integral.integral_bak_6'];//用途?></a> </th>
               <th align="center"><a href="?<?=$search?>&orderby=title&orderlx=" class="<?=orac('title')?>"><?=$LG['explain'];//说明?></a> </th>
              <th align="center"><a href="?<?=$search?>&orderby=integral&orderlx=" class="<?=orac('integral')?>"><?=$LG['integral'];//积分?></a></th>
              <th align="center"><a href="?<?=$search?>&orderby=remain&orderlx=" class="<?=orac('remain')?>"><?=$LG['integral.integral_bak_7'];//账户?></a></th>
              <th align="center"><a href="?<?=$search?>&orderby=operator&orderlx=" class="<?=orac('operator')?>"><?=$LG['integral.integral_bak_8'];//操作员ID?></a></th>
              <th align="center"><a href="?<?=$search?>&orderby=addtime&orderlx=" class="<?=orac('addtime')?>"><?=$LG['time'];//时间?></a></th>
            
            </tr>
          </thead>
          <tbody>
<?php
while($rs=$sql->fetch_array())
{
	
	if($rs['flag']=='cz')
	{
		$rs['type']=integral_cz($rs['type']);
		$rs['integral']=spr($rs['integral']);
		$i_cz++;
	}elseif($rs['flag']=='kf'){
		$rs['type']=integral_kf($rs['type']);
		$rs['integral']='-'.spr($rs['integral']);
		$i_kf++;
	}
?>
            
            <tr class="odd gradeX">
              <td align="center">
                <?=$rs['type']?>
              </td>
              
              <td align="center">
			  <?=$rs['fromtable']?fromtableName($rs['fromtable']).'ID:'.$rs['fromid'].'':''?> 
              </td>
              
              <td align="center">
                <a <?=fromtableUrl($rs['fromtable'],$rs['fromid'])?>  class="popovers" data-trigger="hover" data-placement="top"  data-content="<?=cadd($rs['title'])?><?=$rs['content']?'：'.TextareaToCo($rs['content']):''?>">
                <?=$rs['title']?leng($rs['title'],20,'...'):$LG['explain']?>
                </a>
              </td>
              
              <td align="center">
                <?=$rs['integral'].$LG['integral']?>
              </td>
              <td align="center"><?=spr($rs['remain']).$LG['integral']?></td>
              <td align="center"><?=cadd($rs['operator'])?></td>
              <td align="center"><?=DateYmd($rs['addtime'],1)?></td>
              
            </tr>
<?php
$integral+=$rs['integral'];
}
?>
            
            <thead>
            <tr class="odd gradeX">
              <th align="center"><strong><?=$LG['integral.integral_bak_11']?></strong></th>
              <th align="center"></th>
              <th align="center"></th>
              <th align="center"><strong>
				<?=spr($integral).$LG['integral']?>
			 </strong></th>
              <th align="center"></th>
              <th align="center"></th>
              <th align="center">
              <?=LGtag($LG['integral.integral_bak_13'],'<tag1>=='.spr($i_cz,2,1) )?>;
              <?=LGtag($LG['integral.integral_bak_14'],'<tag1>=='.spr($i_kf,2,1) )?>
              </th>
            </tr>
            </thead>
        </table>			
            
            
<!--底部操作按钮固定--> 
<script>/*$(function(){ Autohidden(); });*/</script> <!--拉到底时自动隐藏-->
<style>body{margin-bottom:40px !important;}</style><!--不用隐藏,增高底部高度-->
 
<div align="right" class="fixed_btn" id="Autohidden">



<?php if(permissions('member_ot','','manage',1)){?>
      <input type="hidden" name="where" value="<?=$where?>">
      <input type="hidden" name="table" value="integral_bak">

      <!--btn-info--><button type="submit"  class="btn btn-grey tooltips" data-container="body" data-placement="top" data-original-title="<?=$LG['integral.integral_bak_10'];//全部分页都导出?>"
      onClick="
      document.XingAoForm.action='../money/excel_export_bak.php';
      document.XingAoForm.lx.value='export';
      document.XingAoForm.target='_blank';
      "><i class="icon-signin"></i> <?=$LG['integral.integral_bak_11'];//导出记录?> </button>
    <?php }?>
    

</div>

        <div class="row">
          <?=$listpage?>
        </div>
      </form>
    </div>
    <!--表格内容结束--> 
    
  </div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/xamember/incluce/foot.php');?>
