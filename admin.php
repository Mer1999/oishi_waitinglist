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
        #div_bottom {
            margin-top:300px;
            width: 100%;
            text-align: center;
        }
        #p_bottom {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            margin: auto;
            font-size: 150%;
        }

        #div_button {
            width: 100%;
            height: 600px;
        }

        #div_table {
            width: 100%;
            text-align: center;
        }

        

        #div_listempty {
            width: 100%;
            text-align: center;
        }

        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            text-align: center;
            margin: 20px auto;
            width: 90%;
            font-size: 200%;
        }

        button {
            width: 100%;
            height: 100%;
            font-size: 200%;
            color: red;
        }
        #txtHint{
            width:70%;
            margin:auto;
        }
    </style>
    <div id="div_title">
        <p class='p_title'>
            oishi | 開丼
        </p>
        <p class='p_title'>
            ADMIN
        </p>
    </div>
    <script language="javascript" type="text/javascript">
        function drop(objButton) {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            }
            //document.getElementById(objButton.value).value
            xmlhttp.open("GET", "drop.php?q=" + objButton.value, true);
            xmlhttp.send();
            //window.location.href = 'drop.php';
        }
    </script>
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

    $sql = "select*from waitinglist";
    $result = $mySQLi->query($sql);

    //判断列表是否为空
    if ($result->num_rows == 0) {
        $mySQLi->close();
        echo "<div id='div_listempty'><p class='p_title'>The list is empty!</p></div>";
    }
    //不为空则输出列表
    else {
        echo "<div id='div_table'><table id='table_word' style='border-color: #e6e6fa;' border='1px' cellpadding='5px' cellspacing='0px'><tr>";
        echo "<th>NO.</th><th>NAME</th><th>PHONE</th><th>PEOPLE</th><th>ADD TIME</th><th>DEAL</th>";
        echo "</tr>";
        $num = 1;
        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "<td>" . $num . "</td>";
            echo "<td>" . $row["customer_name"] . "</td>";
            echo "<td id='".$num."'>" . $row["customer_phone"] . "</td>";
            echo "<td>" . $row["customer_pp"] . "</td>";
            echo "<td>" . $row["submission_time"] . "</td>";
            echo "<td><button value='".$num++."' onclick=drop(this)>DROP</button></td>";
            echo "</tr>";
        }
        echo "</table></div>";
        $result->free();
        $mySQLi->close();
    }
    ?>
    <div id="txtHint"></div>
    <div id='div_bottom'>
        <p id='p_bottom'>
            oishi online waitinglist v0.1.0 </br>
            made by Andy ('ᴗ' )و
        </p>
    </div>

</body>

</html>