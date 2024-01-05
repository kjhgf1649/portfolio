const loginck = async () => {
    // DOM 접근용
    const idInput = document.querySelector(".idInput").value;
    const pwInput = document.querySelector(".pwInput").value;
    
    if(!idInput){
      alert("아이디를 입력하세요.")
      return false;
    }
    if(!pwInput){
        alert("비밀번호를 입력하세요.")
        return false;
    }
    console.log(idInput);
    console.log(pwInput);
    try {
      const response = await axios.post("./login.php",{
          idInput: idInput,
          pwInput: pwInput
      });
      console.log(response.data);
      if(response.data){                  // 로그인 성공 시
        location.href = "index.html?id="+idInput; // 메인화면으로 이동
        
        return true;
        } else {    
        
                                  // 로그인 실패 시
        alert("로그인 실패");              //경고창(로그인 실패)
        return false;
      }
    } catch (error) {
        console.log(error);
    }
  };