@extends('layouts.sidebar')

<style>
    body { background: #f5f7fb; }

    .content-wrapper { margin-left: 250px; min-height: 100vh; transition: all 0.3s ease; }
    .content-wrapper.sidebar-collapsed { margin-left: 70px; }

    .form-container { max-width: 700px; margin: 0 auto; padding: 2rem 0; }
    .form-header { background: linear-gradient(135deg,#359cdc 0%,#2339c8 100%); padding: 1.25rem 1.75rem; border-radius: 12px; color: white; margin-bottom: 1.25rem; text-align: center; }
    .form-header h2 { margin: 0; font-weight: 700; }

    .form-card { background: #fff; padding: 1.75rem; border-radius: 12px; border: 1px solid #e9ecef; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
    .form-group { margin-bottom: 1rem; }
    .form-label { display: block; margin-bottom: .5rem; font-weight: 600; }
    .form-control { width: 100%; padding: .75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; }
    .btn-submit { background: linear-gradient(135deg,#359cdc 0%,#2339c8 100%); color: white; padding: .6rem 1.25rem; border-radius: 8px; border: none; }
    .text-danger { color: #dc3545; }
</style>

<div class="content-wrapper" id="contentWrapper">
    <div class="container py-5">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <div class="form-container">
            <div class="form-header">
                <h2><i class="bi bi-person-plus me-2"></i>Register Reviewer</h2>
                <p class="small mb-0">Create a new reviewer account (admin only).</p>
            </div>

            <div class="form-card">
                <form method="POST" action="{{ route('reviewers.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <div class="text-danger mt-2 small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="text-danger mt-2 small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password') <div class="text-danger mt-2 small">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn-submit">Create Reviewer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
