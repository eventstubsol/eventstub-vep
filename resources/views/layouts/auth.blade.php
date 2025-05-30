<!DOCTYPE html>
<html lang="en" class="js-focus-visible" data-js-focus-visible=""><head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @php
        $event = null;
        if(isset($id))
            $event = \App\Event::findOrFail($id);
    @endphp
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    
    @if(isset($id))
    <link rel="shortcut icon" href="{{ assetUrl(getFieldId('favicon',$id)) }}?v=3">
    @endif
    <!-- App css -->
    <link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet">
    <link href="{{asset("assets/css/app.css")}}" rel="stylesheet" type="text/css" id="app-default-stylesheet">
    <link rel="stylesheet" href="{{ asset("assets/css/log.css") }}?xyz=123">
    {{-- <link href="{{asset("assets/css/bootstrap-dark.min.css")}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled"> --}}
    {{-- <link href="{{asset("assets/css/app-dark.min.css")}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled"> --}}
    <link href="{{ asset('assets/css/auth.css') }}?x=1234" rel="stylesheet" type="text/css" />

    <!-- icons -->
    <link href="{{asset("assets/css/icons.min.css")}}" rel="stylesheet" type="text/css">
    @yield('styles')
    @yield('styles_after')
    @yield('scripts_before')
    
    <style>
        body{
            overflow: hidden;
        }
        .bg-image{
            position: fixed;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            filter: blur(4px);
            object-fit: cover;
            object-position: 55% 0;
        }
        .lh2{
            line-height: 2em;
        }
        .auth-fluid{
           
            background-size: cover;
            background-repeat: no-repeat;
        }
        body.auth .login-container .login-header .logo {
            display: block;
            width: 150px;
            margin: -115px auto -40px;
            border-radius: 5px;
            background: #fff;
            border: 5px solid #fff;
            height: 150px;
            padding: 18px 10px 0;
        }
        body.auth::after{
            content:'';
            position:absolute;
            background:#000;
            top:0;
            left:0;
            right:0;
            bottom:0;
            z-index:-1;
            opacity:0.5
        }
        .device-orentation.disabled{
            display:none;
        }
        .device-orentation .inner{
            position: relative;
            min-width: 300px;
            pointer-events: auto;
        }
        .device-orentation .close{
            position: absolute;
            right: 5px;
            top: 5px;
            width: 20px;
            height: 20px;
            color: #141414;
            cursor: pointer;
        }
        .grecaptcha-badge { 
            visibility: hidden;
        }
        .auth-fluid{
            /* flex-direction: row-reverse; */
            display: flex;
        }
        .auth-fluid .auth-fluid-form-box {
            max-width: 50%;
            width: 50%;
            float: right;
            position: relative;
        }
        .auth-fluid .auth-fluid-image {
            max-width: 55%;
            float:right;
            position: relative;
            min-width: 55%;
            height: 100vh;
        }
        .auth-fluid .auth-fluid-image img{
            /* position: fixed; */
            
            width: 100%;
            height: 100vh;
            z-index: 1;
            object-fit: cover;
            
            object-position: 55% 0;
        }
        @media (max-width: 991.98px){
            
            .auth-fluid-image {    
                max-width: 0 !important;
                min-width: 0 !important;
            }
            .auth-fluid .auth-fluid-form-box {    
                max-width: 100%;
                min-height: 100vh;
                width: 100% !important;
            }
            .auth-fluid-image img{
                height: 100% !important;
            }
            body{
                overflow: auto;
            }
        } 
       @if(isset($event))
       a {
            color: {{ $event->primary_color }};
            text-decoration: none;
            background-color: transparent;
        }
   

        a:hover {
            color: {{ $event->secondary_color }} ;
            text-decoration: underline;
        }

        @endif
        h4.mt-0.ml-2.mb-3 {
         text-align: center;
        font-size: 1.5rem;
        }
    </style>

</head>

