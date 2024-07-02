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

        $new_letters_duration = DB::table('letters as l')
                ->join('sections as s', 'l.section_to', '=', 's.id')
                ->select(
                    's.name as section_name',
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) <= 3 THEN 1 END) as up_to_3_days'),
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) > 3 AND DATEDIFF(NOW(), l.created_at) <= 7 THEN 1 END) as up_to_7_days'),
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) > 7 AND DATEDIFF(NOW(), l.created_at) <= 15 THEN 1 END) as up_to_15_days'),
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) > 15 THEN 1 END) as more_than_15_days'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('l.status', 1)
                ->where('l.is_deleted', 0)
                ->groupBy('s.name')
                ->orderByDesc('total')
                ->get();

        $processing_letters_duration = DB::table('letters as l')
                ->join('sections as s', 'l.section_to', '=', 's.id')
                ->select(
                    's.name as section_name',
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) <= 3 THEN 1 END) as up_to_3_days'),
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) > 3 AND DATEDIFF(NOW(), l.created_at) <= 7 THEN 1 END) as up_to_7_days'),
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) > 7 AND DATEDIFF(NOW(), l.created_at) <= 15 THEN 1 END) as up_to_15_days'),
                    DB::raw('COUNT(CASE WHEN DATEDIFF(NOW(), l.created_at) > 15 THEN 1 END) as more_than_15_days'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('l.status', 2)
                ->where('l.is_deleted', 0)
                ->groupBy('s.name')
                ->orderByDesc('total')
                ->get();

        return view('index', compact('results', 'new_letters_duration', 'processing_letters_duration'));
    }

    public function getSectionsData()
    {
        $sectionsData = DB::table('sections')
            ->leftJoin('letters', 'sections.id', '=', 'letters.section_to')
            ->select('sections.name as section_name', 
                    DB::raw('SUM(CASE WHEN letters.status = 1 THEN 1 ELSE 0 END) as status_1_count'),
                    DB::raw('SUM(CASE WHEN letters.status = 2 THEN 1 ELSE 0 END) as status_2_count'))
            ->groupBy('sections.name')
            ->get();

        return response()->json($sectionsData);
    }

    
}
