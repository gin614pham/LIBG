<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserServices {
    private User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function findAll(): Collection
    {
        return $this->user->all();
    }

    public function findOne($id)
    {
        return $this->user->find($id);
    }

    public function create($request): bool
    {
        $new = new User([
            'Ten' => $request->Ten,
            'GioiTinh' => $request->GioiTinh,
            'NamSinh' => $request->NamSinh,
            'SDT' => $request->SDT,
            'ChucDanh' => $request->ChucDanh,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return $new->save();
    }

    public function update($id, $request)
    {
        $user = $this->findOne($id);
        $user->Ten = $request->Ten;
        $user->GioiTinh = $request->GioiTinh;
        $user->NamSinh = $request->NamSinh;
        $user->SDT = $request->SDT;
        $user->ChucDanh = $request->ChucDanh;
        $user->email = $request->email;
        $user->password = $request->password;
        return $user->update();
    }

    public function delete($id)
    {
        try {
            $item = $this->findOne($id);
            if ($item){
                $item->delete();
                return response()->json([
                    'check' => true,
                    'message' => 'ok'
                ], 200);
            } else {
                return response()->json([
                    'check' => false,
                    'message' => '!ok'
                ], 400);
            }
        } catch (\Exception $e){
            echo $e->getMessage();
            return response()->json([
                'check' => false,
                'message' => '!ok'
            ], 400);

        }
    }

    public function changePassword($id, $request)
    {
        $user = $this->findOne($id);
        $user->password = $request->password;
        return $user->update();
    }

    public function checkLogin($email, $password)
    {
        $user = $this->user->where('email', $email)->first();
        if ($user) {
            if (password_verify($password, $user->password))
                return $user;
        }
        return false;
    }







}

