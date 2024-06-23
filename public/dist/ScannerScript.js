var code = '';
var typingTimer;
var doneTypingInterval = 100;
// document.body.addEventListener("keydown", function(event) {

//     if (event.key === 'Enter') {
//         event.preventDefault(); // Prevent the default action
//     }

//     getkey(event);

// });

function getkey(event,is_livewire=true) {
    
    if (/^\d+$/.test(event.key.toString())) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping(is_livewire), doneTypingInterval);
        code = code + event.key.toString();
    }
}

function sendcode() {

    Livewire.emit('approvePackage', code);

}

function doneTyping(is_livewire) {
    if(code.length >= 3 && code.length <=13 ){ 
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
                    is_livewire:is_livewire
                },
                success: function(response) {
                if(response.data == -1){
                    Swal.fire({
                        title: "Incorrect Password!",
                        text: "Please Try Again",
                        icon: "error"
                        });
                }else{

                        if(is_livewire == true){
                            data = {
                                val: $('#functionId').val(),
                                id: response.data,
                                name: response.name
                            }
                            console.log(data)
                            Livewire.emit( $('#functionName').val(),data);
                        }else{
                            console.log(response.redirect)
                            window.location.replace(response.redirect);
                        }
                   

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
