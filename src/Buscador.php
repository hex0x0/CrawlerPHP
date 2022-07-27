<?php

namespace lucas\buscadorCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class buscador
{
    /**
     * @var ClientInterface 
     */

     private ClientInterface $httpClient;


     /**
      * @var Crawler
      */

      private Crawler $crawler;


      public function __construct(ClientInterface $httpClient, Crawler $crawler)
      {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
      }

      public function buscar(string $url, string $item):array
      {
        $resposta = $this->httpClient->request('GET', $url);

        $html = $resposta->getBody();

        $this->crawler->addHtmlContent($html);

        $elementoCursos = $this->crawler->filter($item);

        $cursos = [];

        foreach($elementoCursos as $elemento){
            $cursos[] = $elemento->textContent;
        }


        return $cursos;

      }

}