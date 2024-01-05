const html = window.location.href;
const reciveData = html.split('=');
const id = (reciveData[1]);

let category;
let title;
let text;
let writedDate;
let imagepath;

const contentInsertIntoElement = async ()=>{
    const responce = await axios.get("./forum.php?contentid="+id);
    if(responce.data){
        document.getElementById("title").value = responce.data.content_title;
        document.getElementById("category_selectBox").value = responce.data.category;
        document.getElementById("imageFile").innerHTML = responce.data.imagename;
        document.getElementById("content_write").innerHTML = responce.data.content_text;
        document.getElementById("idresive").value = responce.data.content_id;
        //document.contentWriteForm.action="edit_content.php?id="+content_id;
        console.log(responce.data.content_id);
    }
    else{
        console.log(error);
    }
    
}