// Navigation menu
var coll = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        
        if(content.style.display === "inline") {
            content.classList.remove("dropdown-open");
            content.classList.add("dropdown-close");
            content.style.display = "inline-block";
        }else{
            content.classList.add("dropdown-open");
            content.classList.remove("dropdown-close");
            content.style.display = "inline";
        }
    });
}

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