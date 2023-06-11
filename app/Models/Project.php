<?php

namespace App\Models;
use App\Models\User;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'created_at', 'updated_at', 'user_id', 'slug', 'type_id'];

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class, 'projects_technologies');
    }
    
}
