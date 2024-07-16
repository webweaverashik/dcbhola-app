<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('role');
        
        if ($role == 1) // For DC Role
        {
            $results = DB::table('letters')
                    ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->select(
                        'sections.name as section_name',
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) <= 7 AND letters.status = 1 THEN 1 END) as up_to_7_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 8 AND 15 AND letters.status = 1 THEN 1 END) as up_to_15_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 16 AND 30 AND letters.status = 1 THEN 1 END) as up_to_30_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) > 30 AND letters.status = 1 THEN 1 END) as days_30_plus'),
                        DB::raw('COUNT(*) as total_count'),
                        DB::raw('SUM(CASE WHEN letters.status = 1 THEN 1 ELSE 0 END) as total_status_1'),
                        DB::raw('SUM(CASE WHEN letters.status = 2 THEN 1 ELSE 0 END) as total_status_2')
                    )
                    ->where('letters.is_deleted', 0)
                    ->groupBy('sections.name')
                    ->get();
        }
        elseif ($role == 2) // For ADC Role
        {
            $results = DB::table('letters')
                    ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->select(
                        'sections.name as section_name',
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) <= 7 AND letters.status = 1 THEN 1 END) as up_to_7_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 8 AND 15 AND letters.status = 1 THEN 1 END) as up_to_15_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 16 AND 30 AND letters.status = 1 THEN 1 END) as up_to_30_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) > 30 AND letters.status = 1 THEN 1 END) as days_30_plus'),
                        DB::raw('COUNT(*) as total_count'),
                        DB::raw('SUM(CASE WHEN letters.status = 1 THEN 1 ELSE 0 END) as total_status_1'),
                        DB::raw('SUM(CASE WHEN letters.status = 2 THEN 1 ELSE 0 END) as total_status_2')
                    )
                    ->where('letters.is_deleted', 0)
                    ->groupBy('sections.name')
                    ->get();
                    // Need to filter section IDs 
        }
        elseif ($role == 3)  // Section Officer Role
        {
            $results = DB::table('letters')
                    ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->select(
                        'sections.name as section_name',
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) <= 7 AND letters.status = 1 THEN 1 END) as up_to_7_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 8 AND 15 AND letters.status = 1 THEN 1 END) as up_to_15_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 16 AND 30 AND letters.status = 1 THEN 1 END) as up_to_30_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) > 30 AND letters.status = 1 THEN 1 END) as days_30_plus'),
                        DB::raw('COUNT(*) as total_count'),
                        DB::raw('SUM(CASE WHEN letters.status = 1 THEN 1 ELSE 0 END) as total_status_1'),
                        DB::raw('SUM(CASE WHEN letters.status = 2 THEN 1 ELSE 0 END) as total_status_2')
                    )
                    ->where('letters.is_deleted', 0)
                    ->where('sections.officer_id', session('loginId'))
                    ->groupBy('sections.name')
                    ->get();
        }
        elseif ($role == 4) // Section Staff CO Role
        {
            $results = DB::table('letters')
                    ->join('sections', 'letters.section_to', '=', 'sections.id')
                    ->select(
                        'sections.name as section_name',
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) <= 7 AND letters.status = 1 THEN 1 END) as up_to_7_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 8 AND 15 AND letters.status = 1 THEN 1 END) as up_to_15_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) BETWEEN 16 AND 30 AND letters.status = 1 THEN 1 END) as up_to_30_days'),
                        DB::raw('COUNT(CASE WHEN DATEDIFF(CURDATE(), letters.created_at) > 30 AND letters.status = 1 THEN 1 END) as days_30_plus'),
                        DB::raw('COUNT(*) as total_count'),
                        DB::raw('SUM(CASE WHEN letters.status = 1 THEN 1 ELSE 0 END) as total_status_1'),
                        DB::raw('SUM(CASE WHEN letters.status = 2 THEN 1 ELSE 0 END) as total_status_2')
                    )
                    ->where('letters.is_deleted', 0)
                    ->where('sections.staff_id', session('loginId'))
                    ->groupBy('sections.name')
                    ->get();
        }

        return view('index', compact('results'));
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
