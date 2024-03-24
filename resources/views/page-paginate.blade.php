<nav class="mt-4">
  <nav class="mb-md-50">

    @if ($paginator->hasPages())
      @if ($paginator->hasPages())
        <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
          <li class="disabled page-item">
            <a class="page-link" href="#!" aria-label="Pagination Arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
              </svg>
            </a>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{$paginator->previousPageUrl()}}" aria-label="Pagination Arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
              </svg>
            </a>
          </li>
        @endif
      @endif

      {{-- @if ($paginator->currentPage() > 3)
        <li class="page-item hidden-xs"><a href="{{$paginator->url(1)}}" class="page-link">1</a></li>
      @endif

      @if ($paginator->currentPage() > 4)
        <li class="page-item"><a class="page-link dots">...</a></li>
      @endif --}}

      @foreach (range(1, $paginator->lastPage()) as $i)
        @if ($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
          @if ($i == $paginator->currentPage())
            <li class="page-item active"><span class="page-link current" aria-current="page">{{$i}}</span></li>
          @else
            <li class="page-item"><a href="{{$paginator->url($i)}}" class="page-link">{{$i}}</a></li>
          @endif
        @endif
      @endforeach

      @if ($paginator->currentPage() < $paginator->lastPage() - 3)
        <li class="page-item"><a class="page-link dots">...</a></li>
      @endif
      @if ($paginator->currentPage() < $paginator->lastPage() - 2)
        <li class="page-item hidden-xs"><a href="{{$paginator->url($paginator->lastPage())}}" class="page-link">{{$paginator->lastPage()}}</a></li>
      @endif

      @if ($paginator->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{$paginator->nextPageUrl()}}" aria-label="Pagination Arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
            </svg>
          </a>
        </li>
      @else
        <li class="disabled page-item">
          <a class="page-link" href="{{$paginator->nextPageUrl()}}" aria-label="Pagination Arrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
            </svg>
          </a>
        </li>
      @endif
    </ul>
    @endif
  </nav>  
</nav>