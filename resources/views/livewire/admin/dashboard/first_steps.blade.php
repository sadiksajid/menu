<div>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bd-wizard.css')}}">
    <style>
        .list-group-item{
            border-left:0px!important;
            border-right:0px!important;
        }
    </style>
    <div class="container">
        <div id="wizard">
            <h3>Step 1 : </h3>
            <section>
                <!-- <h5 class="bd-wizard-step-title">Step 1</h5> -->
                <h2 class="section-heading mt-2">Complete your Business Information</h2>
                <p>Go to business info page and complete the form to complete all your business information and setup
                    your Menu.</p>
                <p>The business name and logo and the location are the most important information you must provide to
                    verify your account! </p>

                <ul class="list-group ">
                    <li class="list-group-item pl-3 "> <input class="form-check-input me-1 fw-semibold" type="checkbox"
                            disabled {{$step1['store_logo']}}> Store Logo.</li>
                    <li class="list-group-item pl-3"> <input class="form-check-input me-1 fw-semibold" type="checkbox"
                            disabled {{$step1['store_info']}}> Store Information. </li>
                    <li class="list-group-item pl-3"> <input class="form-check-input me-1 fw-semibold" type="checkbox"
                            disabled {{$step1['store_contact']}}> Contact Info. </li>
                    <li class="list-group-item pl-3"> <input class="form-check-input me-1 fw-semibold" type="checkbox"
                            disabled {{$step1['store_location']}}> Store Location.</li>

                </ul>
                <div class="purpose-radios-wrapper">
                    <a href="/admin/store_info">
                        <button class='btn btn-primary btn-md' @if($this->finish_step1 == false) disabled @endif >
                            Start Step 1
                        </button>
                    </a>
                </div>
            </section>
            <h3>Step 2 :</h3>
            <section>
                <h2 class="section-heading mt-2">Fill your menu</h2>
                <p>Go to Products page and fill you menu by you products or you can use the products from our library .
                </p>

                <ul class="list-group ">
                    <li class="list-group-item pl-3"> <input class="form-check-input me-1 fw-semibold" type="checkbox"
                            disabled {{$step2['menu_has_products']}}> Menu Has Products. </li>

                </ul>
                <div class="purpose-radios-wrapper">
                    <a href="/admin/products">
                        <button class='btn btn-primary btn-md' @if($this->finish_step2 == false) disabled @endif >
                            Start Step 2
                        </button>
                    </a>
                </div>
            </section>
            <h3>Step 3 Title</h3>
            <section>
                <h5 class="bd-wizard-step-title">Step 3</h5>
                <h2 class="section-heading mb-5">Review your Details and Submit</h2>
                <h6 class="font-weight-bold">Select business type</h6>
                <p class="mb-4" id="business-type">Branding</p>
                <h6 class="font-weight-bold">Enter your Account Details</h6>
                <p class="mb-4"><span id="enteredFirstName">Cha</span> <span id="enteredLastName">Ji-Hun C</span> <br>
                    Phone: <span id="enteredPhoneNumber">+230-582-6609</span> <br>
                    Email: <span id="enteredEmailAddress">willms_abby@gmail.com</span></p>

            </section>
        </div>
    </div>
</div>
@section('js')
<script src="{{ URL::asset('assets/js/jquery.steps.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bd-wizard.js')}}"></script>

<script>
$(document).ready(function() {
    $('.number').each(function() {
        if ($(this).text().trim() === '1') {
            if (@json($finish_step1 == false)) {
                $(this).css('background-color', '#38cb89');
            }
        }else if ($(this).text().trim() === '2') {
            if (@json($finish_step2 == false)) {
                $(this).css('background-color', '#38cb89');
            }
        }
    });
})
</script>
@endsection