<?php

namespace com\leartik\daw24amma\eskariak;
use com\leartik\daw24amma\detaileak\Detailea;
use com\leartik\daw24amma\bezeroak\Bezeroa;

class Eskaria
{
    private $id;
    private $data;
    private $bezeroa;
    private $detaileak = [];

    public function __construct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }


    public function setData($data)
    {
        $this->data = $data;
    }
    public function getData()
    {
        return $this->data;
    }


    public function setBezeroa($bezeroa)
    {
        $this->bezeroa = $bezeroa;
    }
    public function getBezeroa()
    {
        return $this->bezeroa;
    }


    public function setDetaileak($detaileak)
    {
        $this->detaileak = $detaileak;
    }
    public function getDetaileak()
    {
        return $this->detaileak;
    }

}
?>