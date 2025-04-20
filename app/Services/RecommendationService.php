<?php

namespace App\Services;

use App\Models\User;
use App\Models\PackageTour;
use Illuminate\Support\Facades\Auth;

class RecommendationService
{
    protected $matrix = [];

    public function buildInteractionMatrix()
    {
        $users = User::with('ratedTours')->get();

        foreach ($users as $user) {
            foreach ($user->ratedTours as $tour) {
                $this->matrix[$user->id][$tour->id] = $tour->pivot->rating;
            }
        }

        return $this->matrix;
    }

    protected function cosineSimilarity(array $ratingsA, array $ratingsB): float
    {
        $common = array_intersect_key($ratingsA, $ratingsB);
        if (count($common) === 0) return 0;

        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        foreach ($common as $tourId => $_) {
            $dotProduct += $ratingsA[$tourId] * $ratingsB[$tourId];
            $normA += pow($ratingsA[$tourId], 2);
            $normB += pow($ratingsB[$tourId], 2);
        }

        if ($normA == 0 || $normB == 0) return 0;

        return $dotProduct / (sqrt($normA) * sqrt($normB));
    }

    public function getRecommendationsForUser(User $activeUser, $limit = 5)
    {
        $matrix = $this->buildInteractionMatrix();
        $activeRatings = $matrix[$activeUser->id] ?? [];

        $similarities = [];

        foreach ($matrix as $userId => $ratings) {
            if ($userId !== $activeUser->id) {
                $similarities[$userId] = $this->cosineSimilarity($activeRatings, $ratings);
            }
        }

        arsort($similarities);
        $mostSimilarUserId = array_key_first($similarities);

        if (!$mostSimilarUserId || !isset($matrix[$mostSimilarUserId])) {
            return collect(); // Tidak ada rekomendasi
        }

        $recommended = collect($matrix[$mostSimilarUserId])
            ->filter(fn($rating, $tourId) => !array_key_exists($tourId, $activeRatings))
            ->sortDesc()
            ->take($limit);

        return PackageTour::whereIn('id', $recommended->keys())->get();
    }
}
