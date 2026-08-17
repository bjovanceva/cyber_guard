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

    .category-card{
        border:none;
        border-radius:12px;
        transition:.25s;
    }

    .category-card:hover{
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

    .category-name{
        font-weight:600;
        font-size:1rem;
    }
</style>


<div class="content-wrapper" id="contentWrapper">

    <div class="container py-5">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-tags-fill text-primary"></i>
                    Incident Categories
                </h2>

                <p class="text-muted mb-0">
                    Manage categories used for classifying cyber incidents.
                </p>
            </div>


            <a href="{{ route('categories.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>
                Create Category
            </a>

        </div>

        <div class="card shadow-sm border-0">


            <div class="card-header bg-white border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        Available Categories
                    </h5>

                    <small class="text-muted">
                        Showing <strong>{{ $query->count() }}</strong> categories
                    </small>

                </div>

            </div>


            <div class="card-body p-0">


                <div class="table-responsive">


                    <table class="table table-hover align-middle mb-0">


                        <thead class="table-light">

                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-end"></th>
                        </tr>

                        </thead>


                        <tbody>


                        @forelse($query as $category)

                            <tr>

                                <td>
                                    <div class="category-name">
                                        <i class="bi text-danger me-2"></i>
                                        {{ $category->name }}
                                    </div>
                                </td>


                                <td>
                                <span class="text-muted">
                                    {{ $category->description ?? 'No description available' }}
                                </span>
                                </td>


                                <td class="text-end">


                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')


                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this category?')">

                                            <i class="bi bi-trash"></i>
                                            Delete

                                        </button>


                                    </form>


                                </td>


                            </tr>


                        @empty

                            <tr>

                                <td colspan="3">

                                    <div class="p-4 text-center">

                                        <p class="mb-2">
                                            No categories created yet.
                                        </p>


                                        <a href="{{ route('categories.create') }}"
                                           class="btn btn-primary btn-sm">

                                            Create your first category

                                        </a>

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
