<div>
    {{-- @dd($authors) --}}
    <?php
        if (!function_exists('shortTitle')) {
            function shortTitle($title) {
                if (strlen($title) > 33) {
                    return substr($title, 0, 30) . '...';
                } else {
                    return $title;
                }
            }
            
        }

    ?>
    <div class="row g-2 align-items-center mb-3">
        <div class="col">
            <h2 class="page-title">
            Users
            </h2>
            <!-- <div class="text-muted mt-1">1-18 of 413 people</div> -->
        </div>
        <!-- Page title actions -->
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Search</label>
            <div class="input-icon">
                <input type="text" value="" class="form-control" placeholder="Search Posts…" wire:model='search'>
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
                </span>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">Category</label>
            <select class="form-select" wire:model='categorySelecor'>
                <option value="">-</option>
                @foreach ($subCategory as $category)
                <option value="{{$category->id}}">{{$category->subcategory_name}}</option>
                @endforeach
            </select>
        </div>
        @if ($userType == 1)
            <div class="col-md-2 mb-3">
                <label for="" class="form-label">Author</label>
                <select class="form-select" wire:model='authorSelecor'>
                    <option value="">-</option>
                    @foreach ($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-md-2 mb-3">
            <label for="" class="form-label">ShortBy</label>
            <select class="form-select" wire:model='shortBy'>
                <option value="desc">Latest</option>
                <option value="asc">Older</option>
              </select>
        </div>
    </div>

    <div>
        <div class="row row-cards">
            @forelse ($posts as $post)
                <div class="col-md-7 col-lg-3">
                    <div class="card">
                    <div class="d-block"><img src="./storage/images/thumbnails/{{$post->thumbnail}}" class="card-img-top"></div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            {{-- <h2 class="m-0 mb-2" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 550px;"><a target="_blank" href="#">{{$post->post_title}}</a></h2> --}}
                            <h4 class="m-0 mb-2 post-title"><a target="_blank" href="#">{{shortTitle($post->post_title)}}</a></h4>
                        </div>
                        <span class="badge bg-orange-lt mb-2">{{$post->category->parentCategory->category_name}}</span>
                        <span class="badge bg-blue-lt mb-2">{{$post->category->subcategory_name}}</span>
                        <div class="d-flex align-items-center">
                        <span class="avatar me-3 rounded" style="background-image: url({{$post->author->picture}})"></span>
                        <div>
                            <div>{{$post->author->name}}</div>
                            <div class="text-muted">{{$post->created_at->diffForHumans()}}</div>
                        </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="card-btn">
                        <svg class="icon me-2 text-muted" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        Edit
                        </a>
                        <a href="#" class="card-btn text-danger">
                        <svg class="icon me-2 text-danger" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Delete
                        </a>
                    </div>
                    </div>
                </div>
            @empty
                <span class="text-danger">No post(s) found</span>
            @endforelse
        </div>
        <div class="row mt-4">
            {{$posts->links('livewire::simple-bootstrap')}}
        </div>
    </div>
</div>