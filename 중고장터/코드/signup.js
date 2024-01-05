const signupck = async () => { 
  const id = document.querySelector(".idInput").value;
  const password = document.querySelector(".pwInput").value;
  const password2 = document.querySelector(".pwInput2").value;
  const name = document.querySelector(".nameInput").value;
  const nickname = document.querySelector(".nicknameInput").value;
  const tel = document.querySelector(".phInput").value;
  const address = document.querySelector(".addressInput").value;

    if(!id){
        alert("아이디를 입력하세요.");
        return false;
    }
    if(!password){
        alert("비밀번호를 입력하세요.");
        return false;
    }
    if(password2 !== password){
        alert("비밀번호가 동일하지 않습니다.");
        return false;
    }
    if(!name){
        alert("이름을 입력하세요.");
        return false;
    }
    if(!nickname){
        alert("별명을 입력하세요.");
        return false;
    }
    const regphone =/^((01[1|6|7|8|9])[1-9]+[0-9]{6,7})|(010[1-9][0-9]{7})$/;
    if(regphone.test(tel)==false){
        alert("휴대폰 번호 형식이 올바르지 않습니다.")
        return false;
    }
    if(!address){
        alert("주소를 입력하세요.");
        return false;
    }
  console.log(id);
  console.log(password);
  console.log(name);
  console.log(nickname);
  console.log(tel);
  console.log(address);
   try {
    // true: 회원가입 성공
    // false: 회원가입 실패
    const response = await axios.post("./signup.php", {
      idInput: id,
      pwInput: password,
      nameInput: name,
      nicknameInput: nickname,
      phInput: tel,
      addressInput: address
    });
    console.log(response.data);
    if (response.data) {
      // 회원가입 성공 시
      alert("회원가입 성공"); 
      location.href = "login.html";
    } else {
      // 회원가입 실패 시
      alert("회원가입 실패\n아이디가 중복되었습니다."); // 경고창
      idInput=null;
    
      document.getElementById("idInput").focus();
      return false;
    }
  } catch (error) {
    console.log(error);
  }
};
