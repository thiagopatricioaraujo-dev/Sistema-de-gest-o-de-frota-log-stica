<?php

class Veiculo {

    private string $placa;
    private string $modelo;
    private float $capacidadeTanque;
    private float $combustivelAtual;

    private const CONSUMO_KM_POR_LITRO = 10.0;

    public function __construct(
        string $placa,
        string $modelo,
        float $capacidadeTanque,
        float $combustivelAtual
    ) {
        $this->setPlaca($placa);
        $this->setModelo($modelo);
        $this->setCapacidadeTanque($capacidadeTanque);
        $this->setCombustivelAtual($combustivelAtual);
    }

    public function getPlaca(): string {
        return $this->placa;
    }

    public function getModelo(): string {
        return $this->modelo;
    }

    public function getCapacidadeTanque(): float {
        return $this->capacidadeTanque;
    }

    public function getCombustivelAtual(): float {
        return $this->combustivelAtual;
    }

    public function setPlaca(string $placa): void {

        if (trim($placa) === '') {
            throw new InvalidArgumentException(
                "Placa do veículo não pode ser vazia."
            );
        }

        $this->placa = trim($placa);
    }

    public function setModelo(string $modelo): void {

        if (trim($modelo) === '') {
            throw new InvalidArgumentException(
                "Modelo do veículo não pode ser vazio."
            );
        }

        $this->modelo = trim($modelo);
    }

    public function setCapacidadeTanque(float $capacidadeTanque): void {

        if ($capacidadeTanque <= 0) {
            throw new InvalidArgumentException(
                "Capacidade do tanque não pode ser zero ou negativa."
            );
        }

        $this->capacidadeTanque = $capacidadeTanque;
    }

    public function setCombustivelAtual(float $combustivelAtual): void {

        if ($combustivelAtual < 0) {
            throw new InvalidArgumentException(
                "Combustível atual não pode ser negativo."
            );
        }

        if ($combustivelAtual > $this->capacidadeTanque) {
            throw new InvalidArgumentException(
                "Combustível atual não pode exceder a capacidade do tanque."
            );
        }

        $this->combustivelAtual = $combustivelAtual;
    }

    public function abastecer(float $litros): void {

        if ($litros <= 0) {
            echo "[AVISO] Quantidade inválida.\n";
            return;
        }

        $total = $this->combustivelAtual + $litros;

        if ($total > $this->capacidadeTanque) {

            $litrosAceitos =
                $this->capacidadeTanque - $this->combustivelAtual;

            echo "[AVISO] Só foi possível abastecer "
                . $litrosAceitos
                . "L.\n";

            $this->combustivelAtual = $this->capacidadeTanque;

        } else {

            $this->combustivelAtual = $total;

            echo "[OK] Veículo abastecido com "
                . $litros
                . "L.\n";
        }
    }

    public function viajar(float $distancia): float {

        if ($distancia <= 0) {
            echo "[ERRO] Distância inválida.\n";
            return 0;
        }

        $combustivelNecessario =
            $distancia / self::CONSUMO_KM_POR_LITRO;

        if ($combustivelNecessario > $this->combustivelAtual) {

            $distanciaPossivel =
                $this->combustivelAtual
                * self::CONSUMO_KM_POR_LITRO;

            echo "[AVISO] Combustível insuficiente.\n";
            echo "Veículo percorreu "
                . $distanciaPossivel
                . "km.\n";

            $this->combustivelAtual = 0;

            return $distanciaPossivel;
        }

        $this->combustivelAtual -= $combustivelNecessario;

        echo "[OK] Viagem realizada com sucesso.\n";

        return $distancia;
    }

    public function __toString(): string {

        return
            "========================\n" .
            "VEÍCULO\n" .
            "========================\n" .
            "Placa: {$this->placa}\n" .
            "Modelo: {$this->modelo}\n" .
            "Capacidade Tanque: {$this->capacidadeTanque}L\n" .
            "Combustível Atual: {$this->combustivelAtual}L\n";
    }
}

?>