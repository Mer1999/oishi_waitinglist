<center>
    <?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    //读取用户的输入
    $phone = $_POST["phone"];
    if(!preg_match("/^\d{10}$/",$phone)){
        echo "<script>alert('phone has to be 10-digit number, please');</script>";
        header('Refresh:0; url=phoneinput.html');
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

    //检查此手机号是否已经预约
    $sql = "select*from waitinglist where customer_phone='" . $phone . "'";
    $result = $mySQLi->query($sql);

    //未预约过
    if ($result->num_rows == 0){
        $mySQLi->close();
        echo "<script>alert('this phone number is not on the waiting list, jump to the add-list page');</script>";
        header('Refresh:0; url=newcus.html');
        exit;
    }
    else{
        $mySQLi->close();
        $_SESSION["phone"]=$phone;
        header('Refresh:0; url=changeinfo.php');
    }

    ?>
</center>