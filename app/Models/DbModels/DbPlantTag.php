<?php
namespace App\Models\DbModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DbPlantTag extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    protected $table = "plant_tag";
    protected $primaryKey = "id";
    protected $fillable = ['plant_id','tag'];

}
