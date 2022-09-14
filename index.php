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
        #p_bottom{
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            margin:auto;
            font-size:150%;
        }
        #p_refresh{
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            font-size: 250%;
        }
        #div_button {
            width: 100%;
            height: 500px;
        }
        #div_table{
            width:100%;
            text-align:center;
        }
        #div_bottom{
            margin-top:300px;
            width:100%;
            text-align:center;
        }
        #div_listempty{
            width:100%;
            text-align:center;
        }
        #div_refresh{
            width:100%;
            margin-top: 150px;
            text-align:center;
        }

        button {
            width: 70%;
            height: 40%;
            display: block;
            margin: auto;
            margin-top: 100px;
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            font-size: 300%;
        }
        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            text-align: center;
            margin:20px auto;
            width:95%;
            font-size:200%;
        }
        
    </style>
    <div id="div_title">
        <p class='p_title'>
            oishi | 開丼
        </p>
        <p class='p_title'>
            WAITING LIST
        </p>
    </div>
    <script language="javascript" type="text/javascript">
        function turnTonew() {
            window.location.href = 'newcus.html';
        }
        function turnTowait() {
            window.location.href = 'phoneinput.html';
        }
    </script>
    <?php
    echo "
    </br>
    <div id='div_button'>
        <button onclick='turnTonew()'>
            New Customer
        </button>
        </br>
        <button onclick='turnTowait()'>
            Already on the List?<br/>Click to Change your Info
        </button>
    </div>";

    //使用面向对象进行数据库的连接，在创建对象的时候就自动的连接数据
    $mySQLi = new MySQLi('localhost', 'root', '123456', 'oishi_waiting');

    //判断数据库是否连接
    if ($mySQLi->connect_errno) {
        die('connect error' . $mySQLi->connect_error);
    }

    //设置字符集
    $mySQLi->set_charset('utf8');

    $sql="select*from waitinglist";
    $result=$mySQLi->query($sql);
    echo "<div id='div_refresh'><p id='p_refresh'>Refresh This Page to Get the Latest List</p></div>";
    //判断列表是否为空
    if ($result->num_rows == 0){
        $mySQLi->close();
        echo "<div id='div_listempty'><p class='p_title'>The List is Empty!</p></div>";
    }
    //不为空则输出列表
    else{
        echo"<div id='div_table'><table id='table_word' style='border-color: #e6e6fa;' border='1px' cellpadding='5px' cellspacing='0px'><tr>";
        echo"<th>NO.</th><th>NAME</th><th>PHONE</th><th>PEOPLE</th><th>ADD TIME</th>";
        echo"</tr>";
        $num=1;
        while($row=$result->fetch_array()){
            echo"<tr>";
            echo"<td>".$num++."</td>";
            echo"<td>".$row["customer_name"]."</td>";
            $phone1=substr($row["customer_phone"],0,3);
            $phone2=substr($row["customer_phone"],7,3);
            echo"<td>".$phone1."****".$phone2."</td>";
            echo"<td>".$row["customer_pp"]."</td>";
            echo"<td>".$row["submission_time"]."</td>";
            echo"</tr>";
        }
        echo"</table></div>";
        $result->free();
        $mySQLi->close();
    }
    ?>
    <div id='div_bottom'>
    <p id='p_bottom'>
        oishi online waitinglist v0.1.0 </br>
        made by Andy (also the waiter ('ᴗ' )و)
    </p>
    </div>
    
</body>

</html>