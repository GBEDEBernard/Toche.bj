<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Site_touristique;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Contact;

// 

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if ($query) {
            // Search Users
            $results['users'] = User::where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->get();

            // Search Contacts (adjust based on your Contact model)
            $results['contacts'] = Contact::where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->get();

            // Add more models as needed (e.g., Posts, Events)
            // Example: 
            // $results['posts'] = Post::where('title', 'like', "%{$query}%")->get();
        }

        return view('Admin.search', compact('results', 'query'));
    }
}