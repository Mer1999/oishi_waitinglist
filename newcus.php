<center>
    <?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    //读取用户的输入
    $name = $_POST["cusname"];
    $phone = $_POST["phone"];
    $pp = $_POST["pp"];
    if(!preg_match("/^\d{10}$/",$phone)){
        echo "<script>alert('phone has to be 10-digit number, please');</script>";
        header('Refresh:0; url=newcus.html');
        exit;
    }
    if (!preg_match("/^[A-Za-z]+$/",$name)) {
        echo "<script>alert('no special character in name, please');</script>";
        header('Refresh:0; url=newcus.html');
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

    //已预约过
    if ($result->num_rows > 0){
        $mySQLi->close();
        echo "<script>alert('this phone number is already in the waiting list');</script>";
        header('Refresh:0; url=index.php');
        exit;
    }
    else{
        $sql= "INSERT INTO waitinglist(customer_name,customer_phone,customer_pp,submission_time) VALUES ('" . $name . "', '" . $phone . "','".$pp."',CURTIME())";
        if ($mySQLi->query($sql)){
            $mySQLi->close();
            echo "<script>alert('SUCCESS!');</script>";
            header('Refresh:0; url=index.php');
        }
    }

    ?>
</center>