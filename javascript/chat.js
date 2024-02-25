const form = document.querySelector('.typing-area'),
inputField = form.querySelector('.input-field'),
sendBtn =  form.querySelector('button'),
chatBox = document.querySelector('.chat-box');

form.onsubmit = (e)=>{
    e.preventDefault(); //Preventing form from submitting
}

sendBtn.onclick = () => {
    // Strating of the Ajax part
    let xhr = new XMLHttpRequest(); //Creating XML object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; //once message inserted into database then leave the input field blank
                scrollToBottom();
            }
        }
    }    
    //we have to send the form data through ajax to php
    let formData = new FormData(form); //Creating new formData object
    xhr.send(formData); //Sending the form data to php
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    // Strating of the Ajax part
    let xhr = new XMLHttpRequest(); //Creating XML object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ //if active class is not in chat box then scroll to bottom
                    scrollToBottom();
                }
            }
        }
    } 

    //we have to send the form data through ajax to php
    let formData = new FormData(form); //Creating new formData object
    xhr.send(formData); //Sending the form data to php
}, 500); //this function will run frequently after 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}