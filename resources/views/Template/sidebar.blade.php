<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
          <a href="">DashBoard</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
          <a href="index.html">Ds</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="dropdown">
              <li class="{{ request()->is('transaksi') ? 'active' : '' }}">
                  <a href="{{ url('/transaksi') }}" class="nav-link">
                      <i class="fas fa-fire" ></i><span>Dashboard</span>
                  </a>
              </li>
              <li class="{{ request()->is('table') ? 'active' : '' }}">
                  <a href="{{ url('/table') }}" class="nav-link">
                      <i class="fa-solid fa-table" style="margin-right: 0px;"></i><span>Table</span>
                  </a>
              </li>
          </li>
      </ul>
  </aside>
</div>
