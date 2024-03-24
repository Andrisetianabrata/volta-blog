@if ($paginator->hasPages())
<div class="d-flex mt-4">
  @if ($paginator->hasPages())
    <ul class="pagination ms-auto">
    @if ($paginator->onFirstPage())
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
          <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>
          prev
        </a>
      </li>
    @else
      <li class="page-item">
        <a class="page-link" href="{{$paginator->previousPageUrl()}}" tabindex="-1" aria-disabled="true">
          <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>
          prev
        </a>
      </li>
    @endif
  @endif

  @foreach (range(1, $paginator->lastPage()) as $i)
    @if ($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
      @if ($i == $paginator->currentPage())
        <li class="page-item active"><span class="page-link" aria-current="page">{{$i}}</span></li>
      @else
        {{-- <li class="page-item"><a " class="page-link">{{$i}}</a></li> --}}
        <li class="page-item"><a class="page-link" href="{{$paginator->url($i)}}"">{{$i}}</a></li>
      @endif
    @endif
  @endforeach
  
  @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link" href="{{$paginator->nextPageUrl()}}">
        next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
      </a>
    </li>
  @else
  <li class="disabled page-item">
    <a class="page-link" href="{{$paginator->nextPageUrl()}}">
      next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
    </a>
  </li>
  @endif
  </ul>
</div>
@endif
    
    

