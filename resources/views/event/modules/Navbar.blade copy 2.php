@php
    $notifications = App\PushNotification::where('event_id',$event_id)->get();
    $finalnotes = [];
    $noteCount = 0;
    foreach ($notifications as $note) {
        $seens = App\SeenNotification::where('notification_id',$note->id)->where('user_id',Auth::id())->count();
        if($seens < 1){
            $notes = new \stdClass();
            $notes->id = $note->id;
            $notes->message = $note->message;
            $notes->title = $note->title;
            $notes->created_at = $note->created_at;
            array_push($finalnotes,$notes);
            $noteCount++;
        }
    }
@endphp

<style>
    ul{
        list-style:none;
    }
    ul .dropdown .notification-list{
        list-style:none;
    }
    .nav-link {
        display: block;
        padding: 0.5rem 1rem;
        color: #6658dd;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
    }
    .waves-effect {
        position: relative;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        -webkit-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    
    }
    .navbar-custom .dropdown .nav-link.show {
        background-color: rgba(255,255,255,.05);
    }
    .navbar-custom .topnav-menu .nav-link {
        padding: 0 15px;
        color: rgba(255,255,255,.6);
        min-width: 32px;
        display: block;
        line-height: 70px;
        text-align: center;
        max-height: 70px;
    }
    .dropdown-toggle {
    white-space: nowrap;
    }
    [role=button] {
        cursor: pointer;
    }
    a {
        color: #6658dd;
        text-decoration: none;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    user agent stylesheet
    a:-webkit-any-link {
        color: -webkit-link;
        cursor: pointer;
        text-decoration: underline;
    }
    style attribute {
        visibility: visible;
        opacity: 1;
    }
    .profile{
        left:0;
    }
</style> 
<script src="https://coderthemes.com/ubold/layouts/default/assets/js/app.min.js"></script>
<script src="https://coderthemes.com/ubold/layouts/default/assets/js/app.min.js"></script>
<div class="navbar-custom navs hidden theme-nav">
    <div class="container-fluid row">
        <div class="col-5 col-md-2 fluid-col logo-col">
            <div class="logo-box">
                <a class="logo area" data-link="lobby">
                    <img async src="{{ assetUrl(getFieldId('logo',$event_id)) }}" style="max-height: 50px;border-radius: 10px;padding: 0px;">
                </a>
            </div>
        </div>
        @php
            $menus = App\Menu::where('type','nav')->where('event_id',$event_id)->where('parent_id','0')->where('status','1')->orderBy('position','asc')->get();
            
        @endphp
        <div class="col-2 col-md-8 fluid-col menu-col">
           <ul class="menu">
               @foreach($menus as $menu)
                @if($menu->name === 'lounge')      
                    <li><a data-link="networking" class="area"><i class="fe-home"></i>Lounge</a></li>
                @elseif($menu->name === 'lobby')      
                    <li><a data-link="lobby" class="area"><i class="fe-home"></i>Lobby</a></li>
                @elseif($menu->name === 'library')
                    <li><a data-toggle="modal" data-target="#resources-modal"><i class="fe-folder"></i>Library</a></li>
                @elseif($menu->name == 'schedule')
                    <li><a data-toggle="modal" data-target="#schedule-modal"><i class="fe-calendar"></i>Schedule</a></li>
                @elseif($menu->name == 'swagbag')
                    <li><a data-toggle="modal" data-target="#swagbag-modal"><i class="fe-shopping-bag"></i>SwagBag</a></li>
                @elseif($menu->name == 'leaderboard')
                    <li><a class="area" data-link="leaderboard"><i class="fe-bar-chart"></i>Leaderboard</a></li>
                @elseif($menu->name == 'personalagenda')
                    <li><a data-toggle="modal" id="agenda" data-target="#personal-schedule-modal"><i class="fe-calendar"></i>Personal Agenda</a></li>
                @else
                    <li class="not-booth-menu">   
                        {!! getMenuLink($menu) !!}
                    </li>
                @endif
            @endforeach
           </ul>
           <ul class="list-unstyled  menu" style="left:0;">
                 <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="dropdownMenuLink" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    <span id="count" class="badge count bg-danger rounded-circle noti-icon-badge">{{ $noteCount }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg" aria-labelledby="dropdownMenuLink">
    
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                                <button type="button" onclick="clearAll()" class="btn btn-sm btn-dark clear-notes">
                                    <small>Clear All</small>
                                </button>
                            </span>
                        Notification
                        </h5>
                    </div>
    
                    <div class="notificationBody noti-scroll" id="notificationBody" data-simplebar>
                        @foreach ($finalnotes as $notification)
                            <a href="javascript:void(0);" onclick="showNotification(this)" data-id="{{ $notification->id }}" data-title="{{  $notification->title  }}" data-message="{{  $notification->message  }}" class="dropdown-item notify-item active">
                                <div class="notify-icon">
                                    <img src="data:image/png;base64,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" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">{{ $notification->title }}</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>{{ $notification->message }}</small>
                                </p>
                            </a>
                        @endforeach
                        <!-- item-->
                        
    
                        
                    </div>
    
                   
                </div>
            </li>
                </ul>
        </div>
        <div style="display: flex;justify-content: space-between;" class="col-5 col-md-2 fluid-col profile-col">
            <div class="extra">
                @auth
                <div class="custom-dropdown profile">
                    <a href="javascript:void(0);" class="menu-trigger">
                        Test
                    </a>
                    <div class="custom-dropdown-menu">
                       Hello
                    </div>
                </div>  
                @endauth
              
            </div>
            <div class="extra">
                @auth
                <div class="custom-dropdown profile">
                    <a href="javascript:void(0);" class="menu-trigger">
                        <p class="pro-user-name m-0">
                            <span>{{ Auth::user()->name }}</span><i class="mdi mdi-chevron-down mx-1"></i>
                        </p>
                        @if(isset(Auth::user()->profileImage))
                            <img async src="{{assetUrl(Auth::user()->profileImage)}}" class="avatar-sm round-icon">
                        @else
                            <span class="round-icon"><i class="fa fa-user"></i></span><i class="mdi mdi-chevron-down mx-1"></i>
                        @endif
                    </a>
                    <div class="custom-dropdown-menu">
                        @if(Auth::user()->type=="admin" || Auth::user()->type=="exhibiter")
                            <a href="{{ url("/") }}" class="dropdown-item notify-item">
                                <i class="fa fa-cog mr-1"></i> <span>Admin Panel</span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endif
                        <a class="dropdown-item notify-item" href="{{ route('attendeeLogout',$event_name) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fe-log-out mr-1"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
               
                
                
                <div class="mob-menu ml-2 d-none">
                    <a href="void:javascript(0);">
                        <span class="round-icon">
                            <i class="fa fa-bars"></i>
                        </span>
                    </a >
                </div>
                @endauth
                @guest
                <div class="dropdown notification-list topbar-dropdown">
                    <a class="" href="{{ route("login") }}" aria-expanded="false">Login</a>
                </div>
                @endguest
            </div>
        </div>
    </div>
</div>


<!-- end Topbar -->

    <script>
      function clearAll(){
          $('#count').empty();
          $('#count').html(0);
          $('#notificationBody').empty();
          $('#notificationBody').html('<h6><center>No Notification Available</center></h6>');
      }

      function showNotification(e){
          var id = e.getAttribute('data-id');
          var title =  e.getAttribute('data-title');
          var message = e.getAttribute('data-message');
          $.ajax({
              url:"{{ route('notification.user.seen') }}",
              method:"POST",
              data:{
                'id':id
              },
              success:function(res){
                  if(res.code == 200){
                        let consentNotify = $('.consent-notification');
                        $('#notification-head').empty();
                        $('#notification-body').empty();
                        $('#notification-head').html('Subject:&nbsp;'+title);
                        $('#notification-body').html('Message:&nbsp;'+message);
                        consentNotify.removeClass('enable');
                        $('#notification-smallModal').addClass('enable');
                  }
                  else{
                      alert('Something Went Wrong');
                  }
              }
          });
      }

    </script>

