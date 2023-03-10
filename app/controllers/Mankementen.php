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
        $result = $this->mankementModel->getMankementen();


        // var_dump($result);

        $rows = "";

        foreach ($result as $mankementinfo) {
            $dateTimeObj =
                new DateTimeImmutable(
                    $mankementinfo->Datum,
                    new DateTimeZone('Europe/Amsterdam')
                );
            // var_dump($dateTimeObj);
            $rows .= "<tr>
                        <td>{$dateTimeObj->format('d-m-Y')}</td>
                        <td>{$mankementinfo->MANK}</td>

                      </tr>";
        }


        $data = [
            'title' => 'Overzicht mankementen',
            'rows' => $rows,
            'instructorName' => $result[0]->INNA,
            'instructorEmail' => $result[0]->INEM,
            'autoKenteken' => $result[0]->AUKE,
            'mankementenId' => $result[0]->MAID
        ];
        $this->view('mankementen/index', $data);
    }

    public function topicmankementen($id = NULL)
    {
        // Roep de modelmethod getTopics aan
        $result = $this->mankementModel->getTopics($id);

        if ($result) {
            $dt = new DateTimeImmutable($result[0]->Datum, new DateTimeZone('Europe/Amsterdam'));
            $date = $dt->format('d-m-Y');
            $time = $dt->format('H:i');
        } else {
            $date = "";
            $time = "";
        }

        $rows = "";

        foreach ($result as $topic) {

            $rows .= "<tr>
                        <td>{$topic->Mankement}</td>
                      </tr>";
        }


        $data = [
            'title' => 'Onderwerpen mankement',
            'rows' => $rows,
            'date' => $date,
            'time' => $time,
            'mankementenId' => $id
        ];
        $this->view('mankementen/index', $data);
    }

    public function addMankement()
    {
        $result = $this->mankementModel->getMankementen();


        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (strlen($_POST['mankement']) < 50) {
                $result = $this->mankementModel->addMankement($_POST);
                if ($result) {
                    echo "<h3>Het nieuwe mankement is toegevoegd</h3>";
                    header('Refresh:3; url=' . URLROOT . '/mankementen/index');
                } else {
                    echo "<h3>de data is niet opgeslagen</h3>";
                    header('Refresh:3; url=' . URLROOT . '/mankementen/index');
                }
            } else {
                echo "Het nieuwe mankement is meer dan 50 tekens lang en is niet toegevoegd, probeer het opnieuw";
                header('Refresh:3; url=' . URLROOT . '/mankementen/addMankement/' . $result[0]->MAID);
            }
        } else {

            $data = [
                'title' => 'Invoeren Mankement',
                'autoKenteken' => $result[0]->AUKE,
                'id' => $result[0]->MAID,
            ];

            $this->view('mankementen/addMankement', $data);
        }
    }
}
