<?php
class PartidoFutbol extends Partido {
    private $coefMenores;
    private $coefJuveniles;
    private $coefMayores;

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->coefMenores = 0.13;
        $this->coefJuveniles = 0.19;
        $this->coefMayores = 0.27;
    }


    public function getCoefMenores() {
        return $this->coefMenores;
    }

    public function getCoefJuveniles() {
        return $this->coefJuveniles;
    }

    public function getCoefMayores() {
        return $this->coefMayores;
    }

    public function calcularCoeficiente() {
        // Sobrescribe el método calcularCoeficiente() para partidos de fútbol
        $coeficiente = parent::calcularCoeficiente();
        switch ($this->getObjEquipo1()->getObjCategoria()->getDescripcion()) {
            case 'Menores':
                $coeficiente *= $this->getCoefMenores();
                break;
            case 'Juveniles':
                $coeficiente *= $this->getCoefJuveniles();
                break;
            case 'Mayores':
                $coeficiente *= $this->getCoefMayores();
                break;
        }
        return $coeficiente;
    }

    public function __toString() {
        $cadena = parent::__toString();
        $cadena .= "Categoría: " . $this->getObjEquipo1()->getObjCategoria()->getDescripcion() . "\n";
        $cadena .= "Coeficientes: Menores=" . $this->getCoefMenores() . ", Juveniles=" . $this->getCoefJuveniles() . ", Mayores=" . $this->getCoefMayores() . "\n";
        return $cadena;
    }
}
?>