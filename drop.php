<style>
    #div_confirm{
        width:100%;
        text-align: left;
        font-size:200%;
    }
    form{
        width:100%;
        text-align:center;
        font-size:200%;
    }
    #pwd{
        height:30px;
    }
    #btn{
        width:50%;
        height:40%;
        font-size:200%;
    }
    p{
        font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
    }
</style>
<?php
    $q=isset($_GET["q"]) ? intval($_GET["q"]) : '';
    if(empty($q)){
        echo"无事发生";
        exit;
    }
    session_start();
    //使用面向对象进行数据库的连接，在创建对象的时候就自动的连接数据
    $mySQLi = new MySQLi('localhost', 'root', '123456', 'oishi_waiting');

    //判断数据库是否连接
    if ($mySQLi->connect_errno) {
        die('connect error' . $mySQLi->connect_error);
    }

    //设置字符集
    $mySQLi->set_charset('utf8');

    $sql = "select*from waitinglist";
    $result = $mySQLi->query($sql);

    $i=1;//计数器
    while ($row = $result->fetch_array()) {
        if($i++==$q){
            $no=$row["customer_number"];
            $name=$row["customer_name"];
            $phone=$row["customer_phone"];
            $pp=$row["customer_pp"];
            break;
        }
    }
    echo"<div id='div_confirm'><p>CONFIRM THE DROP INFO</p><br />
    <p>NAME:".$name."</p><br />
    <p>PHONE:".$phone."</p><br />
    <p>PP:".$pp."</p></div><br />";
    $_SESSION["dno"]=$no;
    echo"<form action='dealdrop.php' method='POST'>
    <lable for='pwd'>password:</lable>
    <input id='pwd' name='pwd' type='num' required/><br />
    <input id='btn' type='submit' value='CONFIRM'><br />
    </form>";
    //echo$phone;
?>