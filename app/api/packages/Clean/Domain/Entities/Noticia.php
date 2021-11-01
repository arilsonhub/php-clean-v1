<?php

namespace Packages\Clean\Domain\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Illuminate\Support\Facades\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="noticias")
 */
class Noticia extends EntidadeBaseDoctrine {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var date $data
     *
     * @ORM\Column(name="data", type="date")
     */
    private $data;

    public function __construct()
    {
        parent::__construct('id');
    }

    public function obterValorDaChavePrimariaDaEntidade()
    {
        return $this->id;
    }

	public function setId($id){
		$this->id = $id;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getData(){
		return $this->data;
	}

	public function setData($data){
		$this->data = $data;
	}
}
