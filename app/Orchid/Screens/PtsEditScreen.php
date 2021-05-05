<?php

namespace App\Orchid\Screens;
use App\Models\User;
use App\Models\PTS;
use App\Orchid\Layouts\PtsMaps;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Map;
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
            Link::make('Вернутся к остальным')
                ->icon('action-undo')
                ->route('pts.lists'),
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
                    ->required( )
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
                    ->empty('Донецк',  'Донецк')
                    ->options([
                         'Горловка' => 'Горловка',
                         'Макеевка'=> 'Макеевка',
                    ]),


            Quill::make('pts.info')
                ->toolbar(["text","header", "list", "media"])
                ->title('Main text'),

                PtsMaps::make('pts.place')
                    ->title('ПТС на карте')
                    ->help('Введите/проверьте координаты на карте'),
        ])
        ];
    }
    public function createOrUpdate(PTS $pts, Request $request)
    {
        $request->validate(
            [
                'pts.serial_pts'=>'required|unique:pts,serial_pts,'.$pts->id,
                'pts.address'=>'required|max:50',
                'pts.ip'=>'required|ip',
            ]);


    $pts->fill($request->get('pts'))->save();
    Alert::info('Вы успешно обновили запись!');
    return redirect()->route('pts.lists');

    }
    public function remove(PTS $pts)
    {
        $pts->delete();
        Alert::info('Запись успешно удаленна');
        return redirect()->route('pts.list');
    }
}
