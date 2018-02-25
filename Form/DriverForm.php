<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.25
 * Time: 11.51
 */

namespace Form;


use Repository\GenderRepository;
use Repository\TeamRepository;

class DriverForm extends BaseForm
{

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function buildForm()
    {
        $teamRepository = new TeamRepository();
        $genderRepository = new GenderRepository();
        return $this
            ->setName('Vairuotojas')
            ->addField(
                (new Field())
                    ->setType(Field::TEXT_TYPE)
                    ->setMaxLength(100)
                    ->setName('firstName')
                    ->setLabel('Vardas')
                    ->setValue($this->getFieldValue('firstName'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(Field::TEXT_TYPE)
                    ->setMaxLength(100)
                    ->setName('lastName')
                    ->setLabel('Pavarde')
                    ->setValue($this->getFieldValue('lastName'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(Field::TEXT_TYPE)
                    ->setMaxLength(3)
                    ->setName('age')
                    ->setLabel('Amzius')
                    ->setValue($this->getFieldValue('age'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(Field::TEXT_TYPE)
                    ->setMaxLength(3)
                    ->setName('drivingExperienceYears')
                    ->setLabel('Vairavimo stazas (m)')
                    ->setValue($this->getFieldValue('drivingExperienceYears'))
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(Field::SELECT_TYPE)
                    ->setName('team')
                    ->setLabel('Komanda')
                    ->setValue($this->getFieldValue('team'))
                    ->setOptions(
                        $teamRepository->executeRawSql('SELECT id, name FROM ' . $teamRepository->getTableName(), [])
                    )->setIsForeignKey(true)
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(Field::RADIO_TYPE)
                    ->setName('gender')
                    ->setLabel('Lytis')
                    ->setValue($this->getFieldValue('gender'))
                    ->setOptions(
                        $genderRepository->executeRawSql('SELECT id, name FROM ' . $genderRepository->getTableName(), [])
                    )->setIsRequired(true)
            );
    }
}