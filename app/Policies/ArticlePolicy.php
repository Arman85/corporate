<?php

namespace Corp\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Corp\User;
use Corp\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function save ( User $user )
    {
        return $user->canDo('ADD_ARTICLES');
    }

    public function edit ( User $user ) {
        return $user->canDo('UPDATE_ARTICLES');
    }

    public function destroy (User $user, Article $article)
    {
/*Если у пользователя есть права на удаление материала и если id пользователя который аутентифицирован на сайте, равен id который в поле user_id но в моделе $article,
то значит материал добавлен пользователь который сейчас аутенцифитирован.*/
        return ($user->canDo('DELETE_ARTICLES') && $user->id == $article->user_id);
    }
}
