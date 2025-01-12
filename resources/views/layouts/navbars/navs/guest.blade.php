<!-- Navbar -->

<style>
  .activo2{
  
  text-decoration: none; 
  text-shadow: 0 0 10px #ffffff, 0 0 20px #ffffff, 0 0 20px #ffffff;
  color: rgb(255, 255, 255);

} 
@keyframes shadow-pulse {
  0% {
    text-shadow: 0 0 0 0 #feffce;
  }
  100% {
    text-shadow: 0 0 8px 16px rgba(255, 255, 255, 0);
  }
}
</style>

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand text-black font-weight-bold" href="{{ route('home') }}">DevJobs</a>
      <a class="ml-0" href="#"><br>
        <span class="text-white activo2 text-sm">By MiguelMontealegre </span></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="material-icons">dashboard</i> {{ __('Inicio') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->