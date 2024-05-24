<?php

class PartidoBasquetbol extends Partido {
    private $cantInfracciones;
    private $coefPenalizacion;

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2, $cantInfracciones) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
        $this->coefPenalizacion = 0.75;
    }

    public function setCantInfracciones($cantInfracciones) {
        $this->cantInfracciones = $cantInfracciones;
    }

    public function getCantInfracciones() {
        return $this->cantInfracciones;
    }

    public function getCoefPenalizacion() {
        return $this->coefPenalizacion;
    }

    public function calcularCoeficiente() {
        // Sobrescribe el método calcularCoeficiente() para partidos de básquetbol
        $coeficiente = parent::calcularCoeficiente();
        $coeficiente -= $this->getCoefPenalizacion() * $this->getCantInfracciones();
        return $coeficiente;
    }

    public function __toString() {
        $cadena = parent::__toString();
        $cadena .= "Cantidad de Infracciones: " . $this->getCantInfracciones() . "\n";
        $cadena .= "Coeficiente de Penalización: " . $this->calcularCoeficiente() . "\n";
        return $cadena;
    }
}
?>