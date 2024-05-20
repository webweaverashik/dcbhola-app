<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $results = DB::table('sections as s')
        ->leftJoin('letters as l', 's.id', '=', 'l.section_to')
        ->select(
            's.name as section_name',
            DB::raw('SUM(CASE WHEN l.status = 1 THEN 1 ELSE 0 END) AS status_1_count'),
            DB::raw('SUM(CASE WHEN l.status = 2 THEN 1 ELSE 0 END) AS status_2_count'),
            DB::raw('SUM(CASE WHEN l.status = 3 THEN 1 ELSE 0 END) AS status_3_count'),
            DB::raw('SUM(CASE WHEN l.status IN (1, 2, 3) THEN 1 ELSE 0 END) AS total_count')
        )
        ->groupBy('s.id', 's.name')
        ->having('total_count', '>', 0)
        ->orderByDesc('status_1_count')
        ->get();

        return view('index', compact('results'));
    }
}
