<?php
error_reporting (E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
  session_start();
  $userid =  $_GET['userid']??'';
  $expense_id = $_GET['id'];
  echo $userid;
  echo $expense_id;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>지출내역 수정 삭제</title>
        
    </head>

    <body>
        <header>
            <h1>지출내역 수정 삭제</h1>
        </header>
            
        <nav id="topMenu">
            <ul>
                <li><a class="menuLink" href="daily.php?userid=<?php echo $userid;?>">일별 지출내역</a></li>
                <li><a class="menuLink" href="category.php?userid=<?php echo $userid;?>">카테고리별 지출내역</a></li>
                <li><a class="menuLink" href="expenditureInput.php?userid=<?php echo $userid;?>">지출내역 작성</a></li>
            </ul>
        </nav>

        <article>
        <form name="frm" method = "post">
            날짜 <input type = "date" name = "date" value = "dateValue"/><br>
            시간 <input type = "time" name = "time" value = "timeValue"/><br>

            분류 <select name = "category" size = "1">
                <option value = "1" selected> 식비 </option>
                <option value = "2"> 생활용품 </option>
                <option value = "3"> 교통비 </option>
                <option value = "4"> 의류 </option>
                <option value = "5"> 저축 </option>
            </select><br>

            금액 <input type = "text" name = "price" placeholder = "금액을 입력해주세요."/><br>
            내용 <input type = "text" name = "content" placeholder = "내용을 입력해주세요."/><br>
            현금과 카드 중 어떤 것을 사용하셨나요?<br>
            <input type = "radio" name = "method" value = "현금"/> 현금 <br>
            <input type = "radio" name = "method" value = "카드"/> 카드 <br>
            <input type = hidden name = "userid" value = "<?php echo $userid;?>" />
            <input type = "submit" value = "수정" onclick='btn_click("update");'/>
            <input type = "submit" value = "삭제" onclick='btn_click("delete");'/>
        </form>
        </article>
    </body>
</html>

<script language=javascript>
    function btn_click(str){                             
        if(str=="update"){ 
            frm.action = "update.php?userid=<?php echo $userid;?>&id=<?php echo $expense_id;?>";
        } else if(str=="delete"){  
            frm.action ="delete.php?userid=<?php echo $userid;?>&id=<?php echo $expense_id;?>";
        } 
       frm.submit();
    }
</script>
