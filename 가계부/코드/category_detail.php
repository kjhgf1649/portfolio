<?php
  error_reporting (E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
  session_start();
  $userid =  $_GET['userid']??'';
  $expense_id = $_GET['id'];
  $division_id = $_GET['divisionid'];
  echo $userid;
  echo $expense_id;
  echo $division_id;
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <header>
            <h1>소비생각</h1>
        </header>
        
        <nav id="topMenu">
            <ul>
                <li><a class="menuLink" href="daily.php?userid=<?php echo $userid;?>">일별 지출내역</a></li>
                <li><a class="menuLink" href="category.php?userid=<?php echo $userid;?>">카테고리별 지출내역</a></li>
                <li><a class="menuLink" href="expenditureInput.php?userid=<?php echo $userid;?>">지출내역 작성</a></li>
            </ul>
        </nav>

        <article>
            <h4>선택 된 카테고리의 지출 목록을 날짜 및 시간순으로 정렬하여 출력</h4>

            <?php 
            
                $conn = mysqli_connect("localhost", "root", "091405", "think", 3306);   //php, mysql 연동을 위한 정보
               
                mysqli_set_charset($conn, 'utf8'); 
                //mysql 명령문 : 이전 category.php에서 전달받은 uer_id와 division_id가 모두 일치하는 데이터만 내림차순(시간순)으로 정렬
                $sql = "SELECT * From expenses LEFT JOIN division ON expenses.division_id = division.division_id WHERE user_id='$userid' AND expenses.division_id='$division_id' ORDER BY expenses.date_time DESC"; 
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));    //php, mysql 연동을 위한 함수

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<li>";   
                        echo "시간: " . $row["date_time"]. " 카테고리: " . $row["division_name"]. " 결제수단: " . $row["method"]. 
                        " 금액: " . $row["prices"]. " 내용: ". $row["contents"]; //지출내용 출력
                        echo "</li>";
                    }
                }

                mysqli_close($conn); // DB 접속 닫기
            ?>

        </article>

    </body>
    
</html>





