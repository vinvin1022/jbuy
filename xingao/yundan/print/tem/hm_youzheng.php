<?php $print_i++;?>
<script language="javascript" type="text/javascript">
function CreatePrintPage<?=$print_i?>() {

LODOP.PRINT_INITA("-5mm","-23mm","232mm","152mm","<?=yundan_print($print_tem)?>-海门邮政套打-吉买转运打印");
LODOP.SET_PRINT_PAGESIZE(1,2320,1520,"");//设置纸张高度宽度 (默认单位为0.1mm,如800=80mm)
LODOP.ADD_PRINT_SETUP_BKIMG("G:\hm_youzheng.jpg");
LODOP.SET_SHOW_MODE("BKIMG_LEFT",2);
LODOP.SET_SHOW_MODE("BKIMG_TOP",6);
LODOP.SET_SHOW_MODE("BKIMG_WIDTH","232mm");
LODOP.SET_SHOW_MODE("BKIMG_HEIGHT","152mm");
LODOP.SET_SHOW_MODE("BKIMG_IN_PREVIEW",1);
//<?=CompanySend('sendName')?>\n  公司名字
//<?=cadd($rs['ydh'])?>\n    运单号
//<?=cadd($rs['whPlace'])?> 
//(<?=spr($rs['payment']+$rs['tax_payment'])?>)\n  总费用
//\n<?=channel_name($mr['groupid'],$rs['warehouse'],$rs['country'],$rs['channel'])?>渠道
//LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.ADD_PRINT_TEXT("74mm","93mm","15mm","9mm","<?=CompanySend('sendZip')?>");//发件邮编
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("74mm","56mm","33.07mm","6.09mm","15921688717");//发件电话
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("49mm","87mm","15mm","7mm","<?=cadd($rs['f_add_chengshi'])?><?=cadd($mrf['add_chengshi'])?>");//发件人城市
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("54mm","85mm","19mm","8mm","中国");//发件国家
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("49mm","45mm","20mm","6mm","<?=cadd($rs['f_name'])?><?=cadd($mrf['truename'])?>");//发件名字
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("65mm","23mm","82mm","7mm","<?=CompanySend('sendAdd')?>");// 换行\n  发件人发件地址
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");


LODOP.ADD_PRINT_TEXT("137mm","175mm","23mm","7mm","<?php $r=CustomerService($rs['userid']);echo $r[0]."({$r[1]})";?>");//客服代表
LODOP.SET_PRINT_STYLEA(0,"FontSize",13);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("44.5mm","112mm","16mm","6mm","<?=spr($rs['weight'],2,0,1).$XAwt?>");  //总重量
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");


//LODOP.ADD_PRINT_TEXT("105mm","105mm","23mm","10mm","<?=spr($rs['payment']+$rs['tax_payment'])?>元");//总费用
//LODOP.SET_PRINT_STYLEA(0,"FontSize",13);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("48mm","135mm","24mm","6mm","<?=cadd($rs['s_name'])?>");//收件人
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("65mm","108mm","95mm","7mm","<?=yundan_add_all($rs,'s')?>");//收件地址
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");

LODOP.ADD_PRINT_TEXT("48mm","177mm","25mm","7mm","<?=cadd($rs['s_add_chengshi'])?><?=cadd($mrs['add_chengshi'])?>"); //收货城市
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.ADD_PRINT_TEXT("54mm","177mm","25mm","7mm","<?=Country($rs['country'],'','EN')?>"); //收货国家
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);

LODOP.ADD_PRINT_TEXT("74mm","145mm","35mm","7mm","<?=cadd($rs['s_mobile_code'])?>-<?=cadd($rs['s_mobile'])?>");//收件电话
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("74mm","190mm","15mm","7mm","<?=cadd($rs['s_zip'])?>");//收件邮编
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");


