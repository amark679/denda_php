<?php

namespace com\leartik\daw24amma\kategoriak;
class Kategoria
{
    private $kategoria_id;
    private $izena;
    private $deskribapena;
	private $produktuak = [];
	private $img;
    

    public function __construct()
    {
    }

    public function setKategoria_id($kategoria_id)
    {
        $this->kategoria_id = $kategoria_id;
    }
    public function getKategoria_id()
    {
        return $this->kategoria_id;
    }


    public function setIzena($izena)
    {
        $this->izena = $izena;
    }
    public function getIzena()
    {
        return $this->izena;
    }


    public function setDeskribapena($deskribapena)
    {
        $this->deskribapena = $deskribapena;
    }
    public function getDeskribapena()
    {
        return $this->deskribapena;
    }
	
	 public function setProduktuak($produktuak)
    {
        $this->produktuak = $produktuak;
    }
    public function getProduktuak()
    {
        return $this->produktuak;
    }
	
	public function getImg() 
	{ 
		return $this->img; 
	}
	public function setImg($img) 
	{ 
		$this->img = $img; 
	}
	
	
	
}
?>
