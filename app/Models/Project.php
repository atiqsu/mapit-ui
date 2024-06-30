<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['name', 'code', 'is_active'];



    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_users', 'study_id', 'user_id');
    }

}
