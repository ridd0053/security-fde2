<nav class="navbar navbar-expand-lg nav navbar-dark sticky-top shadow-sm">
  <h1 class="ml-5">Skyring</h1>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse collapse justify-content-end mr-5" id="navbarSupportedContent">
    <ul class="navbar-nav text-right">
      <li class="nav-item active">
        <a class="nav-link nav-link-color ml-4 {{ Request::is('/') ? 'active' : '' }}" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-link-color ml-4 {{ Request::is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
      </li>
      @auth
    <a class="nav-link nav-link-color ml-4 {{ Request::is('post') ? 'active' : '' }}" href="/post">Post</a>
    
    <li class="nav-item dropdown">
      
      <a id="navbarDropdown" class="nav-link nav-link-color ml-4 {{ Request::is('profiel') ? 'active' : '' }} nav-link dropdown-toggle" href="{{ route('home') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <img  src="/images/avatar/{{Auth::user()->avatar}}" alt="profiel foto {{Auth::user()->name}}" width="32px" height="32px">
        {{Auth::user()->name}}<span class="caret"></span>
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/profiel">
          Profiel 
         </a>
          @can('manage-users')
          <a class="dropdown-item" href="{{ route('admin.users.index') }}">
           User management
          </a>
          @endcan

         
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </div>
  </li>
    
    
    
    
    
    
    
    
    
    
    
    
    @else
      <li class="nav-item">
        <a class="nav-link nav-link-color ml-4 {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-link-color ml-4 {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
      </li>
      @endauth
    </ul>

  </div>
</nav>