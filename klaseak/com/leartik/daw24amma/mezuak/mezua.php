<?php

namespace com\leartik\daw24amma\mezuak;
class Mezua
{
    private $id;
    private $izena;
	private $email;
    private $mezua;
	private $erantzuna;
	
	
    public function __construct($id = null, $izena = null, $email = null, $mezua = null, $erantzuna = null)
    {
        $this->id = $id;
        $this->izena = $izena;
		$this->email = $email;
		$this->mezua = $mezua;
		$this->erantzuna = $erantzuna;
		
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }


    public function setIzena($izena)
    {
        $this->izena = $izena;
    }
    public function getIzena()
    {
        return $this->izena;
    }
	
	public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setMezua($mezua)
    {
        $this->mezua = $mezua;
    }
    public function getMezua()
    {
        return $this->mezua;
    }
	
	public function setErantzuna($erantzuna)
    {
        $this->erantzuna = $erantzuna;
    }
    public function getErantzuna()
    {
        return $this->erantzuna;
    }
}
?>
