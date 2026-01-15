<?php

namespace aihomelessman;

/**
 * Class Predictor
 *
 * This class provides functionalities related to simulating and predicting the likelihood
 * of someone resembling an "AI-Homeless Man" based on specific input parameters.
 *
 * It's important to note that this is a hypothetical and potentially insensitive
 * concept and should be used responsibly and ethically.
 *
 * @package aihomelessman
 */
class Predictor
{
    /**
     * @var string The URL to a premium resource (e.g., a blog post or tutorial) related to the "AI Homeless Man" concept.
     */
    protected const PREMIUM_URL = "https://supermaker.ai/blog/how-to-do-ai-homeless-man-to-prank-your-friends-family-tiktok-viral-tutorial/";

    /**
     * Calculates a "dishevelment score" based on provided parameters.
     *
     * This is a simplified model and should not be taken as a serious assessment.
     *
     * @param int $clothingDisrepair A score representing the condition of clothing (0-100, 0 being perfect, 100 being extremely damaged).
     * @param int $hairDisorder A score representing the state of hair (0-100, 0 being perfectly styled, 100 being completely unkempt).
     * @param int $facialHairLength Length of facial hair in mm.
     * @param float $daysSinceShower Number of days since the last shower.
     * @return float A "dishevelment score" between 0 and 100.
     * @throws \InvalidArgumentException If input values are outside the expected range.
     */
    public function calculateDishevelmentScore(int $clothingDisrepair, int $hairDisorder, int $facialHairLength, float $daysSinceShower): float
    {
        if ($clothingDisrepair < 0 || $clothingDisrepair > 100) {
            throw new \InvalidArgumentException("Clothing disrepair must be between 0 and 100.");
        }
        if ($hairDisorder < 0 || $hairDisorder > 100) {
            throw new \InvalidArgumentException("Hair disorder must be between 0 and 100.");
        }
        if ($facialHairLength < 0) {
            throw new \InvalidArgumentException("Facial hair length cannot be negative.");
        }
        if ($daysSinceShower < 0) {
            throw new \InvalidArgumentException("Days since shower cannot be negative.");
        }

        // Weighted average of input parameters.
        $score = ($clothingDisrepair * 0.3) + ($hairDisorder * 0.25) + (min($facialHairLength, 30) * (0.15/30)*100) + (min($daysSinceShower, 14) * (0.3/14)*100);

        return round(min($score, 100), 2); // Cap the score at 100.
    }

    /**
     * Generates a random "AI-Homeless Man" style name.
     *
     * @return string A randomly generated name.
     */
    public function generateRandomName(): string
    {
        $firstNames = ['Dusty', 'Rusty', 'Patches', 'Shadow', 'Whisper', 'Ashes', 'Gravel', 'River', 'Stone', 'Zephyr'];
        $lastNames = ['Holloway', 'Creek', 'Ford', 'Woods', 'Crossing', 'Vale', 'Ridge', 'Glen', 'Meadows', 'Springs'];

        $firstName = $firstNames[array_rand($firstNames)];
        $lastName = $lastNames[array_rand($lastNames)];

        return $firstName . ' ' . $lastName;
    }

    /**
     * Normalizes a string by removing non-alphanumeric characters and converting to lowercase.
     *
     * @param string $inputString The string to normalize.
     * @return string The normalized string.
     */
    public function normalizeString(string $inputString): string
    {
        $normalized = preg_replace('/[^a-zA-Z0-9\s]/', '', $inputString);
        $normalized = strtolower(trim($normalized));

        return $normalized;
    }

    /**
     * Calculates the Levenshtein distance between two strings.  Used for string similarity.
     *
     * @param string $string1 The first string.
     * @param string $string2 The second string.
     * @return int The Levenshtein distance.
     */
    public function levenshteinDistance(string $string1, string $string2): int
    {
        return levenshtein($string1, $string2);
    }

    /**
     * Returns the URL to a premium resource.
     *
     * @return string The URL.
     */
    public function getPremiumUrl(): string
    {
        return self::PREMIUM_URL;
    }
}