<?php

namespace App\Http\Controllers\Backend\Master\Frame;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Master\Frame\DeleteFrameRequest;
use App\Http\Requests\Backend\Master\Frame\EditFrameRequest;
use App\Http\Requests\Backend\Master\Frame\StoreFrameRequest;
use App\Http\Requests\Backend\Master\Frame\UpdateFrameRequest;
use App\Repositories\Backend\Master\Frame\FrameContract;
use App\Repositories\Backend\Reseller\Reseller\EloquentResellerRepository;

class FrameController extends Controller
{

    protected $frames;

    protected $reseller;

    /**
     * FrameController constructor.
     * @param FrameContract $frames
     * @param EloquentResellerRepository $reseller
     */
    public function __construct(
        FrameContract $frames,
        EloquentResellerRepository $reseller
    )
    {
        $this->frames = $frames;
        $this->reseller = $reseller;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.master.frame.index')
            ->withFrames($this->frames->getFramesPaginated(config('master.default_per_page')));
    }

    public function create()
    {

        return view('backend.master.frame.create')
            ->withResellers($this->reseller->getAllResellers());
    }

    public function store(StoreFrameRequest $request)
    {
        $this->frames->create($request->all(),$request);

        return redirect()->route('admin.master.frame.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    public function edit($id, EditFrameRequest $request)
    {
        $frame = $this->frames->findOrThrowException($id);

        return view('backend.master.frame.edit')
            ->withFrame($frame)
            ->withResellers($this->reseller->getAllResellers());
    }

    public function update($id, UpdateFrameRequest $request)
    {
        $this->frames->update($id,$request->all(),$request);

        return redirect()->route('admin.master.frame.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    public function destroy($id, DeleteFrameRequest $request)
    {
        $this->frames->destroy($id);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }
}