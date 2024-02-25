const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault(); //Preventing form from submitting
}

continueBtn.onclick = ()=>{
    // Strating of the Ajax part
    let xhr = new XMLHttpRequest(); //Creating XML object
    xhr.open("POST", "php/login.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data = "success"){
                    // if(data == "success") This is not working here only work  if(data = "success")

                    // console.log("Hello");
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    // console.log("error");
                }
            }
        }
    }    
    //we have to send the form data through ajax to php
    let formData = new FormData(form); //Creating new formData object
    xhr.send(formData); //Sending the form data to php
}