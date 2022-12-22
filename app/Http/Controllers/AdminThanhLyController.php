<?php

namespace App\Http\Controllers;

use App\Http\Services\SachServices;
use App\Http\Services\ThanhLyServices;
use App\Models\ThanhLy;
use App\Http\Requests\StoreThanhLyRequest;
use App\Http\Requests\UpdateThanhLyRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AdminThanhLyController extends Controller
{
    private ThanhLyServices $thanhLyServices;
    private SachServices $sachServices;

    public function __construct(
        ThanhLyServices $thanhLyServices,
        SachServices $sachServices
    )
    {
        $this->thanhLyServices = $thanhLyServices;
        $this->sachServices = $sachServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $thanhLys = $this->thanhLyServices->getAllPaginate();
        return view('admin.pages.thanhly.index', compact('thanhLys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $id
     * @param $lydo
     * @param $name
     * @return JsonResponse
     */
    public function store($id, $lydo): JsonResponse
    {
        $this->sachServices->sachTL($id);
        return $this->thanhLyServices->create($id, $lydo);
    }

    /**
     * Display the specified resource.
     *
     * @param ThanhLy $thanhLy
     * @return \Illuminate\Http\Response
     */
    public function show(ThanhLy $thanhLy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ThanhLy $thanhLy
     * @return \Illuminate\Http\Response
     */
    public function edit(ThanhLy $thanhLy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param $lydo
     * @return JsonResponse
     */
    public function update($id, $lydo): JsonResponse
    {
        return $this->thanhLyServices->update($id, $lydo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->thanhLyServices->delete($id);
    }

    public function restore($id): JsonResponse
    {
        $this->sachServices->restore($this->thanhLyServices->findOne($id)->MaSach);
        return $this->thanhLyServices->delete($id);
    }
}
