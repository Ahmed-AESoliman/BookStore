<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'city',
        'town',
        'price',
        'exchangable',
        'negationable',
        'sold',
        'state',
        'status',
        'quantity',
        'owner_id',
        'category_id',
        // 'sub_category_id',
        // 'subject_id',
    ];
    /**
     * Get the owner of the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the category associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the subcategory associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function subCategory()
    // {
    //     return $this->belongsTo(SubCategory::class, 'sub_category_id');
    // }

    /**
     * Get the subject associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function subject()
    // {
    //     return $this->belongsTo(Subject::class, 'subject_id');
    // }

    /**
     * Get all of the attachments for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Scope to filter records based on request parameters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, Request $request): Builder
    {

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->input('city') . '%');
        }

        // Filter by town
        if ($request->filled('town')) {
            $query->where('town', 'like', '%' . $request->input('town') . '%');
        }

        // Filter by title (using partial match)
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        // Filter by price range
        if ($request->filled('price')) {
            $priceRange = $request->input('price');
            $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        }

        // Filter by category ID
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Filter by sub-category ID
        // if ($request->filled('sub_category')) {
        //     $query->where('sub_category_id', $request->input('sub_category'));
        // }

        // Filter by subject ID
        // if ($request->filled('subject')) {
        //     $query->whereIn('subject_id', $request->input('subject_id'));
        // }
        // Filter by authenticated user area
        if ($request->filled('authenticatedUserArea') && $request->input('authenticatedUserArea') == true) {
            $user = auth()->user();
            $query->where('city', 'like', '%' . $user->city . '%')->where('town', 'like', '%' . $user->town . '%');
        }

        // Filter by educational records
        if ($request->filled('is_educational')) {
            $isEducational = $request->input('is_educational');
            if ($isEducational == 2) {
                $educationalCategories = Category::where("is_educational", true)->get()->pluck('id');
                // dd($educationalCategories);
                $query->whereIn('category_id', $educationalCategories);
            } else {
                $generalCategories = Category::where("is_educational", false)->get()->pluck('id');
                $query->whereIn('category_id', $generalCategories);
            }
        }

        // Filter by status (only active records)
        $query->where('status', true);

        return $query;
    }
}
