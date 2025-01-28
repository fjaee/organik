let togglePassword = document.getElementById("togglePassword");
let password = document.getElementById("password");

togglePassword.onclick = function(){
    if(password.type == "password"){
        password.type = "text";
        togglePassword.src = "./images/eye-show-svgrepo-com.png";
    }else{
        password.type = "password";
        togglePassword.src = "./images/eye-hide-svgrepo-com.png";
    }
}

