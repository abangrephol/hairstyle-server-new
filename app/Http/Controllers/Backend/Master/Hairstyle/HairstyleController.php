<?php

namespace App\Http\Controllers\Backend\Master\Hairstyle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Master\Frame\DeleteFrameRequest;
use App\Http\Requests\Backend\Master\Frame\EditFrameRequest;
use App\Http\Requests\Backend\Master\Frame\StoreFrameRequest;
use App\Http\Requests\Backend\Master\Frame\UpdateFrameRequest;
use App\Http\Requests\Backend\Master\Hairstyle\DeleteHairstyleRequest;
use App\Http\Requests\Backend\Master\Hairstyle\EditHairstyleRequest;
use App\Http\Requests\Backend\Master\Hairstyle\StoreHairstyleRequest;
use App\Http\Requests\Backend\Master\Hairstyle\UpdateHairstyleRequest;
use App\Repositories\Backend\Master\Category\EloquentCategoryRepository;
use App\Repositories\Backend\Master\Frame\FrameContract;
use App\Repositories\Backend\Master\Hairstyle\HairstyleContract;
use App\Repositories\Backend\Reseller\Reseller\EloquentResellerRepository;

class HairstyleController extends Controller
{

    protected $hairstyles;

    protected $reseller;

    protected $categories;

    /**
     * FrameController constructor.
     * @param HairstyleContract $hairstyles
     * @param EloquentResellerRepository $reseller
     * @param EloquentCategoryRepository $categories
     * @internal param FrameContract $frames
     */
    public function __construct(
        HairstyleContract $hairstyles,
        EloquentResellerRepository $reseller,
        EloquentCategoryRepository $categories
    )
    {
        $this->hairstyles = $hairstyles;
        $this->reseller = $reseller;
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.master.hairstyle.index')
            ->withHairstyles($this->hairstyles->getHairstylesPaginated(config('master.default_per_page')));
    }

    public function create()
    {

        return view('backend.master.hairstyle.create')
            ->withCategories($this->categories->getAllCategories())
            ->withResellers($this->reseller->getAllResellers());
    }

    public function store(StoreHairstyleRequest $request)
    {
        $this->hairstyles->create($request->all(),$request);

        return redirect()->route('admin.master.hairstyle.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    public function edit($id, EditHairstyleRequest $request)
    {
        $hairstyle = $this->hairstyles->findOrThrowException($id);

        return view('backend.master.hairstyle.edit')
            ->withHairstyle($hairstyle)
            ->withCategories($this->categories->getAllCategories())
            ->withResellers($this->reseller->getAllResellers());
    }

    public function update($id, UpdateHairstyleRequest $request)
    {
        $this->hairstyles->update($id,$request->all(),$request);

        return redirect()->route('admin.master.hairstyle.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    public function destroy($id, DeleteHairstyleRequest $request)
    {
        $this->hairstyles->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }
}