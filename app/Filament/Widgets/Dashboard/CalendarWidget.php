<?php

namespace App\Filament\Widgets\Dashboard;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Actions;
use App\Models\Event;
use Saade\FilamentFullCalendar\Data\EventData;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms;
use Saade\FilamentFullCalendar\Actions\CreateAction;

class CalendarWidget extends FullCalendarWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;

    protected function headerActions(): array
    {
        return [
            CreateAction::make()
                ->mountUsing(
                    function (Forms\Form $form, array $arguments) {
                        $form->fill([
                            'starts_at' => $arguments['start'] ?? null,
                            'ends_at' => $arguments['end'] ?? null
                        ]);
                    }
                )
        ];
    }
    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make()
                ->mountUsing(
                    function (Event $record, Forms\Form $form, array $arguments) {
                        $form->fill([
                            'name' => $record->name,
                            'starts_at' => $arguments['event']['start'] ?? $record->starts_at,
                            'ends_at' => $arguments['event']['end'] ?? $record->ends_at
                        ]);
                    }
                ),
            Actions\DeleteAction::make(),
        ];
    }

    public function eventDidMount(): string
    {
        return <<<JS
            function({ event, timeText, isStart, isEnd, isMirror, isPast, isFuture, isToday, el, view }){
                el.setAttribute("x-tooltip", "tooltip");
                el.setAttribute("x-data", "{ tooltip: '"+event.title+"' }");
            }
        JS;
    }

    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        // This method should return an array of event-like objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#returning-events
        // You can also return an array of EventData objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#the-eventdata-class
        return  Event::query()
            ->get()
            ->map(
                fn (Event $event) => EventData::make()
                    ->id($event->id)
                    ->title($event->name)
                    ->start($event->starts_at)
                    ->end($event->ends_at)
            )
            ->toArray();
    }
    protected function getStats(): array
    {
        return [
            //
        ];
    }
    public Model | string | null $model = Event::class;

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'left' => 'dayGridWeek,dayGridDay',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name'),

            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DateTimePicker::make('starts_at'),

                    Forms\Components\DateTimePicker::make('ends_at'),
                ]),
        ];
    }
}
