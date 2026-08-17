@extends('layouts.sidebar')

<style>
    body {
        background: #f5f7fb;
    }

    .content-wrapper {
        margin-left: 250px;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    .content-wrapper.sidebar-collapsed {
        margin-left: 70px;
    }

    .hero-card,
    .info-card,
    .action-card {
        border: none;
        border-radius: 14px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .hero-card:hover,
    .info-card:hover,
    .action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 .75rem 1.75rem rgba(0, 0, 0, .08);
    }

    .hero-card {
        background: linear-gradient(135deg, #111827 0%, #c82333 100%);
        color: #fff;
        overflow: hidden;
        position: relative;
    }

    .hero-card::after {
        content: "";
        position: absolute;
        inset: auto -80px -80px auto;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
    }

    .hero-kicker {
        letter-spacing: .12em;
        text-transform: uppercase;
        font-size: .78rem;
        font-weight: 700;
        color: rgba(255, 255, 255, .8);
    }

    .hero-title {
        font-weight: 800;
        font-size: clamp(2rem, 4vw, 3.5rem);
        line-height: 1.05;
        margin: .5rem 0 1rem;
    }

    .hero-text {
        color: rgba(255, 255, 255, .9);
        max-width: 42rem;
        margin-bottom: 1.5rem;
    }

    .hero-actions .btn {
        border-radius: 999px;
        padding: .8rem 1.25rem;
        font-weight: 600;
    }

    .hero-visual {
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 18px;
        padding: 1.25rem;
        backdrop-filter: blur(10px);
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }

    .stat-item {
        background: rgba(255, 255, 255, .08);
        border-radius: 14px;
        padding: 1rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1;
    }

    .stat-label {
        margin-top: .35rem;
        color: rgba(255, 255, 255, .75);
        font-size: .85rem;
    }

    .section-title {
        font-weight: 800;
        margin-bottom: .35rem;
    }

    .section-subtitle {
        color: #6b7280;
        margin-bottom: 0;
    }

    .info-icon,
    .action-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .info-card {
        background: #fff;
        border: 1px solid #e5e7eb;
    }

    .info-card .card-text {
        color: #6b7280;
    }

    .action-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        height: 100%;
    }

    .action-card a {
        color: inherit;
        text-decoration: none;
    }

    .action-card .card-text {
        color: #6b7280;
    }

    .action-list {
        display: flex;
        flex-direction: column;
        gap: .75rem;
    }

    .action-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 1.1rem;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        text-decoration: none;
        color: inherit;
        transition: all .2s ease;
        background: #fff;
    }

    .action-item:hover {
        border-color: #d1d5db;
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1.2rem rgba(0, 0, 0, .05);
        text-decoration: none;
        color: inherit;
    }

    .action-item-left {
        display: flex;
        align-items: center;
        gap: .9rem;
        min-width: 0;
    }

    .action-item-copy {
        min-width: 0;
    }

    .action-item-title {
        font-weight: 700;
        margin-bottom: .15rem;
        color: #111827;
    }

    .action-item-text {
        color: #6b7280;
        font-size: .9rem;
        margin-bottom: 0;
    }

    .action-arrow {
        color: #9ca3af;
        flex-shrink: 0;
    }

    .mini-panel {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
    }

    .mini-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: .9rem 0;
        border-bottom: 1px solid #eef2f7;
    }

    .mini-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .mini-row:first-child {
        padding-top: 0;
    }

    @media (max-width: 991.98px) {
        .content-wrapper {
            margin-left: 0;
        }

        .stat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="content-wrapper" id="contentWrapper">
    <div class="container py-5">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <div class="hero-card shadow-sm p-4 p-lg-5 mb-4">
            <div class="row align-items-center position-relative">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="hero-kicker">Cyber incident response platform</div>
                    <h1 class="hero-title">Monitor, report, and manage security incidents in one place.</h1>
                    <p class="hero-text">
                        CyberGuard helps your team capture incidents, let AI classify them, and keep response work visible from first report to resolution.
                    </p>

                    <div class="hero-actions d-flex flex-wrap" style="gap:.75rem;">
                        @auth
                            <a href="{{ route('incidents.create') }}" class="btn btn-light text-dark">
                                <i class="bi bi-plus-circle mr-2"></i>Report Incident
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light text-dark">
                                <i class="bi bi-box-arrow-in-right mr-2"></i>Sign In
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light">
                                <i class="bi bi-person-plus mr-2"></i>Create Account
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="hero-visual">
                        <div class="stat-grid">
                            <div class="stat-item">
                                <div class="stat-value">24/7</div>
                                <div class="stat-label">Incident visibility</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">Fast</div>
                                <div class="stat-label">Report turnaround</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">AI</div>
                                <div class="stat-label">Auto classification</div>
                            </div>
                        </div>
                        <div class="mt-4 mini-panel p-3">
                            <div class="mini-row">
                                <div>
                                    <div class="font-weight-bold text-dark">Incident intake</div>
                                    <small class="text-muted">Log and review reports quickly.</small>
                                </div>
                                <i class="bi bi-shield-check text-danger"></i>
                            </div>
                            <div class="mini-row">
                                <div>
                                    <div class="font-weight-bold text-dark">Category management</div>
                                    <small class="text-muted">Keep classifications organized.</small>
                                </div>
                                <i class="bi bi-tags-fill text-danger"></i>
                            </div>
                            <div class="mini-row">
                                <div>
                                    <div class="font-weight-bold text-dark">Resolution tracking</div>
                                    <small class="text-muted">Follow every update to closure.</small>
                                </div>
                                <i class="bi bi-clipboard-data text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-end mb-3">
            <div>
                <h3 class="section-title">What you can do</h3>
                <p class="section-subtitle">Use the same interface style as the rest of the app.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card info-card shadow-sm h-100 p-4">
                    <div class="info-icon bg-danger text-white mb-3">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h5 class="font-weight-bold">Report incidents</h5>
                    <p class="card-text mb-0">Capture incident details and evidence in a structured form.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card info-card shadow-sm h-100 p-4">
                    <div class="info-icon bg-dark text-white mb-3">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <h5 class="font-weight-bold">Review reports</h5>
                    <p class="card-text mb-0">Browse reported incidents and follow their status.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card info-card shadow-sm h-100 p-4">
                    <div class="info-icon bg-primary text-white mb-3">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <h5 class="font-weight-bold">AI classification</h5>
                    <p class="card-text mb-0">Let the system tag incidents automatically.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card action-card shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="section-title mb-1">Main paths</h4>
                            <p class="section-subtitle">Simple entry points without the grid-card feel.</p>
                        </div>
                        <span class="badge badge-light px-3 py-2">Start here</span>
                    </div>

                    <div class="action-list">
                        <a class="action-item" href="{{ route('login') }}">
                            <div class="action-item-left">
                                <div class="action-icon bg-dark text-white">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </div>
                                <div class="action-item-copy">
                                    <div class="action-item-title">Log in</div>
                                    <p class="action-item-text">Sign in before reporting an incident.</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right action-arrow"></i>
                        </a>

                        <a class="action-item" href="{{ auth()->check() ? route('incidents.create') : route('login') }}">
                            <div class="action-item-left">
                                <div class="action-icon bg-danger text-white">
                                    <i class="bi bi-plus-circle"></i>
                                </div>
                                <div class="action-item-copy">
                                    <div class="action-item-title">Report an incident</div>
                                    <p class="action-item-text">Create a new report in a clean form flow.</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right action-arrow"></i>
                        </a>

                        <a class="action-item" href="{{ auth()->check() ? route('incidents.index') : route('login') }}">
                            <div class="action-item-left">
                                <div class="action-icon bg-dark text-white">
                                    <i class="bi bi-folder2-open"></i>
                                </div>
                                <div class="action-item-copy">
                                    <div class="action-item-title">Review incidents</div>
                                    <p class="action-item-text">Browse the current incident queue.</p>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right action-arrow"></i>
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card action-card shadow-sm p-4">
                    <h4 class="section-title mb-1">Workflow</h4>
                    <p class="section-subtitle mb-3">A simple path from report to response.</p>

                    <div class="mini-row">
                        <div>
                            <div class="font-weight-bold text-dark">1. Capture</div>
                            <small class="text-muted">Record the incident details.</small>
                        </div>
                        <i class="bi bi-pencil-square text-danger"></i>
                    </div>
                    <div class="mini-row">
                        <div>
                            <div class="font-weight-bold text-dark">2. AI review</div>
                            <small class="text-muted">The AI assigns the right tag.</small>
                        </div>
                        <i class="bi bi-tags text-danger"></i>
                    </div>
                    <div class="mini-row">
                        <div>
                            <div class="font-weight-bold text-dark">3. Resolve</div>
                            <small class="text-muted">Track progress until closure.</small>
                        </div>
                        <i class="bi bi-check2-circle text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
