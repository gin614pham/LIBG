<?php

namespace App\Http\Controllers;

use App\Http\Services\DauSachServices;
use App\Http\Services\DocGiaServices;
use App\Http\Services\MailServices;
use App\Http\Services\NgonNguServices;
use App\Http\Services\NhaCungCapServices;
use App\Http\Services\PhanLoaiServices;
use App\Http\Services\PhieuMuonServices;
use App\Http\Services\PhieuNhapServices;
use App\Http\Services\SachServices;
use App\Http\Services\ThanhLyServices;
use App\Http\Services\TheLoaiServices;
use App\Http\Services\UserServices;
use App\Http\Services\ViPhamServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private UserServices $userServices;
    private DauSachServices $dauSachServices;
    private SachServices $sachServices;
    private DocGiaServices $docGiaServices;
    private NgonNguServices $ngonNguServices;
    private NhaCungCapServices $nhaCungCapServices;
    private PhanLoaiServices $phanLoaiServices;
    private PhieuMuonServices $phieuMuonServices;
    private PhieuNhapServices $phieuNhapServices;
    private ThanhLyServices $thanhLyServices;
    private TheLoaiServices $theLoaiServices;
    private ViPhamServices $viPhamServices;
    private MailServices $mailServices;

    public function __construct(
         UserServices $userServices,
         DauSachServices $dauSachServices,
         SachServices $sachServices,
         DocGiaServices $docGiaServices,
         NgonNguServices $ngonNguServices,
         NhaCungCapServices $nhaCungCapServices,
         PhanLoaiServices $phanLoaiServices,
         PhieuMuonServices $phieuMuonServices,
         PhieuNhapServices $phieuNhapServices,
         ThanhLyServices $thanhLyServices,
         TheLoaiServices $theLoaiServices,
         ViPhamServices $viPhamServices,
         MailServices $mailServices,
    )
    {
        $this->userServices = $userServices;
        $this->dauSachServices = $dauSachServices;
        $this->sachServices = $sachServices;
        $this->docGiaServices = $docGiaServices;
        $this->ngonNguServices = $ngonNguServices;
        $this->nhaCungCapServices = $nhaCungCapServices;
        $this->phieuNhapServices = $phieuNhapServices;
        $this->phanLoaiServices = $phanLoaiServices;
        $this->theLoaiServices = $theLoaiServices;
        $this->viPhamServices = $viPhamServices;
        $this->phieuMuonServices = $phieuMuonServices;
        $this->thanhLyServices = $thanhLyServices;
        $this->mailServices = $mailServices;
    }

    public function login(){
        return view('admin.pages.auth.login');
    }

    public function getLogin(Request $request): RedirectResponse
    {
        $user = $this->userServices->checkLogin($request->email, $request->password);
        if ($user) {
            auth()->login($user);
            return redirect()->route('admin.dausach.index');
        }
            else
            {
                session()->flash('error', 'Email or password is incorrect');
                return redirect()->back()->withInput();
            }

    }

    public function logout(){
        auth()->logout();
        return redirect()->route('admin.auth.login');
    }

    public function sendNotification($id): JsonResponse
    {
        $phieuMuon = $this->phieuMuonServices->findOne($id);
        return $this->mailServices->confirm($phieuMuon);
    }

    public function statistical(): Factory|View|Application
    {
        $sumDauSach = $this->dauSachServices->findAll()->count();
        $sumSach = $this->sachServices->getAll()->count();
        $sumDocGia = $this->docGiaServices->findAll()->count();
        $sumTheLoai = $this->theLoaiServices->findAll()->count();
        $sumPhieuMuon = $this->phieuMuonServices->getAll()->count();
        $sumPhieuNhap = $this->phieuNhapServices->getAll()->count();
        $sumThanhLy = $this->thanhLyServices->findAll()->count();
        $sumViPham = $this->viPhamServices->findAll()->count();
        return view('admin.pages.index', compact(
            'sumDauSach', 'sumSach', 'sumDocGia',
                    'sumTheLoai', 'sumPhieuMuon', 'sumPhieuNhap',
                    'sumThanhLy', 'sumViPham',
        ));
    }

}
