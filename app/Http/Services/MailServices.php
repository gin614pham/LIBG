<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class MailServices {
    public function sendMail($phieuMuon): void
    {
        $data = [
            'name' => $phieuMuon->DocGia->Ten,
            'email' => $phieuMuon->DocGia->Email,
            'subject' => 'Thông báo thời hạn trả sách',
            'body' => "Đây là thông báo về hạn trả sách
                - Mã sách: {$phieuMuon->MaSach}
                - Tên sách: {$phieuMuon->Sach->DauSach->TenSach}
                - Ngày mượn: ".Carbon::parse($phieuMuon->created_at)->format('d-m-Y H:i:s')."
                - Hạn trả: ".Carbon::parse($phieuMuon->HanTra)->format('d-m-Y')."
            Xin vui lòng trả sách đúng hạn."
        ];

        Mail::send('admin.Mails.notification', $data, function ($message) use ($data) {
            $message->from(env('MAIL_FROM_ADDRESS', 'thuvien@qltv.com'), config('app.name'));
            $message->to($data['email'], $data['name']);
            $message->subject($data['subject']);
        });
    }

    public function confirm($phieuMuon): JsonResponse
    {
        try {
            $this->sendMail($phieuMuon);
            return response()->json([
                'check' => true,
                'message' => 'ok'
            ], 200);
        } catch (\Exception $e){
            echo $e->getMessage();
            return response()->json([
                'check' => false,
                'message' => '!ok'
            ], 400);

        }
    }
}
