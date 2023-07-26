<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'position',
        'birthday',
        'address',
        'address2',
        'city',
        'country',
        'cp'
    ];

    /**
     * The skill that belong to the employee.
     */
    public function skill(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'employee__skills');
    }
}
