<?php 
namespace App\Awesome;

class Economia{
    const BASE_URL = 'https://economia.awesomeapi.com.br/json';

    /**
     * @param string $moedaA
     * @param string $moedaB
     * @return array
     * 
     */

     public function consultarCotacao($moedaA, $moedaB){
         return $this->get('/last/'.$moedaA.'-'.$moedaB);
     }

        /**
         * @param string $resouce
         * @return array
         */

     public function get($resource){
         //ENDPOINT
         $endpoint = self::BASE_URL.$resource;
         
         //INICIA CURL
         $curl = curl_init();

         //CONFIGURAÇÃO DO CURL
         curl_setopt_array($curl, [
             CURLOPT_URL => $endpoint,
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_CUSTOMREQUEST => 'GET'
         ]);

         $response = curl_exec($curl);  
         curl_close($curl);

         return json_decode($response, true);
     }




}