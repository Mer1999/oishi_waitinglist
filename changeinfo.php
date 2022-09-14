<!DOCTYPE html>
<html>

<body>
    <meta charset="utf-8">
    <title>welcome to oishi</title>
    <style>
        #div_title {
            width: 100%;
            height: 20%;
            text-align: center;
        }

        .p_title {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            font-size: 300%;
            letter-spacing: 10px;
        }
        form{
            width:100%;
            height:500px;
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            font-size:200%;
            margin-top: 300px;
        }
        table{
            width:100%;
        }
        #div_table{
            width:100%;
            text-align: center;
        }
        tr{
            width:100%;
            height:100px;
        }
        input{
            height:60px;
            width:80%;
            font-size: 100%;
        }
        #btn_change{
            margin-top: 100px;
            width:60%;
            height:100px;
        }
        #div_bottom {
            position: absolute;
            bottom:100px;
            width: 100%;
            text-align: center;
        }
        #p_bottom {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            margin: auto;
            font-size: 150%;
            letter-spacing: 0px;
        }
    </style>
    <div id="div_title">
        <p class='p_title'>
            oishi | 開丼
        </p>
        <p class='p_title'>
            CHANGE INFO
        </p>
    </div>
    <?php
    session_start();
    //使用面向对象进行数据库的连接，在创建对象的时候就自动的连接数据
    $mySQLi = new MySQLi('localhost', 'root', '123456', 'oishi_waiting');

    //判断数据库是否连接
    if ($mySQLi->connect_errno) {
        die('connect error' . $mySQLi->connect_error);
    }

    //设置字符集
    $mySQLi->set_charset('utf8');

    $phone=$_SESSION["phone"];
    $sql="select*from waitinglist where customer_phone='" . $phone . "'";
    $result=$mySQLi->query($sql);
    if ($result->num_rows == 0){
        $mySQLi->close();
        echo"<script>alert('this phone number is not on the waiting list, jump to the add-list page');</script>";
        header('Refresh:0; url=newcus.html');
        exit;
    }
    else{
        $row=$result->fetch_array();
        $_SESSION["no"]=$row["customer_number"];
    }
    echo
    "<form action='dealchangeinfo.php' method='POST'>
    <div id=div_table>
    <table>
        <tr><td><lable for='cusname'>NAME:</lable></td>
        <td><input id='cusname' name='cusname' type='text' maxlength='15' value=".$row["customer_name"]." required/></td></tr>
        <tr><td><lable for='phone'>PHONE(10-digit):</lable></td>
        <td><input id='phone' name='phone' type='text' maxlength='10' value=".$row["customer_phone"]." required/></td></tr>
        <tr><td><lable for='pp'>PEOPLE NUMBER:</lable></td>
        <td><input id='pp' name='pp' type='number' min='1' max='8' value=".$row["customer_pp"]." required/></td></tr>
    </table>
    <input id='btn_change' type='submit' value='CHANGE'>
    </div>
    </form>";
    $mySQLi->close();
    ?>
    <script>
        const WIN_HEIGHT=window.innerHeight
        window.addEventListener('resize',()=>{
            if(window.innerHeight<WIN_HEIGHT){
                var t=document.getElementById("div_bottom");
                t.style.display='none';
            }else{
                var t=document.getElementById("div_bottom");
                t.style.display='block';
            }
        })
    </script>
    <div id='div_bottom'>
        <p id='p_bottom'>
            oishi online waitinglist v0.1.0 </br>
            made by Andy (also the waiter ('ᴗ' )و)
        </p>
    </div>
</body>

</html>