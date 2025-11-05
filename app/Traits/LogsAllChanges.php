<?php 
namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait LogsAllChanges
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()                  // log all attributes
            ->useLogName(class_basename($this)) // model name as log name
            ->logOnlyDirty()            // only changed fields
            ->dontSubmitEmptyLogs();    // skip empty logs
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return class_basename($this) . " has been {$eventName}";
    }
}
