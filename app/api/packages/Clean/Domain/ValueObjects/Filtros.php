<?php

namespace Packages\Clean\Domain\ValueObjects;

use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Application\Helper\CadastroHelper;

class Filtros
{
    private $filtros;
    private $ordenacao;
    private $camposPermitidosOrdenacao;

    public function __construct(Array $filtros = null, Array $ordenacao = null, Array $camposPermitidosOrdenacao = null)
    {
        $this->filtros = collect($filtros);
        $this->ordenacao = collect($ordenacao);
        $this->camposPermitidosOrdenacao = $camposPermitidosOrdenacao;
    }

    public function obterData($filto)
    {
        $campo = $this->possuiFiltro($filto) ? $this->$filto : null;
        if ($campo) {
            return CadastroHelper::converterDataParaFormatoBR($campo);
        }
        return null;
    }

    public function possuiFiltro($filtro)
    {
        $filtros = is_array($filtro) ? $filtro : func_get_args();

        foreach ($filtros as $filtro) {
            if ($this->ehUmaStringVazia($filtro)) {
                return false;
            }
        }

        return true;
    }

    private function ehUmaStringVazia($filtro)
    {
        $valor = $this->filtros->get($filtro);
        $ehBoleanoOuArray = is_bool($valor) || is_array($valor);
        return ! $ehBoleanoOuArray && trim((string) $valor) === '';
    }

    public function obterFiltro($atributo)
    {
        $filtroExiste = $this->filtros->has($atributo);
        return ($filtroExiste) ? $this->filtros[$atributo] : null;
    }

    public function obterCampoDeOrdenacao($campoPadrao)
    {
        $campoEhNulo = is_null($this->ordenacao->get('campo'));
        $campoDeOrdenacao = $campoEhNulo ? $campoPadrao : $this->ordenacao->get('campo');
        $temListaCamposPermitidos = is_array($this->camposPermitidosOrdenacao);

        if(!$temListaCamposPermitidos)
            throw new CleanException("A lista de campos permitidos para ordenação não foi definida");

        if(!in_array($campoDeOrdenacao, $this->camposPermitidosOrdenacao))
            throw new CleanException("O campo {$campoDeOrdenacao} não é permitido para ordenação");

        return $campoDeOrdenacao;
    }

    public function obterSentidoDaOrdenacao($odenacaoPadrao = 'asc')
    {
        $ordenacaoEhNula = is_null($this->ordenacao->get('sentido'));
        $sentidoDeOrdenacao =  $ordenacaoEhNula ? $odenacaoPadrao :  trim(strtolower($this->ordenacao->get('sentido')));

        return $sentidoDeOrdenacao;
    }
}
