<div>
    <div class='container'>
        <div class='row'>
            <div class='col-md-6 col-12'>
                <div class="input-group mb-3 ">
                    <label class="col-md-12 form-label">{{ $translations['your_link'] }} : </label>
                    <input type="text" class="form-control text-dark" placeholder="your Link"  value='{{$store_url}}' id='input_link'>
                    <div class="input-group-append">
                        <span class="input-group-text bg-dark text-white" style='cursor:pointer'  id="copy_link">{{ $translations['copy_link'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(document).ready(function() {
            $('#copy_link').click(function(){
                // Select the input field
                var input = $('#input_link');
                // Copy the text inside the input field to the clipboard
                navigator.clipboard.writeText(input.val()).then(function() {
                    swalTimer('success',"{{ $translations['link_copied'] }}")
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                });
            });
        });
    </script>
@endsection
