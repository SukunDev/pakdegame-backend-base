<?php

namespace App\Http\Controllers\Blog\Options;

use App\Http\Controllers\Controller;
use App\Http\Resources\OptionsResource;
use App\Models\Options;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function getOptions(Request $request)
    {
        $options = Options::all();
        $optionsResource = [];
        foreach (OptionsResource::collection($options) as $items) {
            $value = json_decode($items["value"]);
            if ($value == null) {
                $value = $items["value"];
            }
            $optionsResource[$items["key"]] = $value;
        }
        return response()->json([
            "success" => true,
            "result" => $optionsResource,
        ]);
    }
}
