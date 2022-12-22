<?php

namespace App\Http\Controllers;

use App\Http\Services\DauSachServices;
use App\Http\Services\NhaCungCapServices;
use App\Http\Services\PhieuNhapServices;
use App\Http\Services\SachServices;
use App\Models\PhieuNhap;
use App\Http\Requests\StorePhieuNhapRequest;
use App\Http\Requests\UpdatePhieuNhapRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminPhieuNhapController extends Controller
{
    private PhieuNhapServices $phieuNhapServices;
    private DauSachServices $dauSachServices;
    private NhaCungCapServices $nhaCungCapServices;
    private SachServices $sachServices;

    public function __construct(
        PhieuNhapServices $phieuNhapServices,
        DauSachServices $dauSachServices,
        NhaCungCapServices $nhaCungCapServices,
        SachServices $sachServices,
    )
    {
        $this->phieuNhapServices = $phieuNhapServices;
        $this->dauSachServices = $dauSachServices;
        $this->nhaCungCapServices = $nhaCungCapServices;
        $this->sachServices = $sachServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $phieuNhaps = $this->phieuNhapServices->findAll();
        return view('admin.pages.phieunhap.index', compact('phieuNhaps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $dauSachs = $this->dauSachServices->findAll();
        $nhaCungCaps = $this->nhaCungCapServices->findAll();
        return view('admin.pages.phieunhap.create', compact('dauSachs', 'nhaCungCaps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePhieuNhapRequest $request
     * @return RedirectResponse
     */
    public function store(StorePhieuNhapRequest $request)
    {
        $this->phieuNhapServices->create($request);
        $this->sachServices->createMultiple($request);
        return redirect()->route('admin.phieunhap.index');
    }

    /**
     * Display the specified resource.
     *
     * @param PhieuNhap $phieuNhap
     * @return Response
     */
    public function show(PhieuNhap $phieuNhap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhieuNhapRequest  $request
     * @param PhieuNhap $phieuNhap
     * @return Response
     */
    public function update(UpdatePhieuNhapRequest $request, PhieuNhap $phieuNhap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $this->phieuNhapServices->delete($id);
    }
}
