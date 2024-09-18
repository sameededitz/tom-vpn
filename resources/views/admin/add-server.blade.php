@extends('layout.admin-layout')
@section('title')
    Add Server | Admin
@endsection
@section('admin_content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Servers</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin-home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Servers</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Add Server</h6>
                </div>
                <div class="card-body">
                    @livewire('server-create')
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
@section('admin_scripts')
    <script>
        // =============================== Upload Single Image js start here ================================================
        // const fileInput = document.getElementById("upload-file");
        // const imagePreview = document.getElementById("uploaded-img__preview");
        // const uploadedImgContainer = document.querySelector(".uploaded-img");
        // const removeButton = document.querySelector(".uploaded-img__remove");

        // fileInput.addEventListener("change", (e) => {
        //     if (e.target.files.length) {
        //         const src = URL.createObjectURL(e.target.files[0]);
        //         imagePreview.src = src;
        //         uploadedImgContainer.classList.remove('d-none');
        //     }
        // });
        // removeButton.addEventListener("click", () => {
        //     imagePreview.src = "";
        //     uploadedImgContainer.classList.add('d-none');
        //     fileInput.value = "";
        // });
        // =============================== Upload Single Image js End here ================================================
    </script>
@endsection
