<?php
/**
 * Created by PhpStorm.
 * User: Visualturk
 * Date: 23.02.2017
 * Time: 18:01
 */

namespace Modules\User\Composers;


use Illuminate\View\View;
use Modules\User\Repositories\UserRepository;

class UserListViewComposer
{
    /**
     * @var UserRepository
     */
    private $user;

    public function __construct(UserRepository $user)
    {

        $this->user = $user;
    }

    public function compose(View $view)
    {
        $view->with('userLists', $this->user->all()->pluck('fullname', 'id')->toArray());
    }
}