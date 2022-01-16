<?php

namespace App\Models\Company;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Company extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function(Company $company) {
            $company->user_id = auth()->user()->id;
            $company->uuid = Uuid::uuid4();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'contract_type',
        'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean'
    ];

    // Relatioships

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessors

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }
}
