<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Notifications\WelcomeNewsletter;
use Illuminate\Support\Facades\Notification;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest()->get();
        return view('Admin.newsletter.index', compact('newsletters'));
    }

    public function create()
    {
        return view('Admin.newsletter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $subscriber = Newsletter::create([
            'email' => $request->email,
        ]);

        try {
           $newsletter->notify(new WelcomeNewsletter());
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Abonné ajouté, mais email non envoyé.');
        }

        return redirect()->back()->with('success', 'Merci de vous être abonné à notre newsletter ! 🎉');
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('Admin.newsletter.edit', compact('newsletter'));
    }

    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:newsletters,email,' . $id,
        ]);

        $newsletter->update([
            'email' => $request->email,
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'Abonné modifié avec succès.');
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')->with('success', 'Abonné supprimé avec succès.');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $newsletter = Newsletter::create([
            'email' => $request->email,
        ]);

        try {
            Notification::send($newsletter, new WelcomeNewsletter());
        } catch (\Exception $e) {
            return redirect()->back()->with('contenu', 'Inscription réussie, mais email non envoyé.');
        }

        return redirect()->back()->with('contenu', 'Inscription réussie à la newsletter ! 🎉');
    }
}
