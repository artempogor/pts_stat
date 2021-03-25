<?php

namespace App\Orchid\Screens;
use App\Models\User;
use App\Models\PTS;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PtsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Создание нового ПТС';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'ПТС';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(PTS $pts): array
    {
        $this->exists = $pts->exists;
        if ($this->exists)
        {
            $this->name ='Изменить запись';
        }
        return [
        'pts' => $pts
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
                Input::make('pts.serial_pts')
                    ->title('Cерийный номер')
                    ->placeholder('####')
                    ->required()
                    ->help('Введите порядковый номер '),

                Input::make('pts.address')
                    ->title('Адресс терминала')
                    ->placeholder('Пр.Богдана Хмельницкого д.102')
                    ->help('Введите адресс '),

                Input::make('pts.ip')
                    ->title('IP')
                    ->required()
                    ->placeholder('127.0.0.1')
                    ->help('Введите IP адресс '),

                Select::make('pts.city')
                    ->empty('Донецк', 0)
                    ->options([
                        1 => 'Горловка',
                        2 => 'Макеевка',
                    ]),




            Quill::make('pts.info')
                ->title('Main text'),

        ])
        ];
    }
    public function createOrUpdate(PTS $pts, Request $request)
    {
        $request->validate(
            [
                'pts.serial_pts'=>'required|max:4|unique:pts_status,serial_pts',
                'pts.address'=>'required|max:50',
                'pts.ip'=>'required|ip',
            ]);


    $pts->fill($request->get('pts'))->save();
    Alert::info('Вы успешно обновили запись!');
    return redirect()->route('pts.list');

    }
    public function remove(PTS $pts)
    {
        $pts->delete();
        Alert::info('Запись успешно удаленна');
        return redirect()->route('pts.list');
    }
}
