<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function Laravel\Prompts\search;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ["title", "salary", "location", "description", "category", "experience", "employer_id"];
    public static array $category = ["IT", "Sales", "Finance", "Marketing", "Development"];
    public static array $experience = ["entry", "junior", "intermediate", "senior"];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }
    public function hasUserApplied(Authenticatable|User|int $user)
    {
        return $this->where("id", $this->id)
            ->whereHas(
                "jobApplications",
                fn (Builder $query) => $query->where("user_id", "=", $user->id ?? $user)
            )->exists();
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        return $query->when(
            $filters["search"] ?? null,
            function ($query) use ($filters) {
                $query->where(
                    function (Builder $query) use ($filters) {
                        $query->where("title", "LIKE", "%" . $filters["search"] . "%")
                            ->orWhere("description", "LIKE", "%" . $filters["search"] . "%")
                            ->orWhereHas("employer", function ($query) use ($filters) {
                                $query->where("company_name", "LIKE", "%" . $filters["search"] . "%");
                            });
                    }
                );
            }
        )->when($filters["from"] ?? null, function ($query) use ($filters) {
            $query->where("salary", ">=", $filters["from"]);
        })->when($filters["to"] ?? null, function ($query) use ($filters) {
            $query->where("salary", "<=", $filters["to"]);
        })->when($filters["experience"] ?? null, function ($query) use ($filters) {
            $query->where("experience", $filters["experience"]);
        })->when($filters["category"] ?? null, function ($query) use ($filters) {
            $query->where("category", $filters["category"]);
        });
    }
}
