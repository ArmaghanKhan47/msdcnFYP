<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\Medicine;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class SearchController extends Controller
{

    public function search($option, $query)
    {
        switch($option)
        {
            case 1:
                return $this->searchByMedicine($query);
                break;
            case 2:
                return $this->searchByDistributor($query);
                break;
            case 3:
                return $this->searchByFormula($query);
                break;
            case 4:
                return $this->searchByCompany($query);
                break;
        }
    }

    public function searchByMedicine($query)
    {
        $result = Medicine::with(['inventorydistributors', 'inventorydistributors.distributor'])->where('MedicineName', 'LIKE', '%' . $query . '%')->first();
        return view('search.bymedicine')->with('data', $result);
    }

    public function searchByDistributor($query)
    {
        $result = DistributorShop::with('inventories', 'inventories.medicine')->where('DistributorShopName', 'LIKE', '%' . $query . '%')->first();
        return view('search.bydistributor')->with('data', $result);
    }

    public function searchByFormula($query)
    {
        $result = Medicine::with(['inventorydistributors', 'inventorydistributors.distributor'])->where('MedicineFormula', 'LIKE', '%' . $query . '%')->first();
        return view('search.bymedicine')->with('data', $result);
    }

    public function searchByCompany($query)
    {
        $result = Medicine::with(['inventorydistributors', 'inventorydistributors.distributor'])->where('MedicineCompany', 'LIKE', '%' . $query . '%')->first();
        return view('search.bymedicine')->with('data', $result);
    }
}
