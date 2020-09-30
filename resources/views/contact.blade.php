@extends('layouts.main')
@section('title')
    <title>{{ config('app.name') }} | Contact Us</title>
@endsection
@section('contacts-nav')
    {{ 'act-link' }}
@endsection

@section('content')

    <div class="content">
        <!--fixed-column-wrap-->
        <div class="fixed-column-wrap">
            <div class="pr-bg"></div>
            <div class="fixed-column-wrap-content map-mobile">
                <div class="scroll-nav-wrap color-bg">
                    <div class="carnival">Scroll down</div>
                    <div class="snw-dec">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-bar-wrap bot-element">
                    <div class="progress-bar"></div>
                </div>
                <div class="map-container mc_big">
                    <div id="map-single" class="map" data-latlog="[27.6737678,85.3710367]" data-popuptext="We are located in Bhaktapur . <br> We are waiting for your visit"></div>
                </div>
            </div>
            <!--fixed-column-wrap-content end-->
        </div>
        <!--fixed-column-wrap end-->
        <!--column-wrap-->
        <div class="column-wrap">
            <!--column-wrap-container -->
            <div class="column-wrap-container fl-wrap" style="border-right: 1px solid #ddd">
                <div class="col-wc_dec">
                    <div class="pr-bg pr-bg-white"></div>
                </div>
                <div class="col-wc_dec col-wc_dec2">
                    <div class="pr-bg pr-bg-white"></div>
                </div>
                <!--section-->
                <section id="sec1" class="small-padding">
                    <div class="container">
                        <div class="split-sceen-content_title fl-wrap">
                            <div class="pr-bg pr-bg-white"></div>
                            <h3> Contact Details</h3>
                            <p>Getting in touch is Easy. Either Call, Email or Visit.</p>
                        </div>
                        <div class="column-wrap-content fl-wrap">
                            <div class="column-wrap-media fl-wrap">
                                <div class="pr-bg pr-bg-white"></div>
                                <img src="{{ asset('public/images/all/7.jpg') }}"  class="respimg" alt="">
                                <div class="cont-det-wrap dark-bg">
                                    <div class="pr-bg pr-bg-white"></div>
                                    <ul>
                                        <li><strong>01.</strong><span>Write : </span> <a href="mailto:@if($footer) {{$footer->email}} @endif">@if($footer) {{$footer->email}} @endif</a></li>
                                        <li><strong>02.</strong><span> Call :</span> <a href="tel:@if($footer) {{$footer->phone}} @endif">@if($footer) {{$footer->phone}} @endif</a></li>
                                        <li><strong>03.</strong><span> Visit :</span> <a>@if($footer) {{$footer->location}} @endif</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="section-number right_sn">
                            {{-- <span>0</span>1. --}}
                        </div>
                    </div>
                </section>
                <!--section end-->
                <div class="section-separator"></div>
                <!--section-->
                <section id="sec2" class="small-padding">
                    <div class="container">
                        <div class="split-sceen-content_title fl-wrap">
                            <div class="pr-bg pr-bg-white"></div>
                            <h3>Get In touch</h3>
                            <p>Our team is happy to answer all your questions. Fill up the form and we'll be in touch as soon as possible.</p>
                        </div>
                        <div id="contact-form">
                            <div class="pr-bg pr-bg-white"></div>
                            <div id="message"></div>

                            <form  class="custom-form" action="{{ route('post.contact') }}" method="POST">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="name" id="name" placeholder="Your Name *" value="" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email"  name="email" id="email" placeholder="Email Address *" value="" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text"  name="phone" id="phone" placeholder="Phone *" value="" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text"  name="subject" id="subject" placeholder="Subject *" value="" required/>
                                        </div>
                                    </div>
                                    <textarea name="message"  id="comments" cols="40" rows="3" placeholder="Your Message:" required></textarea>
                                    <div class="clearfix"></div>
                                    <button class="btn float-btn flat-btn color-bg" id="submit">Send Message <i class="fal fa-long-arrow-right"></i></button>
                                </fieldset>
                            </form>
                        </div>
                        <!-- contact form  end-->
                        <div class="section-number right_sn">
                            <div class="pr-bg pr-bg-white"></div>
                            {{-- <span>0</span>2. --}}
                        </div>
                    </div>
                </section>
                <!--section end-->
            </div>
            <!--column-wrap-container end-->
        </div>
        <!--column-wrap end-->
        <div class="limit-box fl-wrap"></div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('success'))
    <script>
        swal({
            title: "Success !!!",
            text: "Message send successfully.",
            icon: "success",
        });
    </script>
    @elseif(session('error'))
    <script>
        swal({
                title: "Error !!!",
                text: "Error while sending message.",
                icon: "error",
            });
    </script>
    @endif
@endsection
