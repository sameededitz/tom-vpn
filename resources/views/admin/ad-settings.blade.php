@extends('layout.admin-layout')
@section('title')
    Options | Admin
@endsection
@section('admin_content')
    @if (session('status'))
        <div class="row py-3">
            <div class="col-6">
                <x-alert :type="session('status', 'info')" :message="session('message', 'Operation completed successfully.')" />
            </div>
        </div>
    @endif
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Options</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin-home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Options</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <div
                    class="card-header pt-16 pb-0 px-24 bg-base border border-end-0 border-start-0 border-top-0 d-flex align-items-center flex-wrap justify-content-between">
                    <h6 class="text-lg mb-0">Settings</h6>
                    <ul class="nav bordered-tab d-inline-flex nav-pills mb-0" id="pills-tab-six" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10 active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true" tabindex="-1">Ads</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-24 pt-16 mt-24">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <div>
                                @if ($errors->any())
                                    <div class="py-2">
                                        @foreach ($errors->all() as $error)
                                            <x-alert type="danger" :message="$error" />
                                        @endforeach
                                    </div>
                                @endif
                                <form action="{{ route('save-ad') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Advertisement 1</label>
                                        </div>
                                        <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                            <div class="row w-100">
                                                <div class="col-12 col-md-6">
                                                    <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                                        @if ($ad_img_1_url)
                                                            <div
                                                                class="uploaded-img position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                                <img id="uploaded-img__preview"
                                                                    class="w-100 h-100 object-fit-cover"
                                                                    src="{{ $ad_img_1_url }}" alt="info_img">
                                                            </div>
                                                        @endif
                                                        <label
                                                            class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                                            for="upload-file-1">
                                                            <iconify-icon icon="solar:camera-outline"
                                                                class="text-xl text-secondary-light"></iconify-icon>
                                                            <span
                                                                class="fw-semibold text-secondary-light text-center file-name-display">Upload</span>
                                                            <input id="upload-file-1" name="ad_img_1" class="upload-input"
                                                                type="file" hidden>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mt-12 mt-md-0 d-flex">
                                                    <div class="info-box d-flex align-items-center justify-content-center">
                                                        <div class="w-50">
                                                            <input type="text" name="ad_link_1" class="form-control"
                                                                placeholder="ad link 1" value="{{ $ad_link_1 }}"
                                                                required>
                                                        </div>
                                                        <div class="ms-4 w-50">
                                                            <input type="text" name="ad_time_1" class="form-control"
                                                                placeholder="ad time 1" value="{{ $ad_time_1 }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Advertisement 2</label>
                                        </div>
                                        <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                            <div class="row w-100">
                                                <div class="col-12 col-md-6">
                                                    <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                                        @if ($ad_img_2_url)
                                                            <div
                                                                class="uploaded-img position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                                <img id="uploaded-img__preview"
                                                                    class="w-100 h-100 object-fit-cover"
                                                                    src="{{ $ad_img_2_url }}" alt="info_img">
                                                            </div>
                                                        @endif
                                                        <label
                                                            class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                                            for="upload-file-2">
                                                            <iconify-icon icon="solar:camera-outline"
                                                                class="text-xl text-secondary-light"></iconify-icon>
                                                            <span
                                                                class="fw-semibold text-secondary-light text-center file-name-display">Upload</span>
                                                            <input id="upload-file-2" name="ad_img_2" class="upload-input"
                                                                type="file" hidden>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mt-12 mt-md-0 d-flex">
                                                    <div
                                                        class="info-box d-flex align-items-center justify-content-center w-100">
                                                        <input type="text" name="ad_link_2" class="form-control"
                                                            placeholder="ad link 2" value="{{ $ad_link_2 }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Advertisement 3</label>
                                        </div>
                                        <div class="col-sm-8 d-flex align-items-center justify-content-between">
                                            <div class="row w-100">
                                                <div class="col-12 col-md-6">
                                                    <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                                        @if ($ad_img_3_url)
                                                            <div
                                                                class="uploaded-img position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                                <img id="uploaded-img__preview"
                                                                    class="w-100 h-100 object-fit-cover"
                                                                    src="{{ $ad_img_3_url }}" alt="info_img">
                                                            </div>
                                                        @endif
                                                        <label
                                                            class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                                            for="upload-file-3">
                                                            <iconify-icon icon="solar:camera-outline"
                                                                class="text-xl text-secondary-light"></iconify-icon>
                                                            <span
                                                                class="fw-semibold text-secondary-light text-center file-name-display">Upload</span>
                                                            <input id="upload-file-3" name="ad_img_3"
                                                                class="upload-input" type="file" hidden>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mt-12 mt-md-0 d-flex">
                                                    <div
                                                        class="info-box d-flex align-items-center justify-content-center w-100">
                                                        <input type="text" name="ad_link_3" class="form-control"
                                                            placeholder="ad link 3" value="{{ $ad_link_3 }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary-600">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
@section('admin_scripts')
    <script>
        $(document).ready(function() {
            // Trigger when the file input changes
            $('.upload-input').on('change', function() {
                // Get the file name from the input
                var fileName = $(this).val().split('\\').pop();

                // Find the closest span with class 'file-name-display' within the same label
                var displayElement = $(this).closest('label').find('.file-name-display');

                // Update the text of the correct span
                if (fileName) {
                    displayElement.text(fileName); // Change the text to the file name
                } else {
                    displayElement.text('Upload'); // Reset text if no file is selected
                }
            });
        });
    </script>
@endsection
