function dropdownbtn(){
    // Navigation menu
    var dropdownbtn = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdownbtn.length; i++) {
        dropdownbtn[i].addEventListener("click", function() {
            var content = this.nextElementSibling;
            if(content.style.display === "inline") {
                // When closed
                content.classList.remove("dropdown-open");
                content.classList.add("dropdown-close");
                content.style.display = "inline-block";
            }else{
                // When opened
                content.classList.add("dropdown-open");
                content.classList.remove("dropdown-close");
                content.style.display = "inline";
            }
        });
    }
}
dropdownbtn();

function uploadbtn(){
    // Upload menu
    var uploadbtn = document.getElementsByClassName("upload-btn");
    var x;
    for (x = 0; x < uploadbtn.length; x++) {
        uploadbtn[x].addEventListener("click", function() {
            var content = this.nextElementSibling;
            var btn = this;
            if(content.style.display === "inline") {
                // When closed
                content.classList.remove("upload-open");
                content.classList.add("upload-close");
                content.style.display = "inline-block";
                btn.classList.remove("upload-active");
                btn.classList.add("upload-inactive");
            }else{
                // When opened
                content.classList.add("upload-open");
                content.classList.remove("upload-close");
                content.style.display = "inline";
                btn.classList.remove("upload-inactive");
                btn.classList.add("upload-active");
            }
        });
    }
}
uploadbtn();

// Password check
function validate() {
    var password = document.getElementById("password").value; // input of first field
    var confirmpassword = document.getElementById("confirmpassword").value; // input of second field
    if(password == confirmpassword && password.length >= 6 && confirmpassword.length >= 6){
        // when passwords match and have the correct amount of charachters
        document.getElementById("password").style.borderColor = "green";
        document.getElementById("password").style.backgroundColor = "rgb(220, 255, 220)";
        document.getElementById("confirmpassword").style.borderColor = "green";
        document.getElementById("confirmpassword").style.backgroundColor = "rgb(220, 255, 220)";
        document.getElementById("msg").innerHTML = "Match.";
    }else if(password !== confirmpassword){
        // when password don't match
        document.getElementById("password").style.borderColor = "red";
        document.getElementById("password").style.backgroundColor = "rgb(255, 220, 220)";
        document.getElementById("confirmpassword").style.borderColor = "red";
        document.getElementById("confirmpassword").style.backgroundColor = "rgb(255, 220, 220)";
        document.getElementById("msg").innerHTML = "Mismatch.";
    }else if(password.length < 6 && confirmpassword.length < 6){
        // when passwords match but don't have the correct amount of charachters
        document.getElementById("password").style.borderColor = "red";
        document.getElementById("password").style.backgroundColor = "rgb(255, 220, 220)";
        document.getElementById("confirmpassword").style.borderColor = "red";
        document.getElementById("confirmpassword").style.backgroundColor = "rgb(255, 220, 220)";
        document.getElementById("msg").innerHTML = "Password needs atleast 6 charachters.";
    }
}