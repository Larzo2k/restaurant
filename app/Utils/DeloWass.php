<?php

namespace App\Utils;


class DeloWass
{
    private static $dominio = "https://whatsapp.desarrollamelo.com/api/";
    private static $instancia = "65FC85E7DD024";
    private static $accessToken = "64711d2458bd9";


    //eviar texto
    public static function enviarTexto($number, $message)
    {
        $params = array(
            'access_token' => self::$accessToken,
            'instance_id' => self::$instancia,
            'number' => self::borrandoCaracteresEspeciales($number),
            'type' => 'text',
            'message' => $message,
        );

        $response = self::curlWaziper('send', $params);
        return $response;
    }

    public static function enviarTextoMasivo($recipents, $message)
    {
        $params = array(
            'access_token' => self::$accessToken,
            'instance_id' => self::$instancia,
            'recipients' => self::borrandoCaracteresEspeciales($recipents),
            'type' => 'text',
            'message' => $message,
        );

        $response = self::curlWaziper('send-bulk-messages', $params);
        return $response;
    }

    public static function enviarTextoMasivoAsyncrono($recipents, $message, $min_delay = 0, $max_delay = 0, $fecha_hora_de_envio = null)
    {
        $params = array(
            'access_token' => self::$accessToken,
            'instance_id' => self::$instancia,
            'recipients' => self::borrandoCaracteresEspeciales($recipents),
            'type' => 'text',
            'message' => $message,
            'min_delay' => $min_delay,
            'max_delay' => $max_delay,
            'fecha_hora_de_envio' => $fecha_hora_de_envio,
        );

        $response = self::curlWaziper('send-bulk-messages-async', $params);
        return $response;
    }

    public static function enviarArchivoMasivoAsyncrono($recipents, $message, $mediaUrl, $filename="", $min_delay = 0, $max_delay = 0, $fecha_hora_de_envio = null)
    {
        $params = array(
            'access_token' => self::$accessToken,
            'instance_id' => self::$instancia,
            'recipients' => self::borrandoCaracteresEspeciales($recipents),
            'type' => 'media',
            'message' => $message,
            'file' => $mediaUrl,
            'filename' => $filename,
            'min_delay' => $min_delay,
            'max_delay' => $max_delay,
            'fecha_hora_de_envio' => $fecha_hora_de_envio,
        );

        $response = self::curlWaziper('send-bulk-messages-async', $params);
        return $response;
    }

    public static function enviarArchivoEnMasivo($recipents, $message, $mediaUrl, $filename="")
    {
        $params = array(
            'access_token' => self::$accessToken,
            'instance_id' => self::$instancia,
            'recipients' => self::borrandoCaracteresEspeciales($recipents),
            'type' => 'media',
            'message' => $message,
            "media_url" => $mediaUrl,
            "filename" => $filename,
        );

        $response = self::curlWaziper('send-bulk-messages', $params);
        return $response;
    }


    public static function enviarArchivo($number, $message, $mediaUrl, $filename = '')
    {
        $params = array(
            'access_token' => self::$accessToken,
            'instance_id' => self::$instancia,
            'number' => self::borrandoCaracteresEspeciales($number),
            'type' => 'media',
            'message' => $message,
            'media_url' => $mediaUrl,
            'filename' => $filename, //Debe ser usado para enviar documentos
        );

        $response = self::curlWaziper('send', $params);
        return $response;
    }

    public static function curlWaziper($codigoUrl, $data)
    {
        $curl = curl_init();

        $queryString = http_build_query($data);
        $url = self::$dominio . $codigoUrl . '?' . $queryString;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if($httpStatus != 200)
            return false;

        $status = isset($response['status']) ? $response['status'] : "error";
        if($status != 'success')
            return false;

        return true;
    }
    private static function borrandoCaracteresEspeciales(String $whatsapp)
    {
        return str_replace(['+', ' ', '(', ')', '-'], '', $whatsapp);
    }
}