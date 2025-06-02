<?php
namespace App\Services;

use App\UseCases\VeripagosUseCase;

class VeripagosService
{
    protected VeripagosUseCase $veripagosUseCase;

    public function __construct(VeripagosUseCase $veripagosUseCase)
    {
        $this->veripagosUseCase = $veripagosUseCase;
    }

    public function generateQr(Float $amount, Array $extraInformation = [])
    {
        $response = $this->veripagosUseCase->generateQr($amount, $extraInformation);
        if($response['Status'] !== 200) {
            throw new \Exception($response['Message'], $response['Status']);
        }

        return $response['Data'];
    }
}
