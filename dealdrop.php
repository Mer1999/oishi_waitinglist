<center>
    <?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    //读取用户的输入
    $pwd = $_POST["pwd"];
    //密码不对跳回去
    if($pwd!="168"){
        echo "<script>alert('wrong password');</script>";
        header('Refresh:0; url=admin.php');
        exit;
    }
    //使用面向对象进行数据库的连接，在创建对象的时候就自动的连接数据
    $mySQLi = new MySQLi('localhost', 'root', '123456', 'oishi_waiting');

    //判断数据库是否连接
    if ($mySQLi->connect_errno) {
        die('connect error' . $mySQLi->connect_error);
    }

    //设置字符集
    $mySQLi->set_charset('utf8');

    //删除
    $sql = "delete from waitinglist where customer_number=".$_SESSION["dno"]."";
    if ($mySQLi->query($sql)){
        $mySQLi->close();
        echo "<script>alert('DROP SUCCESS, KEEP WORKING^^');</script>";
        header('Refresh:0; url=admin.php');
        exit;
    }
    ?>
</center>