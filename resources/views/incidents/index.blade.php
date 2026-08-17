@extends('layouts.sidebar')
<style>
    body{
        background:#f5f7fb;
    }

    .content-wrapper {
        margin-left: 250px;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    .content-wrapper.sidebar-collapsed {
        margin-left: 70px;
    }

    .dashboard-card{
        border:none;
        border-radius:12px;
        transition:.25s;
    }

    .dashboard-card:hover{
        transform:translateY(-4px);
        box-shadow:0 .6rem 1.6rem rgba(0,0,0,.06);
    }

    .table tbody tr{
        transition:.15s;
    }

    .table tbody tr:hover{
        background:#ffffff;
    }

    .table td,
    .table th{
        vertical-align:middle;
    }

    .badge{
        font-size:.8rem;
    }

    .proof-link{
        color:#495057;
        text-decoration:none;
    }

    .proof-link:hover{
        color:#dc3545;
    }

    .incident-title{
        font-weight:600;
        font-size:1rem;
    }

    .card{ /* small, safe override */
        border-radius:12px;
    }
</style>

<div class="content-wrapper" id="contentWrapper">
<div class="container py-5">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-list-check text-danger"></i>
                Reported Incidents
            </h2>

            <p class="text-muted mb-0">
                View and manage all reported cyber incidents.
            </p>
        </div>

        <a href="{{ route('incidents.create') }}" class="btn btn-danger rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>
            Report Incident
        </a>

    </div>

    <div class="row mb-4">

        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card dashboard-card shadow-sm p-3">
                <small class="text-muted">Total Reports</small>
                <div class="h4 mb-0">{{ $query->count() }}</div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card dashboard-card shadow-sm p-3">
                <small class="text-muted">Pending</small>
                <div class="h4 text-warning mb-0">{{ $query->where('status','pending')->count() }}</div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card dashboard-card shadow-sm p-3">
                <small class="text-muted">Under review</small>
                <div class="h4 text-success mb-0">{{ $query->where('status','under_review')->count() }}</div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card dashboard-card shadow-sm p-3">
                <small class="text-muted">Resolved</small>
                <div class="h4 text-danger mb-0">{{ $query->where('status','resolved')->count() }}</div>
            </div>
        </div>

    </div>

    <!-- Incidents table card -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Cyber Incident Reports</h5>
                <small class="text-muted">Showing <strong>{{ $query->count() }}</strong> reports</small>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Incident</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date Reported</th>
                            <!-- <th>Evidence</th> -->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($query as $incident)
                        <tr>
                            <td>
                                <div class="incident-title">{{ $incident->title }}</div>
                                <small class="text-muted">{{ Str::limit($incident->description, 70) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary text-white">{{ $incident->category->name ?? 'Not assigned' }}</span>
                            </td>
                            <td>
                                @if($incident->status == 'Pending')
                                    <span class="badge bg-warning text-dark">⏳ Pending</span>
                                @elseif($incident->status == 'Resolved')
                                    <span class="badge bg-success text-white">✔ Resolved</span>
                                @elseif($incident->status == 'Rejected')
                                    <span class="badge bg-danger text-white">✖ Rejected</span>
                                @else
                                    <span class="badge bg-info text-white">{{ $incident->status }}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($incident->date_reported)->format('d M Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('incidents.show', $incident->id) }}" class="btn btn-outline-dark btn-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="p-4 text-center">
                                    <p class="mb-2">No incidents reported yet.</p>
                                    <a href="{{ route('incidents.create') }}" class="btn btn-primary btn-sm">Report your first incident</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
</div>

