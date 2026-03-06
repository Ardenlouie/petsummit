<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summit;
use App\Http\Traits\SettingTrait;

class PetSummitController extends Controller
{
    use SettingTrait;

    public function index(Request $request)
    {   
        $search = trim($request->get('search') ?? '');

        $summit = Summit::orderBy('id', 'DESC')
            ->when(!empty($search), function($query) use($search) {
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->paginate($this->getDataPerPage())->onEachSide(1)
            ->appends(request()->query());

        return view('pages.pet-summits.index')->with([
            'summit' => $summit,
            'search' => $search,
    
        ]);
       
    }

    public function confirm($pet_id)
    {   
        $summit = Summit::findOrFail($pet_id);

        return view('pages.pet-summits.confirm')->with([
            'summit' => $summit,
     
        ]);
       
    }

    public function update_pet($pet_id)
    {   
        $summit = Summit::findOrFail($pet_id);

        $summit->update([
            'attendance' => 1
        ]);

        return back()->with([
            'message_success' => __('
                Registration has been updated successfully.')
        ]);
       
    }
}
