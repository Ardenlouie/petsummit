<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Summit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterPetRequest;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\DNS2D;


class RegisterPetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/thank-you';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register_petsummit()
    {   
        $control_number = $this->generateControlNumber();

        return view('start')->with([
            'control_number' => $control_number,
     
        ]);
       
    }


    public function thank_you($pet_id)
    {   
        $summit = Summit::findOrFail(decrypt($pet_id));

        return view('thank-you')->with([
            'summit' => $summit,

        ]);
       
    }

    public function downloadTicket($pet_id)
    {
        // 1. Fetch any needed data (optional)
        $registration = Summit::findOrFail(decrypt($pet_id));
    
        // 2. Load the Blade view
        $pdf = Pdf::loadView('pdf');

        // 3. Optional: Set paper size (e.g., 'a4', 'letter', or custom array in points)
        // For a custom ticket size (e.g., 4x6 inches = 288x432 points)
        $pdf->setPaper([0, 0, 288, 432], 'portrait');

        // 4. Stream to browser or download
        return $pdf->download('Top2Tail-Ticket.pdf');
    }

    public function printPDF($pet_id, $shouldStream = false) {
        $summit = Summit::findOrFail($pet_id); 

        $bar_code = new DNS2D();
        $bar_code = $bar_code->getBarcodeHTML(route('confirm', [$summit->id]), 'QRCODE', 5, 5);


        $pdf = PDF::loadView('pdf', [
            'summit' => $summit,
            'bar_code' => $bar_code
        ]);

        return $shouldStream ? $pdf->stream() : $pdf;
    }

    public function showPdf($id) {

        return $this->printPDF($id, true); 
    }


    private function generateControlNumber() {
        $date_code = date('Ymd');

        do {
            $control_number = 'T2T-'.$date_code.'-001';

            $pet = Summit::withTrashed()->orderBy('control_number', 'DESC')
                ->first();
            if(!empty($pet)) {
                $latest_control_number = $pet->control_number;
                list(, $prev_date, $last_number) = explode('-', $latest_control_number);

                $number = ($date_code == $prev_date) ? ((int)$last_number + 1) : 1;

                $formatted_number = str_pad($number, 3, '0', STR_PAD_LEFT);

                $control_number = "T2T-$date_code-$formatted_number";
            }

        } while(Summit::withTrashed()->where('control_number', $control_number)->exists());

        return $control_number;

        
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:summit_2026'],
            'control_number' => ['required', 'string', 'unique:summit_2026'],
            'pets' => 'required|array|min:1',
            'store' => 'required|array|min:1',
            'product' => 'required|array|min:1',
            'brand' => 'required|array|min:1',
            'switch' => 'required|array|min:1',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register_pet(RegisterPetRequest $request)
    {
        $request->control_number = $this->generateControlNumber();

        $pets = $request->pets;

        if (in_array('others', $pets) && $request->filled('other_pet_name')) {
            $key = array_search('others', $pets);
            $pets[$key] = $request->other_pet_name;
        }

        $attendance = 0;
        $pet = new Summit([
            'name' => $request->name,
            'email' => $request->email,
            'control_number' => $request->control_number,
            'pets' => $pets,
            'spend' => $request->spend,
            'store' => $request->store,
            'product' => $request->product,
            'brand' => $request->brand,
            'switch' => $request->switch,
            'bath' => $request->bath,
            'attendance' => $attendance,
        ]);
        $pet->save();

        $pet_id = encrypt($pet->id);

        $pdfContent = $this->printPDF($pet->id)->output();

        Mail::to($pet->email)->send(new RegisterMail($pet, $pdfContent));

        return redirect()->route('thank-you', ['pet_id' => $pet_id]);
    }
}
