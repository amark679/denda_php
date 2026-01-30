<?php

namespace com\leartik\daw24amma\produktuak;
class Produktua
{
    private $id;
    private $marka;
    private $modeloa;
    private $prezioa;
	private $nobedadeak;
	private $id_kategoria;
	private $irudia;
	private $deskontuak;
	
    public function __construct($id = null, $id_kategoria = null, $marka = null, $modeloa = null, $prezioa = null, $nobedadeak = null, $deskontuak = null)
    {
        $this->id = $id;
        $this->id_kategoria = $id_kategoria;
        $this->marka = $marka;
        $this->modeloa = $modeloa;
        $this->prezioa = $prezioa;
        $this->nobedadeak = $nobedadeak;
		$this->deskontuak = $deskontuak;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }


    public function setId_kategoria($id_kategoria)
    {
        $this->id_kategoria = $id_kategoria;
    }
    public function getId_kategoria()
    {
        return $this->id_kategoria;
    }


    public function setMarka($marka)
    {
        $this->marka = $marka;
    }
    public function getMarka()
    {
        return $this->marka;
    }


    public function setModeloa($modeloa)
    {
        $this->modeloa = $modeloa;
    }
    public function getModeloa()
    {
        return $this->modeloa;
    }
	
	
	public function setPrezioa($prezioa)
    {
        $this->prezioa = $prezioa;
    }
    public function getPrezioa()
    {
        return $this->prezioa;
    }
	
	public function setNobedadeak($nobedadeak)
    {
        $this->nobedadeak = $nobedadeak;
    }
    public function getNobedadeak()
    {
        return $this->nobedadeak;
    }
	public function setIrudia($irudia) {
    $this->irudia = $irudia;
	}

	public function getIrudia() {
		return $this->irudia;
	}
	public function setDeskontuak($deskontuak) {
        $this->deskontuak = $deskontuak;
    }

    public function getDeskontuak() {
        return $this->deskontuak;
    }
}
?>
