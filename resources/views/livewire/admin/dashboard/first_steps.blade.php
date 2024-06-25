<div>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bd-wizard.css')}}">
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

                <ul class="list-group">
                  <li class="list-group-item"> <input class="form-check-input me-1 fw-semibold" type="checkbox" disabled {{$step1['store_logo']}} > Store Logo.
                    <li class="list-group-item"> <input class="form-check-input me-1 fw-semibold" type="checkbox" disabled {{$step1['store_info']}}> Store Information. </li>
                    <li class="list-group-item"> <input class="form-check-input me-1 fw-semibold" type="checkbox" disabled {{$step1['store_contact']}}> Contact Info. </li>
                    <li class="list-group-item"> <input class="form-check-input me-1 fw-semibold" type="checkbox" disabled {{$step1['store_location']}}> Store Location.

                    </li>
                </ul>
                <div class="purpose-radios-wrapper">
                    <a href="/admin/store_info">
                        <button class='btn btn-primary btn-md' @if($this->finish_step1 == false) disabled @endif >
                            Start Step 1
                        </button>
                    </a>
                </div>
            </section>
            <h3>Step 2 Title</h3>
            <section>
                <h5 class="bd-wizard-step-title">Step 2</h5>
                <h2 class="section-heading">Enter your Account Details</h2>
                <div class="form-group">
                    <label for="firstName" class="sr-only">First Name</label>
                    <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="lastName" class="sr-only">Last Name</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="phoneNumber" class="sr-only">Phone Number</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control"
                        placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label for="emailAddress" class="sr-only">Email Address</label>
                    <input type="email" name="emailAddress" id="emailAddress" class="form-control"
                        placeholder="Email Address">
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
            if(@json($finish_step1 == false)){
              $(this).css('background-color', '#38cb89');
            }
          }
      });
    })
</script>
@endsection