<?php
error_reporting (E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
  session_start();
  $userid =  $_SESSION['userId'];
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <header>
            <h1><a href="index.html">소비생각</a></h1>
        </header>
                
        <nav id="topMenu">
            <ul>
                <li><a class="menuLink" href="daily.php?userid=<?php echo $userid;?>">일별 지출내역</a></li>
                <li><a class="menuLink" href="category.php?userid=<?php echo $userid;?>">카테고리별 지출내역</a></li>
                <li><a class="menuLink" href="expenditureInput.php?userid=<?php echo $userid;?>">지출내역 작성</a></li>
            </ul>
        </nav>

        <article>
                <h4>각 카테고리별로 합산된 지출내역 출력, 각 카테고리 선택 시 선택한 카테고리의 지출목록 출력화면으로 이동</h4>

                <?php

                    $conn = mysqli_connect("localhost", "root", "091405", "think", 3306);   //php, mysql 연동을 위한 정보
                    mysqli_set_charset($conn, 'utf8'); 
                    $sql = "SELECT expenses.division_id,division_name,sum(prices) From expenses LEFT JOIN division ON expenses.division_id = division.division_id WHERE user_id='$userid' GROUP BY division_id ORDER BY expenses.division_id ASC";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));    //php, mysql 연동을 위한 함수

                    $sum_prices = 0;
                    $divisionId = 0;

                    while($row = mysqli_fetch_array($result)) {
   	            $sum_prices = $row['sum(prices)'];
                         //링크 이동과 함께 선택한 카테고리의 division_id, user_id, expenses_id를 넘겨준다
                         echo "<br> <h4> <li> <a href = \"category_detail.php?userid={$userid}&divisionid={$row['division_id']}\">";   
                         echo "카테고리명: ". $row["division_name"]. "   총 지출: ". $sum_prices. "원";   //카테고리명: division_name   총 지출: $sum_prices
                         echo "</a> </li> </h4>";
                    }

                ?>

        </article>

    </body>
    
</html>

