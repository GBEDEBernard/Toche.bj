<?php
namespace App\Http\Controllers;

use App\Models\Apropos;
use Illuminate\Http\Request;

class AproposController extends Controller
{
    public function __construct()
    {
        // Apply auth middleware to admin methods
        $this->middleware('auth')->only(['indexAdmin', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    // Public page
    public function index()
    {
        $sections = Apropos::where('type', 'section')->orderBy('order')->get();
        $teamMembers = Apropos::where('type', 'team_member')->get();
        return view('apropos', compact('sections', 'teamMembers'));
    }

    // Admin index
    public function indexAdmin()
    {
        $sections = Apropos::where('type', 'section')->orderBy('order')->get();
        $teamMembers = Apropos::where('type', 'team_member')->get();
        return view('Admin.Apropos.index', compact('sections', 'teamMembers'));
    }

    public function create()
    {
        return view('Admin.Apropos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:section,team_member',
            'title' => 'required|string|max:255',
            'content' => 'required_if:type,section|nullable',
            'image' => 'nullable|image|max:2048',
            'order' => 'required_if:type,section|integer|nullable',
        ]);

        $data = $request->only(['type', 'title', 'content', 'order']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        if ($data['type'] === 'team_member') {
            $data['content'] = null;
            $data['order'] = 0;
        }

        Apropos::create($data);
        return redirect()->route('admin.apropos.index')->with('success', 'Élément ajouté.');
    }

    public function edit(Apropos $apropos)
    {
        return view('editapropos', compact('apropos'));
    }

    public function update(Request $request, Apropos $apropos)
    {
        $request->validate([
            'type' => 'required|in:section,team_member',
            'title' => 'required|string|max:255',
            'content' => 'required_if:type,section|nullable',
            'image' => 'nullable|image|max:2048',
            'order' => 'required_if:type,section|integer|nullable',
        ]);

        $data = $request->only(['type', 'title', 'content', 'order']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        if ($data['type'] === 'team_member') {
            $data['content'] = null;
            $data['order'] = 0;
        }

        $apropos->update($data);
        return redirect()->route('admin.apropos.index')->with('success', 'Élément mis à jour.');
    }

    public function destroy(Apropos $apropos)
    {
        $apropos->delete();
        return redirect()->route('admin.apropos.index')->with('success', 'Élément supprimé.');
    }
}