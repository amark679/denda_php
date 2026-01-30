<?php

namespace com\leartik\daw24amma\saskia;


use com\leartik\daw24amma\produktuak\Produktua;

class Detailea
{
    private $produktua; 
    private $kopurua;  

    // Constructor
    public function __construct($produktua = null, $kopurua = null)
    {
        $this->produktua = $produktua;
        $this->kopurua = $kopurua;
    }

    // Getters y Setters para Produktua
    public function setProduktua($produktua)
    {
        $this->produktua = $produktua;
    }

    public function getProduktua()
    {
        return $this->produktua;
    }


    public function setKopurua($kopurua)
    {
        $this->kopurua = $kopurua;
    }

    public function getKopurua()
    {
        return $this->kopurua;
    }


    public function getGuztira()
    {
        if ($this->produktua != null) {
            $prezioa = $this->produktua->getPrezioa();
            $desk = $this->produktua->getDeskontuak(); // Asumimos que es decimal (ej: 0.10)
            
            // Si hay descuento, aplicamos la fórmula
            if ($desk > 0) {
                $prezioFinal = $prezioa * (1 - $desk);
            } else {
                $prezioFinal = $prezioa;
            }

            // Devolvemos Precio Final * Cantidad
            return $prezioFinal * $this->kopurua;
        }
        return 0.0;
    }
}
?>