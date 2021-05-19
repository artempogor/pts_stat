<?php

namespace App\Orchid\Screens;
use App\Imports\PtsImport;
use App\Exports\PtsExport;
use App\Models\Status;
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
use Orchid\Support\Facades\Alert;

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
    protected function striped(): bool
    {
        return true;
    }

    public function query(Request $request): array
    {
        return [
            'pts'=>PTS::filters()
            ->defaultSort('id')
            ->paginate(10),

        'file' =>$request
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
                Input::make( 'file.files')
                    ->type('file')
                    ->horizontal(),
                Button::make('Импортировать и обновить')
                    ->icon('history')
                    ->horizontal()
                    ->method('importUpdate'),
                Button::make('Удалить и импортировать')
                    ->icon('brush')
                    ->horizontal()
                    ->method('importNew'),
                Link::make(__('Экспорт в Exel'))
                    ->icon('printer')
                    ->horizontal()
                    ->rawClick()
                    ->title('Файл для экспорта :')
                ->route('pts.export'),
            ])->label('Нажмите для импорта/файлов')];
    }

    public function importNew(Request $request)

    {
       // dd(request()->file('file.files'));
        if (empty(request()->file('file.files')))
        {
            Toast::error('Вы не приеркпили файл для импорта!')
                ->delay(5000);
            return back();

        }
        else{
        PTS::query()->delete();
        Status::query()->delete();
        Excel::import(new PtsImport(), request()->file('file.files'));
        Toast::success('Файл успешно загружен!')
                ->delay(5000);
            return back();
        }
    }
    public function importUpdate(Request $request)

    {
        if (empty(request()->file('file.files')))
        {
            Toast::error('Вы не приеркпили файл для импорта!')
                ->delay(5000);
            return back();

        }
        else{
            Excel::import(new PtsImport(), request()->file('file.files'));
            Toast::success('Файл успешно загружен!')
                ->delay(5000);
            return back();
        }
    }
}
