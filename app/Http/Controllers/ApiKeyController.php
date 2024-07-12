<?php
namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apiKeys = ApiKey::where('user_id', Auth::id())->get();
        return Inertia::render('ApiKey/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    public function create()
    {
        return Inertia::render('ApiKey/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ApiKey::create([
            'uuid' => Str::uuid(),
            'user_id' => auth()->id(),
            'name' => $request->name,
            'key' => Str::random(40),
        ]);

        return redirect()->route('api-keys.index')->with('success', 'API Key created successfully.');
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();

        return redirect()->route('api-keys.index')->with('success', 'API Key deleted successfully.');
    }
}
