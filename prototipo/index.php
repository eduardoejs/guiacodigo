<?php

class Usuario {
    public $id;
    public $nome;
    public $email;
    public $senha;

}

class Bolao {
    public $id;
    public $usuario_id;
    public $titulo;
    public $rodadaAtual = 0; //incrementa a cada rodada
    public $pontosResultado = 10; 
    public $pontosExtras = 5;
    public $pontosTaxa = 5;
}

class Rodada {
    public $id;
    public $bolao_id;
    public $titulo;
    public $dataInicio;
    public $dataFim;    
}

class Partida {
    public $id;
    public $rodada_id;
    public $titulo;
    public $estadio;
    public $timeA;
    public $timeB;
    public $resultado; // (A,B,E) E = empate
    public $placarTimeA; // placar time A
    public $placarTimeB; // placar time B
    public $data;
}

// relaciona usuario que pode apostar no bolao
class BolaoUsuario {    
    public $bolao_id;
    public $usuario_id;
    public $pontos; // pontuacao do usuario no bolao
}

class PartidaUsuario {
    public $partida_id;
    public $usuario_id;
    public $resultado; // (A,B,E) E = empate
    public $placarTimeA; // placar time A
    public $placarTimeB; // placar time B
}

// Testes

// Gerenciador do Bolao
$admin = new Usuario;
$admin->id = 1;
$admin->nome = "Admin";
$admin->email = "admin@mail.com";
$admin->senha = "123";

// Apostador
$apostador = new Usuario;
$apostador->id = 1;
$apostador->nome = "Apostador";
$apostador->email = "apostador@mail.com";
$apostador->senha = "123";

// Bolao
$bolao = new Bolao;
$bolao->id = 1;
$bolao->usuario_id = $admin->id;
$bolao->titulo = "Bolão 1";
$bolao->rodadaAtual = 0; 
$bolao->pontosResultado = 10; 
$bolao->pontosExtras = 5;
$bolao->pontosTaxa = 5;

// Rodada
$rodada = new Rodada;
$rodada->id = 1;
$rodada->bolao_id = $bolao->id;
$rodada->titulo = 'Primeira rodada';
$rodada->dataInicio = '2018-10-01';
$rodada->dataFim = '2018-10-10';

//Partida
$partida1 = new Partida;
$partida1->id = 1;
$partida1->rodada_id = $rodada->id;
$partida1->titulo = 'MAC x Bauru';
$partida1->estadio = 'Abreuzão';
$partida1->timeA = 'MAC';
$partida1->timeB = 'Bauru';
//$partida1->resultado = ''; 
//$partida1->placarTimeA = ; 
//$partida1->placarTimeB = ; 
$partida1->data = '2018-10-11';

//Apostador no Bolao
$bolaoUsuario = new BolaoUsuario;
$bolaoUsuario->bolao_id = $bolao->id;
$bolaoUsuario->usuario_id = $apostador->id;
$bolaoUsuario->pontos = 0;

// Aposta do usuario
$partida1Apostador = new PartidaUsuario;
$partida1Apostador->partida_id = $partida1->id;
$partida1Apostador->usuario_id = $apostador->id;
$partida1Apostador->resultado = 'B'; // (A,B,E) E = empate
$partida1Apostador->placarTimeA = 0; // placar time A
$partida1Apostador->placarTimeB = 3;

//Finalização da rodada
$bolao->rodadaAtual++;
$partida1->resultado = 'B'; 
$partida1->placarTimeA = 0; 
$partida1->placarTimeB = 3; 

// Lógica de cálculo de pontos
if($partida1Apostador->resultado == $partida1->resultado) {
    $bolaoUsuario->pontos += $bolao->pontosResultado;
}
if($partida1Apostador->placarTimeA == $partida1->placarTimeA && 
   $partida1Apostador->placarTimeB == $partida1->placarTimeB) {
    $bolaoUsuario->pontos += $bolao->pontosExtras;
}

//Lógica para incrementar valores do bolao
$bolao->pontosResultado += $bolao->pontosTaxa; 
$bolao->pontosExtras += $bolao->pontosTaxa;

echo "Pontos do apostador: " . $bolaoUsuario->pontos;