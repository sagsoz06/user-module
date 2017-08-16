<?php

namespace Modules\User\Events;

use Modules\Core\Events\AbstractEntityHook;
use Modules\Core\Contracts\EntityIsChanging;
use Modules\User\Entities\UserInterface;

class UserIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    private $user;

    public function __construct(UserInterface $user, array $data)
    {
        $this->user = $user;
        parent::__construct($data);
    }
}