<body class="auth-fluid-pages pb-0" data-sidebar-size="condensed" data-layout-width="fluid" data-layout-menu-position="fixed" data-sidebar-color="light" data-sidebar-showuser="false" data-topbar-color="dark" style="visibility: visible; opacity: 1;">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-image">
            @if(isset($id))
                <img src="{{assetUrl(getFieldId('login_background',$id,"uploads/wFkbCQhQS1m96tBFRk2dRQtCc0v7snLgf3C8IRXf.jpg"))}}" alt="No Image">
            @else
                <img src="{{assetUrl(getField('login_background',"uploads/wFkbCQhQS1m96tBFRk2dRQtCc0v7snLgf3C8IRXf.jpg"))}}"  alt="No Image">
                

            @endif
        </div>
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="mb-5 text-center  text-lg-center">
                        <div class="auth-logo">
                            <a href="/" class="logo text-center">
                                <span class="logo ">
                                    @if(isset($id))
                                    <img src="{{assetUrl(getFieldId('logo',$id,"uploads/xmbGmR1olTbfKNwonBymeJv0mJV9emC2EK9bjCdF.png"))}}" alt="" height="82">
                                    @else   
                                    <img src="{{assetUrl(getField('logo',"uploads/xmbGmR1olTbfKNwonBymeJv0mJV9emC2EK9bjCdF.png"))}}" alt="" height="82">
                                    @endif
                                </span>
                            </a>

                        </div>
                    </div>
                  
                    @include('flash::message')
                    <!-- title-->
                     <h4 class="mt-0 ml-2 mb-3">
                         @yield("form_title")
                     </h4>
                     <p style="padding-left: 15px" class="text-muted mb-4 mt-0 ml-2 mb-3">
                         @yield("form_desc")
                     </p>
                    {{-- <p class="text-muted mb-4">Enter your email address and password to access account.</p> --}} 

                    <div class="auth">
                        <div class="container">

                            <div class="login-container">
        
                                <!-- form -->
                                <div class="form">
                                    @yield('form')
                                    {{-- <p class="text mt-3">By logging in and using the platform, you hereby accept our <a href="{{ route('privacyPolicy') }}" >Privacy Policy</a>. For more details <a href="{{ route("faq") }}">read the FAQs</a></p> --}}
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer ml-4 footer-alt">
                        @yield("form_footer")
                    </footer>

                    
                    <div class="device-orentation disabled">
                        <div class="inner">
                            <div class="icon">
                                <svg id="Capa_1" enable-background="new 0 0 512 512" height="32" viewBox="0 0 512 512" width="32" xmlns="http://www.w3.org/2000/svg"><g><path d="m356.225 417v-76-55-186c-49.254 0-88.509-10-137.764-10-50.745 0-101.49 0-152.236 0v337h150.902c49.7 0 89.399-10 139.098-10z" fill="#e9f6ff"/><path d="m66.225 166h120v30h-120z" fill="#d2e4fd"/><path d="m66.225 226h75v30h-75z" fill="#d2e4fd"/><path d="m356.225 64.5c0-35.565-28.935-59.5-64.5-59.5l-75.5-5h-85.5c-35.565 0-64.5 28.935-64.5 64.5v25.5h150l140-5z" fill="#4c607e"/><path d="m66.225 447.5c0 35.565 28.935 64.5 64.5 64.5h85.5l75.5-5c35.565 0 64.5-23.935 64.5-59.5v-22.5l-140-5h-150z" fill="#4c607e"/><path d="m216.225 420h150v-79-55-196h-150z" fill="#d2e4fd"/><path d="m301.725 0h-85.5v90h150v-25.5c0-35.565-28.935-64.5-64.5-64.5z" fill="#374965"/><path d="m216.225 512h85.5c35.565 0 64.5-28.935 64.5-64.5v-27.5h-150z" fill="#374965"/><path d="m440.775 211.377-37.427-37.426-37.123 32.123-37.123-37.123-42.427 42.426 37.124 37.123-37.124 37.123 42.427 42.426 37.123-37.123 37.123 32.123 37.427-37.426-37.124-37.123z" fill="#e58f22"/><path d="m445.775 285.623-37.124-37.123 37.124-37.123-42.427-42.426-37.123 37.123v84.852l37.123 37.123z" fill="#df6426"/></g></svg>
                            </div>
                            <p>For an immersive experience, please login using a Tablet Device/Laptop/PC Or switch to landscape mode in your mobile phone.</p>
                        </div>
                    </div>


                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        {{-- <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3 text-white">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> I've been using your theme from the previous developer for our web app, once I knew new version is out, I immediately bought with no hesitation. Great themes, good documentation with lots of customization available and sample app that really fit our need. <i class="mdi mdi-format-quote-close"></i>
                </p>
                <h5 class="text-white">
                    - Fadlisaad (Ubold Admin User)
                </h5>
            </div> <!-- end auth-user-testimonial-->
        </div> --}}
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    @yield('scripts_after')
    
    <script>
        (function () {
            let deviceElem = document.querySelector('.device-orentation');
            let deviceElemClose = document.querySelector('.device-orentation .close');

            function isMobile() {
                let check = false;
                (function(a){
                    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) 
                    check = true;
                })(navigator.userAgent||navigator.vendor||window.opera);
                return check;
            }
            function isProtrait(){
                return !window.screen.orientation.angle;
            }

            // window.addEventListener("orientationchange", function(event) {
            //     (isMobile() && isProtrait()) ?  deviceElem.classList.remove('disabled') : deviceElem.classList.add('disabled');
            // });

            // window.addEventListener("DOMContentLoaded", function(){
            //     (isMobile() && isProtrait()) ?  deviceElem.classList.remove('disabled') : deviceElem.classList.add('disabled');
            //     deviceElemClose.addEventListener('click', function(){
            //         deviceElem.classList.add('disabled');
            //     });
            // }, false);
        })();
    </script>
    <!-- Vendor js -->
    <script src="{{asset("assets/js/vendor.min.js")}}"></script>

    <!-- App js -->
    <script src="{{asset("assets/js/app.min.js")}}"></script>
    

</body>
</html>