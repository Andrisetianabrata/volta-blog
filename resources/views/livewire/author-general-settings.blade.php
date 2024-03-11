<form action="" method="POST" wire:submit.prevent="updateGeneralSettings()">
    <div class="row">
        <div class="col-md-100">
            <div class="mb-3">
                <label class="form-label">Blog Name</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="Blog Name" wire:model="blog_name">
                <span class="text-danger">@error('blog_name'){{$message}}@enderror</span>
            </div>
            <div class="mb-3">
                <label class="form-label">Blog Email</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="Blog Email" wire:model="blog_email">
                <span class="text-danger">@error('blog_email'){{$message}}@enderror</span>
            </div>
            <div class="mb-3">
                <label class="form-label">Blog Description</label>
                <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Blog Description..." wire:model="blog_description"></textarea>
                <span class="text-danger">@error('blog_description'){{$message}}@enderror</span>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                  Save Changes
                </button>
              </div>
        </div>
    </div>
</form>
