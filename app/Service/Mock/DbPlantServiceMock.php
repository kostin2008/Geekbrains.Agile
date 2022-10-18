<?php
namespace App\Service\Mock;

use App\Models\CalendarPlant;
use App\Models\PlantFull;
use App\Models\PlantShort;
use App\Service\IDbPlantService;

/**
 * Class DbPlantServiceMock
 * Фэйковый сервис по работате с растениями в БД
 */
class DbPlantServiceMock implements IDbPlantService
{

    public function getAllPlants(?string $search): array
    {
        $plant1 = new PlantShort();
        $plant1->id = 1;
        $plant1->name = "Растение 1";
        $plant1->shortInfo = "Дикорастущее растение средней полосы";
        $plant1->photoSmallPath = "image1.jpg";
        $plant1->tags = "Солнцелюбивое, дикорастущее";

        $plant2 = new PlantShort();
        $plant2->id = 2;
        $plant2->name = "Растение 2";
        $plant2->shortInfo = "Дикорастущее растение средней полосы";
        $plant2->photoSmallPath = "image1.jpg";
        $plant2->tags = "Солнцелюбивое, дикорастущее";

        $plant3 = new PlantShort();
        $plant3->id = 3;
        $plant3->name = "Растение 3";
        $plant3->shortInfo = "Дикорастущее растение средней полосы";
        $plant3->photoSmallPath = "image1.jpg";
        $plant3->tags = "Солнцелюбивое, дикорастущее";

        return [$plant1, $plant2, $plant3, $plant1, $plant2, $plant3, $plant1, $plant2, $plant3];

    }
    public function getPlant(int $id): PlantFull
    {
        $plant1 = new PlantFull();
        $plant1->id = 1;
        $plant1->name = "Растение 1";
        $plant1->shortInfo = "Дикорастущее растение средней полосы";
        $plant1->fullInfo = "Дикорастущее растение средней полосы. Произростает в каких-то широтах, на каких-то берегах";
        $plant1->photoSmallPath = "image1.jpg";
        $plant1->tags = ["Солнцелюбивое", "Дикорастущее"];
        return $plant1;

    }
    public function updatePlant(PlantFull $plant)
    {
        echo("<script>console.log('Update Plant');</script>");
    }
    public function insertPlant(PlantFull $plant): int
    {
        echo("<script>console.log('Insert Plant');</script>");
    }
    public function deletePlant(int $plantId)
    {
        echo("<script>console.log('Delete Plant');</script>");
    }
    public function addPlantToFavor(int $userId, int $plantId)
    {
        echo("<script>console.log('addPlantToFavor');</script>");
    }
    public function removePlantFromFavor(int $userId, int $plantId)
    {
        echo("<script>console.log('removePlantFromFavor');</script>");
    }
    public function getFavorPlants(int $userId): array
    {
        echo("<script>console.log('getFavorPlants');</script>");
    }

    public function getFavorCalendar(int $userId): ?array
    {
        // TODO: Implement getFavorCalendar() method.
    }

    public function setUserPlantDone(int $userId, int $plantId, int $actionId, string $date): void
    {
        // TODO: Implement setUserPlantDone() method.
    }

    public function resetUserPlantDone(int $userId, int $plantId, int $actionId, string $date): void
    {
        // TODO: Implement resetUserPlantDone() method.
    }

    public function getTagById(int $plantId)
    {
        // TODO: Implement getTagById() method.
    }
}
