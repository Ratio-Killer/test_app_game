<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Game;
use App\Helpers\FileHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filters = $request->only(['title', 'genre', 'platform']);
        $games = Game::query()->applyFilters($filters)->paginate(15);

        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GameRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['cover'] = FileHelper::uploadCover($request->file('cover'));
        Game::create($data);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     * @param Game $game
     * @return View
     */
    public function show(Game $game): View
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
        $data['cover'] = FileHelper::uploadCover($request->file('cover'));
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
