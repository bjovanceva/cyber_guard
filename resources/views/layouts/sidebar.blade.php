
<style>
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        height: 100vh;
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
        color: #000000;
        padding: 2rem 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        overflow-y: auto;
        transition: all 0.3s ease;
    }

    .sidebar.collapsed {
        width: 70px;
    }

    .sidebar.collapsed .sidebar-brand,
    .sidebar.collapsed .sidebar-menu a span {
        display: none;
    }

    .sidebar-toggle {
        position: absolute;
        right: 0.5rem;
        top: 1rem;
        width: 40px;
        height: 40px;
        background: #000000;
        border: none;
        color: white;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        z-index: 1001;
    }

    .sidebar-toggle:hover {
        background: #616161;
        transform: scale(1.1);
    }

    .sidebar-brand {
        padding: 0 1.5rem 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 700;
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }

    .sidebar-brand i {
        font-size: 1.5rem;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        margin: 0;
    }

    .sidebar-menu li:first-child {
        margin-top: 0;
    }

    .sidebar.collapsed .sidebar-menu li:first-child {
        margin-top: 3rem;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        color: rgb(0, 0, 0);
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .sidebar-menu a:hover {
        background: #f1f5f9;
        color: #333232;
        border-left-color: #333232;
    }

    .sidebar-menu a.active {
        background: #f1f5f9;
        color: #333232;
        border-left-color: #333232;
        font-weight: 600;
    }

    .sidebar-menu i {
        width: 1.5rem;
        text-align: center;
        flex-shrink: 0;
    }

    .sidebar.collapsed .sidebar-menu a {
        padding: 1rem 0.5rem;
        justify-content: center;
    }

    .sidebar-user {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        border-top: 1px solid #e5e7eb;
        padding: 0.75rem;
        background: #ffffff;
    }

    .sidebar-user-button {
        width: 100%;
        border: none;
        background: transparent;
        padding: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        border-radius: 8px;
        transition: background 0.2s ease;
    }

    .sidebar-user-button:hover {
        background: #f1f5f9;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 0;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .user-avatar i {
        font-size: 1.1rem;
        color: #333232;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-width: 0;
    }

    .user-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: #222;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 140px;
    }

    .user-email {
        font-size: 0.75rem;
        color: #6b7280;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 140px;
    }

    .user-chevron {
        font-size: 0.8rem;
        color: #6b7280;
        transition: transform 0.2s ease;
    }

    .user-dropdown {
        display: none;
        margin-top: 0.5rem;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }

    .user-dropdown.show {
        display: block;
    }

    .user-dropdown a,
    .user-dropdown button {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border: none;
        background: transparent;
        color: #333232;
        text-decoration: none;
        font-size: 0.9rem;
        cursor: pointer;
        text-align: left;
    }

    .user-dropdown a:hover,
    .user-dropdown button:hover {
        background: #f1f5f9;
    }

    .user-dropdown i {
        width: 1.2rem;
    }
</style>

<div class="sidebar" id="sidebar">
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-chevron-left"></i>
    </button>
    <div class="sidebar-brand">
        <i class="bi bi-shield-exclamation"></i>
        <span>CyberGuard</span>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">><i class="bi bi-gear"></i><span>Home</span></a></li>
        <li><a href="{{ route('incidents.index') }}" class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}">><i class="bi bi-list-check"></i><span>All Incidents</span></a></li>
        <li><a href="{{ route('incidents.create') }}" class="{{ request()->routeIs('incidents.create') ? 'active' : '' }}">><i class="bi bi-plus-circle"></i><span>Report Incident</span></a></li>
        <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">><i class="bi bi-tags-fill"></i><span>All Categories</span></a></li>
        <li><a href="{{ route('categories.create') }}" class="{{ request()->routeIs('categories.create') ? 'active' : '' }}">><i class="bi bi-plus-circle"></i><span>Create Category</span></a></li>
{{--        <li><a href="#"><i class="bi bi-gear"></i><span>Settings</span></a></li>--}}
{{--        <li><a href="#"><i class="bi bi-question-circle"></i><span>Help</span></a></li>--}}
    </ul>

    @if(Auth::check())
    <div class="sidebar-user">
        <button class="sidebar-user-button" id="userDropdownToggle">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="user-details">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-email">{{ Auth::user()->email }}</span>
                </div>
            </div>

            <i class="bi bi-chevron-down user-chevron"></i>
        </button>

        <div class="user-dropdown" id="userDropdown">
            {{-- Profile - only keep this if you have profile.edit --}}
            {{--
            <a href="{{ route('profile.edit') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
            --}}

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
    @endif
</div>


<script>
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('contentWrapper');
    const sidebarToggle = document.getElementById('sidebarToggle');

    // Load saved state from localStorage
    const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (sidebarCollapsed) {
        sidebar.classList.add('collapsed');
        contentWrapper.classList.add('sidebar-collapsed');
        sidebarToggle.innerHTML = '<i class="bi bi-chevron-right"></i>';
    }

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        contentWrapper.classList.toggle('sidebar-collapsed');

        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);

        sidebarToggle.innerHTML = isCollapsed
            ? '<i class="bi bi-chevron-right"></i>'
            : '<i class="bi bi-chevron-left"></i>';
    });

    const userDropdownToggle = document.getElementById('userDropdownToggle');
    const userDropdown = document.getElementById('userDropdown');

    userDropdownToggle.addEventListener('click', () => {
        userDropdown.classList.toggle('show');
    });
</script>

