<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Exemplo+Web+Service+Consulta+SQL
 **/

namespace App\WebService;

use App\Connection\WebService;

class ConsultaSQL
{
    private $sentence;
    private $affiliate;
    private $system;
    private $parameters;
    private $connection;

    public function __construct(WebService $ws)
    {
        $this->connection = $ws->getClient('/wsConsultaSQL/MEX?wsdl');
    }

    /**
     * @param string $sentence
     * @return void
     */

    public function setSentence(string $sentence): void
    {
        $this->sentence = $sentence;
    }

    /**
     * @param int $affiliate
     * @return void
     */

    public function setAffiliate(int $affiliate): void
    {
        $this->affiliate = $affiliate;
    }

    /**
     * @param string $system
     * @return void
     */

    public function setSystem(string $system): void
    {
        $this->system = $system;
    }

    /**
     * @param array $params
     * @return void
     */

    public function setParameters(array $params = []): void
    {
        $array = [];

        if ($params):
            foreach ($params as $key => $value):
                $array[] = "{$key}={$value}";
            endforeach;
        endif;

        $this->parameters = join(';', $array);
    }

    /**
     * @return array
     */

    public function execute(): array
    {
        try {

            $execute = $this->connection->RealizarConsultaSQL([
                'codSentenca' => $this->sentence,
                'codColigada' => $this->affiliate,
                'codSistema' => $this->system,
                'parameters' => $this->parameters,
            ]);

            $result = json_decode(json_encode(simplexml_load_string($execute->RealizarConsultaSQLResult)), true);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return ['response' => (isset($result['Resultado']) ? $result['Resultado'] : false)];
    }
}
