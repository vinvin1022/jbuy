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
$pervar='qujian';require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/session.php');
$headtitle="上门送件管理";
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/head.php');


//搜索
$where="1=1";
$so=(int)$_GET['so'];
if($so==1)
{
	$key=par($_GET['key']);
	$status=par($_GET['status']);
	
	if($key){$where.=" and (truename like '%{$key}%' or mobile like '%{$key}%' or address like '%{$key}%'  or userid='".CheckNumber($key,-0.1)."' or username like '%{$key}%' )";}
	
	if(CheckEmpty($status)){$where.=" and status='{$status}'";}

	$search.="&so={$so}&key={$key}&status={$status}";
}

$order=' order by status asc,qjid desc';//默认排序
include($_SERVER['DOCUMENT_ROOT'].'/public/orderby.php');//排序处理页

//echo $search;exit();
$query="select * from qujian where {$where}   {$order}";

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
      
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  
  <!-- BEGIN PAGE CONTENT-->
  <div class="tabbable tabbable-custom boxless">
    <div class="tab-content" style="padding:10px;"> 
      <!--搜索-->
      <div class="navbar navbar-default" role="navigation">
        
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <form class="navbar-form navbar-left"  method="get" action="?">
            <input name="so" type="hidden" value="1">
            <div class="form-group">
              <input type="text" name="key" class="form-control input-msmall popovers" data-trigger="hover" data-placement="right"  data-content="会员ID/会员名/送件姓名/电话/地址 (可留空)" value="<?=$key?>">
            </div>
            <div class="form-group">
              <div class="col-md-0">
                <select  class="form-control input-small select2me" name="status" data-placeholder="状态">
                  <option></option>
                  <?=qujian_Status($status,1)?>
                </select>
              </div>
            </div>
            
            <button type="submit" class="btn btn-info"><i class="icon-search"></i> <?=$LG['search']//搜索?></button>
          </form>
        </div>
      </div>
      <form action="save.php" method="post" name="XingAoForm">
        <input name="lx" type="hidden">
        <input name="addclass" type="hidden">
        <table class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th align="center" class="table-checkbox"> <input type="checkbox"  id="aAll" onClick="chkAll(this)"  title="全选/取消"/>
              </th>
              
              <th align="center"><a href="?<?=$search?>&orderby=qjdate&orderlx=" class="<?=orac('qjdate')?>">送件日期</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=truename&orderlx=" class="<?=orac('truename')?>">联系人</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=weight&orderlx=" class="<?=orac('weight')?>">大约重量</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=address&orderlx=" class="<?=orac('address')?>">送件地址</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=username&orderlx=" class="<?=orac('username')?>">会员</a></th>
             <th align="center"><a href="?<?=$search?>&orderby=status&orderlx=" class="<?=orac('status')?>"><?=$LG['status']//状态?></a></th>
              <th align="center">操作</th>
            </tr>
          </thead>
          <tbody>
<?php
while($rs=$sql->fetch_array())
{
?>
            <tr class="odd gradeX <?=spr($rs['status'])==2?'gray2':''?>">
              <td align="center" valign="middle">
              
               <input type="checkbox" id="a" onClick="chkColor(this);" name="qjid[]" value="<?=$rs['qjid']?>" />
              
               </td>
              
                
            
                
              <td align="center" valign="middle">
              
			  <?=DateYmd($rs['qjdate'],2)?><br>
                <font class="gray2">
                <?=cadd($rs['qjtime'])?>
                </font>
                
                </td>
              <td align="center" valign="middle"><?=cadd($rs['truename'])?><br>
                <font class="gray2">
                <?=$rs['mobile']?>
                </font></td>
              <td align="center" valign="middle"><?=cadd($rs['weight'])?> <?=$XAwt?>
                </td>
              <td align="center" valign="middle"><?=cadd($rs['address'])?>
                </td>
                <td align="center" valign="middle">
              
			  <?=cadd($rs['username'])?><br>
                <font class="gray2">
                <?=cadd($rs['userid'])?>
                </font>
                
                </td>
                
                  <td align="center" valign="middle">
			   <?=qujian_Status(spr($rs['status']))?>
               </td>
              <td align="center" valign="middle">
             
              <a href="form.php?lx=edit&qjid=<?=$rs['qjid']?>" class="btn btn-xs btn-info" target="_blank"><i class="icon-edit"></i> <?=$LG['showedit']?></a> <br>

              <a href="save.php?lx=del&qjid=<?=$rs['qjid']?>" class="btn btn-xs btn-danger"  onClick="return confirm('<?=$LG['pptDelConfirm']//确认要删除所选吗?此操作不可恢复!?>');"><i class="icon-remove"></i> <?=$LG['del']?></a> 
            

              </td>
            </tr>
            
            <tr>
              <td colspan="8" align="left">
              
		 <?php
         $zhi=cadd($rs['content']);
         if($zhi){
		 ?>
          <div class="gray modal_border"> <strong>备注：</strong>
            <?php 
			echo leng($zhi,100,"...");
			Modals($zhi,$title='备注',$time=$rs['addtime'],$nameid='content'.$rs['qjid'],$count=100);
			?>
           </div>
        <?php }?>
        <!---->
		
              
		 <?php
         $zhi=cadd($rs['reply']);
         if($zhi){
		 ?>
          <div class="gray modal_border"> <strong>回复：</strong>
            <?php 
			echo leng($zhi,100,"...");
			Modals($zhi,$title='回复',$time=$rs['replytime'],$nameid='reply'.$rs['qjid'],$count=100);
			?>
           </div>
        <?php }?>
        <!---->

              </td>
            </tr>
<?php
}
?>
                     
                     
          </tbody>
        </table>				
			
            
<!--底部操作按钮固定--> 

<style>body{margin-bottom:50px !important;}</style><!--后台不用隐藏,增高底部高度-->
<div align="right" class="fixed_btn" id="Autohidden">


<select  class="form-control input-small select2me" data-placeholder="Select..." name="status">
                  <?=qujian_Status($status,1)?>            
          </select>
                      
 <!--btn-primary--><button type="submit" class="btn btn-grey" 
 onClick="
  document.XingAoForm.lx.value='attr';
  document.XingAoForm.target='_blank';
  return confirm('确认修改所选信息的状态吗? ');
  "><i class="icon-signin"></i> 修改状态</button>
  
  <button type="submit" class="btn btn-grey" 
  onClick="
  document.XingAoForm.action='print.php';
   document.XingAoForm.target='_blank';
  " title="勾选则打印所选,不勾则显示打印选项"><i class="icon-signin"></i> 打印</button>

  <!--btn-danger--><button type="submit" class="btn btn-grey" onClick="
  document.XingAoForm.lx.value='del';
  return confirm('<?=$LG['pptDelConfirm']//确认要删除所选吗?此操作不可恢复!?>');
  "><i class="icon-signin"></i> <?=$LG['delSelect']//删除所选?></button>
  
        </div>
        <div class="row">
          <?=$listpage?>
        </div>
      </form>
     
    </div>
    <!--表格内容结束--> 
   <div class="xats">
   &raquo;  更新过资料后,需要刷新本页才能看到最新修改!
   </div>
    
  </div>
</div>

  
                     
     
<?php
$sql->free(); //释放资源
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/foot.php');
?>
