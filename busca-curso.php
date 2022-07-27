<?php

require 'vendor/autoload.php';
require 'src/buscador.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


use Lucas\buscadorCursos\buscador;


$client = new Client(['base_uri' => 'https://alura.com.br/', 'verify' => false]);

$crawler = new Crawler();

$buscador = new buscador($client, $crawler);

$cursos = $buscador->buscar('/formacoes/', 'h4.formacao__title');


foreach($cursos as $curso){
    echo $curso . PHP_EOL;
}