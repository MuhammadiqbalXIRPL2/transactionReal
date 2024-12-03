<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">DashBoard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Ds</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('transaction') ? 'active' : '' }}">
                <a href="{{ url('/transaction') }}" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('table') ? 'active' : '' }}">
                <a href="{{ url('/table') }}" class="nav-link">
                    <i class="fa-solid fa-table"></i>
                    <span>Table</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
