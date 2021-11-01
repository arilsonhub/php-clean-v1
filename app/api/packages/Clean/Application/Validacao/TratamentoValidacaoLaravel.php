<?php

namespace Packages\Clean\Application\Validacao;

use App\Facade\AutoMapperFacade;
use App\Factory\GenericFactory;
use Illuminate\Support\Facades\Validator;
use Packages\Clean\Application\Exceptions\CleanException;
use Packages\Clean\Application\Helper\CadastroHelper;
use Packages\Clean\Domain\Dto\Validacao\RegraCampoValorUnicoDTO;

class TratamentoValidacaoLaravel implements TratamentoValidacao {

    private $genericFactory;

    public function __construct(GenericFactory $genericFactory)
    {
        $this->genericFactory = $genericFactory;
    }

    public function obterListaDeErros(Array $dadosDeEntrada, Array $regras, Array $mensagens) : Array
    {
        $listaDeErros = [];

        try {
            $objetoValidador = Validator::make($dadosDeEntrada, $regras, $mensagens);
            $errosDoValidador = $objetoValidador->errors();
            $campos = array_keys($regras);

            foreach ($campos as $nomeCampo) {
                $mensagem = $errosDoValidador->first($nomeCampo);

                if($mensagem !== "")
                    $listaDeErros[$nomeCampo] = $mensagem;
            }
        } catch(\Exception $e) {
            throw new CleanException($e->getMessage());
        }

        return $listaDeErros;
    }

    public function obterRegraCampoComValorUnico(RegraCampoValorUnicoDTO $regraCampoValorUnicoDTO)
    {
        $dadosDeEntrada = $regraCampoValorUnicoDTO->getDadosDeEntrada();
        $repository = $regraCampoValorUnicoDTO->getRepository();
        $indiceId = $regraCampoValorUnicoDTO->getIndiceId();
        $indiceId = (is_null($indiceId) ? 'f_id' : $indiceId);
        $entidade = $this->genericFactory->getInstance($regraCampoValorUnicoDTO->getReferenciaEntidade());
        $indiceCampo = $regraCampoValorUnicoDTO->getIndiceCampo();
        $nomeConexaoTabela = $regraCampoValorUnicoDTO->getNomeConexaoTabela();

        $naoEstaInserindo = (!CadastroHelper::estaInserindo($dadosDeEntrada, $indiceId));
        $valorDoId = ($naoEstaInserindo ? $dadosDeEntrada[$indiceId] : -1);
        $dadosDoRegistroNoBanco = null;

        if($naoEstaInserindo)
        {
            $dadosDoRegistroNoBanco = $repository->obterPeloId($valorDoId, $entidade);
            $dadosDoRegistroNoBanco = AutoMapperFacade::autoMap($dadosDoRegistroNoBanco, []);
        }

        $valorCampo = (isset($dadosDeEntrada[$indiceCampo]) ? $dadosDeEntrada[$indiceCampo] : null);

        if($valorCampo !== null)
        {
            if($dadosDoRegistroNoBanco !== null)
            {
                $valorCampoNoBanco = $dadosDoRegistroNoBanco[$indiceCampo];

                if(strcmp($valorCampo, $valorCampoNoBanco) === 0)
                    return null;
            }

            return "iunique:{$nomeConexaoTabela},{$indiceCampo},{$valorDoId},{$indiceId}";
        }

        return null;
    }

}
