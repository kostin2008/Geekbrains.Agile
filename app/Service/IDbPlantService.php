<?php
namespace App\Service;
use App\Models\CalendarPlant;
use App\Models\PlantFull;
use App\Models\PlantShort;

interface IDbPlantService
{
    /**
     * Возвращает список растений
     * @return PlantShort[]
     */
    public function getAllPlants(?string $search): array;

    /**
     * Возвращает подробную информацию об одном растении
     * @param int $id
     * @return PlantFull
     */
    public function getPlant(int $id): PlantFull;

    /**
     * Сохраняет подробную информацию о существующем растении
     */
    public function updatePlant(PlantFull $plant);

    /**
     * Вставляет подробную информацию о растении, которого нет в БД
     * @return int - Id вставленного растения
     */
    public function insertPlant(PlantFull $plant);

    /**
     * Удаляет растение
     */
    public function deletePlant(int $plantId);

    /**
     * Добавляет растение в избранное
     * @param int $userId
     * @param int $plantId
     * @return mixed
     */
    public function addPlantToFavor(int $userId, int $plantId);

    /**
     * Удаляет растение из избранного
     * @param int $userId
     * @param int $plantId
     * @return mixed
     */
    public function removePlantFromFavor(int $userId, int $plantId);

    /**
     * Возвращает список избранных растений
     * @return PlantShort[]
     */
    public function getFavorPlants(int $userId): array;

    /**
     * Возвращает календарь
     * @param int $userId
     * @return CalendarPlant[]
     */

    public function getFavorCalendar(int $userId): ?array;

    /**
     * Установка флага сделанной работы
     * @param int $userId
     * @param int $plantId
     * @param int $actionId
     * @param string $date
     */
    public function setUserPlantDone(int $userId, int $plantId, int $actionId, string $date): void;

    /**
     * Сброс флага сделанной работы
     * @param int $userId
     * @param int $plantId
     * @param int $actionId
     * @param string $date
     */
    public function resetUserPlantDone(int $userId, int $plantId, int $actionId, string $date): void;
    public function getTagById(int $plantId);
}
