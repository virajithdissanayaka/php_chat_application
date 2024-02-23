const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input");

form.onsubmit = (e)=>{
    e.preventDefault(); //Preventing form from submitting
}

continueBtn.onclick = ()=>{
    // Strating of the Ajax part
    let xhr = new XMLHttpRequest(); //Creating XML object
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
            }
        }
    }    
    //we have to send the form data through ajax to php
    let formData = new FormData(form); //Creating new formData object
    xhr.send(formData); //Sending the form data to php
}