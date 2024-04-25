<div>
    <div id="preloader" wire:ignore>
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->

    <header class="header clearfix element_to_stick">
        <div class="container-fluid">
            <div id="logo">
                <a href="index.html">
                    <img src="{{ URL::asset('index1/img/logo.svg') }}" width="140" height="35" alt=""
                        class="logo_normal rounded-circle">
                    <img src="{{ URL::asset('index1/img/logo_sticky.svg') }}" width="140" height="35"
                        alt="" class="logo_sticky">
                </a>
            </div>
            <ul id="top_menu">
                <li><a href="#0" class="search-overlay-menu-btn"></a></li>
                <li>
                    <div class="dropdown dropdown-cart">
                        <a href="shop-cart.html" class="cart_bt"><strong>2</strong></a>
                        <div class="dropdown-menu">
                            <ul>
                                <li>
                                    <figure><img src="{{ URL::asset('index1/img/item_placeholder_square_small.jpg') }}"
                                            data-src="{{ URL::asset('index1/img/item_square_small_1.jpg') }}"
                                            alt="" width="50" height="50" class="lazy"></figure>
                                    <strong><span>1x Pizza Napoli</span>$12.00</strong>
                                    <a href="#0" class="action"><i class="icon_trash_alt"></i></a>
                                </li>
                                <li>
                                    <figure><img src="{{ URL::asset('index1/img/item_placeholder_square_small.jpg') }}"
                                            data-src="{{ URL::asset('index1/img/item_square_small_2.jpg') }}"
                                            alt="" width="50" height="50" class="lazy"></figure>
                                    <strong><span>1x Hamburgher Maxi</span>$10.00</strong>
                                    <a href="#0" class="action"><i class="icon_trash_alt"></i></a>
                                </li>
                                <li>
                                    <figure><img src="{{ URL::asset('index1/img/item_placeholder_square_small.jpg') }}"
                                            data-src="{{ URL::asset('index1/img/item_square_small_3.jpg') }}"
                                            alt="" width="50" height="50" class="lazy"></figure>
                                    <strong><span>1x Red Wine Bottle</span>$20.00</strong>
                                    <a href="#0" class="action"><i class="icon_trash_alt"></i></a>
                                </li>
                            </ul>
                            <div class="total_drop">
                                <div class="clearfix add_bottom_15"><strong>Total</strong><span>$32.00</span></div>
                                <a href="shop-cart.html" class="btn_1 outline">View Cart</a><a href="shop-checkout.html"
                                    class="btn_1">Checkout</a>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown-cart-->
                </li>
            </ul>
            <!-- /top_menu -->
            <a href="#0" class="open_close">
                <i class="icon_menu"></i><span>Menu</span>
            </a>
            <nav class="main-menu">
                <div id="header_menu">
                    <a href="#0" class="open_close">
                        <i class="icon_close"></i><span>Menu</span>
                    </a>
                    <a href="index.html"><img src="{{ URL::asset('index1/img/logo.svg') }}" width="140"
                            height="35" alt=""></a>
                </div>
                <ul>
                    <li class="submenu">
                        <a href="#0" class="show-submenu">Home</a>
                        <ul>
                            <li><a href="index-7.html">KenBurns Slider <span class="badge text-bg-danger">New</span></a>
                            </li>
                            <li><a href="index.html">Slider 1</a></li>
                            <li><a href="index-2.html">Slider 2</a></li>
                            <li><a href="index-6.html">Slider 3</a></li>
                            <li><a href="index-3.html">Video Background</a></li>
                            <li><a href="index-5.html">Text Rotator</a></li>
                            <li><a href="index-4.html">GDPR Cookie Bar EU Law</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#0" class="show-submenu">Menu</a>
                        <ul>
                            <li><a href="menu-1.html">Menu 2 Column</a></li>
                            <li><a href="menu-2.html">Menu Add To Cart</a></li>
                            <li><a href="menu-3.html">Menu With Tabs</a></li>
                            <li><a href="menu-4.html">Menu Grid</a></li>
                            <li><a href="menu-of-the-day.html">Menu of the Day <span
                                        class="badge badge-danger">HOT</span></a></li>
                            <li><a href="order-food.html">Order Food</a></li>
                            <li><a href="confirm.html">Confirm</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#0" class="show-submenu">Other Pages</a>
                        <ul>
                            <li><a href="about.html">About</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="gallery-2.html">Gallery Masonry</a></li>
                            <li><a href="modal-advertise.html">Modal Advertise</a></li>
                            <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                            <li><a href="404.html">404 Error page</a></li>
                            <li><a href="coming-soon.html" target="_blank">Coming Soon</a></li>
                            <li><a href="leave-review.html">Leave a review</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
                            <li><a href="icon-pack-2.html">Icon Pack 2</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#0" class="show-submenu">Shop</a>
                        <ul>
                            <li><a href="shop-1.html">Shop Grid</a></li>
                            <li><a href="shop-2.html">Shop Rows</a></li>
                            <li><a href="shop-single.html">Product Single</a></li>
                            <li><a href="shop-cart.html">Cart Page</a></li>
                            <li><a href="shop-checkout.html">Checkout</a></li>
                        </ul>
                    </li>
                    <li><a href="#0">Buy this template</a></li>
                    <li><a href="reservations.html" class="btn_top">Reservations</a></li>
                </ul>
            </nav>
        </div>
        <!-- Search -->
        <div class="search-overlay-menu">
            <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
            <form role="search" id="searchform" method="get">
                <input value="" name="q" type="search" placeholder="Search..." />
                <button type="submit"><i class="icon_search"></i></button>
            </form>
        </div><!-- End Search -->
    </header>
    <!-- /header -->
    <main>

        <div class="hero_single inner_pages background-image edit-image"
        @if (isset($images['img_1']))   data-background="url({{ get_image($images['img_1'])}})" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >
        <button class="edit-button-image"  data-cue="slideInUp"  data-id='img_1' style='top: 50%;font-size: 180%;'><i class="fa fa-upload"></i></button>

            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1 class='edit-title' data-id='title-1' > {{ $titles['en']['title-1'] ?? 'Menu thumbs' }}  </h1>
                            <p class='edit-title' data-id='title-2' >{{ $titles['en']['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->
        
        <div class="pattern_2">
            <div class="container margin_60_40" data-cues="slideInUp">
                
              @foreach ( $products as $product)
                <div class="main_title center">
                    <span><em></em></span>
                    <h2>{{ $product[0]['category']['title']}}</h2>
                    <p>{{ $product[0]['category']['s_title']}}</p>
                </div>
                <div class="row add_bottom_45 magnific-gallery">

                    @foreach ( $product as $prod)
                        <div class="col-lg-6" data-cue="slideInUp">
                            <div class="menu_item">
                                <figure>
                                    <a href="{{ get_image($prod['media'][0]['media']) }}" title="Summer Berry"
                                        data-effect="mfp-zoom-in">
                                        
                                        <img src="{{ URL::asset('index1/img/menu_items/menu_items_placeholder.png') }}"
                                            data-src="{{get_image( $prod['media'][0]['media']) }}" class="lazy"
                                            alt="">
                                    </a>
                                </figure>
                                <div class="menu_title">
                                    <h3>{{$prod['title']}}</h3><em>{{ $prod['price']}} {{ $currency }}</em>
                                </div>
                                <p>{{ substr($prod['description'], 0, 40) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
              @endforeach
                
                {{-- <div class="banner lazy" data-bg="url(img/banner_bg.jpg)">
                    <div class="wrapper d-flex align-items-center justify-content-between opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div>
                            <small>Special Offer</small>
                            <h3>Burgher Menu $18 only</h3>
                            <p>Hamburgher, Chips, Mix Sausages, Beer, Muffin</p>
                            <a href="reservations.html" class="btn_1">Reserve now</a>
                        </div>
                        <figure class="d-none d-lg-block"><img src="img/banner.svg" alt="" width="200" height="200" class="img-fluid"></figure>
                    </div>
                    <!-- /wrapper -->
                </div>
                <!-- /banner --> --}}

               
                <!-- /row -->
                <p class="text-center"><a href="#0" class="btn_1 outline">Download Menu</a></p>
            </div>
            <!-- /container -->
        </div>
        <!-- /pattern_2 -->
    </main>

    <footer>
        <div class="frame black"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp">
                        <i class="icon_pin_alt"></i>
                        <h3>Address</h3>
                        <p>{{$this->store_info->address}}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp">
                        <i class="icon_tag_alt"></i>
                        <h3>Reservations</h3>
                        <p><a href="tel:{{$this->store_info->phone}}">{{$this->store_info->phone}}</a><br><a
                                href="#0">{{$this->store_info->email}}</a></p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp">
                        <i class="icon_clock_alt"></i>
                        <h3>Opening Hours</h3>
                        <ul>
                            <li>Mon - Sat: 10am - 11pm</li>
                            <li>Sunday: Closed</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <h3>Keep in touch</h3>
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="phpmailer/newsletter_template_email.php" name="newsletter_form"
                            id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter"
                                    class="form-control" placeholder="Your email">
                                <button type="submit" id="submit-newsletter"><i
                                        class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row">
                <div class="col-sm-5">
                    <p class="copy">© Sadik Sajid  - All rights reserved</p>
                </div>
                <div class="col-sm-7">
                    <div class="follow_us">
                        <ul>
                            @if(!empty($this->store_info->twitter))
                                <li><a href="{{$this->store_info->twitter}}"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="{{ URL::asset('index1/img/twitter_icon.svg') }}" alt=""
                                            class="lazy"></a></li>
                            @endif
                            @if(!empty($this->store_info->facebook))

                            <li><a href="{{$this->store_info->facebook}}"><img
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        data-src="{{ URL::asset('index1/img/facebook_icon.svg') }}" alt=""
                                        class="lazy"></a></li>
                            @endif
                            @if(!empty($this->store_info->instagram))
                            <li><a href="{{$this->store_info->instagram}}"><img
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        data-src="{{ URL::asset('index1/img/instagram_icon.svg') }}" alt=""
                                        class="lazy"></a></li>
                            @endif
                            @if(!empty($this->store_info->youtube))

                            <li><a href="{{$this->store_info->youtube}}"><img
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        data-src="{{ URL::asset('index1/img/youtube_icon.svg') }}" alt=""
                                        class="lazy"></a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <p class="text-center"></p>
        </div>
    </footer>
    <!--/footer-->

    <div id="toTop"></div><!-- Back to top button -->

    


    <!-- Modal -->
    <div class="modal fade" id="editimgModal" tabindex="-1" role="dialog" aria-labelledby="editimgModalTitle"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="col-md-12 form-label">Category Image</label>

                        <div class="dropify-wrapper" style="height:auto;border: none;">

                            <img id='output' src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                style="height: 50%;width:50%">

                            <div class="dropify-loader">
                            </div>
                            <input type="file" id='upload_img' class="dropify" wire:model="upload_image"
                                data-height="210">
                        </div>
                        @error('upload_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id='saveImg' class="btn btn-primary" wire:click='editImg()'>Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>


</div>





<!-- COMMON SCRIPTS -->

<link href="{{ URL::asset('index1/css/wizard.css') }}" rel="stylesheet">

<script src="{{ URL::asset('index1/js/common_scripts.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/common_func.js') }}"></script>
<script src="{{ URL::asset('index1/phpmailer/validate.js') }}"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="{{ URL::asset('index1/js/modernizr.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/video_header.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
<script src="{{ URL::asset('assets/js/filupload.js') }}"></script>
@livewireScripts


<script>
    $('#upload_img').on('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>


<script>
    // Video Header
    $(document).ready(function() {


        $('.btn_play').unbind('click').click(null);


        $(document).on('click','.edit-button-tile', async function(event) {
            // var text_click = $(event.target).text();
            var text_click = $(this).parent(".edit-title").text().trim();

            var id = $(this).data("id")
            const {
                value: text
            } = await Swal.fire({
                input: "text",
                inputLabel: "Edit Title",
                inputValue: text_click,
                inputAttributes: {
                    "aria-label": "Type your message here"
                },
                showCancelButton: true
            });
            if (text) {
                Livewire.emit('editText', 'title', id, text);
                $(this).parent(".edit-title").text(text)
          
            }
        });


        $(document).on('click','.edit-button-text', async function(event) {
            // var text_click = $(event.target).text();
            var text_click = $(this).parent(".edit-text").find('p').html();

            var val = text_click.replace(/<br>/g, '\n');

            var id = $(this).data("id")
            const {
                value: text
            } = await Swal.fire({
                input: "textarea",
                inputLabel: "Edit text",
                inputValue:  val ,
                inputAttributes: {
                    "aria-label": "Type your message here"
                },
                showCancelButton: true
            });
            if (text) {
                val = text.replace(/\n/g, ' <br> ')
                Livewire.emit('editText', 'text', id, val);
                $(this).parent(".edit-text").find('p').html(val);
          
            }
        });


        $(document).on('click','.edit-button-url', async function(event) {
            // var text_click = $(event.target).text();
            var url = $(this).parent(".edit-url").attr('href')
            url = url.replace('#', '');

            var id = $(this).data("id")
            const {
                value: text
            } = await Swal.fire({
                input: "text",
                inputLabel: "Edit text",
                inputValue:  url ,
                inputAttributes: {
                    "aria-label": "Type your message here"
                },
                showCancelButton: true
            });
            if (text) {
                Livewire.emit('editText', 'url', id, text);
                $(this).attr("wire:click", '#'+text);
          
            }
        });




        $('.edit-btn').on('click', async function(event) {
            var text_click = $(event.target).text();
            var url = $(this).attr('href');
            url = url.replace('#', '');
            var id = $(this).data("id")

            const {
                value: formValues
            } = await Swal.fire({
                title: "Edit Button",
                html: `
                <input id="swal-input1" class="swal2-input" value='${text_click}'>
                <input id="swal-input2" class="swal2-input" value='${url}'>
            `,
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById("swal-input1").value,
                        document.getElementById("swal-input2").value
                    ];
                }
            });
            if (formValues) {
                Livewire.emit('editBtn', id, formValues);
                $(event.target).text(formValues[0]);

            }
        });

        $('.edit-button-image').on('click', function() {
            console.log('sdfsdf')
            var id = $(this).data("id")
            $("#saveImg").attr("wire:click", "editImg('" + id + "')");

            $('#editimgModal').modal('show');


        });

        window.addEventListener('closeModal', event => {
            $('#editimgModal').modal('hide');
        });


        window.addEventListener('refreshJs', event => {
            changeUrl()

        });

        ////////////////////////////////

        const editIconClass = 'fa fa-edit';
        const editIconClassurl = 'fa fa-link';
        var editButton 

        // Create an icon element and append it to the button
        let editIconurl = $('<i>').addClass(editIconClassurl);

        let editIcon = $('<i>').addClass(editIconClass);
        let clonedButton
        // Function to handle button creation and positioning
        function addEditButtonToDiv(div,type='title') {

            editButton = $('<button>');

            // Define styles for the button (you can add them separately in CSS)
            editButton.css({
                position: 'absolute',
                padding: '7px',
                background: 'transparent', // Remove background if using icon
                border: 'none',
                'background-color': '#0090ff',
                'font-size': 'min(1vw, 60%)',
                cursor: 'pointer',
                display: 'none',
                right: '0px',
                top:' 0px',
                color:'white',
            });


            if(type == 'url'){
                editButton.append(editIconurl);
            }else{
                editButton.append(editIcon);
            }
            clonedButton = editButton.clone();

            if(type == 'title'){
                clonedButton.addClass('edit-button-tile edit-button')
            }else if(type == 'text'){
                clonedButton.addClass('edit-button-text edit-button')
            }else if(type == 'url'){
                clonedButton.addClass('edit-button-url url-btn edit-button')
            }else{
                clonedButton.addClass('edit-button')
            }
            
            clonedButton.attr("data-id", div.data("id"));
            div.append(clonedButton);

        }

        // Select all divs on the page
        let divs = $('.edit-title');

        // Loop through all divs and add the edit button functionality
        divs.each(function() {
            $(this).css("position", "relative");
            addEditButtonToDiv($(this));
        });

        // Select all divs on the page
        let divs_text = $('.edit-text');

        // Loop through all divs and add the edit button functionality
        divs_text.each(function() {
            $(this).css("position", "relative");
            addEditButtonToDiv($(this),'text');
        });

        let divs_btn = $('.edit-btn');

        // Loop through all divs and add the edit button functionality
        divs_btn.each(function() {
            $(this).css("position", "relative");
            addEditButtonToDiv($(this),'btn');
        });

        let divs_url = $('.edit-url');

        // Loop through all divs and add the edit button functionality
        divs_url.each(function() {
            // $(this).css("position", "relative");
            addEditButtonToDiv($(this),'url');
        });


        function changeUrl() {
            $('a').each(function() {
            var currentHref = $(this).attr('href');
            if (currentHref && currentHref.indexOf('#') !== 0) {
                $(this).attr('href', '#' + currentHref);
            }
         });
        }

        changeUrl()

    });
</script>

<!-- SPECIFIC SCRIPTS (wizard form) -->
<script src="{{ URL::asset('index1/js/wizard/wizard_scripts.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/wizard/wizard_func.js') }}"></script>
