<?php

namespace App\Http\Controllers;

use App\Http\Services\DocGiaServices;
use App\Http\Services\PhieuMuonServices;
use App\Http\Services\SachServices;
use App\Models\PhieuMuon;
use App\Http\Requests\StorePhieuMuonRequest;
use App\Http\Requests\UpdatePhieuMuonRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminPhieuMuonController extends Controller
{
    private PhieuMuonServices $phieuMuonServices;
    private DocGiaServices $docGiaServices;
    private SachServices $sachServices;

    public function __construct(
        PhieuMuonServices $phieuMuonServices,
        DocGiaServices $docGiaServices,
        SachServices $sachServices
    )
    {
        $this->phieuMuonServices = $phieuMuonServices;
        $this->docGiaServices = $docGiaServices;
        $this->sachServices = $sachServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $phieuMuons = $this->phieuMuonServices->findAll();
        return view('admin.pages.phieumuon.index', compact('phieuMuons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $saches = $this->sachServices->sachMuon();
        $docGias = $this->docGiaServices->findAll();
        return view('admin.pages.phieumuon.create', compact('saches', 'docGias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePhieuMuonRequest $request
     * @return RedirectResponse
     */
    public function store(StorePhieuMuonRequest $request): RedirectResponse
    {
        if($this->phieuMuonServices->create($request)){
            $this->sachServices->muonSach($request->MaSach);
        }

        return redirect()->route('admin.phieumuon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param PhieuMuon $phieuMuon
     * @return Response
     */
    public function show(PhieuMuon $phieuMuon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $phieuMuon = $this->phieuMuonServices->findOne($id);
        $saches = $this->sachServices->sachMuon();
        $docGias = $this->docGiaServices->findAll();
        return view('admin.pages.phieumuon.edit', compact('phieuMuon', 'saches', 'docGias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePhieuMuonRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->phieuMuonServices->update($request, $id);
        $this->phieuMuonServices->findOne($id)->NgayTra == null
            ? $this->sachServices->muonSach($request->MaSach)
            : $this->sachServices->traSach($request->MaSach);
        return redirect()->route('admin.phieumuon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->phieuMuonServices->delete($id);
    }

    public function check($id): bool
    {
        return $this->phieuMuonServices->checkSoLuong($id);
    }

    public function traSach($id): JsonResponse
    {
        $this->sachServices->traSach($this->phieuMuonServices->findOne($id)->MaSach);
        return $this->phieuMuonServices->traSach($id);
    }
}
