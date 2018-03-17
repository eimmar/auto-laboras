<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 17.16
 */

namespace Form;


use Repository\CarRepository;
use Repository\DriverRepository;
use Repository\TireRepository;
use Repository\TrackRepository;
use Repository\WeatherConditionRepository;

class LapForm extends BaseForm
{

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function buildForm()
    {
        $weatherRepository = new WeatherConditionRepository();
        $carRepository = new CarRepository();
        $driverRepository = new DriverRepository();
        $tiresRepository = new TireRepository();

        return $this
            ->setName('Trasa')
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(10)
                    ->setName('lapTimeMs')
                    ->setLabel('Apvaziavimo laikas (ms)')
                    ->setValue($this->getFieldValue('lapTimeMs'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(11)
                    ->setName('note')
                    ->setLabel('Papildoma informacija')
                    ->setValue($this->getFieldValue('note'))
                    ->setIsRequired(false)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('weatherConditions')
                    ->setLabel('Oro salygos')
                    ->setValue($this->getFieldValue('weatherConditions'))
                    ->setOptions($weatherRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('car')
                    ->setLabel('Automobilis')
                    ->setValue($this->getFieldValue('car'))
                    ->setOptions($carRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('driver')
                    ->setLabel('Vairuotojas')
                    ->setValue($this->getFieldValue('driver'))
                    ->setOptions($driverRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('tire')
                    ->setLabel('Padangos')
                    ->setValue($this->getFieldValue('tire'))
                    ->setOptions($tiresRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            );
    }
}
