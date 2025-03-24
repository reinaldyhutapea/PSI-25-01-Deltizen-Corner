<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    // Tambahkan function untuk dashboard
    public function dashboard() {
        return view('admin.dashboard'); // Pastikan view ini ada di resources/views/admin/dashboard.blade.php
    }

    public function profil() {
        return view('admin.profil');
    }

    public function store(Request $request) {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('admin.profil')->with('success', 'Password berhasil diubah');
    }
}
