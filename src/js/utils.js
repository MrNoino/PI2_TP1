document.getElementById("toggle_show_password").addEventListener("click", function(){

    if(document.getElementById("input_password").type == "password"){

        document.getElementById("toggle_show_password_img").src = "./src/assets/eye-close.svg";
        document.getElementById("input_password").type = "text";

    }else{

        document.getElementById("toggle_show_password_img").src = "./src/assets/eye.svg";
        document.getElementById("input_password").type = "password";

    }

});