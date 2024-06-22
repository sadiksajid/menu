var code = '';
var typingTimer;
var doneTypingInterval = 100;
// document.body.addEventListener("keydown", function(event) {

//     if (event.key === 'Enter') {
//         event.preventDefault(); // Prevent the default action
//     }

//     getkey(event);

// });

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
 
    if(code.length >= 8 && code.length <=13 ){ 
        console.log(code)
        try {

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                url: '/checkCodedAdmin',
                method: 'POST',
                data :{
                    bar_code:code,
                },
                success: function(response) {
                if(response.data == -1){
                    Swal.fire({
                        title: "Incorrect Password!",
                        text: "Please Try Again",
                        icon: "error"
                        });
                }else{

                   
                        data = {
                        val: $('#functionId').val(),
                        id: response.data,
                        name: response.name
                        }
                        console.log(data)
                        Livewire.emit( $('#functionName').val(),data);

                }
                },
                error: function(err) {
                    Swal.fire({
                        title: "Incorrect Password!",
                        text: "Please Try Again",
                        icon: "error"
                        });
                }
            });


        } catch (error) {
            Swal.fire({
                        title: "Incorrect Password!",
                        text: "Please Try Again",
                        icon: "error"
                        });
        }
    }
    code = ''
}
