@extends(env('THEME_BACK').'.back.layout')


@section('css')
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css') }}">
@endsection

@section('sidebar')
  <div class="sidebar" data-color="orange">
    {{-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" --}}
    <div class="logo">
      <a href="http://www.creative-tim.com" class="simple-text logo-mini">
        CT
      </a>
      <a href="http://www.creative-tim.com" class="simple-text logo-normal">
        Creative Tim
      </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li>
          <a href="./dashboard.html">
            <i class="now-ui-icons design_app"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li>
          <a href="./icons.html">
            <i class="now-ui-icons education_atom"></i>
            <p>Icons</p>
          </a>
        </li>
        <li>
          <a href="./map.html">
            <i class="now-ui-icons location_map-big"></i>
            <p>Maps</p>
          </a>
        </li>
        <li>
          <a href="./notifications.html">
            <i class="now-ui-icons ui-1_bell-53"></i>
            <p>Notifications</p>
          </a>
        </li>
        <li class="active ">
          <a href="./user.html">
            <i class="now-ui-icons users_single-02"></i>
            <p>User Profile</p>
          </a>
        </li>
        <li>
          <a href="./tables.html">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>Table List</p>
          </a>
        </li>
        <li>
          <a href="./typography.html">
            <i class="now-ui-icons text_caps-small"></i>
            <p>Typography</p>
          </a>
        </li>
        <li class="active-pro">
          <a href="./upgrade.html">
            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
            <p>Upgrade to PRO</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
@endsection


@section('navbar')
    <nav class="navbar navbar-expand-lg fixed-top navbar-transparent  bg-primary  navbar-absolute">
      <div class="container-fluid">
        <div class="navbar-wrapper">
          <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </button>
          </div>
          <a class="navbar-brand" href="#pablo">User Profile</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
          <form>
            @csrf
            <div class="input-group no-border">
              <input type="text" value="" class="form-control" placeholder="Search...">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="now-ui-icons ui-1_zoom-bold"></i>
                </div>
              </div>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#pablo">
                <i class="now-ui-icons media-2_sound-wave"></i>
                <p>
                  <span class="d-lg-none d-md-block">Stats</span>
                </p>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="now-ui-icons location_world"></i>
                <p>
                  <span class="d-lg-none d-md-block">Some Actions</span>
                </p>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pablo">
                <i class="now-ui-icons users_single-02"></i>
                <p>
                  <span class="d-lg-none d-md-block">Account</span>
                </p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
@endsection


@section('footer')
    <footer class="footer">
      <div class="container">
        <div class="copyright" id="copyright">
          &copy;
          <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
          </script>, Coded by
          <a href="#" target="_blank">Viktor Prilepin</a>.
        </div>
      </div>
    </footer>
@endsection


@section('modals')
  @include(env('THEME_BACK').'.back.modals')
@endsection


@section('js')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('js/datatables.js') }}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
      $(document).ready(function () {
        $('#dataTables-example').DataTable({
          responsive: true
        });
      });
    </script>
@endsection