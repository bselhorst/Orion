<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
  <!-- Brand Logo Light -->
  <a href="index.php" class="logo logo-light">
    <span class="logo-lg">
      <img src="{{ asset('assets/images/logo-LARGO-removebg.png') }}" alt="logo" style="height: 52px"/>
    </span>
    <span class="logo-sm" style="margin-left: -13px">
      <img src="{{ asset('assets/images/logo-ICO-removebg.png') }}" alt="small logo" style="height: 52px" />
    </span>
  </a>

  <!-- Brand Logo Dark -->
  <a href="index.php" class="logo logo-dark">
    <span class="logo-lg">
      <img src="{{ asset('assets/images/logo-LARGO-removebg.png') }}" alt="dark logo" />
    </span>
    <span class="logo-sm">
      <img src="{{ asset('assets/images/logo-ICO-removebg.png') }}" alt="small logo" />
    </span>
  </a>

  <!-- Sidebar Hover Menu Toggle Button -->
  <div
    class="button-sm-hover"
    data-bs-toggle="tooltip"
    data-bs-placement="right"
    title="Show Full Sidebar"
  >
    <i class="ri-checkbox-blank-circle-line align-middle"></i>
  </div>

  <!-- Full Sidebar Menu Close Button -->
  <div class="button-close-fullsidebar">
    <i class="ri-close-fill align-middle"></i>
  </div>

  <!-- Sidebar -left -->
  <div class="h-100" id="leftside-menu-container" data-simplebar>
    <!-- Leftbar User -->
    {{-- <div class="leftbar-user">
      <a href="pages-profile.php">
        <img
          src="assets/images/users/avatar-1.jpg"
          alt="user-image"
          height="42"
          class="rounded-circle shadow-sm"
        />
        <span class="leftbar-user-name mt-2">Tosha Minner</span>
      </a>
    </div> --}}

    <!--- Sidemenu -->
    <ul class="side-nav">
      <li class="side-nav-title">Navigation</li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarDashboards"
          aria-expanded="false"
          aria-controls="sidebarDashboards"
          class="side-nav-link"
        >
          <i class="ri-home-4-line"></i>
          <span class="badge bg-success float-end">2</span>
          <span> Dashboards </span>
        </a>
        <div class="collapse" id="sidebarDashboards">
          <ul class="side-nav-second-level">
            <li>
              <a href="dashboard-analytics.php">Analytics</a>
            </li>
            <li>
              <a href="index.php">Ecommerce</a>
            </li>
          </ul>
        </div>
      </li>

      {{-- <li class="side-nav-title">Apps</li>

      <li class="side-nav-item">
        <a href="apps-calendar.php" class="side-nav-link">
          <i class="ri-calendar-event-line"></i>
          <span> Calendar </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a href="apps-chat.php" class="side-nav-link">
          <i class="ri-message-3-line"></i>
          <span> Chat </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarEmail"
          aria-expanded="false"
          aria-controls="sidebarEmail"
          class="side-nav-link"
        >
          <i class="ri-mail-line"></i>
          <span> Email </span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEmail">
          <ul class="side-nav-second-level">
            <li>
              <a href="apps-email-inbox.php">Inbox</a>
            </li>
            <li>
              <a href="apps-email-read.php">Read Email</a>
            </li>
          </ul>
        </div>
      </li> --}}

      @canany(['projeto.create', 'projeto.read', 'projeto.update', 'projeto.delete'])
      <li class="side-nav-title">Orçamento</li>
      <li class="side-nav-item">
        <a href="/projetos/grafico" class="side-nav-link">
          <i class="ri-pie-chart-line"></i>
          <span> Dashboard </span>
        </a>
      </li>
      <li class="side-nav-item">
        <a href="/projetos" class="side-nav-link">
          <i class="ri-file-list-line"></i>
          <span> Projetos </span>
        </a>
      </li>
      @endcanany

      @canany(['user.create', 'user.read', 'user.update', 'user.delete'])
      <li class="side-nav-title">Admin</li>
      <li class="side-nav-item">
        <a href="/users" class="side-nav-link">
          <i class="ri-calendar-event-line"></i>
          <span> Usuarios </span>
        </a>
      </li>
      @endcanany

    </ul>
    <!--- End Sidemenu -->

    <div class="clearfix"></div>
  </div>
</div>
<!-- ========== Left Sidebar End ========== -->
