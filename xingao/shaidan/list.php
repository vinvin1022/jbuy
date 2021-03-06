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
$pervar='shaidan';//权限验证
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/session.php');
$headtitle="晒单管理";
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/head.php');

if(!$off_shaidan)
{
	exit ("<script>alert('晒单功能未开启,无法使用！');goBack('uc');</script>");
}

//搜索
$where="1=1";
$so=(int)$_GET['so'];
if($so==1)
{
	$key=par($_GET['key']);
	$types=par($_GET['types']);
	$checked=par($_GET['checked']);
	
	if($key){$where.=" and (ydh like '%{$key}%' or content like '%{$key}%' or userid='".CheckNumber($key,-0.1)."' or username like '%{$key}%' )";}
	if(CheckEmpty($types)){$where.=" and types='{$types}'";}
	if(CheckEmpty($checked)){$where.=" and checked='{$checked}'";}

	$search.="&so={$so}&key={$key}&checked={$checked}";
}

$order=' order by checked asc,sdid desc';//默认排序
include($_SERVER['DOCUMENT_ROOT'].'/public/orderby.php');//排序处理页


//echo $search;exit();
$query="select * from shaidan where {$where}   {$order}";

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
      <!--<ul class="page-breadcrumb breadcrumb">
        <button type="button" class="btn btn-info" onClick="location.href='form.php';"><i class="icon-plus"></i> 我要晒单 </button>
      </ul>--> 
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
            <input name="my" type="hidden" value="<?=$my?>">
            <div class="form-group">
              <input type="text" name="key" class="form-control input-msmall popovers" data-trigger="hover" data-placement="right"  data-content="运单号/内容/会员ID/会员名 (可留空)" value="<?=$key?>">
            </div>
            
            <div class="form-group">
              <div class="col-md-0">
                <select  class="form-control input-small select2me" name="types" data-placeholder="<?=$LG['shaidan.types'];//类型?>">
                  <option></option>
                  <?=shaidan_Types($types,1)?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-md-0">
                <select  class="form-control input-small select2me" name="checked" data-placeholder="状态">
                  <option></option>
                  <option value="0"  <?=$checked=='0'?' selected':''?>>未审</option>
                  <option value="1"  <?=$checked=='1'?' selected':''?>>已审</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-info"><i class="icon-search"></i> <?=$LG['search']//搜索?></button>
          </form>
        </div>
      </div>
      <form action="save.php" method="post" name="XingAoForm">
        <input name="lx" type="hidden">
        <input name="checked" type="hidden">
        <table class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th align="center" class="table-checkbox"> <input type="checkbox"  id="aAll" onClick="chkAll(this)"  title="全选/取消"/>
              </th>
              <th align="center"><a href="?<?=$search?>&orderby=sdid&orderlx=" class="<?=orac('sdid')?>">ID</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=ydh&orderlx=" class="<?=orac('ydh')?>">运单号</a></th>
               <th align="center"><a href="?<?=$search?>&orderby=checked&orderlx=" class="<?=orac('checked')?>"><?=$LG['status'];//状态?></a></th>
              <th align="center"><a href="?<?=$search?>&orderby=username&orderlx=" class="<?=orac('username')?>">会员</a></th>
             <th align="center"><a href="?<?=$search?>&orderby=onclick&orderlx=" class="<?=orac('onclick')?>">浏览</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=plclick&orderlx=" class="<?=orac('plclick')?>">评论</a></th>
              <th align="center"><a href="?<?=$search?>&orderby=addtime&orderlx=" class="<?=orac('addtime')?>">时间</a></th>
              <th align="center">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php
