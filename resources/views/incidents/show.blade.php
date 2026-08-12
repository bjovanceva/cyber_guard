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

    .dashboard-card {
        border: none;
        border-radius: 12px;
        transition: .25s;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 .6rem 1.6rem rgba(0, 0, 0, .06);
    }

    .badge {
        font-size: .8rem;
    }

    .card {
        border-radius: 12px;
    }

    .incident-title {
        font-weight: 600;
        font-size: 1.2rem;
    }

    .incident-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .detail-box {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 .2rem .4rem rgba(0, 0, 0, .05);
        transition: .25s;
    }

    .detail-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 .4rem 1rem rgba(0, 0, 0, .1);
    }

    .detail-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #6c757d;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        font-size: 1rem;
        font-weight: 600;
        color: #212529;
    }

    .detail-subtext {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    .evidence-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .evidence-item {
        display: flex;
        flex-direction: row;
        border-radius: 10px;
        overflow: hidden;
        background: white;
        border: 2px solid #f0f0f0;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        height: 70px;
    }

    .evidence-item:hover {
        transform: translateX(4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, .15);
        border-color: #667eea;
    }

    .evidence-item a {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: row;
        height: 100%;
        width: 100%;
    }

    .evidence-preview {
        width: 120px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8f9fa;
        position: relative;
        flex-shrink: 0;
    }

    .evidence-item.img .evidence-preview {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    }

    .evidence-item.video .evidence-preview {
        background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
    }

    .evidence-item.pdf .evidence-preview {
        background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
    }

    .evidence-item.file .evidence-preview {
        background: linear-gradient(135deg, #f3e5f5 0%, #ede7f6 100%);
    }

    .evidence-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .evidence-icon {
        font-size: 2.5rem;
        color: #667eea;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .evidence-item.video .evidence-icon {
        color: #764ba2;
    }

    .evidence-item.pdf .evidence-icon {
        color: #f59e0b;
    }

    .evidence-item.file .evidence-icon {
        color: #8b5cf6;
    }

    .evidence-info {
        padding: 1rem;
        background: white;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: center;
        border-left: 1px solid #f0f0f0;
    }

    .evidence-label {
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        word-break: break-word;
        line-height: 1.3;
        margin-bottom: 0.4rem;
    }

    .evidence-type {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        width: fit-content;
    }

    .evidence-type.img-type {
        background: #dbeafe;
        color: #1e40af;
    }

    .evidence-type.video-type {
        background: #e9d5ff;
        color: #581c87;
    }

    .evidence-type.pdf-type {
        background: #fed7aa;
        color: #92400e;
    }

    .evidence-type.file-type {
        background: #ede9fe;
        color: #5b21b6;
    }
</style>

<div class="content-wrapper" id="contentWrapper">
<div class="container py-5">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('incidents.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-2"></i>Back to Incidents
        </a>
    </div>

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-shield-exclamation text-danger"></i>
            {{ $incident->title }}
        </h2>
        <p class="text-muted mb-0">
            <i class="bi bi-clock-history me-1"></i>
            {{ $incident->description ? Str::limit($incident->description, 100) : 'No description' }}
        </p>
    </div>

    <!-- Detail Cards Grid -->
    <div class="detail-grid">

        <!-- Status -->
        <div class="detail-box">
            <div class="detail-label">
                <i class="bi bi-info-circle me-1"></i>Status
            </div>
            <div>
                @if($incident->status == 'Pending')
                    <span class="badge bg-warning text-dark">⏳ Pending</span>
                @elseif($incident->status == 'Resolved')
                    <span class="badge bg-success text-white">✔ Resolved</span>
                @elseif($incident->status == 'Rejected')
                    <span class="badge bg-danger text-white">✖ Rejected</span>
                @else
                    <span class="badge bg-info text-white">{{ $incident->status }}</span>
                @endif
            </div>
        </div>

        <!-- Category -->
        <div class="detail-box">
            <div class="detail-label">
                <i class="bi bi-tag me-1"></i>Category
            </div>
            @if($incident->category)
                <span class="badge bg-secondary text-white">{{ $incident->category->name }}</span>
            @else
                <span class="text-muted">Not assigned</span>
            @endif
        </div>

        <!-- Date Reported -->
        <div class="detail-box">
            <div class="detail-label">
                <i class="bi bi-calendar-event me-1"></i>Date Reported
            </div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($incident->date_reported)->format('d M Y') }}</div>
            <div class="detail-subtext">{{ \Carbon\Carbon::parse($incident->date_reported)->format('H:i A') }}</div>
        </div>

        <!-- Incident ID -->
        <div class="detail-box">
            <div class="detail-label">
                <i class="bi bi-hash me-1"></i>Incident ID
            </div>
            <div class="detail-value" style="font-family: monospace; color: #0d6efd;">#{{ str_pad($incident->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>

        @if($incident->user)
        <!-- Reporter -->
        <div class="detail-box">
            <div class="detail-label">
                <i class="bi bi-person me-1"></i>Reported By
            </div>
            <div class="detail-value">{{ $incident->user->name }}</div>
        </div>
        @endif


    </div>

    <!-- Description Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 p-4">
            <h5 class="mb-0">
                <i class="bi bi-file-text me-2"></i>Full Description
            </h5>
        </div>
        <div class="card-body p-4">
            <p class="mb-0" style="line-height: 1.6; color: #495057;">{{ $incident->description }}</p>
        </div>
    </div>

    <!-- Evidence Card -->
    @if($incident->proofs->count() > 0)
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 p-4">
            <h5 class="mb-0">
                <i class="bi bi-image me-2"></i>Evidence & Attachments
            </h5>
        </div>
        <div class="card-body p-4">
            <div class="evidence-grid">
                @foreach($incident->proofs as $proof)
                    @if(Str::startsWith($proof->file_type, 'image'))
                        <div class="evidence-item img">
                            <a href="{{ asset('storage/' . $proof->file_path) }}" target="_blank" data-lightbox="evidence">
                                <div class="evidence-preview">
                                    <img src="{{ asset('storage/' . $proof->file_path) }}" alt="{{ $proof->file_name }}">
                                </div>
                                <div class="evidence-info">
                                    <div class="evidence-label">{{ $proof->file_name }}</div>
                                    <span class="evidence-type img-type">
                                        <i class="bi bi-image"></i>Image
                                    </span>
                                </div>
                            </a>
                        </div>
                    @elseif(Str::startsWith($proof->file_type, 'video'))
                        <div class="evidence-item video">
                            <a href="{{ asset('storage/' . $proof->file_path) }}" target="_blank">
                                <div class="evidence-preview">
                                    <i class="bi bi-play-circle evidence-icon"></i>
                                </div>
                                <div class="evidence-info">
                                    <div class="evidence-label">{{ $proof->file_name }}</div>
                                    <span class="evidence-type video-type">
                                        <i class="bi bi-film"></i>Video
                                    </span>
                                </div>
                            </a>
                        </div>
                    @elseif($proof->file_type == 'application/pdf')
                        <div class="evidence-item pdf">
                            <a href="{{ asset('storage/' . $proof->file_path) }}" target="_blank">
                                <div class="evidence-preview">
                                    <i class="bi bi-file-pdf evidence-icon"></i>
                                </div>
                                <div class="evidence-info">
                                    <div class="evidence-label">{{ $proof->file_name }}</div>
                                    <span class="evidence-type pdf-type">
                                        <i class="bi bi-file-earmark-pdf"></i>PDF
                                    </span>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="evidence-item file">
                            <a href="{{ asset('storage/' . $proof->file_path) }}" target="_blank">
                                <div class="evidence-preview">
                                    <i class="bi bi-file-earmark evidence-icon"></i>
                                </div>
                                <div class="evidence-info">
                                    <div class="evidence-label">{{ $proof->file_name }}</div>
                                    <span class="evidence-type file-type">
                                        <i class="bi bi-file"></i>File
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4 text-center text-muted">
            <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.5;"></i>
            <p class="mt-3 mb-0">No evidence or attachments provided</p>
        </div>
    </div>
    @endif

    <!-- AI Summary (if exists) -->
    @if($incident->summarizedIncident)
    <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%); border-left: 4px solid #0284c7;">
        <div class="card-body p-4">
            <h5 class="mb-3">
                <i class="bi bi-lightbulb text-info me-2"></i>AI-Generated Summary
            </h5>
            <p class="mb-0" style="line-height: 1.6; color: #0c4a6e;">{{ $incident->summarizedIncident->summary }}</p>
        </div>
    </div>
    @endif

    <!-- Timeline Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 p-4">
            <h5 class="mb-0">
                <i class="bi bi-clock-history me-2"></i>Timeline
            </h5>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <small class="text-muted d-block mb-1">
                            <i class="bi bi-plus-circle me-1"></i>CREATED
                        </small>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($incident->created_at)->diffForHumans() }}</div>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($incident->created_at)->format('d M Y, H:i A') }}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <small class="text-muted d-block mb-1">
                            <i class="bi bi-arrow-repeat me-1"></i>LAST UPDATED
                        </small>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($incident->updated_at)->diffForHumans() }}</div>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($incident->updated_at)->format('d M Y, H:i A') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

<!-- Lightbox -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
