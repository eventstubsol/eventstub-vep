@php
    $event = App\Event::findOrFail($id);
@endphp
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<li>
    <a href="{{ route("event.Dashboard",['id'=>$id]) }}"  class="nav-second-level"> 
        <i class="fas fa-tachometer-alt"></i>
        <span>
            Dashboard
        </span>  
    </a>
</li>
@if(Carbon\Carbon::now($event->timezone) <= $event->end_date)
    {{-- <li class="menu-title">Administration</li>
    <li> --}}
 <li>
        {{--    <a href="{{ route('eventee.media',$id) }}">
            <i class="fa fa-picture-o" aria-hidden="true"></i>
            <span> My Media </span>
        </a>
    </li> --}}
    <a href="#users" data-toggle="collapse">
        <i data-feather="users"></i>
       <span> Attendees<span>
    </a>
    <div class="collapse" id="users">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.user.create",['id'=>$id]) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.user",['id'=>$id]) }}">Manage</a>
            </li>
            <li>
                <a href="{{ route("eventee.verifications",['id'=>$id]) }}">Verifications</a>
            </li>
            <li>
                <a href="{{ route("eventee.subtypes",['id'=>$id]) }}">Manage Types</a>
            </li>
            <li>
                <a href="{{ route("access.index",['id'=>$id]) }}" > Access Control</a>
            </li>
            <li>
                <a href="{{ route("eventee.form",['id'=>$id]) }}">Registration Forms</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#sessionrooms" data-toggle="collapse">
        <i  data-feather="home"></i>
        <span> Session Rooms</span>
    </a>
    <div class="collapse" id="sessionrooms">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.sessionrooms.create",$id) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.sessionrooms.index",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>


<li>
    <a href="#sessions" data-toggle="collapse">
        <i class="mdi mdi-play"></i>
        <span> Sessions</span>
    </a>
    <div class="collapse" id="sessions">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.sessions.create",$id) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.sessions.index",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="{{ route("eventee.options",$id) }}">
        <i class="mdi mdi-file-multiple"></i>
        <span> Event Creatives </span>
    </a>
</li>
<li>
    <a href="{{ route("library",$id) }}">
        <i class="mdi mdi-file-multiple"></i>
        <span> Event Library </span>
    </a>
</li>


<li>
    <a href="#pages" data-toggle="collapse">
        <i class="mdi mdi-file-multiple"></i>
        <span> Event Rooms/Pages</span>
    </a>
    <div class="collapse" id="pages">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.pages.create",$id) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.pages.index",$id) }}">Manage</a>
            </li>
            {{-- <li>
                <a href="{{ route("elobby",$id) }}">Lobby</a>
            </li> --}}
        </ul>
    </div>
</li>

<li>
    <a href="#booths" data-toggle="collapse">
        <i data-feather="grid"></i>
        <span> Expo Booths </span>
    </a>
    <div class="collapse" id="booths">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.booth.create",$id) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.booth",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#lounge" data-toggle="collapse">
        <i data-feather="grid"></i>
        <span>Networking Lounge </span>
    </a>
    <div class="collapse" id="lounge">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.lounge.create",$id) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.lounge.index",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>
<li>
    <a href="#modals" data-toggle="collapse">
        <i data-feather="grid"></i>
        <span> Lightbox/Modals </span>
    </a>
    <div class="collapse" id="modals">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.modal.create",$id) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.modal",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#menu" data-toggle="collapse">
        <i class="fa fa-bars"></i>
        <span> Menu</span>
    </a>
    <div class="collapse" id="menu">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.menu",$id) }}">Top Menu</a>
            </li>
            <li>
                <a href="{{ route("eventee.menu.footer",$id) }}">Bottom</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#notification" data-toggle="collapse" >
        <i data-feather="bell"></i>
        <span> Push Notifications</span>
    </a>
    <div class="collapse" id="notification">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.notification",$id) }}">Instant</a>
            </li>
            <li>
                <a href="{{ route("eventee.schedule",$id) }}">Schedule </a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#posts" data-toggle="collapse" >
        <i data-feather="bell"></i>
        <span> Post</span>
    </a>
    <div class="collapse" id="posts">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.post.create",$id) }}">Create Post </a>
            </li>
            <li>
                <a href="{{ route("eventee.post",$id) }}">Manage</a>
            </li>
            <li>
                <a href="{{ route("eventee.post.allComments",$id) }}">Comments</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#mail" data-toggle="collapse">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <span>E-Mail</span>
    </a>
    <div class="collapse" id="mail">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.mail.create",['id'=>$id]) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.mail",['id'=>$id]) }}">Manage</a>
            </li>
            {{-- <li>
                <a href="{{ route("eventee.mail.template",['id'=>$id]) }}">Manage Template</a>
            </li> --}}
        </ul>
    </div>
