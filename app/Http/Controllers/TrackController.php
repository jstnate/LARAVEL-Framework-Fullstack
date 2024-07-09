<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Track;
use Illuminate\Support\Str;


class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::where('display', true)->orderBy('artist')->get();

        return Inertia::render('Track/index', [
            'tracks' => $tracks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Track/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'artist' => ['required', 'string', 'min:3', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'music' => ['required', 'file', 'mimes:mp3,wav,ogg', 'max:10240']
        ]);
        $uuid = 'trk-' . Str::uuid();

        $image_extension = $request->image->extension();
        $image_path = $request->image->storeAs('tracks/images', $uuid . '.' . $image_extension);
        $music_extension = $request->music->extension();
        $music_path = $request->music->storeAs('tracks/musics', $uuid . '.' . $music_extension);

        $display_value = $request->display == true ? 1 : 0;

        Track::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'image' => $image_path,
            'music' => $music_path,
            'display' => $display_value
        ]);

        return redirect()->route('tracks.index')->with('success', 'Track successfully created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {
        return Inertia::render('Track/edit',[
            'track' => $track,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'artist' => ['required', 'string', 'min:3', 'max:255'],
            'display' => ['required'],
        ]);

        $track->title = $request->title;
        $track->artist = $request->artist;
        $track->display = $request->display === 'true' ? 1 : 0;
        $track->save();

        return redirect()->route('tracks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        $track->delete();
    }
}
