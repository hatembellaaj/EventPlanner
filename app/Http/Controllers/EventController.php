<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $categoryId = $request->query('category');
        $freeParam = $request->query('free');
        $dateFrom = $request->query('date_from');
        $dateTo = $request->query('date_to');

        $freeFilter = null;
        if (in_array($freeParam, ['0', '1'], true)) {
            $freeFilter = $freeParam === '1';
        }

        $events = Event::query()
            ->active()
            ->with('category')
            ->withCount('registrations')
            ->when($search, function ($query, $search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('ba_title', 'like', "%{$search}%")
                        ->orWhere('ba_place', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('ba_category_id', $categoryId);
            })
            ->when($freeFilter !== null, function ($query) use ($freeFilter) {
                $query->where('ba_is_free', $freeFilter);
            })
            ->when($dateFrom, function ($query, $dateFrom) {
                $query->whereDate('ba_start_date', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query, $dateTo) {
                $query->whereDate('ba_start_date', '<=', $dateTo);
            })
            ->orderBy('ba_start_date')
            ->paginate(9)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('ba_name')
            ->get();

        $filters = [
            'q' => $search,
            'category' => $categoryId,
            'free' => $freeParam,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];

        return view('events.index', compact('events', 'categories', 'filters'));
    }
}
