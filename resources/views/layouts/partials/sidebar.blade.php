<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('index')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-building"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{env('APP_NAME')}}</div>
    </a>

    
    <hr class="sidebar-divider my-0">

    
    <li class="nav-item {{active('index')}}">
        <a class="nav-link" href="{{route('index')}}">
            <i class="fas fa-fw fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @if (auth()->user()->role == 'admin')
        <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-users"></i>
            <span>Data aparatur Desa</span>
        </a>
    </li>
    @endif
    @if (auth()->user()->role == 'admin')
    <li class="nav-item {{active('ketua-rt.index')}}">
        <a class="nav-link" href="{{route('ketua-rt.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Ketua RT</span>
        </a>
    </li>
    @endif
    {{-- <li class="nav-item {{active('data-rumah.index')}}">
        <a class="nav-link" href="{{route('data-rumah.index')}}">
            <i class="fas fa-fw fa-home"></i>
            <span>Data Rumah</span>
        </a>
    </li> --}}

    <li class="nav-item {{active('data-rumah.*')}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data-rumah"
            aria-expanded="true" aria-controls="data-rumah">
            <i class="fas fa-fw fa-home"></i>
            <span>Data Rumah</span>
        </a>
        <div id="data-rumah" class="collapse {{active('data-rumah.*','show')}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item {{active(['data-rumah.*','not:data-rumah.rekap'])}}" href="{{route('data-rumah.index')}}">Data Rumah</a>
                <a class="collapse-item {{active('data-rumah.rekap')}}" href="{{route('data-rumah.rekap')}}">Rekap</a>
                {{-- <a class="collapse-item" href="cards.html">Cards</a> --}}
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
        <i class="fas fa-fw fa-users"></i>
        <span>Data Penduduk</span>
         </a>
         </li>
    @if (auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="#">
        <i class="fas fa-fw fa-users"></i>
        <span>Data Kematian</span>
         </a>
    </li>
     @endif
    @if (auth()->user()->role == 'admin')
    <li class="nav-item {{active('user.index')}}">
        <a class="nav-link" href="{{route('user.index')}}">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>User</span>
        </a>
    </li>
    @endif

    {{-- <div class="sidebar-heading">
        Interface
    </div> --}}

    
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    

</ul>