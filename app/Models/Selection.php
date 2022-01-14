<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @package
 * @BookSelection BookSelection
 */

class Selection extends Model
{
    use HasFactory;

    protected $table = 'selections';

    protected $guarded = [];

    protected $dates = [];

//    protected $fillable = [
//        'bookSelection_name',
//        'sortByPrice',
//        'sortBySales',
//        'limit',
//        'priceParamLow',
//        'priceParamHigh',
//      'bookSelection_id',
//      'bookSelectionable_id',
//      'bookSelectionable_type'
//    ];

    /**
     * @param $date
     * @return string
     */

    public function getCreatedAtAttribute($date): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }

    /**
     * @return BelongsToMany
     */

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }



//    /**
//     * @return MorphToMany
//     */
//
//    public function authors(): MorphToMany
//    {
//        return $this->morphedByMany(Author::class, 'bookSelectionable');
//    }
//
//    public function genres(): MorphToMany
//    {
//        return $this->morphedByMany(Genre::class, 'bookSelectionable');
//    }
//
//    public function getRelations()
//    {
//        Relation::enforceMorphMap([
//            'author' => Author::class,
//            'genre' => Genre::class,
//        ]);
//    }


}
