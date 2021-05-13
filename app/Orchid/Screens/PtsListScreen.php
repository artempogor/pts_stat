<?php

namespace App\Orchid\Screens;
use App\Exports\PtsExport;
use App\Orchid\Layouts\FiltersPTS;
use App\Orchid\Layouts\ListPTSLayout;
use App\Models\PTS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use PHPUnit\Util\Filter;

class PtsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ПТС';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Все Терминалы';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'pts'=>PTS::filters()
            ->defaultSort('id')
            ->paginate(6),
//            'sort_pts'=>PTS::with('serial_pts')
//                ->filters()
//                ->filtersApplySelection(FiltersPTS::class)
//                ->defaultSort('id', 'desc')
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
            Link::make('Создать запись')
                ->canSee(Auth::user()->hasAccess('create_pts'))
                ->icon('pencil')
                ->route('pts.edit'),
            ];
    }
    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     * .
     */
    public function layout(): array
    {
        return [
            ListPTSLayout::class,
            Layout::collapse([
                Input::make( 'file')
                    ->type('file')
                    ->horizontal()
                    ->title('Файл для импорта :'),
                Link::make(__('Экспорт в Exel'))
                    ->icon('printer')
                    ->horizontal()
                    ->rawClick()
                    ->title('Файл для экспорта :')
                ->route('pts.export'),
            ])->label('Нажмите для импорта/файлов')];
    }
}
