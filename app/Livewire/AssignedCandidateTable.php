<?php

namespace App\Livewire;

use App\Filament\Resources\Actions\CandidateAddNotesAction;
use App\Filament\Resources\Actions\CandidateAddToBlacklistAction;
use App\Filament\Resources\Actions\CandidateViewAction;
use App\Filament\Resources\Actions\ConfirmCandidateAction;
use App\Filament\Resources\CandidatesDuringRecruitmentResource;
use App\Filament\Resources\CandidatesWorkingResource;
use App\Http\Controllers\StuffController;
use App\Models\Candidate;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\Position;
use App\Models\Project;
use App\Services\CandidateService;
use Carbon\Carbon;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use IbrahimBougaoua\FilamentRatingStar\Columns\RatingStarColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use mysql_xdevapi\Exception;

#[Lazy]
class AssignedCandidateTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $orderId;
    public $isPlanning;
    public $customerId;

    public function getTableQuery()
    {
        if ($this->isPlanning) {
            $this->customerId = Orders::find($this->orderId[0])->customer_id;
        }

        return Candidate::query()
            ->when($this->orderId, function ($query) {
                $query->whereIn('order_id', $this->orderId)
                    ->whereNot('is_working', Candidate::STATUS_NOT_WORKING);

                if ($this->isPlanning) {
                    $query->where('is_working', Candidate::STATUS_WORKING)
                        ->whereHas('projects', function ($query) {
                            $query->where('customer_id', $this->customerId);
                        });
                }

                $query->with(['projects' => function ($query) {
                    if ($this->isPlanning) {
                        $query->where('customer_id', $this->customerId);
                    }
                }]);
            });
    }

    protected function getTableColumns(): array
    {
        if($this->isPlanning)
        {
            return $this->planningTableSchema();
        }
        return [
            TextColumn::make('full_name', 'Name')
                ->label(__('admin_candidate.full_name'))
                ->sortable()
                ->getStateUsing(function (Model $record) {
                    return $record->first_name . ' ' . $record->last_name;
                })
                ->searchable(['first_name', 'last_name']),
            TextColumn::make('positions_names')
                ->sortable()
                ->label(__('admin_candidate.position')),
        ];
    }

    protected function getDefaultTableSortColumn(): ?string
    {

        return $this->isPlanning ? 'last_name' : 'first_name';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'asc';
    }

    protected function getTableFilters(): array
    {
        if(!$this->isPlanning) return [];

        return [
            Filter::make('date_filter')
                ->form([
                    Select::make('month')
                        ->options(array_combine(range(1, 12), range(1, 12)))
                        ->label(__('admin_planning.month')),
                    Select::make('year')
                        ->options(array_combine(range(2020, 2027), range(2020, 2027)))
                        ->label(__('admin_planning.year')),
                ])
                ->query(function (Builder $query, array $data) {
                    if (isset($data['month']) && isset($data['year'])) {
                        $query->whereHas('projects', function ($query) use ($data) {
                            $query->whereMonth('start_time', $data['month'])
                                ->whereYear('start_time', $data['year'])
                                ->where('customer_id', $this->customerId); // Ensure customer_id matches
                        });
                    }
                }),
        ];
    }


    protected function getTableActions(): array
    {
        if($this->isPlanning)
        {
            return $this->planningActionSchema();
        }
        return [

            ActionGroup::make([
                ConfirmCandidateAction::make()
                    ->tooltip(__('admin_order.confirm_candidate')),
                ViewAction::make()
                    ->form(CandidateService::getFormSchema())
                    ->modalWidth('md')
                    ->slideOver()
                    ->tooltip(__('admin_candidate.view_candidate')),
                CandidateAddToBlacklistAction::make()
                    ->visible(fn($record)=>$record->is_working == Candidate::STATUS_DURING_RECRUITMENT ? 1 : 0),
                CandidateAddNotesAction::make(),
                Action::make('Remove')
                    ->tooltip(__('admin_order.remove_candidate'))
                    ->color('danger')
                    ->icon('heroicon-s-user-minus')
                    ->requiresConfirmation()
                    ->action(function(Candidate $candidate){
                        try {
                            $candidate->order_id = 0;
                            $candidate->is_working = Candidate::STATUS_NOT_WORKING;
                            $candidate->save();
                            Notification::make()
                                ->title('Success')
                                ->body('Candidate is remove from the order successfully')
                                ->success()
                                ->send();
                        }catch (\Exception $e) {
                            Notification::make()
                                ->title('Error')
                                ->body('Failed to remove candidate from the order.')
                                ->danger()
                                ->send();
                            throw new \Exception($e->getMessage());
                        }
                    })
            ])
        ];
    }

    public function planningActionSchema(): array
    {
        return [
            ActionGroup::make([
                Action::make('complete')
                    ->tooltip(__('admin_planning.end_project'))
                    ->icon('heroicon-o-document-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-document-check')
                    ->modalHeading(fn($record) => $record->fullName)
                    ->form([
                        DatePicker::make('end_date')
                            ->label('End Project')
                            ->required()
                            ->default(Carbon::make(now()))
                    ])
                    ->action(function (Candidate $candidate, $livewire){
                        $date = $livewire->mountedTableActionsData[0]['end_date'];
                        $project = Project::where('candidate_id',$candidate->id)->whereNull('end_time')->first();
                        try {
                            $project->end_time = $date;
                            $project->save();

                            $candidate->is_working = Candidate::STATUS_NOT_WORKING;
                            $candidate->save();
                            Notification::make()
                                ->title('Success')
                                ->body('Candidate end date successfully updated.')
                                ->success()
                                ->send();
                        }catch (\Exception $e) {
                            Notification::make()
                                ->title('Error')
                                ->body('Failed to update candidate\'s project end date.')
                                ->danger()
                                ->send();
                            throw new \Exception($e->getMessage());
                        }

                    })
                    ->modalDescription('Enter the completion date for this candidate.'),
                CandidateAddNotesAction::make(),
                CandidateViewAction::make(),
                CandidateAddToBlacklistAction::make()
            ])

        ];
    }

    public function planningTableSchema(): array
    {
        return [
            TextColumn::make('last_name')
                ->sortable()
                ->label(__('admin_planning.full_name'))
                ->suffix(function ($record){
                    if($record->private_accommodation)
                    {
                        return ' 🟢';
                    }
                    else return '';
                })
                ->getStateUsing(function (Model $record) {
                    return $record->last_name . ' ' . $record->first_name;
                })
                ->searchable(['first_name', 'last_name']),
            TextColumn::make('positions')
                ->sortable()
                ->formatStateUsing(fn($state) => Position::find($state)?->name)
                ->label(__('admin_planning.positions')),
            TextColumn::make('updated_at')
                ->default(0)
                ->sortable()
                ->label(__('admin_planning.start_date'))
                ->formatStateUsing(function (Candidate $candidate) {
                    // Assuming $this->customerId is set somewhere in your class
                    $customerId = $this->customerId;

                    $project = Project::where('candidate_id', $candidate->id)
                        ->where('customer_id', $customerId)
                        ->whereNull('end_time')
                        ->first();

                    if (!$project?->start_time) {
                        return 'NA';
                    }

                    return date_format(Carbon::make($project->start_time), 'Y-m-d');
                }),
            TextColumn::make('created_at')
                ->default(0)
                ->sortable()
                ->label(__('admin_planning.end_date'))
                ->formatStateUsing(function (Candidate $candidate){
                    $projects = Project::where('candidate_id', $candidate->id)->first();

                    if(!$projects?->end_time) return 'NA';
                    return date_format(Carbon::make($projects->end_time),'Y-m-d');

                })
        ];
    }


    public function mount($order_id = null,$is_planning = false)
    {
        $this->orderId = $order_id;
        $this->isPlanning = $is_planning;
    }

    public function render()
    {
        return view('livewire.assigned-candidate-table');
    }

    public function getDefaultTableRecordsPerPageSelectOption(): int|string
    {
        return 50;
    }
}
