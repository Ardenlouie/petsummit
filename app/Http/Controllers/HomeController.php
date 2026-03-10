<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use App\Models\Summit;
use App\Exports\AttendanceExport;
use App\Exports\RegistrationExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export()
    {
        return Excel::download(new AttendanceExport, 'attendance.xlsx');
    }

    public function exportAll()
    {
        return Excel::download(new RegistrationExport, 'registration.xlsx');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $all = Summit::orderBy('created_at', 'DESC')->count();
        $registers = Summit::orderBy('created_at', 'DESC')->get();
        $attandance = Summit::where('attendance', 1)->count();

        $allPets = Summit::pluck('pets')->flatten()->count();

        $dogCount = Summit::whereJsonContains('pets', 'dog')->count();
        $catCount = Summit::whereJsonContains('pets', 'cat')->count();
        $bothCount = Summit::whereJsonContains('pets', 'dogcat')->count();
        $otherCount = Summit::whereJsonContains('pets', 'others')->count();

        $percent_dog = $allPets != 0 ? (($dogCount) / $allPets) * 100 : 0;
        $percent_cat = $allPets != 0 ? (($catCount) / $allPets) * 100 : 0;
        $percent_both = $allPets != 0 ? (($bothCount) / $allPets) * 100 : 0;
        $percent_other = $allPets != 0 ? (($otherCount) / $allPets) * 100 : 0;

        $allSpends = Summit::pluck('spend')->flatten()->count();

        $lowCount = Summit::where('spend', 'low')->count();
        $mediumCount = Summit::where('spend', 'medium')->count();
        $highCount = Summit::where('spend', 'high')->count();
        $veryhighCount = Summit::where('spend', 'veryhigh')->count();

        $percent_low = $allSpends != 0 ? (($lowCount) / $allSpends) * 100 : 0;
        $percent_medium = $allSpends != 0 ? (($mediumCount) / $allSpends) * 100 : 0;
        $percent_high = $allSpends != 0 ? (($highCount) / $allSpends) * 100 : 0;
        $percent_veryhigh = $allSpends != 0 ? (($veryhighCount) / $allSpends) * 100 : 0;

        $allStore = Summit::pluck('store')->flatten()->count();

        $petstoreCount = Summit::whereJsonContains('store', 'petstore')->count();
        $tiktokCount = Summit::whereJsonContains('store', 'tiktok')->count();
        $shopeeCount = Summit::whereJsonContains('store', 'shopee')->count();
        $lazadaCount = Summit::whereJsonContains('store', 'lazada')->count();
        $supermarketCount = Summit::whereJsonContains('store', 'supermarket')->count();
        $vetclinicCount = Summit::whereJsonContains('store', 'vetclinic')->count();

        $percent_petstore = $allStore != 0 ? (($petstoreCount) / $allStore) * 100 : 0;
        $percent_tiktok = $allStore != 0 ? (($tiktokCount) / $allStore) * 100 : 0;
        $percent_shopee = $allStore != 0 ? (($shopeeCount) / $allStore) * 100 : 0;
        $percent_lazada = $allStore != 0 ? (($lazadaCount) / $allStore) * 100 : 0;
        $percent_supermarket = $allStore != 0 ? (($supermarketCount) / $allStore) * 100 : 0;
        $percent_vetclinic = $allStore != 0 ? (($vetclinicCount) / $allStore) * 100 : 0;

        $allBath = Summit::pluck('bath')->flatten()->count();

        $weeklyCount = Summit::where('bath', 'weekly')->count();
        $twoweeksCount = Summit::where('bath', 'twoweeks')->count();
        $monthlyCount = Summit::where('bath', 'monthly')->count();
        $dirtyCount = Summit::where('bath', 'dirty')->count();

        $percent_weekly = $allBath != 0 ? (($weeklyCount) / $allBath) * 100 : 0;
        $percent_twoweeks = $allBath != 0 ? (($twoweeksCount) / $allBath) * 100 : 0;
        $percent_monthly = $allBath != 0 ? (($monthlyCount) / $allBath) * 100 : 0;
        $percent_dirty = $allBath != 0 ? (($dirtyCount) / $allBath) * 100 : 0;

        $allProduct = Summit::pluck('product')->flatten()->count();

        $shampooCount = Summit::whereJsonContains('product', 'shampoo')->count();
        $soapCount = Summit::whereJsonContains('product', 'soap')->count();
        $wipesCount = Summit::whereJsonContains('product', 'wipes')->count();
        $cologneCount = Summit::whereJsonContains('product', 'cologne')->count();
        $powderCount = Summit::whereJsonContains('product', 'powder')->count();

        $percent_shampoo = $allProduct != 0 ? (($shampooCount) / $allProduct) * 100 : 0;
        $percent_soap = $allProduct != 0 ? (($soapCount) / $allProduct) * 100 : 0;
        $percent_wipes = $allProduct != 0 ? (($wipesCount) / $allProduct) * 100 : 0;
        $percent_cologne = $allProduct != 0 ? (($cologneCount) / $allProduct) * 100 : 0;
        $percent_powder = $allProduct != 0 ? (($powderCount) / $allProduct) * 100 : 0;

        $allBrand = Summit::pluck('brand')->flatten()->count();

        $priceCount = Summit::whereJsonContains('brand', 'price')->count();
        $scentCount = Summit::whereJsonContains('brand', 'scent')->count();
        $ingredientsCount = Summit::whereJsonContains('brand', 'ingredients')->count();
        $reviewsCount = Summit::whereJsonContains('brand', 'reviews')->count();
        $brandReputationCount = Summit::whereJsonContains('brand', 'brand_reputation')->count();

        $percent_price = $allBrand != 0 ? (($priceCount) / $allBrand) * 100 : 0;
        $percent_scent = $allBrand != 0 ? (($scentCount) / $allBrand) * 100 : 0;
        $percent_ingredients = $allBrand != 0 ? (($ingredientsCount) / $allBrand) * 100 : 0;
        $percent_reviews = $allBrand != 0 ? (($reviewsCount) / $allBrand) * 100 : 0;
        $percent_brandreputation = $allBrand != 0 ? (($brandReputationCount) / $allBrand) * 100 : 0;

        $allSwitch = Summit::pluck('switch')->flatten()->count();

        $bscentCount = Summit::whereJsonContains('switch', 'bscent')->count();
        $mpriceCount = Summit::whereJsonContains('switch', 'mprice')->count();
        $ningredientsCount = Summit::whereJsonContains('switch', 'ningredients')->count();
        $breviewsCount = Summit::whereJsonContains('switch', 'breviews')->count();
        $rinfluencerCount = Summit::whereJsonContains('switch', 'rinfluencer')->count();

        $percent_bscent = $allSwitch != 0 ? (($bscentCount) / $allSwitch) * 100 : 0;
        $percent_mprice = $allSwitch != 0 ? (($mpriceCount) / $allSwitch) * 100 : 0;
        $percent_ningredients = $allSwitch != 0 ? (($ningredientsCount) / $allSwitch) * 100 : 0;
        $percent_breviews = $allSwitch != 0 ? (($breviewsCount) / $allSwitch) * 100 : 0;
        $percent_rinfluencer = $allSwitch != 0 ? (($rinfluencerCount) / $allSwitch) * 100 : 0;

        return view('home')->with([
            'all' => $all,
            'attendance' => $attandance,
            'registers' => $registers,
            'percent_dog' => $percent_dog,
            'percent_cat' => $percent_cat,
            'percent_both' => $percent_both,
            'percent_other' => $percent_other,
            'allPets' => $allPets,
            'percent_low' => $percent_low,
            'percent_medium' => $percent_medium,
            'percent_high' => $percent_high,
            'percent_veryhigh' => $percent_veryhigh,
            'percent_petstore' => $percent_petstore,
            'percent_tiktok' => $percent_tiktok,
            'percent_shopee' => $percent_shopee,
            'percent_lazada' => $percent_lazada,
            'percent_supermarket' => $percent_supermarket,
            'percent_vetclinic' => $percent_vetclinic,
            'percent_weekly' => $percent_weekly,
            'percent_twoweeks' => $percent_twoweeks,
            'percent_monthly' => $percent_monthly,
            'percent_dirty' => $percent_dirty,
            'percent_shampoo' => $percent_shampoo,
            'percent_soap' => $percent_soap,
            'percent_wipes' => $percent_wipes,
            'percent_cologne' => $percent_cologne,
            'percent_powder' => $percent_powder,
            'percent_price' => $percent_price,
            'percent_scent' => $percent_scent,
            'percent_ingredients' => $percent_ingredients,
            'percent_reviews' => $percent_reviews,
            'percent_brandreputation' => $percent_brandreputation,
            'percent_bscent' => $percent_bscent,
            'percent_mprice' => $percent_mprice,
            'percent_ningredients' => $percent_ningredients,
            'percent_breviews' => $percent_breviews,
            'percent_rinfluencer' => $percent_rinfluencer,
        ]);
    }

    
}
