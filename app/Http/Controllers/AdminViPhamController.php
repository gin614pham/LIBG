<?php

namespace App\Http\Controllers;

use App\Http\Services\DocGiaServices;
use App\Http\Services\ViPhamServices;
use App\Models\ViPham;
use App\Http\Requests\StoreViPhamRequest;
use App\Http\Requests\UpdateViPhamRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminViPhamController extends Controller
{
    private ViPhamServices $viPhamServices;
    private DocGiaServices $docGiaServices;

    public function __construct(ViPhamServices $viPhamServices,
        DocGiaServices $docGiaServices
    )
    {
        $this->viPhamServices = $viPhamServices;
        $this->docGiaServices = $docGiaServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $viPhams = $this->viPhamServices->findAll();
        return view('admin.pages.vipham.index', compact('viPhams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $docGias = $this->docGiaServices->findAll();
        return view('admin.pages.vipham.create', compact('docGias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->viPhamServices->create($request);
        return redirect()->route('admin.vipham.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ViPham  $viPham
     * @return \Illuminate\Http\Response
     */
    public function show(ViPham $viPham)
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
        $viPham = $this->viPhamServices->findOne($id);
        return view('admin.pages.vipham.edit', compact('viPham'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateViPhamRequest  $request
     * @param  \App\Models\ViPham  $viPham
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViPhamRequest $request, ViPham $viPham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ViPham  $viPham
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViPham $viPham)
    {
        //
    }
}
