<?php

namespace App\Policies;

use App\Models\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
    use HandlesAuthorization;
 
    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user)
    {
       
        return $user->id == $user->user_id;
  
    }
   
    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->id == $user->id;
    }




    public function userDelete(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

}