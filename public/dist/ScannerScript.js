var code = '';
var typingTimer;
var doneTypingInterval = 100;
document.body.addEventListener("keydown", function(event) {

    getkey(event);

});

function getkey(event) {
    
    if (/^\d+$/.test(event.key.toString())) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
        code = code + event.key.toString();
    }
}

function sendcode() {

    Livewire.emit('approvePackage', code);

}

function doneTyping() {
 
    if(code.length==13 || code.length==12){ 
        Livewire.emit('approvePackage', code);
    }
    code = ''
}
