<?php
namespace App\Models;

class PlantShort extends ModelCommon
{
    /**
    * @var int
    */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $addDate;
    /**
     * @var string
     */
    public $shortInfo;
    /**
     * @var string
     */
    public $photoSmallPath;
    /**
     * @var int
     */
    public $wateringDays;
    /**
     * @var bool
     */
    public $isFavor;
    /**
     * @var string
     */
    public $manuringDays;
    /**
     * @var string
     */
    public $tags;
    public $pestControlDays;

    /**
     * @var string
     */
    public $tagsList;
}
