<div class="container-xl">
    <div class="row g-2 align-items-center mb-3">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">{{$setting->blog_name}} Blog</div>
        <h2 class="page-title">
          {{isset($pageTitle) ? $pageTitle : 'Settings'}}
        </h2>
      </div>
      <!-- Page title actions -->
      <div class="col-auto ms-auto d-print-none">
        {{-- <div class="btn-list">
          <span class="d-none d-sm-inline">
            <a href="#" class="btn">
              New view
            </a>
          </span>
          <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
            Create new report
          </a>
          <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
          </a>
        </div> --}}
      </div>
    </div>
  </div>