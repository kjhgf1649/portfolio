const html = window.location.href;
const array = html.split('=');
const log= array[1];
console.log(log);
let id;
let category;
let title;
let writedDate;

// const btn = async () =>{
//     const str = "";
//     const checkBtn = $(this);
//     const tr = checkBtn.parent().parent();
//     const td = tr.children();
//     const id = td.eq(0).text(); 
//     try {
//         const response = await axios.post("./forum.php", {contentid:id
//         }); // 추후 수정
//         if (response.data) {
//           //
//           console.log(response.data);
//         }
//     } catch (error) {
//         console.log(error);
//     }
// };
const contentListGet = async () => {
    let content;
    let content_header;

    //로그인 확인 시 버튼 이름 바꾸는 것
    if(log){
        console.log(log);
        document.getElementById('log').style.display = "none";
        document.getElementById('logout').style.display = "block";
    }
    else{
        document.getElementById('logout').style.display = "none";
        document.getElementById('log').style.display = "block";
    }

    //get 메서드로 게시글 조회 api 결과값 받아서 responce에 저장
    try{
        const responce = await axios.get("./content_inquire.php");
        if(responce.data){
            for(i = 0; i<responce.data.length;i++){

                //각 데이터들 변수에 저장해줌
                id = responce.data[i].content_id;
                category = responce.data[i].category;
                title = responce.data[i].content_title;
                writedDate = responce.data[i].writed_date;

                //content 문자열에 a태그에 넣을 html 테이블 코드 생성.
                content +=`<tr onclick = \"go_content(${id})\" ><td>`+id+"</td><td>"+category+"</td><td >"+title+"</td><td>"+writedDate+"</td><button>글쓰기</button></tr>"; 
            }
            //index.html 문서의 a태그에 테이블 생성 html코드 넣기
            content_header = "<tr ><th id='listno'>번호</th><th id='listcategory'>카테고리</th><th id='listtitle'>제목</th><th id='listwriter'>작성 일자</th></tr>"  
            document.querySelector("#contentList").innerHTML = "<table class = 'list-table'>"+ content_header + content + "</table>";
        }
    }catch(error){
        console.log(error);
    }
}


const search = async () =>{
    console.log("검색");
    title=document.querySelector(".input").value;
    console.log(title);
    let content;
    let content_header;
    try {
        const response = await axios.get("./forum_search.php?title="+title); // 추후 수정
        if (response.data) {
            for(i = 0; i<response.data.length;i++){
                //각 데이터들 변수에 저장해줌
                id = response.data[i].content_id;
                category = response.data[i].category;
                title = response.data[i].content_title;
                writedDate = response.data[i].writed_date;
                //content 문자열에 a태그에 넣을 html 테이블 코드 생성.
                content +=`<tr onclick = \"go_content(${id})\" ><td>`+id+"</td><td>"+category+"</td><td >"+title+"</td><td>"+writedDate+"</td></tr>"; 
            }
            //index.html 문서의 a태그에 테이블 생성 html코드 넣기
            content_header = "<tr ><th id='listno'>번호</th><th id='listcategory'>카테고리</th><th id='listtitle'>제목</th><th id='listwriter'>작성 일자</th></tr>"  
            document.querySelector("#contentList").innerHTML = "<table class = 'list-table'>"+ content_header + content + "</table><button>글쓰기</button>";
        }
    } catch (error) {
        console.log(error);
    }
};
const search_category = async (search_category) =>{
    console.log("카테고리");
    let content;
    let content_header;
    try{
        const responce = await axios.get("./forum_search_category.php?category="+search_category);
        //const response = await axios.get("./forum_search_category.php?category="+category); // 추후 수정
        
        if(responce.data){
            for(i = 0; i<responce.data.length;i++){
                console.log(responce.data[i]);
                let output = [];
                //각 데이터들 변수에 저장해줌
                output.push(responce.data[i]["content_id"]);
                output.push(responce.data[i]["category"]);
                output.push(responce.data[i]["content_title"]);
                output.push(responce.data[i]["writed_date"]);
                // id = responce.data[i].content_id;
                // category = responce.data[i].category;
                // title = responce.data[i].content_title;
                // writedDate = responce.data[i].writed_date;
                
                console.log(output);
                //content 문자열에 a태그에 넣을 html 테이블 코드 생성.
                content +=`<tr onclick = \"go_content(${output[0]})\" ><td>`+output[0]+"</td><td>"+output[1]+"</td><td >"+output[2]+"</td><td>"+output[3]+"</td></tr>"; 
            }
            //index.html 문서의 a태그에 테이블 생성 html코드 넣기
            content_header = "<tr ><th id='listno'>번호</th><th id='listcategory'>카테고리</th><th id='listtitle'>제목</th><th id='listwriter'>작성 일자</th></tr>"  
            document.querySelector("#contentList").innerHTML = "<table class = 'list-table'>"+ content_header + content + "</table>";
        }
    }catch(error){
        console.log(error);
    }
};

const go_content = async (i)=> {
    const id = i;
    try {
        location.href = "forum.html?id="+id; 
    } catch (error) {
        console.log(error);
    }
}
