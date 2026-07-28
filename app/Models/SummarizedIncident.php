<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SummarizedIncident extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }

    public function predictedCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'predicted_category_id');
    }
}
