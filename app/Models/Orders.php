<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orders extends Model
{
    use HasFactory;
    protected $guarded = [];
    const STATUS_ACTIVE = '1';
    const STATUS_FINISHED = '0';

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function moveToFinish()
    {
        $this->is_active = self::STATUS_FINISHED;
        $this->save();
        Notification::make()
            ->title('Order Update Successfully')
            ->body('Order status is set to finished.')
            ->success()
            ->send();

    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }


}
