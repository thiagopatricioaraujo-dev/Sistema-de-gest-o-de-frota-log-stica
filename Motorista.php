<?php

class Motorista {

    private string $nome;
    private string $cpf;
    private string $cnh;
    private int $validadeCnh;

    public function __construct(
        string $nome,
        string $cpf,
        string $cnh,
        int $validadeCnh
    ) {
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setCnh($cnh);
        $this->setValidadeCnh($validadeCnh);
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getCpf(): string {
        return $this->cpf;
    }

    public function getCnh(): string {
        return $this->cnh;
    }

    public function getValidadeCnh(): int {
        return $this->validadeCnh;
    }

    public function setNome(string $nome): void {
        if (trim($nome) === '') {
            throw new InvalidArgumentException(
                "Nome do motorista não pode ser vazio."
            );
        }

        $this->nome = trim($nome);
    }

    public function setCpf(string $cpf): void {
        if (trim($cpf) === '') {
            throw new InvalidArgumentException(
                "CPF do motorista não pode ser vazio."
            );
        }

        $this->cpf = trim($cpf);
    }

    public function setCnh(string $cnh): void {
        if (trim($cnh) === '') {
            throw new InvalidArgumentException(
                "CNH do motorista não pode ser vazia."
            );
        }

        $this->cnh = trim($cnh);
    }

    public function setValidadeCnh(int $validadeCnh): void {
        if ($validadeCnh <= 0) {
            throw new InvalidArgumentException(
                "Ano de validade da CNH inválido."
            );
        }

        $this->validadeCnh = $validadeCnh;
    }

    public function cnhValida(): bool {
        return $this->validadeCnh >= 2024;
    }

    public function __toString(): string {

        return
            "========================\n" .
            "MOTORISTA\n" .
            "========================\n" .
            "Nome: {$this->nome}\n" .
            "CPF: {$this->cpf}\n" .
            "CNH: {$this->cnh}\n" .
            "Validade CNH: {$this->validadeCnh}\n";
    }
}

?>