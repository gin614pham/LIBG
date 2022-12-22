<?php

namespace App\Http\Controllers;

use App\Http\Services\TheLoaiServices;
use App\Models\TheLoai;
use App\Http\Requests\StoreTheLoaiRequest;
use App\Http\Requests\UpdateTheLoaiRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminTheLoaiController extends Controller
{
    private TheLoaiServices $theLoaiServices;

    public function __construct(TheLoaiServices $theLoaiServices)
    {
        $this->theLoaiServices = $theLoaiServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $theLoais = $this->theLoaiServices->getAllPaginate();
        return view('admin.pages.theloai.index', compact('theLoais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.pages.theloai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTheLoaiRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTheLoaiRequest $request): RedirectResponse
    {
        $this->theLoaiServices->create($request);
        return redirect()->route('admin.theloai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TheLoai  $theLoai
     * @return \Illuminate\Http\Response
     */
    public function show(TheLoai $theLoai)
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
        $theLoai = $this->theLoaiServices->findOne($id);
        return view('admin.pages.theloai.edit', compact('theLoai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTheLoaiRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateTheLoaiRequest $request, $id)
    {
        $this->theLoaiServices->update($request, $id);
        return redirect()->route('admin.theloai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->theLoaiServices->delete($id);
    }
}
