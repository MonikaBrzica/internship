document.getElementById("fileName").addEventListener("change", validateFile)

function validateFile(){
    const allowedExtensions =  ['pdf','docx','doc'],
        sizeLimit = 5000000;

    const { name:file, size:fileSize } = this.files[0];

    const fileExtension = file.split(".").pop();

    if(!allowedExtensions.includes(fileExtension)){
        alert("Please upload only pdf, doc and docx files!");
        this.value = null;
    }else if(fileSize > sizeLimit){
        alert("File size too large!")
        this.value = null;
    }
}