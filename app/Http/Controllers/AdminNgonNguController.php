<?php

namespace App\Http\Controllers;

use App\Http\Services\NgonNguServices;
use App\Models\NgonNgu;
use App\Http\Requests\StoreNgonNguRequest;
use App\Http\Requests\UpdateNgonNguRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminNgonNguController extends Controller
{
    private NgonNguServices $ngonNguServices;

    public function __construct(NgonNguServices $ngonNguServices)
    {
        $this->ngonNguServices = $ngonNguServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ngonNgus = $this->ngonNguServices->findAll();
        return view('admin.pages.ngonngu.index', compact('ngonNgus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.ngonngu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreNgonNguRequest $request): RedirectResponse
    {
        $this->ngonNguServices->create($request);
        return redirect()->route('admin.ngonngu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NgonNgu  $ngonNgu
     * @return Response
     */
    public function show(NgonNgu $ngonNgu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NgonNgu  $ngonNgu
     * @return Response
     */
    public function edit($id)
    {
        $ngonNgu = $this->ngonNguServices->findOne($id);
        return view('admin.pages.ngonngu.edit', compact('ngonNgu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNgonNguRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateNgonNguRequest $request, $id): RedirectResponse
    {
        $this->ngonNguServices->update($request, $id);
        return redirect()->route('admin.ngonngu.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->ngonNguServices->delete($id);
    }
}
