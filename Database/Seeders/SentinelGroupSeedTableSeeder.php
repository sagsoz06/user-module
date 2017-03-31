<?php

namespace Modules\User\Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SentinelGroupSeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $groups = Sentinel::getRoleRepository();

        // Create an Admin group
        $groups->createModel()->create(
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ]
        );

        // Create an Users group
        $groups->createModel()->create(
            [
                'name' => 'User',
                'slug' => 'user',
            ]
        );

        // Save the permissions
        $group = Sentinel::findRoleBySlug('admin');
        $group->permissions = [
            'dashboard.index'                         => true,
            'dashboard.update'                        => true,
            'dashboard.reset'                         => true,
            /* Workbench */
            'workshop.modules.index'                  => true,
            'workshop.modules.show'                   => true,
            'workshop.modules.disable'                => true,
            'workshop.modules.enable'                 => true,
            'workshop.modules.update'                 => true,
            'workshop.themes.index'                   => true,
            'workshop.themes.show'                    => true,
            'workshop.themes.publish'                 => true,
            /* Roles */
            'user.roles.index'                        => true,
            'user.roles.create'                       => true,
            'user.roles.edit'                         => true,
            'user.roles.destroy'                      => true,
            /* Users */
            'user.users.index'                        => true,
            'user.users.create'                       => true,
            'user.users.edit'                         => true,
            'user.users.destroy'                      => true,
            /* API keys */
            'account.api-keys.index'                  => true,
            'account.api-keys.create'                 => true,
            'account.api-keys.destroy'                => true,
            /* Menu */
            'menu.menus.index'                        => true,
            'menu.menus.create'                       => true,
            'menu.menus.edit'                         => true,
            'menu.menus.destroy'                      => true,
            'menu.menuitems.index'                    => true,
            'menu.menuitems.create'                   => true,
            'menu.menuitems.edit'                     => true,
            'menu.menuitems.destroy'                  => true,
            /* Media */
            'media.medias.index'                      => true,
            'media.medias.create'                     => true,
            'media.medias.edit'                       => true,
            'media.medias.destroy'                    => true,
            /* Media Api */
            'api.media.store'                         => true,
            'api.media.link'                          => true,
            'api.media.unlink'                        => true,
            'api.media.all'                           => true,
            'api.media.sort'                          => true,
            /* Settings */
            'setting.settings.index'                  => true,
            'setting.settings.edit'                   => true,
            /* Page */
            'page.pages.index'                        => true,
            'page.pages.create'                       => true,
            'page.pages.edit'                         => true,
            'page.pages.destroy'                      => true,
            'page.pages.sitemap'                      => true,
            'api.page.update'                         => true,
            'api.page.destroy'                        => true,
            /* Translation */
            'translation.translations.index'          => true,
            'translation.translations.edit'           => true,
            'translation.translations.export'         => true,
            'translation.translations.import'         => true,
            /* Translation Api */
            'api.translation.translations.update'     => true,
            'api.translation.translations.clearCache' => true,
            'api.translation.translations.revisions'  => true,
            /* Tags */
            'tag.tags.index'                          => true,
            'tag.tags.create'                         => true,
            'tag.tags.edit'                           => true,
            'tag.tags.destroy'                        => true,
            /* Blog */
            'blog.posts.index'                        => true,
            'blog.posts.create'                       => true,
            'blog.posts.store'                        => true,
            'blog.posts.edit'                         => true,
            'blog.posts.update'                       => true,
            'blog.posts.destroy'                      => true,
            'blog.posts.sitemap'                      => true,
            /* Blog Categories */
            'blog.categories.index'                   => true,
            'blog.categories.create'                  => true,
            'blog.categories.store'                   => true,
            'blog.categories.edit'                    => true,
            'blog.categories.update'                  => true,
            'blog.categories.destroy'                 => true,
            'blog.categories.sitemap'                 => true,
            /* Blog Tags */
            'blog.tags.index'                         => true,
            'blog.tags.create'                        => true,
            'blog.tags.store'                         => true,
            'blog.tags.edit'                          => true,
            'blog.tags.update'                        => true,
            'blog.tags.destroy'                       => true,
            /* Block */
            'block.blocks.index'                      => true,
            'block.blocks.create'                     => true,
            'block.blocks.store'                      => true,
            'block.blocks.edit'                       => true,
            'block.blocks.update'                     => true,
            'block.blocks.destroy'                    => true,
            /* Contact */
            'contact.contacts.index'                  => true,
            'contact.contacts.create'                 => true,
            'contact.contacts.edit'                   => true,
            'contact.contacts.update'                 => true,
            'contact.contacts.destroy'                => true,
            /* Theme Slide */
            'theme.slides.index'                      => true,
            'theme.slides.create'                     => true,
            'theme.slides.edit'                       => true,
            'theme.slides.update'                     => true,
            'theme.slides.destroy'                    => true,
            /* Theme Slider */
            'theme.sliders.index'                     => true,
            'theme.sliders.create'                    => true,
            'theme.sliders.edit'                      => true,
            'theme.sliders.update'                    => true,
            'theme.sliders.destroy'                   => true,
            /* Store */
            'store.categories.index'                  => true,
            'store.categories.create'                 => true,
            'store.categories.edit'                   => true,
            'store.categories.destroy'                => true,
            'store.products.index'                    => true,
            'store.products.create'                   => true,
            'store.products.edit'                     => true,
            'store.products.destroy'                  => true,
            'store.brands.index'                      => true,
            'store.brands.create'                     => true,
            'store.brands.edit'                       => true,
            'store.brands.destroy'                    => true,
            'api.store.product.related'               => true,
            'api.store.product.update'                => true,
            'api.store.category.lists'                => true,
            'api.store.category.update'               => true,
            /* Localization */
            'localization.countries.index'            => true,
            'localization.countries.create'           => true,
            'localization.countries.edit'             => true,
            'localization.countries.destroy'          => true,
            'localization.cities.index'               => true,
            'localization.cities.districts'           => true,
            'localization.cities.create'              => true,
            'localization.cities.edit'                => true,
            'localization.cities.destroy'             => true,
            'localization.districts.index'            => true,
            'localization.districts.create'           => true,
            'localization.districts.edit'             => true,
            'localization.districts.destroy'          => true
        ];
        $group->save();
    }
}
