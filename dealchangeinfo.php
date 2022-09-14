<center>
    <?php
    session_start();
    header("Content-Type:text/html;charset=UTF-8");
    //读取用户的输入
    $name = $_POST["cusname"];
    $phone = $_POST["phone"];
    $pp = $_POST["pp"];
    echo $name;
    echo $phone;
    echo $pp;
    echo $_SESSION["no"];
    if (!preg_match("/^\d{10}$/", $phone)) {
        echo "<script>alert('phone has to be 10-digit number, please');</script>";
        header('Refresh:0; url=newcus.html');
        exit;
    }
    if (!preg_match("/^[A-Za-z]+$/", $name)) {
        echo "<script>alert('no special character in name, please');</script>";
        header('Refresh:0; url=changeinfo.php');
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

    //检查此号码是否已在其他NO.预约
    $sql = "select*from waitinglist where customer_phone='" . $phone . "'";
    $result = $mySQLi->query($sql);
    echo"testa";

    //已预约过
    if ($result->num_rows > 0) {
        echo"testb";
        $row = $result->fetch_array();
        echo $row["customer_name"];
        //编号不同，说明此号码已经在其他地方预约过
        if ($row["customer_number"] != $_SESSION["no"]) {
            $mySQLi->close();
            echo "<script>alert('this phone number is already on the waiting list');</script>";
            header('Refresh:0; url=index.php');
            exit;
        }
    }

    //更新信息
    $sql = "UPDATE waitinglist SET customer_name='" . $name . "',customer_phone='" . $phone . "',customer_pp='" . $pp . "' WHERE customer_number='" . $_SESSION["no"] . "'";
    if ($mySQLi->query($sql)) {
        $mySQLi->close();
        echo "<script>alert('CHANGE INFO SUCCESS!');</script>";
        header('Refresh:0; url=index.php');
        exit;
    }

    ?>
</center>