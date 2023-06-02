const form = document.querySelector('.typing-area');
const inputField = form.querySelector('.message-field');
const chatBox = document.querySelector(".message-box");

form.addEventListener('submit', e => {
    e.preventDefault(); // prevent default form submit behavior

    const message = inputField.value;

    // make AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/insert.php');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = () => {
        if (xhr.status === 200) {
            inputField.value = ''; // clear input field
            scrollToBottom(); // scroll to bottom of chat
        }
    };
    console.log('message=' + encodeURIComponent(message));
    xhr.send('message=' + encodeURIComponent(message)); // send message data
});

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;

                data = replaceGifLinks(data);

                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("sender");
}, 50000);

function replaceGifLinks(message) {
    var gifLinkRegex = /(https?:\/\/\S+\.(?:gif))/g;
    var gifLinkMatches = message.match(gifLinkRegex);

    if (gifLinkMatches && gifLinkMatches.length > 0) {
        gifLinkMatches.forEach(function (gifLink) {
                message = message.replace( gifLink, '<img class="image-gif" src="' + gifLink + '" alt="GIF">');
                console.log(message);
        });
    }

    return message;
}


function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}