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
    private $objModelUsuario;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia
        $this->objModelProduto = new \Model\Produto();
        $this->objModelImgem = new Imagem();
        $this->objModelUsuario = new \Model\Usuario();
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
     * @url produto/alterar/[id]
     * @method GET
     */
    public function alterar($id)
    {
        // Variaveis
        $produto = null;
        $imagens = null;
        $usuario = null;
        $dados = null;

        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Busca o produto
        $produto = $this->objModelProduto
            ->get(["id_produto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($produto))
        {
            // Busca as imagens
            $imagens = $this->objModelImgem
                ->get(["id_produto" => $id])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Retorno
            $dados = [
                "usuario" => $usuario,
                "produto" => $produto,
                "imagens" => $imagens,
                "js" => [
                    "modulos" => ["Produto"]
                ]
            ];

            // Chama a view
            $this->view("painel/produto/alterar", $dados);
        }
        else
        {
            // Pag de addd produto
            $this->adicionar();
        } // Inserir produto

    } // END >> fun::alterar()



    /**
     * Método responsável por exibir uma página
     * que monta um formulário para inserir um novo produto
     * -----------------------------------------------------
     * @url produto/adicionar
     * @methdo GET
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;

        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Retorno
        $dados = [
            "usuario" => $usuario,
            "js" => [
                "modulos" => ["Produto"]
            ]
        ];

        // View
        $this->view("painel/produto/adicionar", $dados);

    } // End >> fun::adicionar()



    /**
     * Método responsável por listar todos os produtos cadastrados
     * no sistema.
     * ------------------------------------------------------------
     * @param $usuario [Usuario logado]
     */
    public function getPaginaListarProdutos($usuario)
    {
        // Variaveis
        $dados = null;
        $cont = null;
        $produtos = null;

        // Total de produto
        $total = $this->objModelProduto
            ->get()
            ->rowCount();

        // Verifica se possui total
        $total = (!empty($total) ? $total : 0);

        // Produtos Ativos
        $cont["produto_ativo"] = $this->objModelProduto
            ->get(["vendido" => false])
            ->rowCount();

        // Calcula a porcentagem
        $cont["produto_ativo_porcentagem"] = ($cont["produto_ativo"] * 100) / $total;


        // Produtos vendidos
        $cont["produto_vendido"] = $this->objModelProduto
            ->get(["vendido" => true])
            ->rowCount();

        // Calcula a porcentagem
        $cont["produto_vendido_porcentagem"] = ($cont["produto_vendido"] * 100) / $total;


        // Usuários
        $cont["usuario"] = $this->objModelUsuario
            ->get()
            ->rowCount();

        // Valor Arrecadado
        $aux = $this->objModelProduto
            ->get(["vendido" => true], null, null, "SUM(valor) as total")
            ->fetch(\PDO::FETCH_OBJ);

        $cont["valor"] = $aux->total;


        // Busca os produtos
        $produtos = $this->objModelProduto
            ->get()
            ->fetchAll(\PDO::FETCH_OBJ);

        // Percorre
        foreach ($produtos as $produto)
        {
            // Busca a imagem
            $produto->imagem = $this->objHelperApoio
                ->getImagem($produto->id_produto);

            // Url
            $produto->url = BASE_URL . "p/" . $produto->id_produto . "/" . $this->objHelperApoio->urlAmigavel($produto->nome);
        }

        // Dados
        $dados = [
            "usuario" => $usuario,
            "cont" => $cont,
            "produtos" => $produtos,
            "js" => [
                "modulos" => ["Produto"]
            ]
        ];

        // View
        $this->view("painel/index", $dados);

    } // End >> fun::getPaginaListarProdutos()

} // End >> Class::Produto