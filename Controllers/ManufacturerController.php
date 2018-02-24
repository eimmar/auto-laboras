<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 21.04
 */

namespace Controllers;


class ManufacturerController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->setRequired(
        [
            'name',
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
}