<?php

namespace App\UseCases;

use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\Log;

class VeripagosUseCase
{

    private string $username;
    private string $password;
    private string $secretKey;



    private string $url = "https://veripagos.com/api/bcp";
    private array $headers;

    public function __construct()
    {
        // $settingRepository = new SettingRepository();
        // $setting = $settingRepository->getSetting();
        $this->username = env('VERIPAGOS_USER_NAME');
        $this->password = env('VERIPAGOS_PASSWORD');
        $this->secretKey = env('VERIPAGOS_SECRET_KEY');
        $this->headers = [
            'Content-Type: application/json'
        ];
    }

    public function generateQr(Float $amount, Array $extraInformation = [])
    {
        $data = [
            "secret_key" => $this->secretKey,
            "monto" => $amount,
            "data" => $extraInformation,
            "vigencia" => "1/00:00",
        ];
        return $this->sendRequest('POST', '/generar-qr', $data);
    }

    private function sendRequest(String $method, String $path, Array $data = [])
    {
        $curlInfo = [
            CURLOPT_URL => $this->url . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "$this->username:$this->password",

        ];

        switch ($method) {
            case 'POST':
                $curlInfo[CURLOPT_POSTFIELDS] = json_encode($data);
                break;

            default:
                break;
        }

        $curl = curl_init();
        curl_setopt_array($curl, $curlInfo);

        $response = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);
        Log::debug($response.'veripagos');
        $json = json_decode($response);
        return $this->handleResponse($json, $httpStatus, $err);
    }

    private function handleResponse($response, $httpStatus, $err)
    {
        if ($httpStatus !== 200) {
            return [
                'Status' => $httpStatus,
                'Message' => $err != '' ? $err : 'Ocurríó un error inesperado',
                'Data' => null,
            ];
        }

        if($response->Codigo === 1) {
            return [
                'Status' => 400,
                'Message' => $response->Mensaje,
                'Data' => null,
            ];
        }else{
            return [
                'Status' => 200,
                'Message' => $response->Mensaje,
                'Data' => $response->Data,
            ];
        }
    }

}
