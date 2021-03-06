<?php
if(!defined('InXingAo'))
{
	exit('No InXingAo');
}
//添加价格表:	本页；	public\function_types.php(搜索:报价公式)；	xingao\yundan\call\calc.php；

//日本邮政价格表  (后台已可以设置价格表)
function price_jp($weight,$channel) 
{  
	global $XAMcurrency,$XAScurrency;
	
	/*
	本站$XAwt的单位:
	如果$XAwt是g,就写$weight=$weight*1;
	如果$XAwt不是g,就写上换算成g的比例(比如$XAwt是kg,就写$weight=$weight*1000;)
	*/
	$weight=$weight*1;
	
	if($XAMcurrency=='JPY'){$price_currency=1;}
	elseif($XAMcurrency!=$XAScurrency){$price_currency=exchange($XAMcurrency,'JPY');}
	
	if(!$weight){return '没有重量';}
	
	//设置价格--开始
	/*  
		2016年6月1日 日本邮局的价格表
		重量是用g,币种是日元
		$p是邮局运费
		$s是自收服务费
	*/
elseif($weight<=500){
	$p['1']=1400;$s['1']=0;//EMS	 
	$p['2']=1700;$s['2']=0;//空运	 
	$p['3']=1800;$s['3']=0;//SAL	 
	$p['4']=1600;$s['4']=0;//船运
}elseif($weight<=600){
	$p['1']=1540;$s['1']=0;//EMS	 
	$p['2']=2050;$s['2']=0;//空运	 
	$p['3']=1800;$s['3']=0;//SAL	 
	$p['4']=1600;$s['4']=0;//船运
}elseif($weight<=700){
	$p['1']=1680;$s['1']=0;//EMS	 
	$p['2']=2050;$s['2']=0;//空运	 
	$p['3']=1800;$s['3']=0;//SAL	 
	$p['4']=1600;$s['4']=0;//船运
}elseif($weight<=800){
	$p['1']=1820;$s['1']=0;//EMS	 
	$p['2']=2050;$s['2']=0;//空运	 
	$p['3']=1800;$s['3']=0;//SAL	 
	$p['4']=1600;$s['4']=0;//船运
}elseif($weight<=900){
	$p['1']=1960;$s['1']=0;//EMS	 
	$p['2']=2050;$s['2']=0;//空运	 
	$p['3']=1800;$s['3']=0;//SAL	 
	$p['4']=1600;$s['4']=0;//船运
}elseif($weight<=1000){
	$p['1']=2100;$s['1']=0;//EMS	 
	$p['2']=2050;$s['2']=0;//空运	 
	$p['3']=1800;$s['3']=0;//SAL	 
	$p['4']=1600;$s['4']=0;//船运
}elseif($weight<=1250){
	$p['1']=2400;$s['1']=0;//EMS	 
	$p['2']=2400;$s['2']=0;//空运	 
	$p['3']=2400;$s['3']=0;//SAL	 
	$p['4']=1900;$s['4']=0;//船运
}elseif($weight<=1500){
	$p['1']=2700;$s['1']=0;//EMS	 
	$p['2']=2400;$s['2']=0;//空运	 
	$p['3']=2400;$s['3']=0;//SAL	 
	$p['4']=1900;$s['4']=0;//船运
}elseif($weight<=1750){
	$p['1']=3000;$s['1']=0;//EMS	 
	$p['2']=2750;$s['2']=0;//空运	 
	$p['3']=2400;$s['3']=0;//SAL	 
	$p['4']=1900;$s['4']=0;//船运
}elseif($weight<=2000){
	$p['1']=3300;$s['1']=0;//EMS	 
	$p['2']=2750;$s['2']=0;//空运	 
	$p['3']=2400;$s['3']=0;//SAL	 
	$p['4']=1900;$s['4']=0;//船运
}elseif($weight<=2500){
	$p['1']=3800;$s['1']=0;//EMS	 
	$p['2']=3100;$s['2']=0;//空运	 
	$p['3']=3000;$s['3']=0;//SAL	 
	$p['4']=2200;$s['4']=0;//船运
}elseif($weight<=3000){
	$p['1']=4300;$s['1']=0;//EMS	 
	$p['2']=3450;$s['2']=0;//空运	 
	$p['3']=3000;$s['3']=0;//SAL	 
	$p['4']=2200;$s['4']=0;//船运
}elseif($weight<=3500){
	$p['1']=4800;$s['1']=0;//EMS	 
	$p['2']=3800;$s['2']=0;//空运	 
	$p['3']=3600;$s['3']=0;//SAL	 
	$p['4']=2500;$s['4']=0;//船运
}elseif($weight<=4000){
	$p['1']=5300;$s['1']=0;//EMS	 
	$p['2']=4150;$s['2']=0;//空运	 
	$p['3']=3600;$s['3']=0;//SAL	 
	$p['4']=2500;$s['4']=0;//船运
}elseif($weight<=4500){
	$p['1']=5800;$s['1']=0;//EMS	 
	$p['2']=4500;$s['2']=0;//空运	 
	$p['3']=4200;$s['3']=0;//SAL	 
	$p['4']=2800;$s['4']=0;//船运
}elseif($weight<=5000){
	$p['1']=6300;$s['1']=0;//EMS	 
	$p['2']=4850;$s['2']=0;//空运	 
	$p['3']=4200;$s['3']=0;//SAL	 
	$p['4']=2800;$s['4']=0;//船运
}elseif($weight<=5500){
	$p['1']=6800;$s['1']=0;//EMS	 
	$p['2']=5150;$s['2']=0;//空运	 
	$p['3']=4700;$s['3']=0;//SAL	 
	$p['4']=3100;$s['4']=0;//船运
}elseif($weight<=6000){
	$p['1']=7300;$s['1']=0;//EMS	 
	$p['2']=5450;$s['2']=0;//空运	 
	$p['3']=4700;$s['3']=0;//SAL	 
	$p['4']=3100;$s['4']=0;//船运
}elseif($weight<=6500){
	$p['1']=8100;$s['1']=0;//EMS	 
	$p['2']=5750;$s['2']=0;//空运	 
	$p['3']=5200;$s['3']=0;//SAL	 
	$p['4']=3400;$s['4']=0;//船运
}elseif($weight<=7000){
	$p['1']=8100;$s['1']=0;//EMS	 
	$p['2']=6050;$s['2']=0;//空运	 
	$p['3']=5200;$s['3']=0;//SAL	 
	$p['4']=3400;$s['4']=0;//船运
}elseif($weight<=7500){
	$p['1']=8900;$s['1']=0;//EMS	 
	$p['2']=6350;$s['2']=0;//空运	 
	$p['3']=5700;$s['3']=0;//SAL	 
	$p['4']=3700;$s['4']=0;//船运
}elseif($weight<=8000){
	$p['1']=8900;$s['1']=0;//EMS	 
	$p['2']=6650;$s['2']=0;//空运	 
	$p['3']=5700;$s['3']=0;//SAL	 
	$p['4']=3700;$s['4']=0;//船运
}elseif($weight<=8500){
	$p['1']=9700;$s['1']=0;//EMS	 
	$p['2']=6950;$s['2']=0;//空运	 
	$p['3']=6200;$s['3']=0;//SAL	 
	$p['4']=4000;$s['4']=0;//船运
}elseif($weight<=9000){
	$p['1']=9700;$s['1']=0;//EMS	 
	$p['2']=7250;$s['2']=0;//空运	 
	$p['3']=6200;$s['3']=0;//SAL	 
	$p['4']=4000;$s['4']=0;//船运
}elseif($weight<=9500){
	$p['1']=10500;$s['1']=0;//EMS	 
	$p['2']=7550;$s['2']=0;//空运	 
	$p['3']=6700;$s['3']=0;//SAL	 
	$p['4']=4300;$s['4']=0;//船运
}elseif($weight<=10000){
	$p['1']=10500;$s['1']=0;//EMS	 
	$p['2']=7850;$s['2']=0;//空运	 
	$p['3']=6700;$s['3']=0;//SAL	 
	$p['4']=4300;$s['4']=0;//船运
}elseif($weight<=11000){
	$p['1']=11300;$s['1']=0;//EMS	 
	$p['2']=8250;$s['2']=0;//空运	 
	$p['3']=7000;$s['3']=0;//SAL	 
	$p['4']=4550;$s['4']=0;//船运
}elseif($weight<=12000){
	$p['1']=12100;$s['1']=0;//EMS	 
	$p['2']=8650;$s['2']=0;//空运	 
	$p['3']=7300;$s['3']=0;//SAL	 
	$p['4']=4800;$s['4']=0;//船运
}elseif($weight<=13000){
	$p['1']=12900;$s['1']=0;//EMS	 
	$p['2']=9050;$s['2']=0;//空运	 
	$p['3']=7600;$s['3']=0;//SAL	 
	$p['4']=5050;$s['4']=0;//船运
}elseif($weight<=14000){
	$p['1']=13700;$s['1']=0;//EMS	 
	$p['2']=9450;$s['2']=0;//空运	 
	$p['3']=7900;$s['3']=0;//SAL	 
	$p['4']=5300;$s['4']=0;//船运
}elseif($weight<=15000){
	$p['1']=14500;$s['1']=0;//EMS	 
	$p['2']=9850;$s['2']=0;//空运	 
	$p['3']=8200;$s['3']=0;//SAL	 
	$p['4']=5550;$s['4']=0;//船运
}elseif($weight<=16000){
	$p['1']=15300;$s['1']=0;//EMS	 
	$p['2']=10250;$s['2']=0;//空运	 
	$p['3']=8500;$s['3']=0;//SAL	 
	$p['4']=5800;$s['4']=0;//船运
}elseif($weight<=17000){
	$p['1']=16100;$s['1']=0;//EMS	 
	$p['2']=10650;$s['2']=0;//空运	 
	$p['3']=8800;$s['3']=0;//SAL	 
	$p['4']=6050;$s['4']=0;//船运
}elseif($weight<=18000){
	$p['1']=16900;$s['1']=0;//EMS	 
	$p['2']=11050;$s['2']=0;//空运	 
	$p['3']=9100;$s['3']=0;//SAL	 
	$p['4']=6300;$s['4']=0;//船运
}elseif($weight<=19000){
	$p['1']=17700;$s['1']=0;//EMS	 
	$p['2']=11450;$s['2']=0;//空运	 
	$p['3']=9400;$s['3']=0;//SAL	 
	$p['4']=6550;$s['4']=0;//船运
}elseif($weight<=20000){
	$p['1']=18500;$s['1']=0;//EMS	 
	$p['2']=11850;$s['2']=0;//空运	 
	$p['3']=9700;$s['3']=0;//SAL	 
	$p['4']=6800;$s['4']=0;//船运
}elseif($weight<=21000){
	$p['1']=19300;$s['1']=0;//EMS	 
	$p['2']=12250;$s['2']=0;//空运	 
	$p['3']=10000;$s['3']=0;//SAL	 
	$p['4']=7050;$s['4']=0;//船运
}elseif($weight<=22000){
	$p['1']=20100;$s['1']=0;//EMS	 
	$p['2']=12650;$s['2']=0;//空运	 
	$p['3']=10300;$s['3']=0;//SAL	 
	$p['4']=7300;$s['4']=0;//船运
}elseif($weight<=23000){
	$p['1']=20900;$s['1']=0;//EMS	 
	$p['2']=13050;$s['2']=0;//空运	 
	$p['3']=10600;$s['3']=0;//SAL	 
	$p['4']=7550;$s['4']=0;//船运
}elseif($weight<=24000){
	$p['1']=21700;$s['1']=0;//EMS	 
	$p['2']=13450;$s['2']=0;//空运	 
	$p['3']=10900;$s['3']=0;//SAL	 
	$p['4']=7800;$s['4']=0;//船运
}elseif($weight<=25000){
	$p['1']=22500;$s['1']=0;//EMS	 
	$p['2']=13850;$s['2']=0;//空运	 
	$p['3']=11200;$s['3']=0;//SAL	 
	$p['4']=8050;$s['4']=0;//船运
}elseif($weight<=26000){
	$p['1']=23300;$s['1']=0;//EMS	 
	$p['2']=14250;$s['2']=0;//空运	 
	$p['3']=11500;$s['3']=0;//SAL	 
	$p['4']=8300;$s['4']=0;//船运
}elseif($weight<=27000){
	$p['1']=24100;$s['1']=0;//EMS	 
	$p['2']=14650;$s['2']=0;//空运	 
	$p['3']=11800;$s['3']=0;//SAL	 
	$p['4']=8550;$s['4']=0;//船运
}elseif($weight<=28000){
	$p['1']=24900;$s['1']=0;//EMS	 
	$p['2']=15050;$s['2']=0;//空运	 
	$p['3']=12100;$s['3']=0;//SAL	 
	$p['4']=8800;$s['4']=0;//船运
}elseif($weight<=29000){
	$p['1']=25700;$s['1']=0;//EMS	 
	$p['2']=15450;$s['2']=0;//空运	 
	$p['3']=12400;$s['3']=0;//SAL	 
	$p['4']=9050;$s['4']=0;//船运
}elseif($weight<=30000){
	$p['1']=26500;$s['1']=0;//EMS	 
	$p['2']=15850;$s['2']=0;//空运	 
	$p['3']=12700;$s['3']=0;//SAL	 
	$p['4']=9300;$s['4']=0;//船运
}
	//设置价格--结束
	
	$price=$p[findNum($channel)];
	$service=$s[findNum($channel)];
	if(!spr($price)){
		$r['price']='该渠道不支持该重量';$r['service']=0;
	}else{
		if($price_currency<=0){$price_currency=1;}
		$r['price']=spr($price*$price_currency);//运费
		$r['service']=spr($service*$price_currency);//服务费
		/*
			0自动按后台设置(如果上面也是0,也是自动按后台设置);	
			-1不收费
		*/
	}
	return $r;
}






