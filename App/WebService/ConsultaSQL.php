<?php

/**
 * @link https://tdn.totvs.com/display/public/LRM/TBC+-+Exemplo+Web+Service+Consulta+SQL
 **/

namespace App\WebService;

use App\Interface\AdapterInterface;

class ConsultaSQL
{
    private string $sentence;
    private int $affiliate;
    private string $system;
    private array $parameters;

    public function __construct(private AdapterInterface $adapterInterface)
    {
        $this->adapterInterface = $adapterInterface->getAdapter('/wsConsultaSQL/MEX?wsdl');
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

        foreach ($params as $key => $value) :
            $array[] = "{$key}={$value}";
        endforeach;

        $this->parameters = join(';', $array);
    }

    /**
     * @return array
     */
    public function execute(): array
    {
        try {

            $execute = $this->adapterInterface->RealizarConsultaSQL([
                'codSentenca' => $this->sentence,
                'codColigada' => $this->affiliate,
                'codSistema' => $this->system,
                'parameters' => $this->parameters,
            ]);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $execute->RealizarConsultaSQLResult;
    }
}
