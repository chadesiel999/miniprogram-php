<?php

//$openid = $_GET['openId'];
$openid = "oxnxJ5Gh6DVXFgVOgolX60z6pTHc";



//echo "openid:".$openid."/n";

$apply = "openid = '{$openid}' and processstatus = '0' and completestatus = '0'";
$process = "openid = '{$openid}' and processstatus = '1' and completestatus = '0'";
$complete = "openid = '{$openid}' and processstatus = '1' and completestatus = '1'";

$applysql = "SELECT `problem` FROM orders WHERE {$apply}";
$processsql = "SELECT `problem`,`orderreply` FROM orders WHERE {$process}";
$completesql = "SELECT `problem`,`orderreply` FROM orders WHERE {$complete}";

//拼接语句

$servername = "localhost";
$username = "root";
$password = "";//服务器中连接数据库的密码
$dbname = "test";//使用的数据库名
 
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
 
$conn -> set_charset('utf8');


// 检测连接
if ($conn->connect_error) {
    die("connect server fail: " . $conn->connect_error);
	echo "数据库连接失败\n";
} 
//echo "数据库连接成功\n";

$applyresult = $conn->query($applysql);
while($applyinfo = $applyresult-> fetch_assoc()){
	$applyinfoarray[] = $applyinfo;
}

$processresult = $conn->query($processsql);
while($processinfo = $processresult-> fetch_assoc()){
	$processinfoarray[] = $processinfo;
}


$completeresult = $conn->query($completesql);
while($completeinfo = $completeresult-> fetch_assoc()){
	$completeinfoarray[] = $completeinfo;
}

//遍历查询结果并输出

$array = ["apply"=>$applyinfoarray,"process"=>$processinfoarray,"complete"=>$completeinfoarray];

echo json_encode($array,JSON_UNESCAPED_UNICODE);

$conn->close();
//echo "数据库已关闭";


?>