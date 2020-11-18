<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Model\Imagem;
use Sistema\Controller;

// Inicia a Classe
class Produto extends Controller
{
    // Objetos
    private $objModelProduto;
    private $objModelImgem;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia
        $this->objModelProduto = new \Model\Produto();
        $this->objModelImgem = new Imagem();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por gerar uma página que exibe os
     * detalhes de um determinado produto.
     * ---------------------------------------------------------
     * @param $id [Id do produto]
     * @param $url [Url formatada]
     * ---------------------------------------------------------
     * @url p/[ID]/[URL]
     * @method GET
     */
    public function detalhes($id, $url)
    {
        // CONTEUDO AQUI

    } // End >> fun::detalhes()


    /**
     * Método responsável por exibir uma página para alterar as
     * informações do produto e adicionar ou remover imagens
     * para o mesmo.
     * ---------------------------------------------------------
     * @param $id [Id do produto]
     * ---------------------------------------------------------
     * @url painel/produto/[id]
     * @method GET
     */
    public function alterar($id)
    {

        // CONTEUDO AQUI

    } // END >> fun::alterar()


    /**
     * Método responsável por listar todos os produtos cadastrados
     * no sistema.
     * ------------------------------------------------------------
     * @param $usuario [Usuario logado]
     */
    public function getPaginaListarProdutos($usuario)
    {
        // CONTEUDO AQUI

    } // End >> fun::getPaginaListarProdutos()

} // End >> Class::Produto