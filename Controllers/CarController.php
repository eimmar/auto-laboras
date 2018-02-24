<?php
namespace Controllers;

use Model\Car;
use Model\ModelRepository;
use Repository\CarRepository;
use Utils\Template;

class CarController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this
            ->setDefaultAction('list')
            ->setRequired(
                [
                    'modelis',
                    'valstybinis_nr',
                    'pagaminimo_data',
                    'pavaru_deze',
                    'degalu_tipas',
                    'kebulas',
                    'bagazo_dydis',
                    'busena',
                    'rida',
                    'vietu_skaicius',
                    'registravimo_data',
                    'verte'
                ]
            )
            ->setMaxLengths(['valstybinis_nr' => 6])
            ->setValidations(
                [
                    'modelis' => 'positivenumber',
                    'valstybinis_nr' => 'alfanum',
                    'pavaru_deze' => 'positivenumber',
                    'degalu_tipas' => 'positivenumber',
                    'kebulas' => 'positivenumber',
                    'bagazo_dydis' => 'positivenumber',
                    'busena' => 'positivenumber',
                    'pagaminimo_data' => 'date',
                    'rida' => 'positivenumber',
                    'vietu_skaicius' => 'positivenumber',
                    'registravimo_data' => 'date',
                    'verte' => 'price'
                ]
            );
    }

    protected function showForm()
    {
        parent::showForm();

        $template = Template::getInstance();

        $brandsModels = ModelRepository::getBrandsAndModels();
        $gearboxes = CarRepository::getGearboxList();
        $fueltypes = CarRepository::getFuelTypeList();
        $bodytypes = CarRepository::getBodyTypeList();
        $luggage = CarRepository::getLuggageTypeList();
        $car_states = CarRepository::getCarStateList();

        $template->assign('brandsModels', $brandsModels);
        $template->assign('gearboxes', $gearboxes);
        $template->assign('fueltypes', $fueltypes);
        $template->assign('bodytypes', $bodytypes);
        $template->assign('luggage', $luggage);
        $template->assign('car_states', $car_states);
    }

    /**
     * @return array|bool
     */
    protected function validateInput()
    {
        $data = parent::validateInput();

        // Fix checkbox values
        $data['radijas'] = (!empty($data['radijas']) && $data['radijas'] == 'on') ? 1 : 0;
        $data['grotuvas'] = (!empty($data['grotuvas']) && $data['grotuvas'] == 'on') ? 1 : 0;
        $data['kondicionierius'] =  (!empty($data['kondicionierius']) && $data['kondicionierius'] == 'on') ? 1 : 0;

        return $data;
    }
};

