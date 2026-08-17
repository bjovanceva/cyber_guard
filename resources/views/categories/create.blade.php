@extends('layouts.sidebar')


<style>
    body {
        background: #f5f7fb;
    }

    /*.sidebar {*/
    /*    position: fixed;*/
    /*    left: 0;*/
    /*    top: 0;*/
    /*    width: 250px;*/
    /*    height: 100vh;*/
    /*    background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);*/
    /*    color: #000000;*/
    /*    padding: 2rem 0;*/
    /*    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);*/
    /*    z-index: 1000;*/
    /*    overflow-y: auto;*/
    /*    transition: all 0.3s ease;*/
    /*}*/

    /*.sidebar.collapsed {*/
    /*    width: 70px;*/
    /*}*/

    /*.sidebar.collapsed .sidebar-brand,*/
    /*.sidebar.collapsed .sidebar-menu a span {*/
    /*    display: none;*/
    /*}*/

    /*.sidebar-toggle {*/
    /*    position: absolute;*/
    /*    right: 0.5rem;*/
    /*    top: 1rem;*/
    /*    width: 40px;*/
    /*    height: 40px;*/
    /*    background: #000000;*/
    /*    border: none;*/
    /*    color: white;*/
    /*    border-radius: 6px;*/
    /*    cursor: pointer;*/
    /*    display: flex;*/
    /*    align-items: center;*/
    /*    justify-content: center;*/
    /*    transition: all 0.3s ease;*/
    /*    font-size: 1.2rem;*/
    /*    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);*/
    /*    z-index: 1001;*/
    /*}*/

    /*.sidebar-toggle:hover {*/
    /*    background: #616161;*/
    /*    transform: scale(1.1);*/
    /*}*/

    /*.sidebar-brand {*/
    /*    padding: 0 1.5rem 2rem;*/
    /*    border-bottom: 1px solid rgba(255, 255, 255, 0.2);*/
    /*    margin-bottom: 1.5rem;*/
    /*    display: flex;*/
    /*    align-items: center;*/
    /*    gap: 0.75rem;*/
    /*    font-weight: 700;*/
    /*    font-size: 1.25rem;*/
    /*    transition: all 0.3s ease;*/
    /*}*/

    /*.sidebar-brand i {*/
    /*    font-size: 1.5rem;*/
    /*}*/

    /*.sidebar-menu {*/
    /*    list-style: none;*/
    /*    padding: 0;*/
    /*    margin: 0;*/
    /*}*/

    /*.sidebar-menu li {*/
    /*    margin: 0;*/
    /*}*/

    /*.sidebar-menu li:first-child {*/
    /*    margin-top: 0;*/
    /*}*/

    /*.sidebar.collapsed .sidebar-menu li:first-child {*/
    /*    margin-top: 3rem;*/
    /*}*/

    /*.sidebar-menu a {*/
    /*    display: flex;*/
    /*    align-items: center;*/
    /*    gap: 0.75rem;*/
    /*    padding: 1rem 1.5rem;*/
    /*    color: rgb(0, 0, 0);*/
    /*    text-decoration: none;*/
    /*    transition: all 0.3s ease;*/
    /*    border-left: 3px solid transparent;*/
    /*}*/

    /*.sidebar-menu a:hover {*/
    /*    background: rgba(255, 255, 255, 0.1);*/
    /*    color: #000000;*/
    /*    border-left-color: white;*/
    /*}*/

    /*.sidebar-menu a.active {*/
    /*    background: rgba(255, 255, 255, 0.2);*/
    /*    color: #000000;*/
    /*    border-left-color: white;*/
    /*}*/

    /*.sidebar-menu i {*/
    /*    width: 1.5rem;*/
    /*    text-align: center;*/
    /*    flex-shrink: 0;*/
    /*}*/

    /*.sidebar.collapsed .sidebar-menu a {*/
    /*    padding: 1rem 0.5rem;*/
    /*    justify-content: center;*/
    /*}*/

    .content-wrapper {
        margin-left: 250px;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    .content-wrapper.sidebar-collapsed {
        margin-left: 70px;
    }

    .form-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 2rem 0;
    }

    .form-header {
        background: linear-gradient(135deg, #359cdc 0%, #2339c8 100%);
        padding: 1.25rem 1.75rem;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-header h2 {
        color: white;
        margin-bottom: 0;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .form-header h2 i {
        margin-right: 0.75rem;
    }

    .form-header p {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0;
        margin-top: 0.5rem;
        font-size: 0.9rem;
        display: block;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #212529;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #359cdc;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        background-color: #fff5f6;
    }

    .form-control::placeholder {
        color: #6c757d;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #e9ecef;
    }

    .file-input-wrapper input[type="file"] {
        display: none;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #359cdc 0%, #2339c8 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        justify-content: center;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #359cdc;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        color: #2339c8;
        gap: 0.75rem;
    }
</style>

{{--<div class="sidebar" id="sidebar">--}}
{{--    <button class="sidebar-toggle" id="sidebarToggle">--}}
{{--        <i class="bi bi-chevron-left"></i>--}}
{{--    </button>--}}
{{--    <div class="sidebar-brand">--}}
{{--        <i class="bi bi-shield-exclamation"></i>--}}
{{--        <span>CyberGuard</span>--}}
{{--    </div>--}}
{{--    <ul class="sidebar-menu">--}}
{{--        <li><a href="{{ route('incidents.index') }}"><i class="bi bi-list-check"></i><span>All Incidents</span></a></li>--}}
{{--        <li><a href="{{ route('incidents.create') }}" class="active"><i class="bi bi-plus-circle"></i><span>Report Incident</span></a></li>--}}
{{--        <li><a href="{{ route('categories.index') }}" class="active"><i class="bi bi-list"></i><span>All Categories</span></a></li>--}}
{{--        <li><a href="{{ route('categories.create') }}" class="active"><i class="bi bi-list"></i><span>Create Category</span></a></li>--}}
{{--        <li><a href="#"><i class="bi bi-gear"></i><span>Settings</span></a></li>--}}
{{--        <li><a href="#"><i class="bi bi-question-circle"></i><span>Help</span></a></li>--}}
{{--    </ul>--}}
{{--</div>--}}

<div class="content-wrapper" id="contentWrapper">
    <div class="form-container">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Back Button -->
        <a href="{{ route('categories.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>Back to Categories
        </a>

        <!-- Header -->
        <div class="form-header">
            <h2>
                <i class="bi bi-plus-circle me-2"></i>Create Category
            </h2>
            <p>Please provide detailed information about the category</p>
        </div>

        <!-- Form -->
        <div class="form-card">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="bi bi-pencil me-2" style="color: #2339c8;"></i>Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter category name..."
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                    <div class="text-danger mt-2" style="font-size: 0.85rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="form-label">
                        <i class="bi bi-file-text me-2" style="color: #2339c8;"></i>Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Describe the category in detail..."
                        value="{{ old('description') }}"
                    ></textarea>
                    @error('description')
                    <div class="text-danger mt-2" style="font-size: 0.85rem;">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i>Create Category
                </button>
            </form>
        </div>
    </div>

{{--    <script>--}}
{{--        const sidebar = document.getElementById('sidebar');--}}
{{--        const contentWrapper = document.getElementById('contentWrapper');--}}
{{--        const sidebarToggle = document.getElementById('sidebarToggle');--}}

{{--        // Load saved state from localStorage--}}
{{--        const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';--}}
{{--        if (sidebarCollapsed) {--}}
{{--            sidebar.classList.add('collapsed');--}}
{{--            contentWrapper.classList.add('sidebar-collapsed');--}}
{{--            sidebarToggle.innerHTML = '<i class="bi bi-chevron-right"></i>';--}}
{{--        }--}}

{{--        sidebarToggle.addEventListener('click', () => {--}}
{{--            sidebar.classList.toggle('collapsed');--}}
{{--            contentWrapper.classList.toggle('sidebar-collapsed');--}}

{{--            const isCollapsed = sidebar.classList.contains('collapsed');--}}
{{--            localStorage.setItem('sidebarCollapsed', isCollapsed);--}}

{{--            sidebarToggle.innerHTML = isCollapsed--}}
{{--                ? '<i class="bi bi-chevron-right"></i>'--}}
{{--                : '<i class="bi bi-chevron-left"></i>';--}}
{{--        });--}}
{{--    </script>--}}

</div>
</div>

