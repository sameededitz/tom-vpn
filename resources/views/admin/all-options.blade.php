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
                                aria-selected="true" tabindex="-1">Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10" id="pills-details-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                                aria-selected="false">TOS</button>
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
                                <form action="{{ route('save-info') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Name</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                value="{{ $name }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Phone</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone"
                                                value="{{ $phone_no }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">API Key</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="apikey" class="form-control" placeholder="API Key"
                                                value="{{ $apikey }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Heading</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="heading" class="form-control" placeholder="Heading"
                                                value="{{ $heading }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Sub heading</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="sub_heading" class="form-control"
                                                placeholder="Sub heading" value="{{ $sub_heading }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Description</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Description" value="{{ $description }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Button text</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" name="btn_text" class="form-control"
                                                placeholder="Button text" value="{{ $btn_text }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-24 gy-3 align-items-center">
                                        <div class="col-12 col-sm-3">
                                            <label class="form-label mb-0 col-sm-3 w-100">Advertisement Img</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="upload-image-wrapper d-flex align-items-center gap-3">
                                                @if ($ad_img_url)
                                                    <div
                                                        class="uploaded-img position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50">
                                                        <img id="uploaded-img__preview"
                                                            class="w-100 h-100 object-fit-cover"
                                                            src="{{ $ad_img_url }}" alt="info_img">
                                                    </div>
                                                @endif
                                                <label
                                                    class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                                                    for="upload-file">
                                                    <iconify-icon icon="solar:camera-outline"
                                                        class="text-xl text-secondary-light"></iconify-icon>
                                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                                    <input id="upload-file" name="ad_img" type="file" hidden>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary-600">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-details" role="tabpanel"
                            aria-labelledby="pills-details-tab" tabindex="0">
                            <div>
                                @if ($errors->any())
                                    <div class="py-2">
                                        @foreach ($errors->all() as $error)
                                            <x-alert type="danger" :message="$error" />
                                        @endforeach
                                    </div>
                                @endif
                                <form id="contentForm" action="{{ route('save-options') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label" for="privacy_policy">Privacy Policy</label>
                                            <textarea name="privacy_policy" id="privacy_policy" class="form-control tinymce-editor">{{ $privacyPolicyContent }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="terms_of_service">Terms of Service</label>
                                            <textarea id="tosEditor" name="tos" class="form-control tinymce-editor">{{ $tosContent }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary-600">Save</button>
                                    </div>
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
    <script src="https://cdn.tiny.cloud/1/profov2dlbtwaoggjfvbncp77rnjhgyfnl3c2hx3kzpmhif1/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinymce-editor',
            setup: function(editor) {
                editor.on('blur', function() {
                    editor.save(); // Automatically save content to the textarea when focus is lost
                });
            }
        });

        document.getElementById('contentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            tinymce.triggerSave(); // Save the content of all TinyMCE editors to their respective textareas
            form.submit(); // Now submit the form
        });
    </script>
@endsection
