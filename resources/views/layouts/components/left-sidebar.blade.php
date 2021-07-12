  <!-- Sidebar Holder -->
  <aside id="sidebar" class="">
    <div class="sidebar-header">
        <div class="title">{{env('APP_NAME')}}</div>
    </div>
     <!-- User Info -->
     <div class="user-info">
        <div class="info-container">
            <div class="user-icon">
                <i class="material-icons">account_circle</i>
            </div>
            <div class="user-details">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{MyHelper::decrypt(Session::get('FullName'))}}</div>
                <div class="position">{{MyHelper::decrypt(Session::get('Position'))}}</div>
            </div>
        </div>
    </div>

    <div class="pages-title">
        MAIN NAVIGATION
    </div>
    <!-- #User Info -->
    <ul class="list-group components">
            <li class="list-group-item {{ request()->is('home*') ? 'active' : '' }}">
                <a href="{{ URL::to('/home') }} ">
                    <i class="material-icons">book</i>
                    <span class="icon-name">Monitoring</span>
                </a>
            </li>
            <li class="selfieOpt list-group-item {{ request()->is('selfie*') ? 'active' : '' }}">
                <a href="{{ URL::to('/selfie') }} ">
                    <i class="material-icons">photo_camera</i>
                    <span class="icon-name">Selfie</span>
                </a>
            </li>
            <li class="list-group-item {{ request()->is('logsheet*') ? 'active' : '' }}">
                <a href="{{ URL::to('/logsheet') }} ">
                    <i class="material-icons">note_alt</i>
                    <span class="icon-name">Manual Log</span>
                </a>
            </li>
            @php
                $checkAccessParams['userAccess'] = Session::get('UserAccess');
                $checkAccessParams['moduleID'] = env('MODULE_APPROVAL');
            @endphp
            @if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_ALL')]))
            <li class="list-group-item {{ request()->is('approval*') ? 'active' : '' }}">
                <a href="{{ URL::to('/approval') }} ">
                    <i class="material-icons">approval</i>
                    <span class="icon-name">Approval</span>
                </a>
            </li>
            @endif
        <li class="list-group-item">
            <a href="{{ URL::to('/logout') }}">
                <i class="material-icons">input</i>
                <span class="icon-name">Logout</span>
            </a>
        </li>
    </ul>
</aside>
