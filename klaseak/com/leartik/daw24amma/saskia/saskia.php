<?php

namespace com\leartik\daw24amma\saskia;

class Saskia
{

    private $detaileak;

    public function __construct()
    {
  
        $this->detaileak = [];
    }

    public function setDetaileak($detaileak)
    {
        $this->detaileak = $detaileak;
    }

    public function getDetaileak()
    {
        return $this->detaileak;
    }


    public function detaileaGehitu($detailea)
    {
        $this->detaileak[] = $detailea;
    }


    public function detaileaAldatu($detaileaNuevo)
    {
        foreach ($this->detaileak as $index => $detaileaActual) {
    
            if ($detaileaActual == $detaileaNuevo) { 
                $this->detaileak[$index] = $detaileaNuevo;
                break;
            }
        }
    }


    public function detaileaEzabatu($detaileaAEliminar)
    {
        foreach ($this->detaileak as $index => $detaileaActual) {
            if ($detaileaActual == $detaileaAEliminar) {
                unset($this->detaileak[$index]);

                $this->detaileak = array_values($this->detaileak); 
                break;
            }
        }
    }


    public function getDetaileKopurua()
    {
        return count($this->detaileak);
    }
}
?>