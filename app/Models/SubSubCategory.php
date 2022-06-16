<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Category;
use App\models\SubCategory;

class SubSubCategory extends Model
{
    use HasFactory;

protected $fillable = [
    'category_id',
    'subcategory_id',
    'subsubcategory_name_en',
    'subsubcategory_name_ar',
    'subsubcategory_slug_en',
    'subsubcategory_slug_ar',
];


    // الفكرة هنا اني بدي اجيب Category from SubCategory 
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    // الفكرة هنا اني بدي اجيب SubCategory from SubSubCategory 
     public function subcategory(){
         return $this->belongsTo(SubCategory::class,'subcategory_id','id');
     }



}
