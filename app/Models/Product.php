<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'best_selling',
        'img_1', 'img_2', 'img_3', 'img_4', 'img_5',
        'category_1_id', 'category_2_id', 'category_3_id', 'category_4_id', 'category_5_id',
        'subcategory_1_id', 'subcategory_2_id', 'subcategory_3_id', 'subcategory_4_id', 'subcategory_5_id',
        'features', 'specification', 'description'
    ];

    protected $table = 'products';

    public function category($index)
    {
        return $this->belongsTo(Category::class, "category_{$index}_id");
    }

    public function subcategory($index)
    {
        return $this->belongsTo(Subcategory::class, "subcategory_{$index}_id");
    }

    // In App\Models\Product
public function category_1() { return $this->belongsTo(Category::class, 'category_1_id'); }
public function category_2() { return $this->belongsTo(Category::class, 'category_2_id'); }
public function category_3() { return $this->belongsTo(Category::class, 'category_3_id'); }
public function category_4() { return $this->belongsTo(Category::class, 'category_4_id'); }
public function category_5() { return $this->belongsTo(Category::class, 'category_5_id'); }
public function subcategory_1() { return $this->belongsTo(SubCategory::class, 'subcategory_1_id'); }
public function subcategory_2() { return $this->belongsTo(SubCategory::class, 'subcategory_2_id'); }
public function subcategory_3() { return $this->belongsTo(SubCategory::class, 'subcategory_3_id'); }
public function subcategory_4() { return $this->belongsTo(SubCategory::class, 'subcategory_4_id'); }
public function subcategory_5() { return $this->belongsTo(SubCategory::class, 'subcategory_5_id'); }



}
