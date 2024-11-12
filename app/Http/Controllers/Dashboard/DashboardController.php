<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Film;
use App\Models\Project;
use App\Models\User;
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

        $filesStatics = File::select('created_at')
            ->whereYear('created_at', now()->year)
            ->get();



        dd($filesStatics);

        // return view('dashboard.index', compact('projects', 'all_files'));
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
