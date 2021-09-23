<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Repositories\LocationRepository;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public static function index(Request $request)
    {
        if ($request->ajax()) {
            \Log::error(LocationService::getList());
            return [
                'success' => __('message.create_user_successfully'),
                'view' => \View::make('admin.locations.table',
                                      [
                                          'locations' => LocationService::getList(),
                                      ])->render()
            ];
        }
        return view('admin.locations.index', [
            'locations' => Locationservice::getList(),
        ]);
    }

    public static function edit(string $id)
    {
        if (!($location = LocationService::findById($id))) {
            return ['error' => __('message.location_is_not_exist')];
        }
        return ['location' => $location];
    }
    public static function store(LocationRequest $request)
    {
        if (!LocationService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('message.create_location_successfully'),
            'view' => \View::make(
                'admin.locations.table',
                [
                    'locations' => LocationRepository::getList(),
                ]
            )->render()
        ];
    }
    public static function update(LocationRequest $request)
    {
        $locationId = $request->get('id');
        if (!($location = LocationService::findById($locationId))) {
            return ['error' => __('message.location_is_not_exist')];
        }
        return LocationService::update($location, $request);
    }
}
