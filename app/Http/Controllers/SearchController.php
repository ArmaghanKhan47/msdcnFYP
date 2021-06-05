<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use SebastianBergmann\Environment\Console;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        //Retailer Only
        Gate::authorize('retailerAccessOnly');
        
        $this->validate($request, [
            'query' => 'string|required|alpha_num',
            'option' => 'numeric|required'
        ]);
        $query = $request->input('query');
        $option = $request->input('option');
        switch($option)
        {
            case 1:
                return $this->searchByMedicine($query);
                break;
            case 2:
                return $this->searchByDistributor($query);
                break;
            case 3:
                return $this->searchByCompany($query);
                break;
        }
    }

    public function searchByMedicine($query)
    {
        $result = Medicine::with(['inventorydistributor', 'inventorydistributor.distributor'])->where('MedicineName', 'LIKE', '%' . $query . '%')->get();
        return view('search.bymedicine')->with('data', $result);
    }

    public function searchByDistributor($query)
    {
        $result = DistributorShop::with('inventories', 'inventories.medicine')->where('DistributorShopName', 'LIKE', '%' . $query . '%')->first();
        return view('search.bydistributor')->with('data', $result);
    }

    public function searchByCompany($query)
    {
        $result = Medicine::with(['inventorydistributor', 'inventorydistributor.distributor'])->where('MedicineCompany', 'LIKE', '%' . $query . '%')->get();
        return view('search.bymedicine')->with('data', $result);
    }
}
