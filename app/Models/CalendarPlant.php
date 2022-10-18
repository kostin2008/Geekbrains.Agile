<?php
namespace App\Models;

class CalendarPlant extends ModelCommon
{
    /**
     * @var int
     */
    public $dayNum;
    /**
     * @var string
     */
    public $date;
    /**
     * @var string
     */
    public $dayInfo;
    /**
     * @var CalendarPlantRow[]
     */
    public $plantsToDo;
    /**
     * @var int
     */
    public $totalCount;
    /**
     * @var int
     */
    public $doneCount;
    /**
     * @var int
     */
    public $percent;
}
