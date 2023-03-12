<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function news()
    {
        return $this->hasMany(News::class);
    }

}



//    private $alfabet = [
//        'а' => 'a',   'б' => 'b',   'в' => 'v',
//        'г' => 'g',   'д' => 'd',   'е' => 'e',
//        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
//        'и' => 'i',   'й' => 'y',   'к' => 'k',
//        'л' => 'l',   'м' => 'm',   'н' => 'n',
//        'о' => 'o',   'п' => 'p',   'р' => 'r',
//        'с' => 's',   'т' => 't',   'у' => 'u',
//        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
//        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
//        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
//        'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
//    ];

//    public function getCategoryId($categoryTitle) {
//
//        $categorySlug = null;
//        $categoryId = null;
//        $category = null;
//
//        switch (mb_strtolower($categoryTitle)) {
//            case 'мир':
//                $categorySlug = 'world';
//                break;
//            case 'бизнес':
//                $categorySlug = 'business';
//                break;
//            case 'спорт':
//                $categorySlug = 'sport';
//                break;
//            case 'культура':
//                $categorySlug = 'culture';
//                break;
//            case 'политика':
//                $categorySlug = 'politics';
//                break;
//            case 'наука':
//                $categorySlug = 'science';
//                break;
//            case 'россия':
//                $categorySlug = 'Russia';
//                break;
//            case 'экономика':
//                $categorySlug = 'economics';
//                break;
//            case 'путешествия':
//                $categorySlug = 'travelling';
//                break;
//            }
//
//            if (!$categorySlug) {
//                $categorySlug = $this->createSlug($categoryTitle);
//            }
//
//            $category = Category::where('slug', $categorySlug)->first();
//
//            if($category == null) {
//                $categoryId = Category::insertGetId([
//                    'title' => $categoryTitle,
//                    'slug' => $categorySlug ? $categorySlug : '',
//                ]);
//            } else {
//                $categoryId = $category->id;
//            }
//
//            return $categoryId;
//    }

//    function createSlug($str) {
//
//        $strArr = preg_split('//u', mb_strtolower($str));
//
//        $strTranslit = [];
//        for ($i = 0; $i < count($strArr); $i++) {
//
//            $key = $strArr[$i];
//
//            if($key === "") continue;
//
//            if(!array_key_exists($key, $this->alfabet)) {
//                $strTranslit[$i] = "_";
//            } else {
//                $strTranslit[$i] = $this->alfabet[$key];
//            }
//        }
//
//        return implode($strTranslit);
//    }

