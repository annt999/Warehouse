<?php

namespace App\Services;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use App\Repositories\LocationRepository;

class LocationService
{
    public static function findById(?int $locationId)
    {
        return $locationId ? LocationRepository::findById($locationId) : null;
    }
    public static function getList()
    {
        return LocationRepository::getList();
    }
    public static function store(LocationRequest $request)
    {
        $dataInsert = $request->only(['name', 'description']);
        $dataInsert['ware_house_id'] = auth()->user()->ware_house_id;
        \Log::error($dataInsert);
        return LocationRepository::store($dataInsert);
    }
    public static function update(Location $location,LocationRequest $request)
    {
        $dataUpdate = $request->only(['name', 'description']);
        if (!LocationRepository::update($location, $dataUpdate))
        {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('message.update_location_successfully'),
            'view' => \View::make('admin.locations.table', [
                'locations' => LocationService::getList(),
            ])->render()
        ];

    }
}