while($rs=$sql->fetch_array())
{
?>
            <tr class="odd gradeX <?=!$rs['checked']?'gray2':''?>">
              <td align="center" valign="middle"><input type="checkbox" id="a" onClick="chkColor(this);" name="sdid[]" value="<?=$rs['sdid']?>" /></td>
              <td align="center" valign="middle"><?=$rs['sdid']?></td>
              
              <td align="center" valign="middle"><?=cadd($rs['ydh'])?></td>
              <td align="center" valign="middle"><?=!$rs['checked']?$LG['shaidan.list_4']:$LG['shaidan.list_6']?></td>
 <td align="center" valign="middle">
<!--显示会员账号-->                            
<?=showUsername($rs['username'],$rs['userid'])?>                           
</td>
              <td align="center" valign="middle"><?=$rs['types']?'N/A':spr($rs['onclick'])?></td>
              <td align="center" valign="middle"><?=$rs['types']?'N/A':spr($rs['plclick'])?></td>
              
              <td align="center" valign="middle"><font title="添加时间">
                <?=DateYmd($rs['addtime']);?>
                </font><br> <font class="gray2" title="修改时间">
                <?=DateYmd($rs['edittime']);?>
                </font></td>
              <td align="center" valign="middle">
               <?php if($rs['checked']){?>
              <a href="<?=pathLT($rs['path'])?>" class="btn btn-xs btn-success"  target="_blank"><i class="icon-eye-open"></i> <?=$LG['show']?></a>
               <?php }?>
              
                <?php if($rs['checked']){?>
                <a href="save.php?lx=attr&checked=0&sdid=<?=$rs['sdid']?>" class="btn btn-xs btn-default"><i class="icon-check-empty"></i> 设为未审</a>
                <?php }else{ ?>
                <a href="save.php?lx=attr&checked=1&sdid=<?=$rs['sdid']?>" class="btn btn-xs btn-success"><i class="icon-check"></i> 设为已审</a>
                <?php }?>
                
                 <a href="form.php?lx=edit&sdid=<?=$rs['sdid']?>" class="btn btn-xs btn-info"><i class="icon-edit"></i> <?=$LG['edit']?></a> 
                <?php if(!$rs['checked']){?>
               <a href="save.php?lx=del&sdid=<?=$rs['sdid']?>" class="btn btn-xs btn-danger"  onClick="return confirm('<?=$LG['pptDelConfirm']//确认要删除所选吗?此操作不可恢复!?>');"><i class="icon-remove"></i> <?=$LG['del']?></a>
                <?php
					}
				?></td>
            </tr>
            <tr>
              <td colspan="9" align="left">
		<?php
         $zhi=cadd($rs['content']);
         if($zhi){
		 ?>
                <div class="modal_border <?=!$rs['checked']?'gray2':'gray'?>"> <strong><?=shaidan_Types($rs['types'])?></strong>
			  <?php 
              if(!$rs['types']){
                echo leng($zhi,100,"...");
                Modals($zhi,$title=$LG['shaidan.content'],$time=$rs['addtime'],$nameid='content'.$rs['sdid'],$count=100);
              }else{
             	 $arr=ToArr($zhi,1);
				if($arr)
				{
					foreach($arr as $arrkey=>$value)
					{
						 if(!$value){continue;}
						 echo '<a href="'.$value.'" target="_blank" title="此网址由会员自行填写,访问前请检查网址安全性&#13;'.$value.'">'.leng($value,30,"...").'</a><span class="xa_sep"> | </span>';
					}
				}
              }
             ?>
                </div>
                <?php }?>
              
                
                <!----> 
                
                <!--图片-->
                
                <?php if($rs['img']){?>
                <div class="gray modal_border">
                    <?php EnlargeImg($rs['img'],$rs['sdid'])?>
                </div>
                <?php }?></td>
            </tr>
            <?php
}
?>
          </tbody>
        </table>				
			
            
<!--底部操作按钮固定--> 

<style>body{margin-bottom:50px !important;}</style><!--后台不用隐藏,增高底部高度-->
<div align="right" class="fixed_btn" id="Autohidden">


<button type="submit" class="btn btn-grey"
    onClick="
  document.XingAoForm.lx.value='attr';
  document.XingAoForm.checked.value='1'; 
  "><i class="icon-signin"></i> 设为已审</button>
          <button type="submit" class="btn btn-grey"
    onClick="
  document.XingAoForm.lx.value='attr';
  document.XingAoForm.checked.value='0'; 
  "><i class="icon-signin"></i> 设为未审</button>
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
    
  </div>
</div>

<?php
require_once('ts_call.php');
$sql->free(); //释放资源
$enlarge=1;//是否用到 图片扩大插件 (/public/enlarge/call.html)
require_once($_SERVER['DOCUMENT_ROOT'].'/xingao/incluce/foot.php');
?>
