<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm expand-header">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></a>

        <ul class="navbar-item flex-row ml-auto">

            <li class="nav-item dropdown message-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-mail">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    @if(Auth::user()->unreadNotifications->where('type','App\Notifications\MsgNotification')->count()>0)
                        <span id="unreadMsg" class="badge badge-primary">
                            {{Auth::user()->unreadNotifications->where('type','App\Notifications\MsgNotification')->count()}}
                        </span>
                    @endif
                </a>
                <div class="dropdown-menu position-absolute e-animated e-fadeInUp notif1" aria-labelledby="messageDropdown" style="height:300px; overflow:auto">
                    <div class="">
                        @foreach(Auth::user()->unreadNotifications->where('type','App\Notifications\MsgNotification') as $notification)
                            <a class="dropdown-item" href="{{url('mailbox')}}">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="notification-icon">
                                            <div class="icon-svg mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-mail">
                                                    <path
                                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                    </path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="meta-title mr-3">1 nouvel email</p>
                                            <p class="message-text">{{Auth::user()::find($notification->data['sender'])->email}}</p>
                                            <p class="meta-time align-self-center mb-0">{{$notification->created_at->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        @foreach(Auth::user()->readNotifications->where('type','App\Notifications\MsgNotification') as $notification)
                            <a class="dropdown-item" href="{{url('mailbox')}}">
                                <div class="">
                                    <div class="media notification-new">
                                        <div class="notification-icon">
                                            <div class="icon-svg mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-mail">
                                                    <path
                                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                    </path>
                                                    <polyline points="22,6 12,13 2,6"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="meta-title mr-3">1 nouvel email</p>
                                            <p class="message-text">{{Auth::user()::find($notification->data['sender'])->email}}</p>
                                            <p class="meta-time align-self-center mb-0">{{$notification->created_at->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        {{Auth::user()->unreadNotifications->where('type','App\Notifications\MsgNotification')->markAsRead()}}
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    @if(Auth::user()->unreadNotifications->where('type','App\Notifications\NewTask')->count()>0 || Auth::user()->unreadNotifications->where('type','App\Notifications\archiveNotification')->count()>0)
                        <span id="unread" class="badge badge-success"></span>
                    @endif
                </a>
                <div class="dropdown-menu position-absolute notif e-animated e-fadeInUp"
                    aria-labelledby="notificationDropdown" style="height:300px; overflow:auto">
                    <div class="notification-scroll">
                        @foreach(Auth::user()->unreadNotifications->where('type','App\Notifications\NewTask') as $notification)
                            <div class="dropdown-item">
                                <div class="media">
                                    <a class="row" href="{{url('user/taches')}}"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-send">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                        <div class="media-body">
                                            <div class="notification-para">Vous avez reçu une nouvelle tâche:
                                                <span class="user-name"> {{$notification->data['nomT']}} </span>
                                            </div>
                                            <div class="notification-meta-time"> {{$notification->created_at->diffForHumans()}} </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @foreach(Auth::user()->unreadNotifications->where('type','App\Notifications\archiveNotification') as $notification)
                            <div class="dropdown-item">
                                <div class="media">
                                    <a class="row" href="{{url('user/taches')}}"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-send">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                        <div class="media-body">
                                            <div class="notification-para">Document:
                                                <span class="user-name"> {{$notification->data['nomD']}} </span> archivé
                                            </div>
                                            <div class="notification-meta-time"> {{$notification->created_at->diffForHumans()}} </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @foreach(Auth::user()->readNotifications->where('type','App\Notifications\NewTask')->take(10) as $notification)
                            <div class="dropdown-item">
                                <div class="media">
                                    <a class="row" href="{{url('user/taches')}}">   
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-send">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                        <div class="media-body">
                                            <div class="notification-para">Vous avez reçu une nouvelle tâche:
                                                <span class="user-name"> {{$notification->data['nomT']}} </span>
                                            </div>
                                            <div class="notification-meta-time"> {{$notification->created_at->diffForHumans()}} </div>
                                        </div>
                                    </a> 
                                </div>
                            </div>
                        @endforeach
                        {{Auth::user()->unreadNotifications->where('type','App\Notifications\NewTask')->markAsRead()}}
                        @foreach(Auth::user()->readNotifications->where('type','App\Notifications\archiveNotification')->take(10) as $notification)
                            <div class="dropdown-item">
                                <div class="media">
                                    <a class="row" href="#">   
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-send">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                        <div class="media-body">
                                            <div class="notification-para">Document:
                                                <span class="user-name"> {{$notification->data['nomD']}} </span> archivé
                                            </div>
                                            <div class="notification-meta-time"> {{$notification->created_at->diffForHumans()}} </div>
                                        </div>
                                    </a> 
                                </div>
                            </div>
                        @endforeach
                        {{Auth::user()->unreadNotifications->where('type','App\Notifications\archiveNotification')->markAsRead()}}
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-user-check">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <polyline points="17 11 19 13 23 9"></polyline>
                    </svg>
                </a>
                <div class="dropdown-menu position-absolute e-animated e-fadeInUp"
                    aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="http://localhost:8000/assets/img/Avatar/{{Auth::user()->photoU}}" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5> {{ Auth::user()->nomU }} {{ Auth::user()->prenomU }}</h5>
                                <p>{{ Auth::user()->professionU }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{url('profil')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg> <span>Mon Profil</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{url('mailbox')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-inbox">
                                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                <path
                                    d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                </path>
                            </svg> <span>Mes messages</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg> <span>Déconnexion</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
