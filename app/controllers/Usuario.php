<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Usuario extends Controller
{
    // Objetos
    private $objModelUsuario;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia
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

        // Variaveis
        $produtos = null;
        $imagens = null;
        $dados = null;

        // Busca o produto
        $produto = $this->objModelProduto
            ->get(["id_produto" => $id]);

        if ($produto->rowCount() == 1)
        {
            // Busca os dados do produto
            $produto = $produto->fetch(\PDO::FETCH_OBJ);

            // Busca as imagem do produto
            $imagens = $this->objModelImagem
                ->get(["id_produto" => $id])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Verificando se tem imagem
            if (!empty($imagens))
            {
                // Percorre todas as imagens
                foreach ($imagens as $imagem)
                {
                    // Monta o link da imagem
                    $imagem->imagem = BASE_STORAGE . "produto/" . $id . "/full/" . $imagem->imagem;
                }
            }

            // Array de retorno
            $dados = [
                "produto" => $produto,
                "imagens" => $imagens
            ];

            // Carrega a view
            $this->view("site/detalhes", $dados);

        }

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
        $usuario = null;
        $user = null;


        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Busca o usuario
        $user = $this->objModelUsuario
            ->get(["id_usuario" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($user))
        {

            // Retorno
            $dados = [
                "usuario" => $usuario,
                "user" => $user,
                "js" => [
                    "modulos" => ["Usuario"]
                ]
            ];

            // Chama a view
            $this->view("painel/usuario/alterar", $dados);
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
                "modulos" => ["Usuario"]
            ]
        ];

        // View
        $this->view("painel/usuario/adicionar", $dados);

    } // End >> fun::adicionar()



    /**
     * Método responsável por listar todos os produtos cadastrados
     * no sistema.
     * ------------------------------------------------------------
     * @param $usuario [Usuario logado]
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuarios = null;

        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Busca todos os usuarios
        $usuarios = $this->objModelUsuario
            ->get()
            ->fetchAll(\PDO::FETCH_OBJ);

        // Dados
        $dados = [
            "usuario" => $usuario,
            "usuarios" => $usuarios,
            "js" => [
                "modulos" => ["Usuario"]
            ]
        ];

        // View
        $this->view("painel/usuario/lista", $dados);

    } // End >> fun::getPaginaListarProdutos()

} // End >> Class::Produto