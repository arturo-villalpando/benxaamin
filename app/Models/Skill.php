<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'skill',
        'score'
    ];

    /**
     * The skill that belong to the employee.
     */
    public function employee(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee__skills');
    }
}
