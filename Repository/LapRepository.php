<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 15.59
 */

namespace Repository;


class LapRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
          'id',
          'lap_time_ms',
          'date_lapped',
          'note',
        ];

        $this->joinFields = [
            'weather_conditions' => new WeatherConditionRepository(),
            'car_id' => new CarRepository(),
            'driver_id' => new DriverRepository(),
            'tires_id' => new TireRepository(),
            'track_id' => new TrackRepository()
        ];
    }
}
