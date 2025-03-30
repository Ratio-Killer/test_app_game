<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('games.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GameRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $data['cover'] = json_encode(['path' => $coverPath]);
        } else {
            $data['cover'] = json_encode([]);
        }
        Game::create($data);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     * @param Game $game
     * @return View
     */
    public function show(Game $game):View
    {
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GameRequest $request, Game $game): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $data['cover'] = json_encode(['path' => $path]);
        }
        $game->update($data);

        return redirect()->route('games.index')->with('success', 'The game has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }
}
