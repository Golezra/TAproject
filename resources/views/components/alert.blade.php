@if ($errors->any())
    <div class="toast toast-autohide custom-toast-1 toast-danger home-page-toast shadow" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="60000" data-bs-autohide="true" id="installWrap">
        <div class="toast-body p-4">
            <div class="toast-text me-2 d-flex align-items-center">
                <img src="{{ asset('img/core-img/bell.gif') }}" alt="Warning Icon" class="me-2" style="width: 50px; height: 50px;">
                <div>
                    <h6 class="text-warning mb-0">Perhatian!</h6>
                    @foreach ($errors->all() as $error)
                        <span class="d-block mb-2">{{ $error }}</span>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-close btn-close-white position-absolute p-2" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif

@if($errors->has('loginError'))
    <div class="toast toast-autohide custom-toast-1 toast-danger home-page-toast shadow" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="60000" data-bs-autohide="true" id="errorToast">
        <div class="toast-body p-4">
            <div class="toast-text me-2 d-flex align-items-center">
                <img src="{{ asset('img/core-img/bell.gif') }}" alt="Error Icon" class="me-2" style="width: 50px; height: 50px;">
                <div>
                    <h6 class="text-warning mb-0">Error</h6>
                    <span class="d-block mb-2">{{ $errors->first('loginError') }}</span>
                </div>
            </div>
            <button class="btn btn-close btn-close-white position-absolute p-2" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="toast toast-autohide custom-toast-1 toast-success home-page-toast shadow" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="60000" data-bs-autohide="true" id="successToast">
        <div class="toast-body p-4">
            <div class="toast-text me-2 d-flex align-items-center">
                <img src="{{ asset('img/core-img/bell.gif') }}" alt="Success Icon" class="me-2" style="width: 50px; height: 50px;">
                <div>
                    <h6 class="text-success mb-0">Success</h6>
                    <span class="d-block mb-2">{{ session('success') }}</span>
                </div>
            </div>
            <button class="btn btn-close btn-close-white position-absolute p-2" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endif