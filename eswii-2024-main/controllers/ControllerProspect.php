<?php
namespace controllers;

require_once('../DAO/DAOProspect.php');

use DAO\DAOProspect;

/**
 * Esta classe é responsável por fazer o tratamento dos dados para
 * apresentação e/ou envio para a DAO executar as consultas no bd.
 * Seu escopo se limita às funções da entidade prospect.
 * 
 * @author Paulo Roberto Córdova
 */
class ControllerProspect{
    /**
     * Recebe um objeto do tipo Prospect, verifica se é para
     * salvar ou alterar e envia para a DAO executar a operação.
     * @param Prospect
     * @return  TRUE|Exception Retorna TRUE caso a operação tenha sido bem sucedida e Exception, caso não tenha.
     */
    public function salvarProspect($prospect){
        $daoProspect = new DAOProspect();

        if($prospect->codigo === null){
            try{
                $daoProspect->incluirProspect($prospect->nome, $prospect->email, 
                                            $prospect->celular, $prospect->facebook,
                                            $prospect->whatsapp);
            
                unset($daoProspect);
                return TRUE;
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }else{
            try{
                $daoProspect->atualizarProspect($prospect->nome, $prospect->email, 
                                            $prospect->celular, $prospect->facebook,
                                            $prospect->whatsapp, $prospect->codigo);
                unset($daoProspect);
                return TRUE;
            }catch(\Exception $e){
                throw new \Exception($e->getMessage());
            }
        }
    }
    /**
    * Recebe um objeto do tipo Prospect e envia para a DAO concluir a exclusão
    *
    * @param Prospect $prospect Objeto Prospect informando o código do prospect a ser excluído
    * @return TRUE|Exception Retorna TRUE caso a inclusão tenha sido bem sucedida
    * ou uma Exception caso não tenha.
    */
    public function excluirProspect($prospect){
        $daoProspect = new DAOProspect();
        try{
            $daoProspect->excluirProspect($prospect->codigo);
            unset($daoProspect);
            return TRUE;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    /**
         * Método para buscar Prospects por email. 
         * Se não for informado o email, serão retornados todos.
         * @param String|null 
         * @return Prospect[]
         */
        public function buscarProspects($email=null){
            $daoProspect = new DAOProspect();
            $prospects = array();

            if($email === null){
                $prospects = $daoProspect->buscarProspects();
                unset($daoProspect);
                return $prospects;
            }else{
                $prospects = $daoProspect->buscarProspects($email);
                unset($daoProspect);
                return $prospects;
            }
        }

}
?>





