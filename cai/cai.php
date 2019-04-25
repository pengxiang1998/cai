<?php
header('Access-Control-Allow-Origin:*');
error_reporting(0);

require_once 'AipImageClassify.php';

// 你的 APPID AK SK
const APP_ID = '15878504';
const API_KEY = 'KWw027gSGzI7dZ2aVCPqF5Ef';
const SECRET_KEY = 'hSWLps4hq1fXxrQDDKVNdtRQ4IkolqGx';
//echo dirname(__FILE__);
if($_SERVER['REQUEST_METHOD']=='POST')
{    $drivingLicence=$_FILES['drivingLicence']['tmp_name'];
	
$client = new AipImageClassify(APP_ID, API_KEY, SECRET_KEY);
$image = file_get_contents($drivingLicence);

// 调用菜品识别
$client->dishDetect($image);

// 如果有可选参数
$options = array();
$options["top_num"] = 3;
$options["filter_threshold"] = "0.7";
$options["baike_num"] = 5;

// 带参数调用菜品识别
$a=$client->dishDetect($image, $options);
//print_r($a['result']);
//var_dump($a['result']);
$arr=$a['result'];
class food_data{
	public $food_name="";
	public $food_calorie="";
	public $food_probability="";
	public $food_img="暂无图片";
	public $food_description="暂无描述";
}
$arr_food=array();

echo "<center><table ><tr><th colspan=4  align=center><h1>菜品识别结果</h1></th></tr><tr bgcolor='#8bffff'><th height=50>菜品名称</th><th>热量</th><th>菜品图片</th><th>菜品描述</th>";
foreach($arr as $arr1){
	$e=new food_data();
	$e->food_name=$arr1['name'];
	$e->food_calorie=$arr1['calorie'];
	$e->food_probability=$arr1['probability'];
	$e->food_img=$arr1['baike_info']['image_url'];
	//$e->food_img=$_FILES['drivingLicence']['tmp_name'];
	$e->food_description=$arr1['baike_info']['description'];
	//array_push($arr_food,$e);
	if($arr1['baike_info']['description']==null){$e->food_description="暂无描述";}
	echo "<tr><th width=100>";
	echo $e->food_name."<th width=200 height=180>";
	echo $e->food_calorie."<font color='red'>kj</font><th>";
	//echo $e->food_probability."<th>";
	echo "<img src='$e->food_img' width=180 height=160>"."<th width=400 align=left>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;".$e->food_description."</th><tr bgcolor='#8bffff'><th colspan=4 ></th>";
	
}

//echo json_encode($arr_food, JSON_UNESCAPED_UNICODE);
}
//$conn->close();
?>
