<?php

require_once 'Motorista.php';
require_once 'Veiculo.php';
require_once 'Viagem.php';

echo nl2br("=== SISTEMA DE GESTÃO DE FROTA LOGÍSTICA ===\n\n");


echo nl2br(">> Criando motoristas...\n");

$motorista1 = new Motorista(
    "Carlos Souza",
    "111.222.333-44",
    "CNH-001",
    2026
);

$motorista2 = new Motorista(
    "Ana Lima",
    "555.666.777-88",
    "CNH-002",
    2021
);

echo nl2br($motorista1 . "\n");
echo nl2br($motorista2 . "\n");

echo nl2br("\n>> Criando veículos...\n");

$veiculo1 = new Veiculo(
    "ABC-1234",
    "Fiat Ducato",
    80.0,
    20.0
);

$veiculo2 = new Veiculo(
    "XYZ-9876",
    "Mercedes Sprinter",
    100.0,
    50.0
);

echo nl2br($veiculo1 . "\n");
echo nl2br($veiculo2 . "\n");

echo nl2br(
    "\n>> Tentativa com motorista de CNH vencida (Ana Lima - validade 2021):\n"
);

$viagemInvalida = new Viagem(
    "São Paulo",
    300.0,
    $motorista2,
    $veiculo2
);

$viagemInvalida->iniciarViagem();

echo nl2br("\n>> Criando viagem válida com Carlos Souza...\n");

$viagemValida = new Viagem(
    "Rio de Janeiro",
    450.0,
    $motorista1,
    $veiculo1
);

echo nl2br("\n>> Abastecendo o veículo 1 antes da viagem...\n");

$veiculo1->abastecer(60.0);

echo nl2br("\n>> Tentativa de abastecer além da capacidade:\n");

$veiculo1->abastecer(10.0);


$viagemValida->iniciarViagem();

$viagemValida->gerarRelatorio();

echo nl2br(">> STATUS FINAL DO COMBUSTÍVEL:\n");

echo nl2br(
    "   "
    . $veiculo1->getModelo()
    . " ("
    . $veiculo1->getPlaca()
    . "): "
    . number_format($veiculo1->getCombustivelAtual(), 2)
    . "L restantes.\n"
);

echo nl2br(
    "   "
    . $veiculo2->getModelo()
    . " ("
    . $veiculo2->getPlaca()
    . "): "
    . number_format($veiculo2->getCombustivelAtual(), 2)
    . "L restantes.\n"
);

echo nl2br("\n>> Testando validação: combustível negativo:\n");

try {

    $veiculo2->setCombustivelAtual(-10.0);

} catch (InvalidArgumentException $e) {

    echo nl2br(
        "[VALIDAÇÃO OK] "
        . $e->getMessage()
        . "\n"
    );
}

echo nl2br("\n=== FIM DO SISTEMA ===\n");

?>