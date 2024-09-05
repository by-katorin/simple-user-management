<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AvoidDuplicateConstraintSoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use SoftDeletes;
    use HasFactory, Notifiable;
    use AvoidDuplicateConstraintSoftDelete;

    /**
     * List of attributes that should be modified to avoid duplicates upon soft deletion.
     */
    public function getDuplicateAvoidColumns(): array
    {
        return ['email', 'username'];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',
        'name',
        'email',
        'photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'fullname',
        'middle_initial',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function getFullnameAttribute()
    {
        $middleInitial = $this->getMiddleInitialAttribute();
        return $middleInitial ? 
            "{$this->firstname} {$middleInitial} {$this->lastname}" : 
            "{$this->firstname} {$this->lastname}";
    }

    public function getMiddleInitialAttribute()
    {
        return $this->middlename ? "{$this->middlename[0]}." : '';
    }
}
