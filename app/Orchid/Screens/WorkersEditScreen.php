<?php

namespace App\Orchid\Screens;

use App\Models\Workers;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class WorkersEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Создание записи работника';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'работники';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Workers $workers): array
    {
        $this->exists = $workers->exists;
        if ($this->exists)
        {
            $this->name ='Изменить запись';
        }
        return [
            'workers' => $workers
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Вернутся к остальным')
                ->icon('action-undo')
                ->route('workers.lists'),
            Button::make('Создать запись')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('workers.tn')
                    ->title('Табельный номер работника')
                    ->placeholder('0000000001')
                    ->required()
                    ->help('Введите ФИО работника '),
                Input::make('workers.fio')
                    ->title('ФИО')
                    ->placeholder('Петров Иван Васильевич')
                    ->required()
                    ->help('Введите ФИО работника'),
                Input::make('workers.phone')
                    ->title('Телефон')
                    ->placeholder('0711234567')
                    ->help('Введите номер телефона работника '),
                Select::make('workers.post')
                    ->empty('инженер')
                    ->help('Введите должность работника ')
                    ->options([
                        'главный инженер'=> 'главный инженер',
                        'инженер второй категории' => 'инженер второй категории' ,
                        'инженер первой категории' => 'инженер первой категории'
                    ]),



            ])
        ];
    }
    public function createOrUpdate(Workers $workers, Request $request)
    {
        $request->validate(
            [
                'workers.fio'=>'required',
                'workers.tn'=>'required',
            ]);


        $workers->fill($request->get('workers'))->save();
        Alert::info('Вы успешно обновили запись!');
        return redirect()->route('workers.lists');

    }
    public function remove(Workers $workers)
    {
        $workers->delete();
        Alert::info('Запись успешно удаленна');
        return redirect()->route('workers.lists');
    }
}
