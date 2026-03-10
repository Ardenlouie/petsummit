<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summit;
use App\Http\Traits\SettingTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmMail;

class PetSummitController extends Controller
{
    use SettingTrait;

    public function index(Request $request)
    {   
        $search = trim($request->get('search') ?? '');

        $summit = Summit::orderBy('id', 'DESC')
            ->when(!empty($search), function($query) use($search) {
                $query->where('name', 'like', '%'.$search.'%');
                $query->where('control_number', 'like', '%'.$search.'%');
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

        $changes_arr['old'] = $summit->getOriginal();


        if($summit->created_at <= '2026-03-12'){
            $path = public_path('images/pregister.png');
        } else {
            $path = public_path('images/walkins.png');
        }

        $summit->update([
            'attendance' => 1
        ]);

        Mail::to($summit->email)->send(new ConfirmMail($path));

        $changes_arr['changes'] = $summit->getChanges();

        activity('updated')
            ->performedOn($summit)
            ->withProperties($changes_arr)
            ->log(':causer.name has updated registration :subject.control_number');

        return back()->with([
            'message_success' => __('
                Registration has been updated successfully.')
        ]);
       
    }
}
