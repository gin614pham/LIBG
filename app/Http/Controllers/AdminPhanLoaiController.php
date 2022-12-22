<?php

namespace App\Http\Controllers;

use App\Http\Services\PhanLoaiServices;
use App\Models\PhanLoai;
use App\Http\Requests\StorePhanLoaiRequest;
use App\Http\Requests\UpdatePhanLoaiRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminPhanLoaiController extends Controller
{
    private PhanLoaiServices $phanLoaiServices;

    public function __construct(PhanLoaiServices $phanLoaiServices)
    {
        $this->phanLoaiServices = $phanLoaiServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $phanLoais = $this->phanLoaiServices->findAll();
        return view('admin.pages.phanloai.index', compact('phanLoais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.pages.phanloai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StorePhanLoaiRequest $request): RedirectResponse
    {
        $this->phanLoaiServices->create($request);
        return redirect()->route('admin.phanloai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhanLoai  $phanLoai
     * @return \Illuminate\Http\Response
     */
    public function show(PhanLoai $phanLoai)
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
        $phanLoai = $this->phanLoaiServices->findOne($id);
        return view('admin.pages.phanloai.edit', compact('phanLoai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePhanLoaiRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdatePhanLoaiRequest $request, $id): RedirectResponse
    {
        $this->phanLoaiServices->update($id, $request);
        return redirect()->route('admin.phanloai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->phanLoaiServices->delete($id);
    }
}
