<?php

namespace Modules\Web\Http\Controllers\Api;

use App\Models\References\ProvinceRegencyDistrict;

use Illuminate\Http\Request;
use Modules\Web\Http\Controllers\Controller;

class ReferenceController extends Controller
{
    /**
     * Get district references.
     */
    public function districts(Request $request)
    {
        $districts = ProvinceRegencyDistrict::with('regency.province')
                        ->where('name', 'like', '%'.$request->get('q', '').'%')
                        ->orWhere('id', 'like', '%'.$request->get('q', '').'%')
                        ->limit(10)
                        ->get()
                        ->map(function($item) {
                            return [
                                'id'    => $item->id,
                                'text'  => $item->regional
                            ];
                        });

        return response($districts);
    }
}
