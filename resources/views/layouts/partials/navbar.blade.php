<div class="navbar-custom">
  <div class="container">
    <div id="navigation">
      <!-- Navigation Menu-->
      <ul class="navigation-menu">

        @if (\Auth::check())
        <li class="">
          <a href="{{ url('/') }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i>Dashboard</a>
          
        </li>
        @role('Administrator')
        <li class="">
          <a href="{{ route('users.index') }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i>User</a>
          
        </li>
        <li class="has-submenu">
          <a href="#"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Master Data</a>
          <ul class="submenu">
            <li class="">
              <a href="{{ route('mst_perkara.index') }}">Data Perkara</a>
              <a href="{{ route('mst_uraian.index') }}">Data Uraian</a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="{{ route('trans_perkara.index_admin') }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i>Perkara</a>
          
        </li>
        @elserole('Penggugat')
        <li class="">
          <a href="{{ route('trans_perkara.index_penggugat') }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i>Perkara</a>
          
        </li>
        @endrole

      </ul>
      @endif
      <!-- End navigation menu -->
    </div> <!-- end #navigation -->
  </div> <!-- end container -->
</div>