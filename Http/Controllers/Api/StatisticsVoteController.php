<?php

namespace Modules\Statistics\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Statistics\Models\Statistics;
use Modules\Statistics\Models\User;
use Modules\Statistics\Models\StatisticVotes;

class StatisticsVoteController extends Controller
{
    /**
     * Gem eller opdater en stemme + kommentar for en statistik.
     */
    public function store(Request $request)
    {
        $user = $this->getUser();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'statistic_id' => 'required|exists:statistics,id',
            'vote' => 'nullable|integer|in:-1,0,1',
            'comment' => 'nullable|string|max:2000',
        ]);

        $statistic_id = $request->input('statistic_id');
        $voteValue = $request->input('vote', null);
        $comment = $request->input('comment', null);

        // Opret eller opdater stemmen
        $StatisticVotes = StatisticVotes::updateOrCreate(
            ['statistic_id' => $statistic_id, 'user_id' => $user->id],
            ['vote' => $voteValue, 'comment' => $comment]
        );

        return response()->json([
            'message' => 'Vote saved',
            'vote' => $StatisticVotes->load('user'),
        ], 201);
    }

    /**
     * Opdater en eksisterende stemme (fx ændre vote eller kommentar)
     */
    public function update(Request $request, ...$args)
    {
        $user = $this->getUser();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $StatisticVotes = StatisticVotes::findOrFail($id);

        // Tjek om brugeren ejer stemmen
        if ($StatisticVotes->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'vote' => 'nullable|integer|in:-1,0,1',
            'comment' => 'nullable|string|max:2000',
        ]);

        $StatisticVotes->fill($request->only(['vote', 'comment']));
        $StatisticVotes->save();

        return response()->json([
            'message' => 'Vote updated',
            'vote' => $StatisticVotes->load('user'),
        ]);
    }

    /**
     * Slet en stemme
     */
    public function destroy(Request $request, ...$args)
    {
        $user = $this->getUser();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $StatisticVotes = StatisticVotes::findOrFail($id);

        // Tjek ejerskab
        if ($StatisticVotes->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $StatisticVotes->delete();

        return response()->json(['message' => 'Vote removed successfully']);
    }


    /**
     * Hjælpemetode til at hente den loggede bruger som User-model
     */
    private function getUser()
    {
        $user = auth()->user();
        return $user ? User::find($user->id) : null;
    }
}
