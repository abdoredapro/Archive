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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $films_count = Film::count();

        $files = File::count();

        $all_files = File::with('project')->limit(4)->get();

        $users = User::count();

        $projects = Project::all();

        $projectsArray = Project::withCount('files')->get()->toArray();

        $category = Category::count();

        return view('dashboard.index', compact('films_count',
            'files', 'projects', 'projectsArray', 'users', 'all_files', 'category'));
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
