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

    .form-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 2rem 0;
    }

    .form-header {
        background: linear-gradient(135deg, #f14368 0%, #c82333 100%);
        padding: 1.25rem 1.75rem;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
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
        border-color: #c54c67;
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

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 2rem;
        border: 2px dashed #dc3545;
        border-radius: 8px;
        background: #fff5f6;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #dc3545;
        font-weight: 600;
    }

    .file-input-label:hover {
        background: #ffe4e9;
        border-color: #c82333;
        color: #c54c67;
    }

    .file-input-wrapper input[type="file"] {
        display: none;
    }

    .file-list {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1rem;
    }

    .file-item {
        position: relative;
        padding: 0.75rem;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        text-align: center;
        font-size: 0.85rem;
        color: #495057;
        word-break: break-word;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #f14368 0%, #c82333 100%);
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
        color: #dc3545;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        color: #c82333;
        gap: 0.75rem;
    }
</style>

<div class="content-wrapper" id="contentWrapper">
<div class="form-container">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Back Button -->
    <a href="{{ route('incidents.index') }}" class="back-link">
        <i class="bi bi-arrow-left"></i>Back to Incidents
    </a>

    <!-- Header -->
    <div class="form-header">
        <h2>
            <i class="bi bi-exclamation-triangle me-2"></i>Report Incident
        </h2>
        <p>Please provide detailed information about the security incident</p>
    </div>

    <!-- Form -->
    <div class="form-card">
        <form action="{{ route('incidents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="form-group">
                <label for="title" class="form-label">
                    <i class="bi bi-pencil me-2" style="color: #dc3545;"></i>Incident Title
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    placeholder="Enter incident title..."
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                    <div class="text-danger mt-2" style="font-size: 0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description" class="form-label">
                    <i class="bi bi-file-text me-2" style="color: #dc3545;"></i>Description
                </label>
                <textarea
                    id="description"
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Describe the incident in detail..."
                    value="{{ old('description') }}"
                ></textarea>
                @error('description')
                    <div class="text-danger mt-2" style="font-size: 0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label class="form-label">
                    <i class="bi bi-paperclip me-2" style="color: #dc3545;"></i>Evidence Files
                </label>
                <div class="file-input-wrapper">
                    <label for="proofs" class="file-input-label">
                        <i class="bi bi-cloud-upload"></i>
                        <span>Click to upload or drag and drop</span>
                    </label>
                    <input
                        type="file"
                        id="proofs"
                        name="proofs[]"
                        multiple
                        class="@error('proofs') is-invalid @enderror"
                    >
                </div>
                <div id="fileList" class="file-list"></div>
                @error('proofs')
                    <div class="text-danger mt-2" style="font-size: 0.85rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-circle"></i>Submit Incident Report
            </button>
        </form>
    </div>
</div>

<script>
    const fileInput = document.getElementById('proofs');
    const fileList = document.getElementById('fileList');

    fileInput.addEventListener('change', function() {
        fileList.innerHTML = '';
        Array.from(this.files).forEach(file => {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            fileItem.textContent = file.name;
            fileList.appendChild(fileItem);
        });
    });

    // Drag and drop functionality
    const fileInputLabel = document.querySelector('.file-input-label');
    const fileInputWrapper = document.querySelector('.file-input-wrapper');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileInputWrapper.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileInputWrapper.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileInputWrapper.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        fileInputLabel.style.background = '#f0f2ff';
        fileInputLabel.style.borderColor = '#764ba2';
    }

    function unhighlight(e) {
        fileInputLabel.style.background = '#f8f9ff';
        fileInputLabel.style.borderColor = '#667eea';
    }

    fileInputWrapper.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        const event = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(event);
    }
</script>

</div>
</div>
