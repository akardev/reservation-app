<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {

        $specials = Category::where('name', 'Özel Menüler')->first();
        $menus = Menu::whereDoesntHave('categories', function ($categoryQuery) {
            $categoryQuery->where('name', 'Özel Menüler');
        })->get();

        return view('menus.index', compact('menus', 'specials'));
    }
}
