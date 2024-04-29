<?php

namespace App\Orchid\Layouts\Client;

use App\Models\Client;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Filter\Filterable;

class CLientListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'clients';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Имя')
                ->align(TD::ALIGN_LEFT)
                ->filter(TD::FILTER_TEXT),
            TD::make('last_name', 'Фамилия')
                ->align(TD::ALIGN_LEFT)
                ->filter(TD::FILTER_TEXT),
            TD::make('bin', 'БИН|ИИН')
                ->align(TD::ALIGN_LEFT)
                ->filter(TD::FILTER_TEXT),
            TD::make('phone', 'Телефон')
                ->cantHide()
                ->canSee($this->isWorkTime())
                ->filter(TD::FILTER_TEXT),
            TD::make('email', 'Email')
                ->align(TD::ALIGN_LEFT)
                ->filter(TD::FILTER_TEXT),
            TD::make('client_type', 'Тип клиента')
                ->render(function (Client $client){
                return $client->client_type === 'Individual' ? 'Физ.лицо' : 'Крестьянское хозяйство';
            })->sort()
                ->width('100px')
                ->align(TD::ALIGN_LEFT),
            TD::make('status','Статус')
                ->render(function (Client $client){
                return $client->status === 'interviewed' ? 'Опрошен' : 'Неопрошен';
            })->width('110px')
                ->popover('Статус по результатам работы оператора')
                ->sort()
                ->align(TD::ALIGN_LEFT),
            TD::make('birthday', 'День рождение')
                ->align(TD::ALIGN_LEFT),
            TD::make('assesment', 'Оценка')
                ->sort('assesment')
                ->width('150px')
                ->align(TD::ALIGN_LEFT),
            TD::make('service.name','Выберите сервис')
                ->sort()
                ->align(TD::ALIGN_LEFT),
            TD::make('region.rus_name', 'Выберите область')
            ->sort()
            ->align(TD::ALIGN_LEFT),
            TD::make('actions', 'Действия')
                ->render(function (Client $client) {
                    // Создание двух кнопок в одной строке
                    $editButton = ModalToggle::make('')
                        ->icon('pencil')
                        ->modal('editClient')
                        ->method('update')
                        ->modalTitle('Редактировать клиента - "' . $client->name . ' ' . $client->last_name . '"')
                        ->cantHide()
                        ->asyncParameters(['client' => $client->id]);

                    $viewButton = ModalToggle::make('')
                        ->icon('wallet')
                        ->modal('viewClient')
                        ->method('view')
                        ->modalTitle('Просмотр')
                        ->cantHide()
                        ->asyncParameters(['client' => $client->id]);
                       // Добавляем класс для стилизации

                    // Возвращаем кнопки как строку или HTML-код
                    return $editButton . ' ' . $viewButton; // Можно добавить разделитель, если требуется
                })->cantHide()
        ];
    }
    public  function  isWorkTime():bool
    {
        $launch = CarbonPeriod::create('10:00', '11:00');
        return $launch->contains(Carbon::now(config('app.timezone'))) === false;
    }
}
