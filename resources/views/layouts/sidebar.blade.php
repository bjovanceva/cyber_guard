
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
</script>
