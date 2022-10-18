<?php


namespace App\Models\DbModels;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class DbPlant extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    protected $table = "plant";
    protected $primaryKey = "id";

    public function tags(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DbPlantTag::class, 'plant_id', 'id');
    }
}
