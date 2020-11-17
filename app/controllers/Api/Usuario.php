<?php

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Apoio;
use Sistema\Controller;
use Sistema\Helper\Seguranca;

// Classe
class Usuario extends Controller
{
    // Objetos
    private $objModelUsuario;
    private $objSeguranca;
    private $objInput;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelUsuario = new \Model\Usuario();
        $this->objHelperApoio = new Apoio();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por realizar o login de um
     * determinado usuário, independente do seu nivel.
     * -----------------------------------------------
     * @url api/usuario/login
     * @method POST
     */
    public function login()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $token = null;
        $dadosLogin = null;

        // Recupera os dados de login
        $dadosLogin = $this->objSeguranca->getDadosLogin();

        // Criptografa a senha
        $dadosLogin["senha"] = md5($dadosLogin["senha"]);

        // Busca o usuário
        $usuario = $this->objModelUsuario
            ->get(["email" => $dadosLogin["usuario"], "senha" => $dadosLogin["senha"]])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou o usuário
        if(!empty($usuario))
        {
            // Gera um token
            $token = $this->objSeguranca->getToken($usuario->id_usuario);

            // Verifica se gerou o token
            if($token != false)
            {
                // Salva os dados na session
                $_SESSION["usuario"] = $usuario;
                $_SESSION["token"] = $token;

                // Array de retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Sucesso! Aguarde...",
                    "objeto" => [
                        "usuario" => $usuario,
                        "token" => $token
                    ]
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorre um erro ao conceder um token de acesso."];
            } // Error >> Ocorre um erro ao conceder um token de acesso.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "E-mail ou senha informados estão incorretos."];

        } // Error >> Dados de login estão incorretos.

        // Retorno
        $this->api($dados);

    } // End >> fun::login()



    /**
     * Método responsável por adicionar um novo usuário no banco
     * de dados, verificando se todos os campos obrigatórios
     * foram informados.
     * --------------------------------------------------------------
     * @url api/usuario/insert
     * @url POST
     */
    public function insert()
    {
        // Váriaveis
        $dados = null;
        $usuario = null;

        // Recupera os dados post
        $post = $_POST;


        // Verifica se informou os dados obrigatorios
        if(!empty($post["nome"]) &&
            !empty($post["email"]) &&
            !empty($post["senha"]))
        {
            // Verifica se as senhas combinam
            if($post["senha"] == $post["re_senha"])
            {
                // Verifica se já possui um cadastro com o e-mail informado
                if($this->objModelUsuario->get(["email" => $post["email"]])->rowCount() == 0)
                {
                    // Criptografa a senha
                    $post["senha"] = md5($post["senha"]);

                    // Removendo o repete senha
                    unset($post["repete_senha"]);

                    // Insere
                    $usuario = $this->objModelUsuario->insert($post);

                    // Verifica se inseriu
                    if(!empty($usuario))
                    {
                        // Busca o usuário inserido
                        $usuario = $this->objModelUsuario
                            ->get(["id_usuario" => $usuario])
                            ->fetch(\PDO::FETCH_OBJ);

                        // Retorno
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Usuário inserido com sucesso.",
                            "objeto" => [
                                "usuario" => $usuario
                            ]
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao inserir o usuário"];
                    } // Error >> Ocorreu um erro ao inseriri o usuário
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Já possui um cadastro com o e-mail informado."];
                } // Error >> Já possui um cadastro com o e-mail informado.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Senhas informadas não são idênticas."];
            } // Error >> Senhas informadas não são idênticas.
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
     * @param $id [Id do usuário]
     * -----------------------------------------------------------------
     * @url api/usuario/update/[ID]
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
        $obj = $this->objModelUsuario
            ->get(["id_usuario" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou o usuário
        if(!empty($obj))
        {
            // Verifica se vai alterar a senha
            if(!empty($put["senha"]) && !empty($put["re_senha"]))
            {
                // Verifica se não são parecidos
                if($put["senha"] != $put["repete_senha"])
                {
                    // Avisa que não são identicas
                    $this->api(["mensagem" => "Senhas informadas não são idênticas."]);
                }

                // Criptografa a senha
                $put["senha"] = md5($put["senha"]);
            }

            // Remove
            unset($put["re_senha"]);

            // Altera e verifica
            if($this->objModelUsuario->update($put, ["id_usuario" => $id]) != false)
            {
                // Busca o objeto alterado
                $objAlterado = $this->objModelUsuario
                    ->get(["id_usuario" => $id])
                    ->fetch(\PDO::FETCH_OBJ);

                // Retorno sucesso
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensgaem" => "Informações alteradas com sucesso.",
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
            $dados = ["mensagem" => "Usuário informado não encontrado."];
        } // Error >> Usuário informado não encontrado.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por deletar um usuário cujo seu nivel seja
     * admin ou ativar/desativar cujo seu nivel seja diferente.
     * ----------------------------------------------------------------
     * @param $id [Id do usuário]
     * -----------------------------------------------------------------
     * @url api/usuario/delete/[ID]
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
        $obj = $this->objModelUsuario
            ->get(["id_usuario" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o usuário existe
        if(!empty($obj))
        {
            // Verifica se o usuário vai deletar ele mesmo
            if($usuario->id_usuario != $id)
            {
                // Deleta
                if($this->objModelUsuario->delete(["id_usuario" => $id]) != false)
                {
                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Usuário deletado com sucesso.",
                        "objeto" => $obj
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao deletar o usuário."];
                } // Error >> Ocorreu um erro ao deletar o usuário.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Impossível deletar você mesmo."];
            } // Error >> Impossível deletar você mesmo.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário informado não existe"];
        } // Error >> Usuário informado não existe

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()


} // End >> Class::Usuario