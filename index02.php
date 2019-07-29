<?php 

    $curlObj = curl_init();

    $url = "http://news.baidu.com/";

    curl_setopt($curlObj,CURLOPT_URL,$url);
    curl_setopt($curlObj,CURLOPT_RETURNTRANSFER ,true);
    curl_setopt($curlObj, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($curlObj,CURLOPT_POSTFIELDS ,false);

    $returnData = curl_exec($curlObj);

    $preg='#<div id="pane-news" class="mod-tab-pane active">.*<ul class="ulist focuslistnews" >.*</ul>.*</div>#isU';
preg_match_all($preg,$returnData,$res);
$preg1='#<a href="(.*)" mon="ct=1&amp;a=2&amp;c=top&pn=.*" target="_blank">(.*)</a>#isU';
preg_match_all($preg1,$res[0][0],$result);
array_shift($result[1]);
array_shift($result[2]);
$href=$result[1];
$title=$result[2];

   

    try {

    $dbh = new PDO('mysql:host=127.0.0.1;dbname=1704phpa', 'root', 'root');
    $dbh->exec('set names utf8');
     $sql ="";
    
     $val ="";
    foreach ($title as $key => $value) {
    	$sql .="('$value','$href[$key]'),";

    	
    }


    $sql=substr($sql, 0,-1);

    $ss ="insert into img(`name`,`emali`) value $sql";

    $res = $dbh->exec($ss);

    if ($res) {
       $res = new Redis();

       $res -> connect('127.0.0.1','6379');

       $json = json_encode($title);

       $res -> set('sss',json_encode($title));

       echo "添加成功";
    }

    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


 ?>