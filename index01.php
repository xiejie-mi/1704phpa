<?php 

$page =isset($_GET['page'])?$_GET['page']:1;

$redis = new Redis;

$redis->connect('127.0.0.1',6379);
if(!$redis->exists("datapage_$page")){
   $res = $resdis->get("datapage_$page");
    $arr=array('code'=>0,'msg'=>'查询成功','data'=>json_decode($res,true));
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新闻展示</title>
</head>
<body>
    <center>
        <form action="">
        <input type="text" name="so" class="content">
        <button class="ss">搜素</button>
            <table>
                <tr>
                    <td>新闻id</td>
                    <td>新闻标题</td>
                    <td>新闻网址</td>
                </tr>

                <?php 
                   foreach ($data as $key => $value) {
                     echo "<tr>
                    <td>$value[id]</td>
                    <td>$value[name]</td>
                    <td><a href='$value[emali]'>$value[emali]</a></td>
                </tr>";
                   }
                ?>
            </table>
        </form>
    </center>
</body>
</html>

