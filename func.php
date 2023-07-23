<?php 



function generateSlug($string) {
    // Remove any special characters except alphanumeric, spaces, and dashes
    $string = preg_replace('/[^a-zA-Z0-9\s-]/', '', $string);

    // Replace multiple spaces with a single space
    $string = preg_replace('/\s+/', ' ', $string);

    // Trim spaces from the beginning and end of the string
    $string = trim($string);

    // Convert spaces to dashes
    $string = str_replace(' ', '-', $string);

    // Convert the string to lowercase
    $slug = strtolower($string);

    return $slug;
}




function convertToRelativeTime($dateString) {
            // Convert the date string to a Unix timestamp
            $timestamp = strtotime($dateString);
        
            // Get the current timestamp
            $now = time();
        
            // Calculate the time difference in seconds
            $diff = $now - $timestamp;
        
            // Define time intervals in seconds
            $minute = 60;
            $hour = 60 * $minute;
            $day = 24 * $hour;
            $week = 7 * $day;
            $month = 30 * $day;
            $year = 365 * $day;
        
            // Format the relative time string based on the time difference
            if ($diff < $minute) {
                return "Just now";
            } elseif ($diff < $hour) {
                $minutes = floor($diff / $minute);
                return $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
            } elseif ($diff < $day) {
                $hours = floor($diff / $hour);
                return $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
            } elseif ($diff < $week) {
                $days = floor($diff / $day);
                return $days . " day" . ($days > 1 ? "s" : "") . " ago";
            } elseif ($diff < $month) {
                $weeks = floor($diff / $week);
                return $weeks . " week" . ($weeks > 1 ? "s" : "") . " ago";
            } elseif ($diff < $year) {
                $months = floor($diff / $month);
                return $months . " month" . ($months > 1 ? "s" : "") . " ago";
            } else {
                $years = floor($diff / $year);
                return $years . " year" . ($years > 1 ? "s" : "") . " ago";
            }
        }


   function formatViewsCount($views) {
            $suffixes = array('', 'k', 'M', 'B', 'T');
            $suffixIndex = 0;
            
            while ($views >= 1000 && $suffixIndex < count($suffixes) - 1) {
                $views /= 1000;
                $suffixIndex++;
            }
        
            // Format the views count to have at most one decimal point
            $formattedViews = number_format($views, $suffixIndex > 0 ? 1 : 0);
        
            // Append the appropriate suffix
            $formattedViews .= $suffixes[$suffixIndex];
        
            return $formattedViews;
        }

        function getUser($id) {
            // Use the $id parameter in the API URL
            $api_url = 'https://driveplyr.appspages.online/dashboard/api/user.php?id=' . $id;
            
            // Fetch the API response as a JSON string
            return $api_response = json_decode(file_get_contents($api_url));
        
        }
        ?>