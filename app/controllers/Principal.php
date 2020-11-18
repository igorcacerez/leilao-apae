<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/03/2019
 * Time: 18:29
 */

namespace Controller;

use Helper\Apoio;
use Sistema\Controller as CI_controller;


class Principal extends CI_controller
{

    // Objetos
    private $objModelProduto;
    private $objHelperApoio;

    // Método construtor
    function __construct()
    {
        // Carrega o contrutor da classe pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objHelperApoio = new Apoio();
    }


    /**
     * Método responsável por verificar se o usuário não está
     * logado e montar a página de login para o mesmo.
     * ----------------------------------------------------------
     * @url login
     */
    public function login()
    {
        // Dados
        $dados = null;

        // Recupera os dados da sessao
        $user = (!empty($_SESSION["usuario"])) ? $_SESSION["usuario"] : null;

        // Verifica se existe session do usuario
        if(!empty($user))
        {
            // Redireciona para o painel admin
            header("Location: " . BASE_URL . "painel");
        }
        else
        {
            // Dados
            $dados = [
                "js" => [
                    "modulos" => ["Usuario"]
                ]
            ];

            // View
            $this->view("site/login", $dados);
        }

    } // End >> fun::login()



    /**
     * Método responsável por buscar todas as configuraçõe necessárias
     * para montar a página inicial com listagem dos produtos.
     * -----------------------------------------------------------------
     * @url BASE_URL
     */
    public function index()
    {
        // Variaveis
        $produtos = null;
        $dados = null;

        // Busca os produtos
        $produtos = $this->objModelProduto
            ->get(null, "vendido ASC, id_produto DESC")
            ->fetchAll(\PDO::FETCH_OBJ);

        // Percorre os produtos encontrados
        foreach ($produtos as $produto)
        {
            // Busca a imagem do produto
            $produto->imagem = $this->objHelperApoio
                ->getImagem($produto->id_produto);

            // Monta a url
            $produto->url = BASE_URL . "p/" . $produto->id_produto . "/" . $this->objHelperApoio->urlAmigavel($produto->nome);
        }

        // Array de retorno
        $dados = [
            "produtos" => $produtos
        ];

        // Carrega a view
        $this->view("site/index", $dados);

    } // End >> fun::index()


    /**
     * Método responsável por gerar a página inicial
     * do painel do usuário logado.
     * --------------------------------------------------
     * @url painel
     */
    public function painel()
    {
        // Variaveis
        $usuario = null;
        $objProduto = null;

        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Instancia o objeto
        $objProduto = new Produto();

        // Chama o método
        $objProduto->getPaginaListarProdutos($usuario);

    } // End >> fun::painel()


    /**
     * Método responsável por destruir a sessão do usuário
     * logado e redirecionar para a home.
     * -----------------------------------------------------
     * @url sair
     */
    public function sair()
    {
        // Destroi a session
        session_destroy();

        // Redireciona para a home
        header("Location: " . BASE_URL);

    } // End >> fun::sair()

} // END::Class Principal