//体积费公式:下拉选择
function cc_formula($zhi,$lx='')
{  
	if($lx)
	{
		//重要:里面的数字必须跟function_price.php中的数字含意相同
		
		$selected=$zhi==''?'selected':''; echo '<option value="" '.$selected.'> </option>';
		$selected=$zhi=='1'?'selected':''; echo '<option value="1" '.$selected.'>长*宽*高/5000</option>';
		$selected=$zhi=='2'?'selected':''; echo '<option value="2" '.$selected.'>长*宽*高/6000</option>';
		$selected=$zhi=='3'?'selected':''; echo '<option value="3" '.$selected.'>长*宽*高/7000</option>';
		
	}else{
		switch($zhi)
		{
			case '':return '';
			case '1':return '长*宽*高/5000';
			case '2':return '长*宽*高/6000';
			case '3':return '长*宽*高/7000';
		}
	}
}


//体积费公式:实际计算
function cc_formula_calc($cc_chang,$cc_kuan,$cc_gao,$formula)
{  
	$lfcc=$cc_chang*$cc_kuan*$cc_gao;
	if($lfcc<=0||!$formula){return;}
	
	if($formula==1){$fee_cc=$cc_chang*$cc_kuan*$cc_gao/5000;}
	elseif($formula==2){$fee_cc=$cc_chang*$cc_kuan*$cc_gao/6000;}
	elseif($formula==3){$fee_cc=$cc_chang*$cc_kuan*$cc_gao/7000;}
	
	return $fee_cc;
}

?>