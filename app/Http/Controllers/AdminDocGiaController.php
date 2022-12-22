<?php

namespace App\Http\Controllers;

use App\Http\Services\DocGiaServices;
use App\Models\DocGia;
use App\Http\Requests\StoreDocGiaRequest;
use App\Http\Requests\UpdateDocGiaRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminDocGiaController extends Controller
{
    private DocGiaServices $docGiaServices;
    public function __construct(DocGiaServices $docGiaServices)
    {
        $this->docGiaServices = $docGiaServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $docGias = $this->docGiaServices->getAllPaginate();
        return view('admin.pages.docgia.index', compact('docGias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.pages.docgia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDocGiaRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDocGiaRequest $request): RedirectResponse
    {
        $this->docGiaServices->create($request);
        return redirect()->route('admin.docgia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        $docGia = $this->docGiaServices->findOne($id);
        $viPhams = $docGia->viPhams;
        $phieuMuons = $docGia->PhieuMuon;
        return view('admin.pages.docgia.view', compact('docGia', 'viPhams', 'phieuMuons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $docGia = $this->docGiaServices->findOne($id);
        return view('admin.pages.docgia.edit', compact('docGia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreDocGiaRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(StoreDocGiaRequest $request, $id): RedirectResponse
    {
        $this->docGiaServices->update($request ,$id);
        return redirect()->route('admin.docgia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->docGiaServices->delete($id);
    }
}
