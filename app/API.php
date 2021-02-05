<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http;

class API extends Model
{
    /**
     * Obtener un array con la informacion necesaria del prestador de servicios de salud especificado con el RUT
     *
     * @param string $rut
     * @return array $data 
     */
    public function get_api_data($rut){
        // 1. Se definen las variables necesarias para realizar la consulta a la API
        $api_url = env('API_URL');
        $auth_key = env('AUTH_KEY');
        // 2. Se utiliza el modelo Http para realizar las consultas a la API
        $http = new Http();
        // 3. Se codifica la respuesta en un array 
        $response = $http->get_response($rut, $api_url, $auth_key);
        $data = $http->json_to_array($response);
        // 4. Se retorna la data codificada 
        return $data;
    }
}
