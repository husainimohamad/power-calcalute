<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeController extends Controller
{
    public function uploadForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
    
        // Open the file
        $file = fopen($request->file('file')->getRealPath(), 'r');
        $prevTime = null;
        $timeDiffs = []; // To store time differences
        $totalSeconds = 0; // To store the total sum of time differences in seconds
    
        // Skip the first row (header)
        fgetcsv($file);
    
        // Iterate through the rows
        while (($row = fgetcsv($file)) !== false) {
            if ($row[1] === 'ON') {
                $currentTime = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $row[0]);
    
                // If we have a previous "ON" event, calculate the time difference
                if ($prevTime) {
                    // Get the total difference in seconds
                    $timeDiffInSeconds = $prevTime->diffInSeconds($currentTime);
    
                    // Add to the total time difference
                    $totalSeconds += $timeDiffInSeconds;
    
                    // Calculate hours, minutes, and seconds from total seconds
                    $hours = floor($timeDiffInSeconds / 3600);
                    $minutes = floor(($timeDiffInSeconds % 3600) / 60);
                    $seconds = $timeDiffInSeconds % 60;
    
                    // Add the time difference in the desired format (hours, minutes, seconds)
                    $timeDiffs[] = [
                        'previous_time' => $prevTime->format('d/m/Y H:i'),
                        'current_time' => $currentTime->format('d/m/Y H:i'),
                        'difference' => sprintf('%02d hours %02d minutes %02d seconds', $hours, $minutes, $seconds)
                    ];
                }
    
                // Update the previous time to the current time
                $prevTime = $currentTime;
            }
        }
    
        // Close the file
        fclose($file);
    
        // Convert total seconds to hours, minutes, and seconds
        $totalHours = floor($totalSeconds / 3600);
        $totalMinutes = floor(($totalSeconds % 3600) / 60);
        $totalSeconds = $totalSeconds % 60;
    
        // Pass the array of time differences and total time to the view
        return view('result', [
            'timeDiffs' => $timeDiffs,
            'totalTime' => sprintf('%02d hours %02d minutes %02d seconds', $totalHours, $totalMinutes, $totalSeconds)
        ]);
    }
    
    

  
}
