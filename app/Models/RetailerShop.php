<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailerShop extends Model
{
    use HasFactory;

    protected $primaryKey = 'RetailerShopId';

    public function inventories(){
            return $this->hasMany(InventoryRetailer::class, 'RetailerShopId');
    }

    // public function inventory()
    // {
    //     // return $this->hasMany(InventoryRetailer::class, 'RetailerShopId');
    //     return InventoryRetailer::select(['Quantity', 'UnitPrice', 'MedicineName', 'MedicineFormula', 'MedicineCompany', 'MedicineType'])->join('medicines', 'medicines.medicineId','inventory_retailers.medicineId')->where('RetailerShopId', $this->RetailerShopId)->get();
    // }
}
