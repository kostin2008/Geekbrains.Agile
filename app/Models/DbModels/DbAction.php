<?php


namespace App\Models\DbModels;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class DbAction extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;
    protected $table = "action";
    protected $primaryKey = "id";

}
