<?php

namespace App\Http\Controllers;

use App\Http\Services\NhaCungCapServices;
use App\Models\NhaCungCap;
use App\Http\Requests\StoreNhaCungCapRequest;
use App\Http\Requests\UpdateNhaCungCapRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminNhaCungCapController extends Controller
{
    private NhaCungCapServices $nhaCungCapServices;
    public function __construct(NhaCungCapServices $nhaCungCapServices)
    {
        $this->nhaCungCapServices = $nhaCungCapServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $nhaCungCaps = $this->nhaCungCapServices->getAllPaginate();
        return view('admin.pages.nhacungcap.index', compact('nhaCungCaps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.pages.nhacungcap.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNhaCungCapRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNhaCungCapRequest $request): RedirectResponse
    {
        $this->nhaCungCapServices->create($request);
        return redirect()->route('admin.nhacungcap.index');
    }

    /**
     * Display the specified resource.
     *
     * @param NhaCungCap $nhaCungCap
     * @return void
     */
    public function show(NhaCungCap $nhaCungCap)
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
        $nhaCungCap = $this->nhaCungCapServices->findOne($id);
        return view('admin.pages.nhacungcap.edit', compact('nhaCungCap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNhaCungCapRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(StoreNhaCungCapRequest $request, $id): RedirectResponse
    {
        $this->nhaCungCapServices->update($id, $request);
        return redirect()->route('admin.nhacungcap.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->nhaCungCapServices->delete($id);
    }
}
