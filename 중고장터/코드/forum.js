const html = window.location.href;
const array = html.split('=');
const contentid= array[1];

let category;
let title;
let text;
let writedDate;
let imagepath;

const contentGet = async () => {
    try{
        const responce = await axios.get("./forum.php?contentid="+contentid);
        //console.log(responce.data);
        if(responce.data){

            //데이터들 받아오기
            category = responce.data.category;
            title = responce.data.content_title;
            text = responce.data.content_text;
            writedDate = responce.data.writed_date;
            imagepath = responce.data.imagepath;

            //제목
            document.getElementById("contentTitle_forumPage").innerHTML = title;
            //글 작성 날짜
            document.getElementById("contentWritedDay_forumPage").innerHTML = writedDate;
            //이미지
            document.getElementById("contentImage_forumPage").src = imagepath;
            //글 제목
            document.getElementById("contentText_forumPage").innerHTML = text;
            document.getElementById("contentCategory_forumPage").innerHTML = "카테고리 : " +category;

        }
    }catch(error){
        console.log(error);
    }
}

const content_delete = async () => {
    
    if(confirm("정말로 삭제하시겠습니까?")){
        try{
            const responce = await axios.get("./delete.php?contentid="+contentid);
            //console.log(responce.data);
            if(responce.data){
                console.log(responce.data);
                location.href = "index.html";

                const file = responce.data.imagepath;
                return true;
                //document.getElementById("image").src = image;
                alert("삭제되었습니다!");
            }
            else{
                return false;
            }
        }catch(error){
            console.log(error);
        }
    }else{
        alert("취소되었습니다");
    }
    
}

const edit_content = () =>{
    try{
        window.location.href="../edit_content.html?ID=" + contentid;
    }catch(error){
        console.log(error);
    }
}
const home_return = () =>{
    location.href = "index.html";
}