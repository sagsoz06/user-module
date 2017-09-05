<?php

namespace Modules\User\Entities\Sentinel;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Users\EloquentUser;
use Laracasts\Presenter\PresentableTrait;
use Modules\Blog\Entities\Post;
use Modules\User\Entities\UserInterface;
use Modules\User\Entities\UserToken;
use Modules\User\Presenters\UserPresenter;

class User extends EloquentUser implements UserInterface, AuthenticatableContract
{
    use PresentableTrait, Authenticatable;

    protected $fillable = [
        'email',
        'password',
        'permissions',
        'first_name',
        'last_name',
        'slug'
    ];

    /**
     * {@inheritDoc}
     */
    protected $loginNames = ['email'];

    protected $presenter = UserPresenter::class;

    protected $appends = ['fullname'];

    public function __construct(array $attributes = [])
    {
        $this->loginNames = config('asgard.user.config.login-columns');
        $this->fillable = config('asgard.user.config.fillable');
        if (config()->has('asgard.user.config.presenter')) {
            $this->presenter = config('asgard.user.config.presenter', UserPresenter::class);
        }
        if (config()->has('asgard.user.config.dates')) {
            $this->dates = config('asgard.user.config.dates', []);
        }
        if (config()->has('asgard.user.config.casts')) {
            $this->casts = config('asgard.user.config.casts', []);
        }

        parent::__construct($attributes);
    }

    /**
     * @inheritdoc
     */
    public function hasRoleId($roleId)
    {
        return $this->roles()->whereId($roleId)->count() >= 1;
    }

    /**
     * @inheritdoc
     */
    public function hasRoleSlug($slug)
    {
        return $this->roles()->whereSlug($slug)->count() >= 1;
    }

    /**
     * @inheritdoc
     */
    public function hasRoleName($name)
    {
        return $this->roles()->whereName($name)->count() >= 1;
    }

    /**
     * @inheritdoc
     */
    public function isActivated()
    {
        if (Activation::completed($this)) {
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function api_keys()
    {
        return $this->hasMany(UserToken::class);
    }

    /**
     * @inheritdoc
     */
    public function getFirstApiKey()
    {
        $userToken = $this->api_keys->first();

        if ($userToken === null) {
            return '';
        }

        return $userToken->access_token;
    }

    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.user.config.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function->bindTo($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

    /**
     * @inheritdoc
     */
    public function hasAccess($permission)
    {
        $permissions = $this->getPermissionsInstance();

        return $permissions->hasAccess($permission);
    }

    public function getFullNameAttribute()
    {
        return $this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name');
    }

    public function blogPosts()
    {
        return $this->hasMany(Post::class)->with('translations');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function(User $user) {
            $user->slug = str_slug(\Patchwork\Utf8::toAscii($user->first_name.' '.$user->last_name));
        });

        static::updating(function(User $user) {
            $user->slug = str_slug(\Patchwork\Utf8::toAscii($user->first_name.' '.$user->last_name));
        });
    }
}