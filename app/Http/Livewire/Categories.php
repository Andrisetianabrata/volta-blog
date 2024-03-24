<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;

    public $subcategory_name;
    public $parent_category;
    public $selected_subCategory_id;
    public $updateSubCategoryMode = false;
    protected $listeners = [
        'deleteAllForm'
    ];

    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();
        if ($saved) {
            toastr()->success('Yayy new Category created');
            $this->dispatchBrowserEvent('hideCategoriesModal');
            $this->category_name = null;
        } else {
            toastr()->error('Oops something wrong');
        }
    }
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        // dd($category->category_name);
        $this->dispatchBrowserEvent('showCategoriesModal');
    }
    public function updateCategory()
    {
        if ($this->selected_category_id) {
            $this->validate([
                'category_name' => 'required|unique:categories,category_name,' . $this->selected_category_id,
            ]);

            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $update = $category->save();
            if ($update) {
                toastr()->success('Yayy category has been updated');
                $this->dispatchBrowserEvent('hideCategoriesModal');
                $this->category_name = null;
                $this->updateCategoryMode = false;
            } else {
                toastr()->error('Oops something wrong');
            }
        }
    }

    public function addSubCategory()
    {
        $this->validate([
            // 'parent_category' => 'required',
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name'
        ]);

        $subCategory = new SubCategory();
        $subCategory->subcategory_name = $this->subcategory_name;
        $subCategory->parent_category = $this->parent_category;
        $subCategory->slug = Str::slug($this->subcategory_name);;
        $saved = $subCategory->save();
        if ($saved) {
            $this->dispatchBrowserEvent('hideSubCategoriesModal');
            $this->parent_category = null;
            $this->subcategory_name = null;
            toastr()->success('Yayy new SubCategory created');
        } else {
            toastr()->error('Oops something wrong');
        }
    }
    public function editSubCategory($id)
    {
        $subCategory = subCategory::findOrFail($id);
        $this->selected_subCategory_id = $subCategory->id;
        $this->subcategory_name = $subCategory->subcategory_name;
        $this->parent_category = $subCategory->parent_category;
        $this->updateSubCategoryMode = true;
        $this->resetErrorBag();
        // dd($this->updateSubCategoryMode);
        $this->dispatchBrowserEvent('showSubCategoriesModal');
    }
    public function updateSubCategory()
    {
        if ($this->updateSubCategoryMode) {
            $this->validate([
                // 'parent_category' => 'required',
                'subcategory_name' => 'required|unique:sub_categories,subcategory_name,' . $this->selected_subCategory_id,
            ]);

            $subCategory = SubCategory::findOrFail($this->selected_subCategory_id);
            $subCategory->subcategory_name = $this->subcategory_name;
            $subCategory->slug = Str::slug($this->subcategory_name);
            $subCategory->parent_category = $this->parent_category == null ? null : $this->parent_category;
            $updated = $subCategory->save();

            if ($updated) {
                $this->dispatchBrowserEvent('hideSubCategoriesModal');
                $this->updateSubCategoryMode = false;
                toastr()->success('Yayy SubCategory has been updated');
            } else {
                toastr()->error('Oops something wrong');
            }
        }
    }
    public function deleteAllForm()
    {
        $this->selected_subCategory_id = null;
        $this->subcategory_name = null;
        $this->parent_category = null;
        $this->selected_category_id = null;
        $this->category_name = null;
        $this->updateCategoryMode = false;
        $this->updateSubCategoryMode = false;
        $this->resetErrorBag();
    }

    public function deleteCategory($category)
    {
        // dd($category);
        $this->selected_category_id = $category;
        $this->dispatchBrowserEvent('showDeleteCategory');
    }
    public function deleteCategoryAction()
    {
        $category = Category::find($this->selected_category_id);
        $deleted = $category->delete();

        if($deleted){
            toastr()->success('Yayy Category has been deleted');
        }else{
            toastr()->error('Oops something wrong');
        }
    }
    public function deleteSubCategory($subcategory)
    {
        // dd($subcategory);
        $subCategory = SubCategory::findOrFail($subcategory);
        if ($subCategory->posts->count() != 0) {
            // dd('true');
            toastr()->error('Canot be delete. This category contain '.$subCategory->posts->count().' post(s)', 'Cannot detele');
        }else{
            // dd('false');
            $this->selected_subCategory_id = $subcategory;
            $this->dispatchBrowserEvent('showDeleteSubCategory');
        }
    }
    public function deleteSubCategoryAction()
    {
        $subcategory = SubCategory::findOrFail($this->selected_subCategory_id);
        $deleted = $subcategory->delete();

        if($deleted){
            toastr()->success('Yayy SubCategory has been deleted');
        }else{
            toastr()->error('Oops something wrong');
        }
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('created_at', 'asc')->get(),
            'subCategories' => SubCategory::orderBy('created_at', 'asc')->get(),
        ]);
    }
}
