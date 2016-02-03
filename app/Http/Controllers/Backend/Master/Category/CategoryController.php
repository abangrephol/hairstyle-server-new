<?php

namespace App\Http\Controllers\Backend\Master\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Master\Category\DeleteCategoryRequest;
use App\Http\Requests\Backend\Master\Category\EditCategoryRequest;
use App\Http\Requests\Backend\Master\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Master\Category\UpdateCategoryRequest;
use App\Repositories\Backend\Master\Category\CategoryContract;
use App\Repositories\Backend\Reseller\Reseller\EloquentResellerRepository;

class CategoryController extends Controller
{
    /**
     * @var CategoryContract
     */
    protected $categories;

    protected $reseller;

    /**
     * CategoryController constructor.
     * @param CategoryContract $categories
     * @param EloquentResellerRepository $reseller
     */
    public function __construct(
        CategoryContract $categories,
        EloquentResellerRepository $reseller
    )
    {
        $this->categories = $categories;
        $this->reseller = $reseller;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.master.category.index')
            ->withCategories($this->categories->getCategoriesPaginated(config('master.default_per_page')));
    }

    public function create()
    {

        return view('backend.master.category.create')
            ->withResellers($this->reseller->getAllResellers());
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categories->create($request->all());

        return redirect()->route('admin.master.category.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    public function edit($id, EditCategoryRequest $request)
    {
        $category = $this->categories->findOrThrowException($id);

        return view('backend.master.category.edit')
            ->withCategory($category)
            ->withResellers($this->reseller->getAllResellers());
    }

    public function update($id, UpdateCategoryRequest $request)
    {
        $this->categories->update($id,$request->all());

        return redirect()->route('admin.master.category.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    public function destroy($id, DeleteCategoryRequest $request)
    {
        $this->categories->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }
}