<?php

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Apoio;
use Model\Imagem;
use Sistema\Controller;
use Sistema\Helper\Seguranca;

// Classe
class Produto extends Controller
{
    // Objetos
    private $objModelProduto;
    private $objModelImagem;
    private $objHelperApoio;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objModelImagem = new Imagem();
        $this->objHelperApoio = new Apoio();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por adicionar
     * um novo produto no sistema.
     * --------------------------------------
     * @url api/produto/insert
     * @method POST
     */
    public function insert()
    {
        // Váriaveis
        $dados = null;
        $usuario = null;
        $obj = null;

        // Recupera os dados post
        $post = $_POST;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Verifica se informou os dados obrigatorios
        if(!empty($post["nome"]) &&
            !empty($post["descricao"]) &&
            !empty($post["valor"]))
        {
            // Limpa o valor
            $post["valor"] = str_replace(".","", $post["valor"]);
            $post["valor"] = str_replace(",",".", $post["valor"]);

            // Insere
            $obj = $this->objModelProduto->insert($post);

            // Verifica se inseriu
            if(!empty($obj))
            {
                // Busca o usuário inserido
                $obj = $this->objModelProduto
                    ->get(["id_produto" => $obj])
                    ->fetch(\PDO::FETCH_OBJ);

                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Produto inserido com sucesso.",
                    "objeto" => $obj
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao inserir o produto"];
            } // Error >> Ocorreu um erro ao inseriri o usuário
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Dados obrigatórios não informados."];

        } // Error >> Dados obrigatórios não informados

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por alterar as informações de um determinado
     * usuário já cadastrado no banco de dados.
     * -----------------------------------------------------------------
     * @param $id [Id do produto]
     * -----------------------------------------------------------------
     * @url api/produto/update/[ID]
     * @method PUT
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $put = null;
        $obj = null;
        $objAlterado = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Recupera os dados put
        $put = $_POST;

        // Busca o usuário a ser alterado
        $obj = $this->objModelProduto
            ->get(["id_produto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou o usuário
        if(!empty($obj))
        {
            // Limpa o valor
            $put["valor"] = str_replace(".","", $put["valor"]);
            $put["valor"] = str_replace(",",".", $put["valor"]);

            // Altera e verifica
            if($this->objModelProduto->update($put, ["id_produto" => $id]) != false)
            {
                // Busca o objeto alterado
                $objAlterado = $this->objModelProduto
                    ->get(["id_produto" => $id])
                    ->fetch(\PDO::FETCH_OBJ);

                // Retorno sucesso
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Informações alteradas com sucesso.",
                    "objeto" => [
                        "antes" => $obj,
                        "atual" => $objAlterado
                    ]
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao alterar as informações."];

            } // Error >> Ocorreu um erro ao alterar as informações.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Produto informado não encontrado."];
        } // Error >> Produto informado não encontrado.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por deletar um usuário cujo seu nivel seja
     * admin ou ativar/desativar cujo seu nivel seja diferente.
     * ----------------------------------------------------------------
     * @param $id [Id do produto]
     * -----------------------------------------------------------------
     * @url api/produto/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o usuário a ser deletado
        $obj = $this->objModelProduto
            ->get(["id_produto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o usuário existe
        if(!empty($obj))
        {
            // Deleta as imagens
            $this->objModelImagem->delete(["id_produto" => $id]);

            // Deleta
            if($this->objModelProduto->delete(["id_produto" => $id]) != false)
            {
                // Array de sucesso
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Produto deletado com sucesso.",
                    "objeto" => $obj
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao deletar o produto."];
            } // Error >> Ocorreu um erro ao deletar o produto.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Produto informado não existe"];
        } // Error >> Produto informado não existe

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()


} // End >> Class::Produto()