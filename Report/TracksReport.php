<?php
namespace Report;

use Form\ReportForm;
use Repository\TrackRepository;
use Utils\Template;

/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.3
 * Time: 21.08
 */

class TracksReport
{
    public function showResult()
    {
        $form = new ReportForm(null, false);
        $form->validate($_POST);
        $template = Template::getInstance();

        if ($form->isSubmitted() && $form->isValid()) {

            $trackRepository = new TrackRepository();
            $template->assign("reportData", $trackRepository->getReportData($form->getRawData()));
            $template->assign("data", $form->getRawData());
            $template->setView("report/tracks_report");
        } else {
            $template
                ->assign('form', $form)
                ->setView('form/entity_form');
        }
    }
}
