<?php

class Torneo {
    private $coleccionPartidos;
    private $importePremio;

    public function __construct($importePremio) {
        $this->setColeccionPartidos([]);
        $this->setImportePremio($importePremio);
    }

    public function getColeccionPartidos() {
        return $this->coleccionPartidos;
    }

    public function setColeccionPartidos($coleccionPartidos) {
        $this->coleccionPartidos = $coleccionPartidos;
    }

    public function getImportePremio() {
        return $this->importePremio;
    }

    public function setImportePremio($importePremio) {
        $this->importePremio = $importePremio;
    }

    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipoPartido) {
        $resultado = -1; // Inicialmente -1 para representar error por categoría o cantidad de jugadores

        if ($objEquipo1->getObjCategoria()->getidcategoria() == $objEquipo2->getObjCategoria()->getidcategoria() &&
            $objEquipo1->getCantJugadores() == $objEquipo2->getCantJugadores()) {
            $partido = null;

            if ($tipoPartido == 'Futbol') {
                $partido = new PartidoFutbol(count($this->getColeccionPartidos()) + 1, $fecha, $objEquipo1, 0, $objEquipo2, 0);
            } elseif ($tipoPartido == 'basquetbol') {
                $partido = new PartidoBasquetbol(count($this->getColeccionPartidos()) + 1, $fecha, $objEquipo1, 0, $objEquipo2, 0,0);
            }

            if ($partido !== null) {
                $this->coleccionPartidos[] = $partido; // Almacenar en la colección de partidos
                $resultado = $partido; // Retornar la instancia del partido
            } else {
                $resultado = 0; // Retornar 0 si no se pudo crear el partido
            }
        }
        return $resultado;
    }

    public function darGanadores($deporte) {
        $ganadores = [];
        foreach ($this->getColeccionPartidos() as $partido) {
            if (($deporte == 'Futbol' && $partido instanceof PartidoFutbol) || 
                ($deporte == 'Basquetbol' && $partido instanceof PartidoBasquetbol)) {
                $ganadores[] = $partido->darEquipoGanador();
            }
        }
        return $ganadores;
    }

    public function calcularPremioPartido($OBJPartido) {
        $equipoGanador = $OBJPartido->darEquipoGanador();
        $coeficiente = $OBJPartido->calcularCoeficiente();
        $premioPartido = $coeficiente * $this->getImportePremio();

        return [
            'equipoGanador' => $equipoGanador,
            'premioPartido' => $premioPartido
        ];
    }

    public function __toString() {
        $cadena = "\n Importe Premio: " . $this->getImportePremio() . "\n";
        $cadena .= "Cantidad de Partidos: " . count($this->getColeccionPartidos()) . "\n";
        $cadena .= "--------------------------------------------------------\n";
        foreach ($this->getColeccionPartidos() as $partido) {
            $cadena .= $partido . "\n";
        }
        return $cadena;
    }
}
?>