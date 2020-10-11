<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Request;

class TagsController extends Controller
{
    /**
     * Страница статей по тегу
     * @param Tag $tag
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Tag $tag, Request  $request)
    {
        $relations = $tag->load(
            [
                'news' => function ($query) {
                    $query->with('tags');
                },
                'posts' => function ($query) {
                    $query->with('tags', 'user');
                }
            ]
        )->getRelations();

        $items = collect();
        foreach ($relations as $relation) {
            $items = $items->merge($relation);
        }

        $items = $items->sortByDesc('created_at');

        return view('main.index', compact('items'));
    }
}
