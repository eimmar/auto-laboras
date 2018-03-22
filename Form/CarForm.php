<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.22
 * Time: 14.47
 */

namespace Form;


use Model\Lap;
use Repository\ModelRepository;
use Repository\BodyTypeRepository;
use Repository\DriveWheelsRepository;
use Repository\EngineRepository;
use Repository\GearboxRepository;
use Repository\TrackRepository;

class CarForm extends BaseForm
{

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function buildForm()
    {
        $driveWheelRepository = new DriveWheelsRepository();
        $bodyTypeRepository = new BodyTypeRepository();
        $engineRepository = new EngineRepository();
        $modelRepository = new ModelRepository();
        $gearboxRepository = new GearboxRepository();

        $this
            ->setName('Automobilis')
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(10)
                    ->setName('dateManufactured')
                    ->setLabel('Pagaminimo data')
                    ->setValue($this->getFieldValue('dateManufactured'))
                    ->setClass('date')
                    ->setIsRequired(true)
                    ->setValidation('date')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(5)
                    ->setName('weightKg')
                    ->setLabel('Svoris (kg)')
                    ->setValue($this->getFieldValue('weightKg'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(11)
                    ->setName('price')
                    ->setLabel('Kaina (Eur)')
                    ->setValue($this->getFieldValue('price'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::CHECKBOX_TYPE)
                    ->setName('isRoadLegal')
                    ->setLabel('Leistina eksplotuoti eisme')
                    ->setValue($this->getFieldValue('isRoadLegal'))
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setName('seats')
                    ->setLabel('Sedimu vietu skaicius')
                    ->setValue($this->getFieldValue('seats'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(5)
                    ->setName('topSpeedKph')
                    ->setLabel('Maksimalus greitis (km/h)')
                    ->setValue($this->getFieldValue('topSpeedKph'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('driveWheels')
                    ->setLabel('Varantys ratai')
                    ->setValue($this->getFieldValue('driveWheels'))
                    ->setOptions($driveWheelRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('bodyType')
                    ->setLabel('Kebulo tipas')
                    ->setValue($this->getFieldValue('bodyType'))
                    ->setOptions($bodyTypeRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('engine')
                    ->setLabel('Variklis')
                    ->setValue($this->getFieldValue('engine'))
                    ->setOptions($engineRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('model')
                    ->setLabel('Modelis')
                    ->setValue($this->getFieldValue('model'))
                    ->setOptions($modelRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('gearbox')
                    ->setLabel('Pavaru deze')
                    ->setValue($this->getFieldValue('gearbox'))
                    ->setOptions($gearboxRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            );

        if (!$this->isEdit()) {
            $this->addField(
                (new Field())
                    ->setType(BaseForm::FORM_TYPE)
                    ->setFormType($this->getLapFormType())
                    ->setName('lap')
                    ->setLabel('Apvaziavimo laikas')
                    ->setValue($this->getFieldValue('lap'))
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            );
        }

        return $this;
    }

    /**
     * @return BaseForm
     * @throws \ReflectionException
     */
    private function getLapFormType()
    {
        $trackRepository = new TrackRepository();

        return (new LapForm(new Lap(), $this->isEdit()))
            ->removeField('car')
            ->addField(
                (new Field())
                    ->setType(BaseForm::SELECT_TYPE)
                    ->setName('track')
                    ->setLabel('Trasa')
                    ->setValue($this->getFieldValue('track'))
                    ->setOptions($trackRepository->getOptionsList())
                    ->setIsForeignKey(true)
                    ->setIsRequired(true)
            );
    }
}
