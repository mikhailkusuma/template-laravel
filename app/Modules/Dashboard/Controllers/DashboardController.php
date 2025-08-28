<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReportStatuses;
use App\Modules\MasterData\Pinpoints\Models\MapPlacePinpoint;
use App\Modules\Report\Reports\Models\Reports;
use App\Modules\Dispositions\Report\Reports\Models\ReportTimelines;
use App\Modules\Dispositions\Report\Reports\Models\ReportTimelineVerification;
use App\Modules\MasterData\GovernmentAgencies\Models\GovernmentAgencies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('Dashboard.views.index');
    }
}
