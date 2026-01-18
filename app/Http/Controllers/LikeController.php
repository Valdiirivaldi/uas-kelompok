<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        // Cek apakah user sudah pernah like postingan ini
        $like = Like::where('post_id', $post->id)
                    ->where('user_id', auth()->id())
                    ->first();

        if ($like) {
            $like->delete(); // Jika sudah ada, maka dihapus (Unlike)
        } else {
            // Jika belum ada, maka buat data baru (Like)
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id
            ]);
        }

        return back(); // Kembali ke halaman sebelumnya
    }
}