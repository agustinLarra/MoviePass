<?php namespace Models;

class Genero {

    private $id;
    private $tipo;

    

    public function getTipo()
    {
        return $this->tipo;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setTipo($tipo)
    {
        $this->tipo=$tipo;
    }
    public function setId($id)
    {
        $this->id=$id;
    }


}

?>