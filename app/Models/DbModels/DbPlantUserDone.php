<?php


namespace App\Models\DbModels;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class DbPlantUserDone extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    protected $table = "plant_user_done";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'plant_id','action_id','date'];

    public function action(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DbAction::class, 'action_id', 'id');
    }
}
