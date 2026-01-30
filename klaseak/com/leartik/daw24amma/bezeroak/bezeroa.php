<?php

namespace com\leartik\daw24amma\bezeroak;
class Bezeroa
{
    private $id_bezeroa;
    private $izena;
    private $abizena;
	private $helbidea;
	private $herria;
	private $postakodea;
	private $probintzia;
	private $emaila;
	
    

    public function __construct()
    {
    }

    public function setId_bezeroa($id_bezeroa)
    {
        $this->id_bezeroa = $id_bezeroa;
    }
    public function getId_bezeroa()
    {
        return $this->id_bezeroa;
    }


    public function setIzena($izena)
    {
        $this->izena = $izena;
    }
    public function getIzena()
    {
        return $this->izena;
    }


    public function setAbizena($abizena)
    {
        $this->abizena = $abizena;
    }
    public function getAbizena()
    {
        return $this->abizena;
    }
	
	 public function setHelbidea($helbidea)
    {
        $this->helbidea = $helbidea;
    }
    public function getHelbidea()
    {
        return $this->helbidea;
    }
	
	public function getHerria() 
	{ 
		return $this->herria; 
	}
	public function setHerria($herria) 
	{ 
		$this->herria = $herria; 
	}
	
	public function setPostakodea($postakodea)
    {
        $this->postakodea = $postakodea;
    }
    public function getPostakodea()
    {
        return $this->postakodea;
    }
	
	 public function setProbintzia($probintzia)
    {
        $this->probintzia = $probintzia;
    }
    public function getProbintzia()
    {
        return $this->probintzia;
    }
	
	public function getEmaila() 
	{ 
		return $this->emaila; 
	}
	public function setEmaila($emaila) 
	{ 
		$this->emaila = $emaila; 
	}
	
	
}
?>
