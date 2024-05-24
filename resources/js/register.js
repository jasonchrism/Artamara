const role = document.getElementById("role");
const artistForm = document.getElementById("artist");

role.addEventListener("change", function() {
    console.log(this.value);
    if(this.value === "ARTIST"){
        artistForm.style.display = "block"
    }else{
        artistForm.style.display = "none"
    }
})