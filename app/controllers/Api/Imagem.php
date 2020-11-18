<?php

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Apoio;
use Helper\Thumb;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Imagem extends Controller
{
    // Variaveis
    private $objModelImagem;
    private $objModelProduto;
    private $objHelperApoio;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objModelImagem = new \Model\Imagem();
        $this->objHelperApoio = new Apoio();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()



    /**
     * Método responsável por inserir uma determinada imagem para
     * um produto já existente. O método deve gerar as thumb e otimizar
     * as imagems.
     * -----------------------------------------------------------------
     * @param $id [Id do produto]
     * -----------------------------------------------------------------
     * @url api/imagem/insert/[ID]
     * @method POST
     */
    public function insert($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $produto = null;
        $obj = null;
        $caminho = null;
        $arquivo = null;
        $salva = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o produto
        $produto = $this->objModelProduto
            ->get(["id_produto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o produto existe
        if(!empty($produto))
        {
            // Verifica se informou a imagem
            if($_FILES["arquivo"]["size"] > 0)
            {
                // Instancia o objeto
                $objFile = new File();

                // Caminho
                $caminho = "./storage/produto/" . $id . "/";

                if(!is_dir($caminho))
                {
                    // Cria
                    mkdir($caminho, 0777, true);
                }


                // Seta as configurações
                $objFile->setStorange($caminho);
                $objFile->setMaxSize(3 * MB);
                $objFile->setExtensaoValida(["jpg","jpeg","png","wep"]);
                $objFile->setFile($_FILES["arquivo"]);

                // Verifica se o tamanho está no limite
                if($objFile->validaSize())
                {
                    // Verifica se é uma extensão permitida
                    if($objFile->validaExtensao())
                    {
                        // Realiza o upload
                        $arquivo = $objFile->upload();

                        // Verifica se deu certo
                        if(!empty($arquivo))
                        {
                            if(!is_dir($caminho . "full/"))
                            {
                                mkdir($caminho . "full/", 0777, true);
                            }

                            // Instancia o objeto de Thumb
                            $objThumb1 = new Thumb();

                            // Adiciona as informações
                            $objThumb1->setNome($arquivo);
                            $objThumb1->setStorage($caminho . "full/");
                            $objThumb1->setTamanho("1000","1000");
                            $objThumb1->setFile($caminho . $arquivo);

                            // Salva a thumb
                            $arquivoAux = $objThumb1->save();

                            // Deleta o arquivo original
                            unlink($caminho .  $arquivo);

                            // Arquivo
                            $arquivo = $arquivoAux;

                            // Verifica se gerou a thumb
                            if(!empty($arquivo))
                            {
                                // Otimiza a imagem
                                $objFile->compressImage($caminho . "full/" . $arquivo, $caminho . "full/" . $arquivo);

                                if(!is_dir($caminho . "thumb/"))
                                {
                                    mkdir($caminho . "thumb/", 0777, true);
                                }

                                // Instancia novamente 190 x 150
                                $objThumb2 = new Thumb();

                                // Adiciona as informações
                                $objThumb2->setNome($arquivo);
                                $objThumb2->setStorage($caminho . "thumb/");
                                $objThumb2->setTamanho("200","200");
                                $objThumb2->setFile($caminho . "full/" . $arquivo);

                                // Salva
                                $thumb = $objThumb2->save();

                                // Verifica se gerou
                                if(!empty($thumb))
                                {
                                    // Monta o array de inserção
                                    $salva = [
                                        "id_produto" => $id,
                                        "imagem" => $arquivo
                                    ];

                                    // Verifica se é a principal
                                    if(!empty($_POST["principal"]))
                                    {
                                        // Add o principal
                                        $salva["principal"] = true;
                                    }


                                    // Insere
                                    $img = $this->objModelImagem->insert($salva);

                                    // Verifica se inseriu
                                    if($img != false)
                                    {
                                        // Busca a imagem
                                        $img = $this->objModelImagem
                                            ->get(["id_imagem" => $img])
                                            ->fetch(\PDO::FETCH_OBJ);

                                        // Verifica se é principal
                                        if($img->principal == true)
                                        {
                                            // Altera o principal anterior
                                            $this->objModelImagem
                                                ->update(
                                                    ["principal" => false],
                                                    ["id_produto" => $id, "id_imagem !=" => $img->id_imagem]
                                                );
                                        }

                                        // Monta o Array de retorno
                                        $dados = [
                                            "tipo" => true,
                                            "code" => 200,
                                            "mensagem" => "Imagem adicionada com sucesso.",
                                            "objeto" => $img
                                        ];

                                    }
                                    else
                                    {
                                        // Deleta os arquivos
                                        unlink($caminho . "full/" . $arquivo);
                                        unlink($caminho . "thumb/" . $arquivo);

                                        // Msg
                                        $dados = ["mensagem" => "Ocorreu um erro ao inserir a imagem."];

                                    } // Error >> Ocorreu um erro ao inserir a imagem no banco de dados.
                                }
                                else
                                {
                                    // Deleta a imagem
                                    unlink($caminho . "full/" . $arquivo);

                                    // Msg
                                    $dados = ["mensagem" => "Ocorreu um erro ao gerar a thumb."];

                                } // Error >> Ocorreu um erro ao gerar a thumb.
                            }
                            else
                            {
                                // Msg
                                $dados = ["mensagem" => "Ocorreu um erro ao redimensionar a imagem."];
                            } // Error >> Ocorreu um erro ao redimensionar a imagem.
                        }
                        else
                        {
                            // Msg
                            $dados = ["mensagem" => "Ocorreu um erro ao realizar o upload da imagem."];
                        } // Error >> Ocorreu um erro ao realizar o upload da imagem.
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "A extensão do arquivo não é permitida."];
                    } // Error >> A extensão utilizada não é permitida.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "A imagem não pode ser maior que 3MB."];
                } // Error >> A imagem não pode ser maior que 3MB.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Imagem não informada."];
            } // Error >> Imagem não informada.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Produto informado não foi encontrado."];
        } // Error >> Produto informado não foi encontrado.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por setar uma determinada imagem como principal.
     * Apenas administradores podem utilizar.
     * ----------------------------------------------------
     * @param $id [Id da Imagem]
     * ----------------------------------------------------
     * @author igorcacerez
     * ----------------------------------------------------
     * @url api/imagem/principal/[Id da imagem]
     * @method PUT
     */
    public function principal($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $imagem = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Where
        $where = ["id_imagem" => $id];

        // Busca a imagem
        $imagem = $this->objModelImagem
            ->get($where)
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se a imagem existe
        if(!empty($imagem))
        {
            // Verifica se a imagem já é principal
            if($imagem->principal == false)
            {
                // Remove a principal atualmente
                $this->objModelImagem
                    ->update(["principal" => false], ["id_produto" => $imagem->id_produto]);

                // Adiciona a imagem como principal
                if($this->objModelImagem->update(["principal" => true], $where) != false)
                {
                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "A imagem principal foi alterada."
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro em setar a imagem como principal."];

                } // Error >> Ocorreu um erro em setar a imagem como principal.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "A imagem já é a principal."];

            } // Error >> A imagem já é a principal.
        }
        else
        {
            // Mag
            $dados = ["mensagem" => "Imagem informada não foi encontrada."];
        } // Error >> Imagem informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::principal()



    /**
     * Método responsável por deleter uma determinada imagem.
     * Apenas admins podem fazer isso.
     * ----------------------------------------------------
     * @param $id [Id da Imagem]
     * ----------------------------------------------------
     * @author igorcacerez
     * ----------------------------------------------------
     * @url api/imagem/delete/[Id da imagem]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $imagem = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Where
        $where = ["id_imagem" => $id];

        // Busca a imagem
        $imagem = $this->objModelImagem
            ->get($where)
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se a imagem existe
        if(!empty($imagem))
        {
            // Verifica se a imagem não é principal
            if($imagem->principal == false)
            {
                // Deleta
                if($this->objModelImagem->delete($where) != false)
                {
                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "A imagem foi deletada.",
                        "objeto" => $imagem
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao tentar deletar a imagem."];

                } // Error >> Ocorreu um erro ao tentar deletar a imagem.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Impossível deletar. Essa imagem é a principal."];
            } // Error >> Imagem principal.
        }
        else
        {
            // Mag
            $dados = ["mensagem" => "Imagem informada não foi encontrada."];
        } // Error >> Imagem informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Imagem