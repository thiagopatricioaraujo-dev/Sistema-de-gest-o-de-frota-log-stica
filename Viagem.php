<?php

require_once 'Motorista.php';
require_once 'Veiculo.php';

class Viagem {

    private string $destino;
    private float $distanciaTotal;
    private Motorista $motorista;
    private Veiculo $veiculo;
    private bool $viagemIniciada;
    private float $distanciaPercorrida;

    public function __construct(string $destino, float $distanciaTotal, Motorista $motorista, Veiculo $veiculo) {
        $this->setDestino($destino);
        $this->setDistanciaTotal($distanciaTotal);
        $this->setMotorista($motorista);
        $this->setVeiculo($veiculo);
        $this->viagemIniciada = false;
        $this->distanciaPercorrida = 0;
    }

    public function getDestino(): string {
        return $this->destino;
    }

    public function getDistanciaTotal(): float {
        return $this->distanciaTotal;
    }

    public function getMotorista(): Motorista {
        return $this->motorista;
    }

    public function getVeiculo(): Veiculo {
        return $this->veiculo;
    }

    public function isViagemIniciada(): bool {
        return $this->viagemIniciada;
    }

    public function getDistanciaPercorrida(): float {
        return $this->distanciaPercorrida;
    }

    public function setDestino(string $destino): void {
        if (trim($destino) === '') {
            throw new InvalidArgumentException("Destino da viagem não pode ser vazio.");
        }
        $this->destino = trim($destino);
    }

    public function setDistanciaTotal(float $distanciaTotal): void {
        if ($distanciaTotal <= 0) {
            throw new InvalidArgumentException("Distância total da viagem deve ser positiva.");
        }
        $this->distanciaTotal = $distanciaTotal;
    }

    public function setMotorista(Motorista $motorista): void {
        $this->motorista = $motorista;
    }

    public function setVeiculo(Veiculo $veiculo): void {
        $this->veiculo = $veiculo;
    }

    public function iniciarViagem(): void {
        echo "\n--- Tentando iniciar viagem para: {$this->destino} ---\n";

        if (!$this->motorista->cnhValida()) {
            $nome = $this->motorista->getNome();
            $validade = $this->motorista->getValidadeCnh();
            echo "[ERRO] Viagem não pode ser iniciada. A CNH do motorista '{$nome}' está vencida (validade: {$validade}).\n";
            return;
        }

        if ($this->veiculo->getCombustivelAtual() <= 0) {
            echo "[ERRO] Veículo sem combustível. Abasteça antes de iniciar a viagem.\n";
            return;
        }

        echo "[OK] Motorista e veículo aptos. Iniciando viagem...\n";
        $this->viagemIniciada = true;
        $this->distanciaPercorrida = $this->veiculo->viajar($this->distanciaTotal);
    }

    public function gerarRelatorio(): void {
        $status = $this->viagemIniciada ? 'Iniciada' : 'Não iniciada';
        $combustivel = number_format($this->veiculo->getCombustivelAtual(), 2);

        echo "\n========== RELATÓRIO DE VIAGEM ==========\n";
        echo "Destino          : {$this->destino}\n";
        echo "Distância total  : {$this->distanciaTotal} km\n";
        echo "Distância percorrida: {$this->distanciaPercorrida} km\n";
        echo "Status           : {$status}\n";
        echo "-----------------------------------------\n";
        echo "Motorista        : {$this->motorista->getNome()}\n";
        echo "CPF              : {$this->motorista->getCpf()}\n";
        echo "CNH              : {$this->motorista->getCnh()} (validade: {$this->motorista->getValidadeCnh()})\n";
        echo "-----------------------------------------\n";
        echo "Veículo          : {$this->veiculo->getModelo()}\n";
        echo "Placa            : {$this->veiculo->getPlaca()}\n";
        echo "Combustível atual: {$combustivel}L\n";
        echo "=========================================\n\n";
    }
}
?>