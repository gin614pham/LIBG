<?php

namespace App\Http\Controllers;

use App\Http\Services\DauSachServices;
use App\Http\Services\SachServices;
use App\Models\Sach;
use App\Http\Requests\StoreSachRequest;
use App\Http\Requests\UpdateSachRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminSachController extends Controller
{
    private SachServices $sachServices;
    private DauSachServices $dauSachServices;

    public function __construct(SachServices $sachServices, DauSachServices $dauSachServices)
    {
        $this->sachServices = $sachServices;
        $this->dauSachServices = $dauSachServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $saches = $this->sachServices->getAllPaginate();
        return view('admin.pages.sach.index', compact('saches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $dauSachs = $this->dauSachServices->findAll();
        return view('admin.pages.sach.create', compact('dauSachs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSachRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->sachServices->create($request);
        return redirect()->route('admin.sach.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sach  $sach
     * @return Response
     */
    public function show(Sach $sach)
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
        $dauSachs = $this->dauSachServices->findAll();
        $sach = $this->sachServices->findOne($id);
        return view('admin.pages.sach.edit', compact('dauSachs', 'sach'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSachRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->sachServices->update($request, $id);
        return redirect()->route('admin.sach.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->sachServices->delete($id);
    }
}
