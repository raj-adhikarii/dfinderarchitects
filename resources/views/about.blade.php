@extends('layouts.main')
@section('title')
    <title>{{ config('app.name') }} | About Us</title>
@endsection
@section('about-nav')
    {{ 'act-link' }}
@endsection

@section('content')

    <div class="content">
        <!--fixed-column-wrap-->
        <div class="fixed-column-wrap">
            <div class="pr-bg"></div>
            <!--fixed-column-wrap-content-->
            <div class="fixed-column-wrap-content">
                <div class="scroll-nav-wrap color-bg">
                    <div class="carnival">Scroll down</div>
                    <div class="snw-dec">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                    </div>
                </div>
                <div class="bg" data-bg="{{ asset('public/images/bg/12.jpg') }}"></div>
                <div class="overlay"></div>
                <div class="progress-bar-wrap bot-element">
                    <div class="progress-bar"></div>
                </div>
                <!--fixed-column-wrap_title-->
                <div class="fixed-column-wrap_title first-tile_load">
                    <h2>About Our<br> Company</h2>
                </div>
                <!--fixed-column-wrap_title end-->
                <div class="fixed-column-dec"></div>
            </div>
            <!--fixed-column-wrap-content end-->
        </div>
        <!--fixed-column-wrap end-->
        <!--column-wrap-->
        <div class="column-wrap">
            <!--column-wrap-container -->
            <div class="column-wrap-container fl-wrap">
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
                            <h3>About Us</h3>
                            <p></p>
                        </div>
                        <div class="column-wrap-content fl-wrap">
                            <div class="column-wrap-media fl-wrap">
                                <div class="pr-bg pr-bg-white"></div>
                                <div class="about-banner">
                                   @if($about && $about->image)<img src="{{ $about->image }}"  class="respimg" alt="">@endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pr-bg pr-bg-white" style="left: 100%; transform: translate3d(0px, 0px, 0px);"></div>
                                    <p>@if($about) {!! $about->description !!} @else No data available yet @endif</p>
                            </div>

                            {{-- <div class="column-wrap-text">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="pr-subtitle">
                                            One of The Best Architecture Agency
                                            <div class="pr-bg pr-bg-white"></div>
                                        </h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="pr-bg pr-bg-white"></div>
                                        <p>Established on 2070 BS by a group of Architects and Civil engineers, Surveyor and Management experts with an objective to aim of bringing forth creative yet practical solutions to the civil engineering, architectural, and planning scene.</p>
                                        <p>Having partnership organisation, owned and managed by its key professionals. It is registered with small and cottage industries office, Nepal Government. We are supported by professional associates who are selected as the basis of their professional competence, experience and commitment to the philosophy and objectives of the group.</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="section-number right_sn">
                            <div class="pr-bg pr-bg-white"></div>
                            {{-- <span>0</span>1. --}}
                        </div>
                    </div>
                </section>
                <!--section end-->
                <div class="section-separator"></div>
                <!--section -->
                <section id="sec2" class="small-padding">
                    <div class="container">
                        <div class="split-sceen-content_title fl-wrap">
                            <div class="pr-bg pr-bg-white" style="left: 100%; transform: translate3d(0px, 0px, 0px);"></div>
                            <h3>Our Phylosophy</h3>
                            <p></p>
                        </div>
                        <div class="column-wrap-content fl-wrap">
                            <div class="column-wrap-text">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pr-bg pr-bg-white" style="left: 100%; transform: translate3d(0px, 0px, 0px);"></div>
                                        <p>@if($about) {!! $about->phylosophy !!} @else No data available yet @endif</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-number right_sn">
                            <div class="pr-bg pr-bg-white" style="left: 100%; transform: translate3d(0px, 0px, 0px);"></div>
                            {{-- <span>0</span>2. --}}
                        </div>
                    </div>
                </section>
                {{-- <section id="sec1-why" class="small-padding">
                    <div class="container">
                        <div class="column-wrap-content fl-wrap">
                            <div class="column-wrap-text">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="pr-subtitle">
                                            Why<br/> Us?
                                            <div class="pr-bg pr-bg-white"></div>
                                        </h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="pr-bg pr-bg-white"></div>
                                        <p>The firm presently boasts of its experienced members of hard working quality, necessary to boost up the firm to achieve its goals and objective in a comprehensive manner and to explore greater heights. The status of the firm is further enhanced due to the presence of outside assistance of some reputed organisations and persons who are related to the Consultancy and are the strength to offer our services as complement to the rapid growth of the country’s changing infrastructure and its development.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
                <!--section end-->
                <div class="section-separator"></div>
                <!-- section -->
                <section id="sec3" class="small-padding">
                    <div class="container">
                        <div class="split-sceen-content_title fl-wrap">
                            <div class="pr-bg pr-bg-white"></div>
                            <h3>Our Vision And Misson</h3>
                            <p></p>
                        </div>
                        <div class="column-wrap-content fl-wrap">
                            <div class="column-wrap-text">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pr-bg pr-bg-white"></div>
                                       <p>@if($about) {!! $about->vision !!} @else No data available yet @endif</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-number right_sn">
                            <div class="pr-bg pr-bg-white"></div>
                            {{-- <span>0</span>3. --}}
                        </div>
                    </div>
                </section>
                <!-- section end -->
                <div class="section-separator"></div>
                <!--section-->
                {{-- <section id="sec2" class="small-padding">
                    <div class="container">
                        <div class="split-sceen-content_title fl-wrap">
                            <div class="pr-bg pr-bg-white"></div>
                            <h3>Our Working Fields</h3>
                            <p></p>
                        </div>
                        <div class="column-wrap-content fl-wrap">
                            <div class="column-wrap-text">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pr-bg pr-bg-white"></div>
                                        <p>We cover a wide range of Architecture Design, Building Renovation, Urban design and planning, Urban conservation and heritage preservation, landscape design and planning, interior design etc.</p>
                                        <h3>Our working fields:</h3>
                                        <p>Architecture & Building, Construction engineering and management, Valuation works, Urban Design and Planning, Conservation and Heritage Preservation, Landscape Design, Interior Design, Low Cost Design, Energy Efficient Design</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-number right_sn">
                            <div class="pr-bg pr-bg-white"></div>
                            <span>0</span>3.
                        </div>
                    </div>
                </section> --}}
                <!--section end-->


            </div>
            <!--column-wrap-container end-->
        </div>
        <!--column-wrap end-->
        <div class="limit-box fl-wrap"></div>
    </div>

@endsection
