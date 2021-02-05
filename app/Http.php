<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Http extends Model
{   

    /**
     * Consumir datos de una API establecida (https://apis.superdesalud.gob.cl/api/prestadores/rut/12950968.json/?apikey=YOUR_AUTH_KEY/;) la respuesta obtenida sera en formato JSON
     *
     * @param string $rut
     * @param string $api_url
     * @param string $auth_key
     * @return JSON $response 
     */
    public function get_response($rut, $api_url, $auth_key) {
        // 1. Se prepara la url completa para consultar los datos de la API externa
        $service_url = "{$api_url}/{$rut}.json/?apikey={$auth_key}";
        // 2. Se instancia la cURL para ejecutar la solicitud a la API
        $curl = curl_init($service_url); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // 3. Se ejecuta la cURL y se almacena el resultado, la salida en este caso es en formato JSON
        $response = curl_exec($curl);
        // 4. Se retorna la respuesta obtenida
        return $response;
    }

// Metodo en PHP
    /*<?php
    $service_url = https://apis.superdesalud.gob.cl/api/prestadores/rut/12950968.json/?apikey=YOUR_AUTH_KEY/;
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        die('error occured during curl exec. Additional info: ' . var_export($info));
    }
    curl_close($curl);
    $decoded = json_decode($curl_response);
    if (isset($decoded->status) && $decoded->status != 200) {
        echo var_export($decoded);
        die('error occured: ' . $decoded->error->description);
    }
    echo $curl_response . PHP_EOL
    ?>*/



    /**
     * Decodificar un objeto JSON en un arreglo manipulable en PHP
     *
     * @param JSON $response
     * @return array $data 
     */
    public function json_to_array($response) {
        // 1. El objeto $response se tranforma en array con el metodo json_decode()
        $decode = json_decode($response, true);
        // 2. La data se codifica en un array manipulable por PHP
        $data = [

            "titulo" => $decode['antecedentes'][0]['cod_antecedente'],
            "nacimiento" => $decode['fecha_nacimiento'],
            "institucion" => $decode['antecedentes'][0]['procedencia'],
            "egreso" => $decode['antecedentes'][0]['fecha_antecedente'],

        ];
        // 2. Se retorna la data transformada en array
        return $data;
    }

   
}

