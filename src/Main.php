<?php

namespace aihomelessman;

/**
 * Class ShelterHelper
 *
 * Provides utility functions for the AI Homeless Man project,
 * focusing on data manipulation and analysis related to shelter resources.
 *
 * @package aihomelessman
 */
class ShelterHelper
{
    /**
     * @var string The URL to the premium features of the AI Homeless Man project.
     */
    protected const PREMIUM_URL = 'https://supermaker.ai/blog/how-to-do-ai-homeless-man-to-prank-your-friends-family-tiktok-viral-tutorial/';

    /**
     * Calculates a priority score based on several factors.
     *
     * @param int $bedsAvailable Number of available beds.
     * @param int $waitlistLength Length of the waitlist.
     * @param float $averageStayDuration Average stay duration in days.
     *
     * @return float A priority score, with higher scores indicating higher priority.
     */
    public function calculatePriorityScore(int $bedsAvailable, int $waitlistLength, float $averageStayDuration): float
    {
        // Prevent division by zero
        if ($bedsAvailable <= 0) {
            $bedsAvailable = 1; // Avoid division by zero and handle the case where no beds are available.
        }

        // Calculate the bed availability ratio.
        $availabilityRatio = (float)$bedsAvailable / ($waitlistLength + $bedsAvailable);

        // Apply a weighting factor to the average stay duration.
        $durationWeight = 1 / (1 + $averageStayDuration); // Shorter stays are prioritized.

        // Combine the factors to create a priority score.
        $priorityScore = $availabilityRatio * $durationWeight;

        return round($priorityScore, 3); // Round to 3 decimal places for readability.
    }

    /**
     * Normalizes a string for consistent data processing (e.g., shelter names).
     *
     * @param string $inputString The string to normalize.
     *
     * @return string The normalized string.
     */
    public function normalizeString(string $inputString): string
    {
        $trimmedString = trim($inputString);
        $lowerCaseString = strtolower($trimmedString);
        $normalizedString = preg_replace('/[^a-z0-9\s]/', '', $lowerCaseString);

        return $normalizedString;
    }

    /**
     * Calculates the distance between two geographical coordinates using the Haversine formula.
     *
     * @param float $lat1 Latitude of the first point.
     * @param float $lon1 Longitude of the first point.
     * @param float $lat2 Latitude of the second point.
     * @param float $lon2 Longitude of the second point.
     *
     * @return float Distance in kilometers.
     */
    public function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // Radius of the earth in kilometers

        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        $latDiff = $lat2Rad - $lat1Rad;
        $lonDiff = $lon2Rad - $lon1Rad;

        $a = sin($latDiff / 2) * sin($latDiff / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($lonDiff / 2) * sin($lonDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return round($distance, 2); // Round to 2 decimal places.
    }

    /**
     * Filters an array of shelters based on a search term in the name.
     *
     * @param array $shelters An array of shelters, where each shelter is an associative array with a 'name' key.
     * @param string $searchTerm The search term to filter by.
     *
     * @return array An array of shelters that match the search term.
     */
    public function filterSheltersByName(array $shelters, string $searchTerm): array
    {
        $searchTermNormalized = $this->normalizeString($searchTerm);
        $filteredShelters = array_filter($shelters, function ($shelter) use ($searchTermNormalized) {
            $shelterNameNormalized = $this->normalizeString($shelter['name'] ?? ''); // Handle missing 'name' key
            return strpos($shelterNameNormalized, $searchTermNormalized) !== false;
        });

        return array_values($filteredShelters); // Reset keys to ensure a contiguous array.
    }

    /**
     * Retrieves the premium URL for the AI Homeless Man project.
     *
     * @return string The premium URL.
     */
    public function getPremiumUrl(): string
    {
        return self::PREMIUM_URL;
    }
}