//LODOP.ADD_PRINT_TEXT("28.05mm","100.99mm","14.55mm","5.29mm","<?=spr($rs['fee_transport'])?>");  //运费
//LODOP.ADD_PRINT_TEXT("28.05mm","110.18mm","12.7mm","4.76mm","<?=spr($rs['insurevalue'])?>");    //保险
//LODOP.ADD_PRINT_TEXT("37.57mm","120.72mm","28.31mm","4.5mm","<?=spr($rs['fee_transport']+$rs['insurevalue'])?>");//运费+保险
LODOP.ADD_PRINT_TEXT("44mm","137mm","10mm","5.29mm","<?=spr($rs['declarevalue'])?>");   //物品价值
LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
//LODOP.ADD_PRINT_TEXT("87.84mm","30.69mm","5.03mm","4.76mm","●");
//LODOP.ADD_PRINT_TEXT("115.09mm","30.69mm","5.03mm","4.76mm","●");
//LODOP.ADD_PRINT_TEXT("120.65mm","30.69mm","4.23mm","4.76mm","●");//右记
//LODOP.ADD_PRINT_TEXT("125.94mm","30.43mm","4.76mm","4.76mm","●");//运送
//LODOP.ADD_PRINT_TEXT("142.61mm","18.79mm","6.09mm","6.35mm","●");

//LODOP.ADD_PRINT_TEXT("65.35mm","171.71mm","5.56mm","4.5mm","●");
//LODOP.ADD_PRINT_TEXT("127.53mm","125.94mm","5.56mm","4.76mm","●");
//LODOP.ADD_PRINT_TEXT("114.83mm","144.99mm","4.76mm","5.03mm","●");//放弃

<?php 
$JPChannel=GetJPChannel($rs['warehouse'],$rs['channel']);
if(!$JPChannel==1){
?>
//无
<?php }elseif($JPChannel==2){?>
	LODOP.ADD_PRINT_TEXT("49.48mm","128.34mm","4.5mm","4.76mm","●");//空运
<?php }elseif($JPChannel==3){?>
	LODOP.ADD_PRINT_TEXT("54.5mm","128.34mm","4.76mm","4.76mm","●");//SAL
<?php }elseif($JPChannel==4){?>
	LODOP.ADD_PRINT_TEXT("60.5mm","128.34mm","4.5mm","4.76mm","●");//船运
<?php }?>

LODOP.ADD_PRINT_TEXT("138mm","145mm","12mm","6mm","<?=DateYmd(time(),'Y')?>年");//	时间年

LODOP.ADD_PRINT_TEXT("138mm","155mm","10mm","6mm","<?=DateYmd(time(),'m')?>月");//	时间月

LODOP.ADD_PRINT_TEXT("138mm","165mm","10mm","6mm","<?=DateYmd(time(),'d')?>日");//	时间日

<?php
$wupin_number=0;
$wupin_total=0;

$fromtable='yundan'; $fromid=$rs['ydid'];
if($fromtable&&$fromid)
{
	$location=89.5;//上边距
	$query_wp="select * from wupin where fromtable='{$fromtable}' and fromid='{$fromid}' order by wupin_name desc  limit 5";
	$sql_wp=$xingao->query($query_wp);
	while($wp=$sql_wp->fetch_array())
	{
		$wupin_number+=$wp['wupin_number'];
		$wupin_total+=$wp['wupin_total'];
		
?>
LODOP.ADD_PRINT_TEXT("<?=$location?>mm","26mm","44mm","6mm","<?=cadd($wp['wupin_name'])?>");// 寄送物品
LODOP.SET_PRINT_STYLEA(0,"FontSize",8);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
LODOP.ADD_PRINT_TEXT("<?=$location?>mm","68mm","17mm","6mm","<?=cadd($wp['wupin_number'])?>");// 寄送物品数量
LODOP.SET_PRINT_STYLEA(0,"FontSize",8);
LODOP.SET_PRINT_STYLEA(0,"FontName","黑体");
//LODOP.ADD_PRINT_TEXT("<?=$location?>mm","100.28mm","14.02mm","3.44mm","");//hs
//LODOP.ADD_PRINT_TEXT("<?=$location?>mm","115.62mm","18.52mm","3.44mm","");//产国
//LODOP.ADD_PRINT_TEXT("<?=$location?>mm","137.85mm","16.67mm","3.44mm","");//重量+单位
//LODOP.ADD_PRINT_TEXT("<?=$location?>mm","158.22mm","12.96mm","3.44mm","<?=spr($wp['wupin_total'])?>");//总价
<?php
	$location+=10;
	}
	
}
?>



}; 
</script>  