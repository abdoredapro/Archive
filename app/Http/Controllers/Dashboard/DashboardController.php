<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Film;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {

        $all_files = File::with('project')->limit(4)->get();

        $projects = Project::all();


        $currentYear = now()->year;

        $results = File::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw("COUNT(*) as count"))
        ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyFileCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthKey = Carbon::createFromDate($currentYear, $month, 1)->format('Y-m');
            $monthlyFileCounts[] = $results[$monthKey] ?? 0;
        }
        // Add some

        return view('dashboard.index', compact('projects', 'all_files', 'monthlyFileCounts'));
    }

    public function settings()
    {

        $user = Auth::user();

        return view('dashboard.settings', compact('user'));
    }

    public function update_info(Request $request, $id): RedirectResponse
    {
        $request->validate(User::rules($id));

        $user = User::findOrfail($id);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');

            if ($user->photo) {
                Storage::disk('public')->delete('users/' . $user->photo);
            }

            $fileName = uniqid('Image-', true) . '.' . $image->getClientOriginalExtension();

            $image->storeAs('users', $fileName, [
                'disk' => 'public',
            ]);

            $data['photo'] = $fileName;
        }


        $user->update($data);

        return redirect()->route('dashboard.settings')
            ->with([
                'message' => 'تم تحديث المعلومات بنجاح'
            ]);
    }
}
