<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Клиенты')
            ->icon('bs.people')
            ->route('platform.clients')
            ->title(__('Списки')),

//            Menu::make('Get Started')
//                ->icon('bs.book')
//                ->title('Navigation')
//                ->route(config('platform.index')),
//
//            Menu::make('Sample Screen')
//                ->icon('bs.collection')
//                ->route('platform.example')
//                ->badge(fn () => 6),
//
//            Menu::make('Form Elements')
//                ->icon('bs.card-list')
//                ->route('platform.example.fields')
//                ->active('*/examples/form/*'),
//
//            Menu::make('Overview Layouts')
//                ->icon('bs.window-sidebar')
//                ->route('platform.example.layouts'),
//
//            Menu::make('Grid System')
//                ->icon('bs.columns-gap')
//                ->route('platform.example.grid'),
//
//            Menu::make('Charts')
//                ->icon('bs.bar-chart')
//                ->route('platform.example.charts'),
//
//            Menu::make('Cards')
//                ->icon('bs.card-text')
//                ->route('platform.example.cards')
//                ->divider(),
            Menu::make(__('Договора'))
                ->icon('bs.file-earmark-bar-graph')
                ->route('platform.contracts')
                ->title(__('Мои договора')),
//
            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider()
//
//            Menu::make('Documentation')
//                ->title('Docs')
//                ->icon('bs.box-arrow-up-right')
//                ->url('https://orchid.software/en/docs')
//                ->target('_blank'),
//
//            Menu::make('Changelog')
//                ->icon('bs.box-arrow-up-right')
//                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
//                ->target('_blank')
//                ->badge(fn () => Dashboard::version(), Color::BASIC),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
            ItemPermission::group(__('Внутренние сервисы'))
                ->addPermission('platform.clients', __('Клиенты'))
                ->addPermission('platform.clients', __('Аналитика'))
                ->addPermission('platform.clients', __('Договора'))
                ->addPermission('platform.clients', __('Логистика'))
                ->addPermission('platform.clients', __('Склады'))
                ->addPermission('platform.clients', __('Маркетинг'))
                ->addPermission('platform.clients', __('Новости'))
                ->addPermission('platform.clients', __('HR'))
                ->addPermission('platform.clients', __('Элеватор')),
            ItemPermission::group(__('Клиент'))
                ->addPermission('platform.clients', __('Договора'))
                ->addPermission('platform.clients', __('Доставки'))
                ->addPermission('platform.clients', __('Документы'))
                ->addPermission('platform.clients', __('Поля'))
                ->addPermission('platform.clients', __('Автопарк'))
                ->addPermission('platform.clients', __('Новости'))
                ->addPermission('platform.clients', __('Опросы'))
                ->addPermission('platform.clients', __('Заявки на субсидии')),
            ItemPermission::group(__('Партнеры'))
                ->addPermission('platform.clients', __('Договора'))
                ->addPermission('platform.clients', __('Закрывающие документы'))
                ->addPermission('platform.clients', __('Новости'))
        ];
    }
}
