<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class ContentPage
 *
 * @package App
 * @property string $title
 * @property text $page_text
 * @property text $excerpt
 * @property string $featured_image
*/
class ContentPage extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['title', 'page_text', 'excerpt', 'featured_image'];
    protected $hidden = [];
    public static $searchable = [
        'attachments',
    ];
    
    
    public function category_id()
    {
        return $this->belongsToMany(ContentCategory::class, 'content_category_content_page');
    }
    
    public function tag_id()
    {
        return $this->belongsToMany(ContentTag::class, 'content_page_content_tag');
    }
    
}
