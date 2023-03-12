<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\Models\Source;
use App\Services\XMLParserService;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function index(XMLParserService $parserService, Source $source)
    {
        $rssLinks = $source->where('id', '!=', 1)->get();

        $start = microtime(true);

        foreach ($rssLinks as $link) {

            NewsParsing::dispatch($link->source);
            // ставить в очередь - сейчас хранилище QUEUE_CONNECTION=sync (смотреть в env - сейчас это выполнить сразу)
            // если поставить QUEUE_CONNECTION=database -

            // $parserService->saveNews($link);
        }

        $end = microtime(true);
        dump($end - $start);

        return redirect()->route('admin.index')->with('success', 'Новости загружаются, перейдите на страницу новостей');

    }
}




//        $xml = XMLParser::load('https://lenta.ru/rss');
//        $this->getNews($xml, $category);
//        $urls = [
//            'https://news.yandex.ru/gadgets.rss',
//            'https://news.yandex.ru/index.rss',
//            'https://news.yandex.ru/martial_arts.rss',
//            'https://news.yandex.ru/communal.rss',
//            'https://news.yandex.ru/health.rss',
//            'https://news.yandex.ru/games.rss',
//            'https://news.yandex.ru/internet.rss',
//            'https://news.yandex.ru/cyber_sport.rss',
//            'https://news.yandex.ru/movies.rss',
//            'https://news.yandex.ru/cosmos.rss',
//            'https://news.yandex.ru/culture.rss',
//            'https://news.yandex.ru/championsleague.rss',
//            'https://news.yandex.ru/music.rss',
//        ];
////        $xml = XMLParser::load('https://news.yandex.ru/music.rss');
////        $this->getNewsMusic($xml, $category);
//        return view('admin.allNews', [
//            'news' => News::orderByDesc('created_at')->paginate(10),
//
//            'categoriesTitle' => Category::query()->select(['id', 'title'])->get() //???
//        ]);
//
//    }
//
//    public function getNews($xml, Category $category) {

//        $data = $xml->parse([
//            'title' => ['uses' => 'channel.title'],
//            'link' => ['uses' => 'channel.link'],
//            'description' => ['uses' => 'channel.description'],
//            'news' => ['uses' => 'channel.item[title,link,description,pubDate,enclosure::url,category]'],
//        ]);
////dd($data);
//        foreach ($data['news'] as $news) {
//
//            $categoryTitle = $news['category'];
//
//            $categoryId = $category->getCategoryId($categoryTitle);
//
//            //Проверка - есть ли такая новость в БД
//            $newsInSystem = News::query()
//                ->where('title', $news['title'])
//                ->first();
//
//            if (is_null($newsInSystem)) {
//                $newsInSystem = new News();
//
//                $newsInSystem->fill([
//                    'category_id' => $categoryId,
//                    'title' => $news['title'],
//                    'text' => $news['description'],
//
//                ]);
//                $newsInSystem->save();
//            }
//
//        }
//    }
//
//    public function getNewsMusic($xml, Category $category) {
//
//        $data = $xml->parse([
//            'title' => ['uses' => 'channel.title'],
//            'link' => ['uses' => 'channel.link'],
//            'description' => ['uses' => 'channel.description'],
//            'news' => ['uses' => 'channel.item[title,link,description,pubDate]'],
//        ]);
//
//
//        foreach ($data['news'] as $news) {
//
//            $categoryTitle = 'Музыка';
//
//            $categoryId = $category->getCategoryId($categoryTitle);
//
//            //Проверка - есть ли такая новость в БД
//            $newsInSystem = News::query()
//                ->where('title', $news['title'])
//                ->first();
//
//            if (is_null($newsInSystem)) {
//                $newsInSystem = new News();
//
//                $newsInSystem->fill([
//                    'category_id' => $categoryId,
//                    'title' => $news['title'],
//                    'text' => $news['description'],
//
//                ]);
//                $newsInSystem->save();
//            }
//        }
//    }


