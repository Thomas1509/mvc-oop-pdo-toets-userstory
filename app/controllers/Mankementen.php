<?php

class Mankementen extends Controller
{
    private $mankementModel;

    public function __construct()
    {
        // We maken een object van de model class en stoppen dit in $mankementModel
        $this->mankementModel = $this->model('mankement');
    }

    public function index()
    {
        $result = $this->mankementModel->getmankementen();

        // var_dump($result);

        $rows = "";

        foreach ($result as $mankementinfo) {
            $dateTimeObj = 
                new DateTimeImmutable($mankementinfo->DatumTijd, 
                                      new DateTimeZone('Europe/Amsterdam'));
            // var_dump($dateTimeObj);
            $rows .= "<tr>
                        <td>{$dateTimeObj->format('d-m-Y')}</td>
                        <td>{$dateTimeObj->format('H:i')}</td>
                        <td>{$mankementinfo->LENA}</td>
                        <td></td>
                        <td>
                            <a href='" . URLROOT . "/mankementen/topicmankementen/{$mankementinfo->LEID}'>
                                <img src='" . URLROOT . "/img/b_sbrowse.png' alt='table picture'>
                            </a>
                        </td>
                      </tr>";
        }


        $data = [
            'title' => 'Overzicht mankementen',
            'rows' => $rows,
            'instructorName' => $result[0]->INNA
        ];
        $this->view('mankementen/index', $data);
    }

    public function topicmankementen($id = NULL)
    {
        // Roep de modelmethod getTopics aan
        $result = $this->mankementModel->getTopics($id);

        if ($result) {
            $dt = new DateTimeImmutable($result[0]->DatumTijd, new DateTimeZone('Europe/Amsterdam'));
            $date = $dt->format('d-m-Y');
            $time = $dt->format('H:i');            
        } else {
            $date = "";
            $time = "";
        }

        $rows = "";

        foreach ($result as $topic) {

            $rows .= "<tr>
                        <td>{$topic->Onderwerp}</td>
                      </tr>";
        }


        $data = [
            'title' => 'Onderwerpen mankement',
            'rows' => $rows,
            'date' => $date,
            'time' => $time,
            'mankementenId' => $id
        ];
        $this->view('mankementen/topicmankementen', $data);
    }

    public function addTopic($id = NULL) 
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $result = $this->mankementModel->addTopic($_POST);

            if($result) {
                echo "<h3>de data is opgeslagen</h3>";
                header('Refresh:3; url=' . URLROOT . '/mankementen/index');
            } else {
                echo "<h3>de data is niet opgeslagen</h3>";
                header('Refresh:3; url=' . URLROOT . '/mankementen/index');
            }
        } else {

            $data = [
                'title' => 'Onderwerp Toevoegen',
                'id' =>$id
            ];
    
            $this->view('mankementen/addTopic', $data);
        }

    }
}
