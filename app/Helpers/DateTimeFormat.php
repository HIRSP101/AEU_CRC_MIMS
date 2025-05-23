<?php
namespace App\Helpers;

class DateTimeFormat
{
    public static function convertDate($date)
    {
        if ($date) {
            $dateTime = \DateTime::createFromFormat('d/m/Y', $date);
            if ($dateTime) {
                return $dateTime->format('Y-m-d');
            }
        }
        return null;
    }

    public static function convertKhmerToEnglishNumbers($string)
    {
        $khmerNumbers = [
            '០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'
        ];
        $englishNumbers = [
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        ];

        return str_replace($khmerNumbers, $englishNumbers, $string);
    }
     public static function convertEnglishToKhmerNumbers($string)
    {
        $khmerNumbers = [
            '០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'
        ];
        $englishNumbers = [
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        ];

        return str_replace($englishNumbers, $khmerNumbers, $string);
    }

    public static function spittingEducationLevel($educationLevel)
    {
        if (!$educationLevel) return null;
        $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $educationLevel = str_replace($khmerNumbers, $englishNumbers, $educationLevel);
    
        preg_match('/\d+/', $educationLevel, $matches);
        $levelNumber = isset($matches[0]) ? intval($matches[0]) : null;
    
        if (!$levelNumber) return null;
    
        if (str_contains($educationLevel, 'ថ្នាក់ទី')) {
            return $levelNumber;
        } elseif (str_contains($educationLevel, 'ឆ្នាំទី')) {
            return $levelNumber;
        }
        return null;
    }

 public static function convertEnglishToKhmerNumbersAndMonth($dateString)
{
    $khmerNumbers = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
    $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    $months = [
        'January' => 'មករា',
        'February' => 'កុម្ភៈ',
        'March' => 'មិនា',
        'April' => 'មេសា',
        'May' => 'ឧសភា',
        'June' => 'មិថុនា',
        'July' => 'កក្កដា',
        'August' => 'សីហា',
        'September' => 'កញ្ញា',
        'October' => 'តុលា',
        'November' => 'វិច្ឆិកា',
        'December' => 'ធ្នូ'
    ];

    try {
        $date = new \DateTime($dateString); // Parse input string into DateTime
        $formatted = $date->format('d-F-Y'); // Format: 02-January-2019

        // Translate month name
        foreach ($months as $english => $khmer) {
            $formatted = str_replace($english, $khmer, $formatted);
        }

        // Translate numbers
        $formatted = str_replace($englishNumbers, $khmerNumbers, $formatted);

        return $formatted;
    } catch (\Exception $e) {
        return $dateString; // Fallback if input is not a valid date
    }
}

}
?>