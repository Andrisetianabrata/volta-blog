<div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Categories</h3>
            <div class="col-12">
              <div class="card">
                <div class="table-responsive">
                  <table class="table table-vcenter card-table table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Child</th>
                        <th class="w-1"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($categories as $category)
                      <tr>
                        <td data-label="Category Name">
                          <div class="font-weight-medium">{{$category->category_name}}</div>
                        </td>
                        <td data-label="Child">
                          <div>{{$category->subCategories->count()}}</div>
                        </td>
                        <td>
                          <div class="btn-list flex-nowrap">
                            {{-- <a href="#" class="text-primary">Edit</a>
                            <a href="#" class="text-danger">Delete</a> --}}
                            <a href="#" class="btn btn-pill btn-primary btn-sm w-100" wire:click.prevent = 'editCategory({{$category->id}})'>Edit</a>
                            <a href="#" class="btn btn-pill btn-danger btn-sm w-100" wire:click.prevent='deleteCategory({{$category->id}})'>Delete</a>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td data-label="Category Name">
                          <div class="font-weight-medium">-</div>
                        </td>
                        <td data-label="Total">
                          <div>-</div>
                        </td>
                        <td>
                          <div class="btn-list flex-nowrap">
                            {{-- <a href="#" style="pointer-events: none" class="text-primary">Edit</a>
                            <a href="#" style="pointer-events: none" class="text-danger">Delete</a> --}}
                            <button href="#" class="btn btn-pill btn-primary btn-sm w-100" disabled>Edit</button>
                            <button href="#" class="btn btn-pill btn-danger btn-sm w-100" disabled>Delete</button>
                          </div>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Card footer -->
          <div class="card-footer">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#category_modal">Add Category</a>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 mb-3">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">SubCategories</h3>
            <div class="col-12">
              <div class="card">
                <div class="table-responsive">
                  <table class="table table-vcenter card-table table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Post Total</th>
                        <th class="w-1"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($subCategories as $subCategory)
                        <tr>
                          <td data-label="SubCategory Name">
                            <div class="font-weight-medium">{{$subCategory->subcategory_name}}</div>
                          </td>
                          <td data-label="Parent">
                            {{-- <div>{{$subCategory->Category->category_name}}</div> --}}
                            <div>
                              @if(isset($subCategory->parentCategory->category_name))
                                {{$subCategory->parentCategory->category_name}}
                              @else
                                {{-- <span class="text-danger">Please update</span> --}}
                              @endif
                            </div>
                          </td>
                          <td data-label="Post Total">
                            <div>{{$subCategory->posts->count()}}</div>
                          </td>
                          <td>
                            <div class="btn-list flex-nowrap">
                              <button href="#" class="btn btn-pill btn-primary btn-sm w-100" wire:click.prevent='editSubCategory({{$subCategory->id}})'>Edit</button>
                              <button href="#" class="btn btn-pill btn-danger btn-sm w-100" wire:click.prevent='deleteSubCategory({{$subCategory->id}})'>Delete</button>
                              {{-- <a href="#" class="btn btn-primary w-100">Edit</a>
                              <a href="#" class="btn btn-danger w-100">Delete</a> --}}
                            </div>
                          </td>
                        </tr>
                        @empty
                        <tr>
                          <td data-label="SubCategory Name">
                            <div class="font-weight-medium">-</div>
                          </td>
                          <td data-label="Parent">
                            <div>{{'-'}}</div>
                          </td>
                          <td data-label="Post Total">
                            <div>{{'-'}}</div>
                          </td>
                          <td>
                            <div class="btn-list flex-nowrap">
                              <button href="#" class="btn btn-pill btn-primary btn-sm w-100" disabled>Edit</button>
                              <button href="#" class="btn btn-pill btn-danger btn-sm w-100" disabled>Delete</button>
                              {{-- <a href="#" class="btn btn-primary w-100">Edit</a>
                              <a href="#" class="btn btn-danger w-100">Delete</a> --}}
                            </div>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- Card footer -->
          <div class="card-footer">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subcategory_modal">Add SubCategory</a>
          </div>
        </div>
      </div>
    </div>

    <div wire:ignore.self class="modal modal-blur fade" id="category_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form class="modal-content" method="POST"
            @if ($updateCategoryMode)
              wire:submit.prevent='updateCategory()'
            @else
              wire:submit.prevent='addCategory()'
            @endif
          > 
            <div class="modal-header">
              <h5 class="modal-title"> {{$updateCategoryMode ? 'Update Category' : 'Add Category'}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="Category Name" wire:model='category_name'>
                <span class="text-danger">@error('category_name') {{$message}} @enderror</span>
             </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>

      <div wire:ignore.self class="modal modal-blur fade" id="subcategory_modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form method="POST" class="modal-content"
            @if ($updateSubCategoryMode)
              wire:submit.prevent='updateSubCategory()'
            @else
              wire:submit.prevent='addSubCategory()'
            @endif
          >
            <div class="modal-header">
              <h5 class="modal-title">{{ $updateSubCategoryMode ? 'Update SubCategory' : 'Add SubCategory' }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              @if ($updateSubCategoryMode)
                <input type="hidden" wire:model='selected_subcategory_id'>
              @endif
              <div class="mb-3">
                <div class="form-label">Parent Category</div>
                <select class="form-select" wire:model='parent_category'>
                    <option value="">No Selected</option>
                    @foreach (\App\Models\Category::all() as $category)
                      <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
                <span class="text-danger">@error('parent_category') {{$message}} @enderror</span>
              </div>
      
              <div class="mb-3">
                <label class="form-label">SubCategory Name</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="SubCategory Name" wire:model='subcategory_name'>
                <span class="text-danger">@error('subcategory_name') {{$message}} @enderror</span>
             </div>
      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">{{$updateSubCategoryMode ? 'Update' : 'Save Changes'}}</button>
            </div>
          </form>
        </div>
      </div>

      <div wire:ignore.self class="modal modal-blur fade" id="delete_category" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='resetForm()'></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to remove this Category? What you've done cannot be undone.</div>
            </div>
            <div class="modal-footer">
              <div class="w-100">
                <div class="row">
                  <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                      Cancel
                    </a></div>
                  <div class="col"><a href="#" wire:click.prevent='deleteCategoryAction' class="btn btn-danger w-100" data-bs-dismiss="modal">
                      Delete
                    </a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div wire:ignore.self class="modal modal-blur fade" id="delete_subcategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='resetForm()'></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
              <h3>Are you sure?</h3>
              <div class="text-muted">Do you really want to remove this SubCategory? What you've done cannot be undone.</div>
            </div>
            <div class="modal-footer">
              <div class="w-100">
                <div class="row">
                  <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                      Cancel
                    </a></div>
                  <div class="col"><a href="#" wire:click.prevent='deleteSubCategoryAction' class="btn btn-danger w-100" data-bs-dismiss="modal">
                      Delete
                    </a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
