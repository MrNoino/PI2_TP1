function toggleShowPassword(inputID, imageID){
    
    if(document.getElementById(inputID).type == "password"){

        document.getElementById(imageID).src = "./resources/assets/eye-close.svg";
        document.getElementById(inputID).type = "text";

    }else{

        document.getElementById(imageID).src = "./resources/assets/eye.svg";
        document.getElementById(inputID).type = "password";

    }

}

console.log("importado");