</li>

<li>
    <a href="#faq" data-toggle="collapse">
        <i class="fas fa-question-circle"></i>
        <span> FAQ</span>
    </a>
    <div class="collapse" id="faq">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.faq.create",['id'=>$id]) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("eventee.faq",['id'=>$id]) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>




<li>
    <a href="#settings" data-toggle="collapse">
        <i class="fa fa-cog"></i>
        <span> Event Settings</span>
    </a>
    <div class="collapse" id="settings">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.settings",$id) }}">
                    <span> Default  </span>
                </a>
            </li>
            <!-- <li>
                <a href="{{ route("settings.chat",$id) }}">
                    <span> Chat</span>
                </a>
            </li> -->
            <li>
                <a href="{{ route("eventee.integrations",$id) }}">
                    <span> Integrations </span>
                </a>
            </li>
            <li>
                <a href="{{ route("eventee.leaderSetting",$id) }}">
                    <span> Leaderboard Setting </span>
                </a>
            </li>
            <li>
                <a href="{{ route("landing.settings",$id) }}">
                    <span> Landing Page Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('eventee.restore',$id) }}">
                    <span> Recycle Bin </span>
                </a>
            </li>

            {{-- <li>
                <a href="{{ route("onboard.settings",$id) }}">
                    <span> Onboard Settings</span>
                </a>
            </li> --}}
        </ul>
    </div>
</li>
<li>
    <a href="#polls" data-toggle="collapse">
        <i data-feather="users"></i>
        <span> Polls</span>
    </a>
    <div class="collapse" id="polls">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.polls.create",['id'=>$id]) }}">Create</a>
            </li>
            <li>
                <a href="{{ route("polls.manage",['id'=>$id]) }}">Manage</a>
            </li>
           
        </ul>
    </div>
</li>
{{-- <li>
    <a href="#form" data-toggle="collapse">
        <i class="fas fa-align-justify"></i>
        <span> Form</span>
    </a>
    <div class="collapse" id="form">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.form",['id'=>$id]) }}">Manage</a>
            </li>
            <li>
                <a href="{{ route("eventee.form.create",['id'=>$id]) }}">Create</a>
            </li>
        </ul>
    </div>
</li> --}}
{{-- <li>
    <a href="{{ route('eventee.dataEntry',$id) }}"  class="nav-second-level">
        <i data-feather="users"></i>
        <span> Data Entry</span>
    </a>
</li> --}}

{{-- <li>
    <a href="#polls" data-toggle="collapse">
        <i data-feather="bar-chart-2"></i>
        <span>Polls</span>
    </a>
    <div class="collapse" id="polls">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.poll",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#QNA" data-toggle="collapse">
        <i class="fa fa-question-circle"></i>
        <span>QnA</span>
    </a>
    <div class="collapse" id="QNA">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.qna",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a href="#announceAdmin" data-toggle="collapse">
        <i class="fa fa-bullhorn" aria-hidden="true"></i>
        <span>Announcements</span>
    </a>
    <div class="collapse" id="announceAdmin">
        <ul class="nav-second-level">
            <li>
                <a href="{{ route("eventee.announce",$id) }}">Manage</a>
            </li>
        </ul>
    </div>
</li> --}}

{{-- <li>
    <a href="{{ route("eventee.videoArchive",$id) }}"  class="nav-second-level"> 
        <span>
            Past Videos Archive
        </span>  
    </a>
</li> --}}

{{-- <li>
    <a href="{{ route("eventee.license",$id) }}"  class="nav-second-level"> 
        <span>
           Licence Upgrade
        </span>  
    </a>
</li> --}}



{{-- <li class="menu-title">Site Content</li> --}}

@endif
<li class="menu-title">Reporting & Analytics</li>

<li>
    <a href="#report" data-toggle="collapse">
        <i class="mdi mdi-file-multiple"></i>
        <span> Reports </span>
    </a>
    <div class="collapse" id="report">
        <ul class="nav-second-level">
            {{-- <li>
                <a href="{{ route("event.Dashboard",['id'=>$id]) }}">General</a>
            </li> --}}
            <li><a href="{{ route('eventee.loginLogs',$id) }}">Login Logs</a></li>
            <li><a href="{{ route('eventee.leaderBoardReports',$id) }}">Leaderboard Logs</a></li>
            <li><a href="{{ route('eventee.room.report',$id) }}">Room Wise Report</a></li>
            <li><a href="{{ route("eventee.user.report",['id'=>$id]) }}">User Wise Report</a></li>
        </ul>
    </div>
</li>