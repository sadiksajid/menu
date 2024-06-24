<div>

<style>
    @media (max-width: 1340px) {
        .center_mobile {
            text-align: center;
            width: 100%;
        }
        .riverce{
            flex-direction: row!important;
        }
    }
</style>

    <div id="content">
        <div class="slider-block style-one">
            <div class="slider-main">
                <div class="container">
                    <div class="row center_mobile">
                        <div class="col-xl-6">
                            <div class="text-content">
                                <div class="heading1 scroll-bottom-to-top2">{{ $translations['title1'] ?? 'text'}}</div>
                                <div class="body2 text-placehover mt-40">{{ $translations['title2'] ?? 'text'}}</div><a
                                    class="button button-blue-hover mt-40 register_popup" href="#"> <span>
                                        <span></span></span><span
                                        class="bg-blue">{{ $translations['title3'] ?? 'text'}}<i
                                            class="ph-bold ph-arrow-up-right fs-18 flex-center"></i></span></a>
                            </div>
                        </div>
                        <div class="col-xl-6 scroll-right-to-left2">
                            <div class="bg-img"> <img src="assets_home/images/slider/user1.png" alt="" /><img
                                    src="assets_home/images/slider/frame-above.png" alt="" /><img
                                    src="assets_home/images/slider/frame-below.png" alt="" /></div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67"
                                    fill="none">
                                    <path
                                        d="M19.5202 46C23.5662 38.2807 35.6305 19.4737 51.5202 5.99999M32.0899 63.5741C37.1814 61.3503 50.7952 56.8307 64.5188 56.5417M3.00006 35.66C3.23721 30.1091 5.15276 15.8931 10.9177 3.43579"
                                        stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="165" height="121" viewbox="0 0 165 121"
                                    fill="none">
                                    <path
                                        d="M2.00006 67C26.6785 44.4479 36.5001 29.5 80.5001 5C55.5001 48.5 36.162 82.718 33.5001 104.5C51.9116 87.0666 132.511 13.8811 138.5 2C124.081 19.8767 76.4868 118.534 76.4868 118.534C76.4868 118.534 116.5 85.5 163 59.1285"
                                        stroke="#3D89FB" stroke-width="4" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="user-infor bora-24 p-16 flex-item-center gap-12"><i
                                    class="ph-fill ph-user fs-24 p-8 bora-50 bg-blue"> </i>
                                <div class="infor">
                                    <div class="heading7">SADIK SAJID</div>
                                    <div class="text-button-small text-placehover">Full Stack Developer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="how-it-work pt-50 pb-100">
            <div class="container">
                <div class="row heading flex-between row-gap-8">
                    <div class="col-lg-6">
                        <div class="heading3">{{ $translations['title4'] ?? 'text'}}
                            ,{{ $translations['title5'] ?? 'text'}} </div>
                    </div>

                </div>
                <div class="row flex-between mt-40 row-gap-40">
                    <div class="col-lg-4">
                        <div class="feature-item flex-item-center gap-24 scroll-bottom-to-top1">
                            <div class="icon"><i class="icon-box-group icon-white fs-40 p-16 bg-line-dark bora-50"></i>
                            </div>
                            <div class="infor">
                                <div class="heading6">{{ $translations['step1'] ?? 'text'}}</div>
                                <div class="text-placehover mt-8">{{ $translations['step1_text'] ?? 'text'}}</div>
                            </div>
                        </div>
                        <div class="feature-item flex-item-center gap-24 mt-40 scroll-bottom-to-top2">
                            <div class="icon"><i class="icon-chart-box icon-white fs-40 p-16 bg-line-dark bora-50"></i>
                            </div>
                            <div class="infor">
                                <div class="heading6">{{ $translations['step2'] ?? 'text'}} </div>
                                <div class="text-placehover mt-8">{{ $translations['step2_text'] ?? 'text'}}</div>
                            </div>
                        </div>
                        <div class="feature-item flex-item-center gap-24 mt-40 scroll-bottom-to-top3">
                            <div class="icon"><i class="icon-flash icon-white fs-40 p-16 bg-line-dark bora-50"></i>
                            </div>
                            <div class="infor">
                                <div class="heading6">{{ $translations['step3'] ?? 'text'}}</div>
                                <div class="text-placehover mt-8">{{ $translations['step3_text'] ?? 'text'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="bg-img bora-24 overflow-hidden"><img class="w-100"
                                src="assets_home/images/components/bg-how-it-work.png" alt="" />
                            <div
                                class="count bg-blue bora-12 flex-item-center gap-60 pt-20 pb-20 pl-32 pr-32 scroll-left-to-right4">
                                <div class="item">
                                    <div class="heading4">1.77<span>k+</span></div>
                                    <div class="text-button">{{$translations['menu']}}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-partner bg-line-dark pt-40 pb-40">
            <div class="container text-center">
                <div class="heading7 text-center">{{$translations['trusted_by']}}</div>
            </div>
            <div class="container gap-32 row-gap-32 flex-between flex-wrap mt-32">
                <div class="partner-item"><img src="assets_home/images/partners/mega.svg" alt="" /></div>
                <div class="partner-item"><img src="assets_home/images/partners/mian.svg" alt="" /></div>
                <div class="partner-item"><img src="assets_home/images/partners/beta.svg" alt="" /></div>
                <div class="partner-item"><img src="assets_home/images/partners/mian2.svg" alt="" /></div>
                <div class="partner-item"><img src="assets_home/images/partners/genvi.svg" alt="" /></div>
            </div>
        </div>
        <!-- /////////////////////////////////////////////// fauturs -->
        <div class="about-us style-one pt-100 pb-100 bg-black-surface">
            <div class="container pb-60">
                <div class="row row-gap-40 flex-between">
                    <div class="col-12 col-lg-5 flex-column row-gap-20 center_mobile">
                        <div class="heading3">{{ $translations['Feature1_title'] ?? 'text'}}</p>
                        </div>
                        <div class="body2 text-placehover mt-16">{{ $translations['Feature1_text'] ?? 'text'}}</div>
           
                        <div class="button-block mt-32"><a class="button button-blue-hover" href="about.html"><span>
                                    <span></span></span><span class="pt-16 pb-16 bg-blue">Find out more<i
                                        class="ph-bold ph-arrow-up-right fs-18 flex-center"></i></span></a></div>
                    </div>
                    <div class="col-12 col-xl-6 center_mobile">
                        <div class="bg w-100 h-100"></div>
                        <div class="bg-img"><img src="assets_home/images/components/avatar-about1-1.png" alt="" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="66" height="68" viewbox="0 0 66 68"
                                fill="none">
                                <path
                                    d="M45.5642 19.8299C37.8449 23.8759 19.0379 35.9403 5.56419 51.8299M63.1383 32.3997C60.9145 37.4912 56.3949 51.105 56.1059 64.8286M35.2242 3.30982C29.6733 3.54696 15.4573 5.46251 3 11.2275"
                                    stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <div class="bg-img"><img src="assets_home/images/components/avatar-about1-2.png" alt="" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67"
                                fill="none">
                                <path
                                    d="M19.5201 46C23.5661 38.2807 35.6305 19.4737 51.5201 5.99999M32.0899 63.5741C37.1813 61.3503 50.7952 56.8307 64.5187 56.5417M3 35.66C3.23715 30.1091 5.1527 15.8931 10.9177 3.43579"
                                    stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                            </svg>
                        </div><img src="assets_home/images/components/line-about1.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="about-us-reflex style-one pt-100 pb-100 bg-black-surface">
            <div class="container pb-60">
                <div class="row row-gap-40 flex-between riverce">

                    <div class="col-12 col-xl-6">
                        <div class="bg w-100 h-100"></div>
                        <div class="bg-img"><img src="assets_home/images/components/avatar-about1-1.png" alt="" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="66" height="68" viewbox="0 0 66 68"
                                fill="none">
                                <path
                                    d="M45.5642 19.8299C37.8449 23.8759 19.0379 35.9403 5.56419 51.8299M63.1383 32.3997C60.9145 37.4912 56.3949 51.105 56.1059 64.8286M35.2242 3.30982C29.6733 3.54696 15.4573 5.46251 3 11.2275"
                                    stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <div class="bg-img"><img src="assets_home/images/components/avatar-about1-2.png" alt="" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67"
                                fill="none">
                                <path
                                    d="M19.5201 46C23.5661 38.2807 35.6305 19.4737 51.5201 5.99999M32.0899 63.5741C37.1813 61.3503 50.7952 56.8307 64.5187 56.5417M3 35.66C3.23715 30.1091 5.1527 15.8931 10.9177 3.43579"
                                    stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                            </svg>
                        </div><img src="assets_home/images/components/line-about1.png" alt="" />
                    </div>


                    <div class="col-12 col-lg-5 flex-column row-gap-20 center_mobile">
                        <div class="heading3">{{ $translations['Feature2_title'] ?? 'text'}}</p>
                        </div>
                        <div class="body2 text-placehover mt-16">{{ $translations['Feature2_text'] ?? 'text'}}</div>

                        <div class="button-block mt-32"><a class="button button-blue-hover" href="about.html"><span>
                                    <span></span></span><span class="pt-16 pb-16 bg-blue">Find out more<i
                                        class="ph-bold ph-arrow-up-right fs-18 flex-center"></i></span></a></div>
                    </div>


                </div>
            </div>
        </div>
        <div class="about-us style-one pt-100 pb-100 bg-black-surface ">
            <div class="container pb-60">
                <div class="row row-gap-40 flex-between">
                    <div class="col-12 col-lg-5 flex-column row-gap-20 center_mobile">
                        <div class="heading3">{{ $translations['Feature3_title'] ?? 'text'}}</p>
                        </div>
                        <div class="body2 text-placehover mt-16">{{ $translations['Feature3_text'] ?? 'text'}}</div>

                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="bg w-100 h-100"></div>
                        <div class="bg-img"><img src="assets_home/images/components/avatar-about1-1.png" alt="" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="66" height="68" viewbox="0 0 66 68"
                                fill="none">
                                <path
                                    d="M45.5642 19.8299C37.8449 23.8759 19.0379 35.9403 5.56419 51.8299M63.1383 32.3997C60.9145 37.4912 56.3949 51.105 56.1059 64.8286M35.2242 3.30982C29.6733 3.54696 15.4573 5.46251 3 11.2275"
                                    stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        <div class="bg-img"><img src="assets_home/images/components/avatar-about1-2.png" alt="" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67"
                                fill="none">
                                <path
                                    d="M19.5201 46C23.5661 38.2807 35.6305 19.4737 51.5201 5.99999M32.0899 63.5741C37.1813 61.3503 50.7952 56.8307 64.5187 56.5417M3 35.66C3.23715 30.1091 5.1527 15.8931 10.9177 3.43579"
                                    stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                            </svg>
                        </div><img src="assets_home/images/components/line-about1.png" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <!-- /////////////////////////////////////////////////////// end fauturs -->





        <div class="testimonial-block style-one">
            <div class="container">
                <div class="heading3 text-center">{{$translations['people_say']}}</div>
                <div class="main-cmt bg-line-dark pl-16 pr-16 pb-60 bora-44 mt-40">
                    <div class="row flex-center">
                        <div class="col-xl-8 col-lg-9 col-md-10">
                            <div class="list-avatar">
                                <div class="prev-btn w-40 h-40 flex-center border-white bora-50"><i
                                        class="ph ph-caret-left fs-20 d-block"></i></div>
                                <div class="avatar">
                                    <div class="item" data-name="0">
                                        <div class="bg-img"><img src="assets_home/images/avatar/76x76.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="item" data-name="1">
                                        <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="item" data-name="2">
                                        <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="item" data-name="3">
                                        <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="item" data-name="4">
                                        <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="item" data-name="5">
                                        <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="next-btn w-40 h-40 flex-center border-white bora-50"><i
                                        class="ph ph-caret-right fs-20 d-block"></i></div>
                            </div>
                            <div class="list-comment">
                                <div class="cmt-item text-center active" data-name="0">
                                    <div class="heading6 fw-500">"Working with this agency has been a game-changer for
                                        our business. Their team is knowledgeable, and always goes the extra mile."
                                    </div>
                                    <div class="text-button mt-24">Maverick Nguyen</div>
                                    <div class="caption1 text-placehover mt-4">UI UX Designer, Avitex Inc</div>
                                </div>
                                <div class="cmt-item text-center" data-name="1">
                                    <div class="heading6 fw-500">"Thanks to their AI solutions, our customer experience
                                        has significantly improved. Personal recommendation fostered stronger
                                        relationships."</div>
                                    <div class="text-button mt-24">Christina Smith</div>
                                    <div class="caption1 text-placehover mt-4">Data Analyst, Microsoft</div>
                                </div>
                                <div class="cmt-item text-center" data-name="2">
                                    <div class="heading6 fw-500">"Their AI services have been a reliable partner in our
                                        business journey. They've empowered us with data-driven solutions for better
                                        results."</div>
                                    <div class="text-button mt-24">David Johnson</div>
                                    <div class="caption1 text-placehover mt-4">Mobile App Developer, Apple</div>
                                </div>
                                <div class="cmt-item text-center" data-name="3">
                                    <div class="heading6 fw-500">"The insight generated by their AI tools have been
                                        invaluable. They helped us understand our customer behavior and optimize our
                                        AI."</div>
                                    <div class="text-button mt-24">Peter Parker</div>
                                    <div class="caption1 text-placehover mt-4">Business Analyst, Oracle</div>
                                </div>
                                <div class="cmt-item text-center" data-name="4">
                                    <div class="heading6 fw-500">"Smart and Efficient! The AI integration into our
                                        workflow has been seamless. It's simplified complex task and improved our
                                        resource."</div>
                                    <div class="text-button mt-24">Georgina Rodriguez</div>
                                    <div class="caption1 text-placehover mt-4">Network Engineer, Amazon</div>
                                </div>
                                <div class="cmt-item text-center" data-name="5">
                                    <div class="heading6 fw-500">"Efficiency at Its Best! Remarkable AI Solutions! Our
                                        business has witnessed remarkable improvements since integrating their AI."
                                    </div>
                                    <div class="text-button mt-24">Rihana Pavard</div>
                                    <div class="caption1 text-placehover mt-4">Database Administrator, IBM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="our-leader pb-100 mt-5">
            <div class="container">
                <div class="row">
                    <div class="heading3">{{$translations['meet_leader']}}</div>
                    <div class="col-xl-6 col-lg-7 body1 text-placehover mt-24">{{$translations['leader_hope']}}</div>
                    <div class="list-our-team mt-40">
                        <div class="row row-gap-32">
                            <div class="col-lg-3 col-sm-6"
                                style='    background-color: #2A2A2D; border-top-left-radius: 50px;border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;padding:0px'>
                                <div class="item">
                                    <div class="bg-img"
                                        style='border: 2px solid white;border-top-left-radius: 50px;border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;'>
                                        <img class="w-100 d-block"
                                            src="https://minio-api.sys.coolrasto.com/general/images/sadik.jpeg"
                                            alt="" />
                                    </div>
                                    <div class="infor mt-16 mb-2">
                                        <center>
                                            <div class="heading7">SADIK SAJID</div>
                                            <div class="text-placehover mt-8">Full Stack Developer</div>
                                        </center>
                                    </div>
                                    <div class="list-social bg-white"><a href="www.linkedin.com/in/sadik-sajid"
                                            target="_blank"> <i class="icon-linkedin fs-14"></i></a><a
                                            href="http://facebook.com/sadiksajid" target="_blank"> <i
                                                class="icon-facebook fs-14"></i></a>
                                        <!-- <a href="http://twitter.com" target="_blank"> <i class="icon-twitter fs-12"></i></a><a href="http://instagram.com" target="_blank"> <i class="icon-instagram fs-12"></i></a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-pricing style-one pt-100 mb-5">
                <div class="bg-blur"></div>
                <div class="container">
                    <div class="bg-blur"></div>
                    <div class="row flex-between row-gap-40">
                        <div class="col-xl-3 col-12">
                            <div class="heading">
                                <div class="heading3 text-white">{{$translations['plan_title']}}</div>
                                <div class="body2 text-placehover mt-16">{{$translations['plan_meta']}}</div>
                                <div
                                    class="choose-type bg-line-dark bora-8 p-8 flex-between gap-8 mt-32 display-inline-flex">
                                    <button
                                        class="button text-white text-button-small bg-transparent pt-12 pb-12 pl-16 pr-16 active"
                                        data-name="monthly">{{$translations['plan_monthly']}}</button>
                                    <button
                                        class="button text-white text-button-small bg-transparent pt-12 pb-12 pl-16 pr-16"
                                        data-name="yearly">{{$translations['plan_yearly']}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-12 pl-65">
                            <div class="list-pricing" data-name="monthly">
                                <div class="row row-gap-32">
                                    <div class="col-md-6 col-12">
                                        <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                                            <div class="heading5 text-white">{{$translations['plan_free']}}</div>
                                            <div class="body3 text-placehover mt-12">{{$translations['plan_free_meta']}}
                                            </div>
                                            <div class="heading2 text-white mt-20">{{$translations['free']}}</div><a
                                                class="button text-white w-100 mt-24 register_popup" href="#"> <span>
                                                    <span> </span></span><span
                                                    class="bg-line-dark">{{$translations['plan_start']}} </span></a>
                                            <div class="list-feature d-flex flex-column gap-12 mt-40">
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list1']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list2']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list3']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list4']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list5']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                                            <div class="heading5 text-white">{{$translations['premium']}}</div>
                                            <div class="body3 text-placehover mt-12">{{$translations['premium_meta']}}
                                            </div>
                                            <div class="price d-flex mt-20">
                                                <div class="heading2 text-white">$9.99</div>
                                                <div class="text-white">/{{$translations['month']}}</div>
                                            </div><a class="button text-white w-100 mt-24 register_popup" href="#">
                                                <span> <span> </span></span><span
                                                    class="bg-line-dark">{{$translations['plan_start']}}</span></a>
                                            <div class="list-feature d-flex flex-column gap-12 mt-40">
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list6']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list2']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list3']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list7']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list8']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list9']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">
                                                        {{$translations['plan_list10']}}</div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">
                                                        {{$translations['plan_list11']}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-pricing hide" data-name="yearly">
                                <div class="row row-gap-32">
                                    <div class="col-md-6 col-12">
                                        <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                                            <div class="heading5 text-white">{{$translations['plan_free']}}</div>
                                            <div class="body3 text-placehover mt-12">{{$translations['plan_free_meta']}}
                                            </div>
                                            <div class="heading2 text-white mt-20">{{$translations['free']}}</div><a
                                                class="button text-white w-100 mt-24 register_popup" href="#"> <span>
                                                    <span> </span></span><span
                                                    class="bg-line-dark">{{$translations['plan_start']}}</span></a>
                                            <div class="list-feature d-flex flex-column gap-12 mt-40">
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list1']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list2']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list3']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list4']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list5']}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                                            <div class="heading5 text-white">{{$translations['premium']}}</div>
                                            <div class="body3 text-placehover mt-12">{{$translations['premium_meta']}}
                                            </div>
                                            <div class="price d-flex mt-20">
                                                <div class="heading2 text-white">$89.99</div>
                                                <div class="text-white">/{{$translations['year']}}</div>
                                            </div><a class="button text-white w-100 mt-24 register_popup" href="#">
                                                <span> <span> </span></span><span
                                                    class="bg-line-dark">{{$translations['plan_start']}}</span></a>
                                            <div class="list-feature d-flex flex-column gap-12 mt-40">
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list6']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-white">{{$translations['plan_list2']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list3']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list7']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list8']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">{{$translations['plan_list9']}}
                                                    </div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">
                                                        {{$translations['plan_list10']}}</div>
                                                </div>
                                                <div class="item flex-item-center gap-16"> <i
                                                        class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                                                    <div class="feature text-placehover">
                                                        {{$translations['plan_list11']}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="style-blue">
                <div id="preload">
                    <div class="main-content flex-center">
                        <div class="circle flex-center"><span></span>
                            <div class="circle-child"></div>
                        </div>
                        <div class="circle flex-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



