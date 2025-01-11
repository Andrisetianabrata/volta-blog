<div>
    {{-- @dd($post); --}}
    {{-- Success is as dangerous as failure. --}}
    <form action="" method="post" wire:submit.prevent='updatePost()' enctype="multipart/form-data">
       @csrf
       <div class="card">
          <div class="card-body">
             <div class="row">
                <div class="col-md-7">
                   <div class="mb-3">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control" wire:model="post_title" placeholder="Title">
                      @error('post_title')<span class="text-danger">{{$message}}</span>@enderror
                   </div>
                </div>
                <div class="col-md-5">
                   <div class="mb-3">
                      <div class="form-label">Category</div>
                      <select class="form-select" wire:model="post_category">
                         <option value="">No selected</option>
                         @foreach (\App\Models\SubCategory::all() as $subCategory)
                         <option value="{{$subCategory->id}}">{{$subCategory->subcategory_name}}</option>
                         @endforeach
                      </select>
                      @error('post_category')<span class="text-danger">{{$message}}</span>@enderror
                   </div>
                   <div class="mb-3">
                      <div class="form-label">Thumbnail</div>
                      <input type="file" class="form-control" wire:model="post_thumbnail" accept="image/jpeg, image/png">
                      @error('post_thumbnail')<span class="text-danger">{{$message}}</span><br>@enderror
                      <span class="small text-indigo">Tips: 2:1 Aspect ratio image</span>
                   </div>
                   <div class="col-6 mb-3" wire:ignore>
                      <div class="img-responsive img-responsive-2x1 rounded-3 border" style="background-image: url(./storage/images/thumbnails/{{$post->thumbnail}})"></div>
                   </div>
                </div>
                <div class="mb-2">
                   <button type="submit" class="btn btn-lime w-100">
                      <svg  xmlns="http://www.w3.org/2000/svg" class="icon" width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                         <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                         <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                         <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                         <path d="M16 5l3 3" />
                      </svg>
                      Update
                   </button>
                </div>
             </div >
          </div>
       </div>
    </form>
    <div class="mt-3">
       <div wire:ignore>
          <label class="form-label">Content</label>
          <textarea id="post_content">
            @if (isset($post->post_content))
            {!!$post->post_content!!}
            @endif
        </textarea>
       </div>
       @error('post_content')<span class="text-danger">{{$message}}</span>@enderror
    </div>
    <script>
       // CKEDITOR.replace( 'post_content' );
       $(document).ready(function(){
         const editor = CKEDITOR.replace( 'post_content', {
            height: 450
         });
         editor.on('change', function(event){
           // console.log(event.editor.getData());
           @this.set('post_content', event.editor.getData());
         }); 
       })
    </script>
  </div>