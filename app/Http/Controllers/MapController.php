<?php

namespace App\Http\Controllers;

use App\Models\Trash;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(){
        $trashs = Trash::all();
    
        foreach ($trashs as $trashIndex) {
            // Check for null values
            if ($trashIndex->location === null) {
                // Handle null location as needed, e.g., set default values or log an error
                // ...
                continue;  // Skip to the next trash item
            }
    
            // Attempt Base64 decoding
            $decodedString = base64_decode($trashIndex->location, true);  // Include strict checking
    
            // Check for decoding errors
            if ($decodedString === false) {
                // Handle invalid Base64 string, e.g., log an error or set default values
                // ...
                continue;  // Skip to the next trash item
            }
    
            // Separate latitude and longitude
            $latLng = explode(",", $decodedString);
    
            // Extract latitude and longitude as floats
            if (count($latLng) === 2) {
                $latitude = floatval($latLng[0]);
                $longitude = floatval($latLng[1]);
    
                $trashIndex->latitude = $latitude;
                $trashIndex->longitude = $longitude;
            } else {
                // Handle unexpected format, e.g., log an error
                // ...
            }
        }
    
        
        return view('client-customer.index', compact('trashs'));
    }
    
}
