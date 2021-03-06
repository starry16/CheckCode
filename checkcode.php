<?php 


/*绘制验证码步骤
 * 1、复制一个字体文件
 * 2、定义一个函数;随机生成验证码内容的函数
 * 3、开始绘制验证码
 */

//绘制验证码

  $num=4;//长度
	$str = getCode($num,0); //使用下面函数获取验证码值

// 1、创建一个画布,分配颜色
	$width = $num*20;
	$height = 30;
	$im = imagecreatetruecolor($width,$height);
	//定义几个颜色（输出不同颜色的验证码）
	$color[] = imagecolorallocate($im,111,0,55);
	$color[] = imagecolorallocate($im,0,77,0);
	$color[] = imagecolorallocate($im,0,0,160);
	$color[] = imagecolorallocate($im,221,111,0);
	$color[] = imagecolorallocate($im,211,0,0);
	
	$bg = imagecolorallocate($im,240,240,240);//背景

// 2、开始绘画
	imagefill($im,0,0,$bg);
	imagerectangle($im,0,0,$width-1,$height-1,$color[rand(0,4)]);
	//添加干扰点
	for($i=0;$i<200;$i++){
		$c = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($im,rand(0,$width),rand(0,$height),$c);
	}
	
	//添加干扰线
	for($i=0;$i<5;$i++){
		$c = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imageline($im,rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$c);
	}
	
	//绘制验证码内容（一个一个字符绘制）
	for($i=0;$i<=$num;$i++){
		imagettftext($im,18,rand(-40,40),8+(18*$i),24,$color[rand(0,4)],"calibri.ttf",$str[$i]);
	}
	
//3、输出图像
	header("Content-Type:image/png");//设置相应头信息（注意次函数的前面不能有输出）
	imagepng($im);
	
	
//4、销毁图片（释放内容）

	imagedestory($im);






/*
 * 随机生成验证码内容的函数
 * @param $m:验证码的个数（默认为4）
 * @param $type:验证码的类型：0纯数字；1数字+小写字母；2数字+大小写字母
 */

function getCode($m=4,$type=0){
	$str = "1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM";
	//echo strlen($str);
	$t = array(9,35,strlen($str)-1);
	//随机生成验证码所需内容
	$c="";
	for($i=0;$i<$m;$i++){
		$c.=$str[rand(0,$t[$type])];
	}
	return $c;
}

//echo getCode(4,1);





?>
