<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability)
    {
        if ($user->role === 'Admin') {
            return true;
        }
    }

    public function view(User $user, Article $article)
    {
        return true; 
    }

    public function create(User $user)
    {
        return $user->is_approved;
    }

    public function update(User $user, Article $article)
    {
        return $user->username === $article->contributor_username;
    }

    public function delete(User $user, Article $article)
    {
        return $user->username === $article->contributor_username;
    }
} 