<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Post $post){
        if ($user->id == $post->user_id) {
            return true;
        }else{
            return false;
        }
    }

    // ? establece que el parametro es opcional y que donde se aplique esta policy
    // permitira que un usuario autentificado o no pueda acceder a la información filtrada
    public function published(?User $user, Post $post){
        if ($post->status == 2) {
            return true;
        }else{
            return false;
        }
    } 

}
