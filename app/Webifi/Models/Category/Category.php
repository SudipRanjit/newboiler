<?php

namespace App\Webifi\Models\Category;

use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Boiler\Boiler;

class Category extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'category',
    'slug',
    'parent',
    'type',
    'icon_light',
    'icon_dark',
    'show_in_menu',
    'publish'
  ];

  /**
   * Category has parent
   */
  public function parent()
  {
    $cat = $this; 
    return cacheRemember('cat_parent_by_id_'.$cat->id, 1000, function () use($cat) {
      return $this->where('id', $cat->parent)->first();
    });
  }

  /**
   * Category has many sub category
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function subCategories()
  {
    $cat = $this;

      return cacheRemember('category_model_sub_category_'.$cat->id, 1000, function () use($cat){
          return $this->where('parent', $cat->id)->where('publish',true)->get();
      });
  }

  /**
   * Category has many sub category
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function subCategoriesFront()
  {
    $cat = $this;

      return cacheRemember('category_model_sub_category_front_'.$cat->id, 1000, function () use($cat){
          return $this->where('parent', $cat->id)->where('publish',true)->where('show_in_menu', true)->get();
      });
  }

  /**
   * Category has many sub category
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function randomSubCategories()
  {
    $cat = $this;

      return cacheRemember('category_model_random_sub_category_'.$cat->id, 1000, function () use($cat) {
          return $this->where('parent', $cat->id)->where('publish',true)->inRandomOrder()->limit(8)->get();
      });
  }
}
