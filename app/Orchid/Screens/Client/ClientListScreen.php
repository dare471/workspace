<?php

namespace App\Orchid\Screens\Client;

use App\Models\ref\region\Region;
use App\Models\Service;
use App\Orchid\Layouts\Client\CLientListTable;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Label;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use App\Models\Client;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class ClientListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'clients' => Client::with(['service', 'region'])->filters()->defaultSort('status', 'desc')->paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Клиенты';
    }
    public function description(): ?string
    {
        return "Список клиентов";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Создать клиента')->modal('createClient')->method('create'),
            ModalToggle::make('Редактировать')->modal('editClient')->method('update'),
            ModalToggle::make('Создать встречу')->modal('createVisitClient')->method('createVisit'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::tabs([
                'Мои клиенты' => [
                CLientListTable::class,
                        Layout::modal('createClient', [
                            Layout::rows([
                                Group::make([
                                    Input::make('name')->title('Имя')->required(),
                                    Input::make('last_name')->title('Фамилья')->required(),
                                ]),
                                Group::make([
                                    Input::make('phone')->mask('8(999)999-99-99')->title('Телефон')->required(),
                                    Input::make('email')->title('Email')->required()
                                ]),
                                Input::make('bin')
                                    ->mask('999-999-999-999')
                                    ->title('БИН')
                                    ->required(),
                                DateTimer::make('birthday')
                                    ->title('День рождение')
                                    ->format('Y-m-d'),
                                Relation::make('region_id')
                                    ->title('Область')
                                    ->fromModel(Region::class, 'rus_name')
                                    ->applyScope('cd', '00')  // Применяем scope с параметром
                                    ->chunk(160)  // Загружаем порциями по 160 элементов
                                    ->required(),
                                Relation::make('service_id')
                                    ->title('Выберите сервис')
                                    ->fromClass(Service::class, 'name')
                                    ->required()]),
                        ])->title('Создать клиента')->applyButton('Создать'),
                        Layout::modal('editClient', Layout::rows([
                            Input::make('client.id')
                                ->required()
                                ->type('hidden'),
                            Group::make([
                                Input::make('client.name')
                                    ->required()
                                    ->title('Имя'),
                                Input::make('client.last_name')
                                    ->required()
                                    ->title('Фамилья'),
                            ]),
                            Group::make([
                                Input::make('client.email')
                                    ->required()
                                    ->title('Email'),
                                Input::make('client.phone')
                                    ->required()
                                    ->title('Телефон')
                                    ->disabled(),
                            ]),
                            Input::make('client.bin')
                                ->required()
                                ->title('БИН')
                                ->disabled(),
                            Relation::make('client.region_id')
                                ->title('Область')
                                ->fromModel(Region::class, 'rus_name')
                                ->applyScope('cd', '00')  // Применяем scope с параметром
                                ->chunk(160)  // Загружаем порциями по 160 элементов
                                ->required(),
                            Relation::make('client.service_id')->title('Выберите сервис')->fromModel(Service::class, 'name')->required()
                                ->help('Одиз из видов услуг для клиента'),
                            Select::make('client.assesment')->options([
                                'Отлично' => 'Отлично',
                                'Хорошо' => 'Хорошо',
                                'Удовлетворительно' => 'Удовлетворительно',
                                'Отвратительно' =>'Отвратительно'
                            ])->help('Реакция на оказанную услугу')
                                ->empty('Неизвестно', 'Неизвестно')
                        ]))->async('asyncGetClient')->title('Изменить данные')->applyButton('Сохранить'),
                    //view modal
                    Layout::modal('viewClient',
                        Layout::rows([
                            Group::make([
                                Label::make('client.id')
                                    ->title('Client ID')
                                    ->value('Здесь будет значение идентификатора клиента'),
                            ]),
                        ])
                    )->async('asyncGetClient')
                    ],
            'Мои визиты' =>[
                CLientListTable::class,
            ]
            ])
        ];
    }


    public function asyncGetClient(Client $client): array
    {
        return [
            'client' => $client
        ];
    }

    public function create(Request $request):void
    {
        $request->validate([
            'phone' => ['required'],
            'name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'bin' => ['required'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'service_id' => ['exists:services,id', 'required'],
            'region_id' => ['exists:region,ab', 'required'],
            'district_id' => ['exists:region,id', 'required'],
        ]);

        Client::create($request->merge([
            'status'=> 'not_interviewed'
        ])->except('_token'));
        Toast::info('Клиент добавлен');
    }
    public function update(Request $request):void
    {
       // dd($request->all());
        Client::find($request->input('client.id'))->update(array_merge($request->client,[
           'status'=> 'not_interviewed'
        ]));
        Toast::info('Данные обновлены');

    }
}
