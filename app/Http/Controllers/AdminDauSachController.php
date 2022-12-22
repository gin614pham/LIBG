<?php

namespace App\Http\Controllers;

use App\Http\Services\DauSachServices;
use App\Http\Services\NgonNguServices;
use App\Http\Services\PhanLoaiServices;
use App\Http\Services\TheLoaiServices;
use App\Models\DauSach;
use App\Http\Requests\StoreDauSachRequest;
use App\Http\Requests\UpdateDauSachRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminDauSachController extends Controller
{
    private DauSachServices $dauSachServices;
    private NgonNguServices $ngonNguServices;
    private TheLoaiServices $theLoaiServices;
    private PhanLoaiServices $phanLoaiServices;

    public function __construct(
        DauSachServices $dauSachServices,
        NgonNguServices $ngonNguServices,
        TheLoaiServices $theLoaiServices,
        PhanLoaiServices $phanLoaiServices)
    {
        $this->dauSachServices = $dauSachServices;
        $this->ngonNguServices = $ngonNguServices;
        $this->theLoaiServices = $theLoaiServices;
        $this->phanLoaiServices = $phanLoaiServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $dauSachs = $this->dauSachServices->getAllPaginate();
        return view('admin.pages.dauSach.index', compact('dauSachs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $NgonNgus = $this->ngonNguServices->findAll();
        $TheLoais = $this->theLoaiServices->findAll();
        $PhanLoais = $this->phanLoaiServices->findAll();
        return view('admin.pages.dausach.create',
            compact('NgonNgus', 'TheLoais', 'PhanLoais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDauSachRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDauSachRequest $request): RedirectResponse
    {

        $this->dauSachServices->create($request);
        return redirect()->route('admin.dausach.index');
    }

    /**
     * Display the specified resource.
     *
     * @param DauSach $dauSach
     * @return Response
     */
    public function show(DauSach $dauSach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $NgonNgus = $this->ngonNguServices->findAll();
        $TheLoais = $this->theLoaiServices->findAll();
        $PhanLoais = $this->phanLoaiServices->findAll();
        $DauSach = $this->dauSachServices->findOne($id);
        return view('admin.pages.dausach.edit',
            compact('NgonNgus', 'TheLoais', 'PhanLoais', 'DauSach'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDauSachRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateDauSachRequest $request,  $id)
    {
        $this->dauSachServices->update($request, $id);
        return redirect()->route('admin.dausach.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->dauSachServices->delete($id);
    }
}
