<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 20);
        $sortBy = $request->get('sort', 'created_at');
        $sortDir = $request->get('dir', 'desc');

        $allowedSorts = ['full_name', 'church', 'group', 'kingschat_handle', 'souls_commitment', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $query = Registration::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('church', 'like', "%{$search}%")
                  ->orWhere('group', 'like', "%{$search}%")
                  ->orWhere('kingschat_handle', 'like', "%{$search}%")
                  ->orWhere('cell', 'like', "%{$search}%");
            });
        }

        $registrations = $query
            ->orderBy($sortBy, $sortDir)
            ->paginate($perPage)
            ->withQueryString();

        // Stats
        $totalRegistered   = Registration::count();
        $totalSoulsComitted = Registration::sum('souls_commitment');
        $totalChurches     = Registration::distinct('church')->count('church');
        $totalGroups = Registration::distinct('group')->count('group');
        $totalKC     = Registration::distinct('kingschat_handle')->count(); // Use a new variable
        $todayRegistrations = Registration::whereDate('created_at', today())->count();
        $withAvatars       = Registration::whereNotNull('avatar_path')->count();

        // Top churches
        $topChurches = Registration::selectRaw('church, COUNT(*) as count, SUM(souls_commitment) as souls')
            ->groupBy('church')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'registrations',
            'totalRegistered',
            'totalSoulsComitted',
            'totalChurches',
            'totalGroups',
            'todayRegistrations',
            'withAvatars',
            'topChurches',
            'search',
            'sortBy',
            'sortDir',
        ));
    }

    public function export()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->get();

        $csvData = "ID,Title,Full Name,Phone Number,Cell,Church,Group,Souls Committed,Avatar,Registered At\n";

        foreach ($registrations as $r) {
            $csvData .= implode(',', [
                $r->id,
                $r->title,
                '"' . $r->full_name . '"',
                $r->phone_number,
                '"' . $r->cell . '"',
                '"' . $r->church . '"',
                '"' . $r->group . '"',
                '"' . $r->kingschat_handle . '"',
                $r->souls_commitment,
                $r->avatar_path ? 'Yes' : 'No',
                $r->created_at->format('Y-m-d H:i:s'),
            ]) . "\n";
        }

        return response($csvData, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="10souls10days_registrations_' . now()->format('Ymd_His') . '.csv"',
        ]);
    }

    // Add this to your DashboardController.php

public function logout(Request $request)
{
    // Clear the specific admin session
    $request->session()->forget('admin_logged_in');

    // Optional: Clear all session data for security
    // $request->session()->flush();

    return redirect()->route('admin.login')->with('success', 'You have been logged out.');
}
}
