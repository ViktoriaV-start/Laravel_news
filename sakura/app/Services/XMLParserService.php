<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class XMLParserService
{
    public function saveNews($link) {
        $xml = XMLParser::load($link);
        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'news' => ['uses' => 'channel.item[title,link,description,pubDate,enclosure::url,category]'],
        ]);

        $categoryTitle = null;
        $categorySlug = null;
        $dt = null;

        $sourceId =  Source::where('source', '=', $link)->first()->id;

        foreach ($data['news'] as $news) {

            if (!$news['category']) { // не везде есть категория
                $categoryTitle = $data['title']; // если нет категории - берем общий title
            } else {
                $categoryTitle = $news['category'];
            }

            switch (mb_strtolower($categoryTitle)) {
            case 'мир':
                $categorySlug = 'world';
                break;
            case 'бизнес':
                $categorySlug = 'business';
                break;
            case 'спорт':
                $categorySlug = 'sport';
                break;
            case 'культура':
                $categorySlug = 'culture';
                break;
            case 'политика':
                $categorySlug = 'politics';
                break;
            case 'наука':
                $categorySlug = 'science';
                break;
            case 'россия':
                $categorySlug = 'Russia';
                break;
            case 'экономика':
                $categorySlug = 'economics';
                break;
            case 'путешествия':
                $categorySlug = 'travelling';
                break;
            default: $categorySlug = null;
            }

            if ($categorySlug === null) {
                $categorySlug = Str::slug($categoryTitle);
            }
            dump($categorySlug);

            $category = Category::query()->firstOrCreate([
                'title' => $categoryTitle,
                'slug' => $categorySlug
            ]);

            $dt = (Carbon::parse($news['pubDate']))->format('Y-m-d H:i:s');

            $added = News::query()->firstOrCreate([
                'title' => $news['title'],
                'text' => $news['description'],
                'isPrivate' => false,
                'image' => $news['enclosure::url'],
                'category_id' => $category->id,
            ]);

            $added->created_at = $dt;
            $added->source_id = $sourceId;
            $added->save();
        }
    }
}
