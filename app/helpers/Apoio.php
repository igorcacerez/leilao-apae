<?php

/**
 * Classe responsável por conter métodos que auxiliam no desenvolvimento
 * de softwares.
 */

// NameSpace
namespace Helper;

// Inicia a classe
use Model\Imagem;

class Apoio
{

    /**
     * Método responsável por válidar se o usuário está logado
     * ou não. Caso esteja, retorna o objeto com os dados do mesmo.
     * Se não redireciona para a página de login.
     */
    public function seguranca()
    {
        // Recupera os dados da sessao
        $user = $_SESSION["usuario"];
        $token = $_SESSION["token"];


        // Verifica se possui algo
        if(!empty($user->id_usuario))
        {
            // Verifica se o token está valido
            if($token->data_expira > date("Y-m-d H:i:s"))
            {
                // Add o token ao usuario
                $user->token = $token;

                // Retorna o usuario
                return $user;
            }
            else
            {
                // Deleta a session
                session_destroy();

                // Redireciona para a tela de logof
                header( "Location: " . BASE_URL . "login");
            } // Error - Token Expirado
        }
        else
        {
            // Redireciona para a tela de login
            header( "Location: " . BASE_URL . "login");
        } // Error - usuario não logado

    } // End >> fun::seguranca()


    /**
     * Método responsável por formatar um numero na casa do milhar, deixando
     * em siglas K,M,B,T,Q
     * ---------------------------------------------------------------------
     * @param null|int $numero
     * @return string
     */
    public function formatNumero($numero = null)
    {
        // Variaveis
        $cont = 0;
        $array  = ["","K","M","B","T","Q"];

        // Divide o numero por mil
        while ($numero >= 1000)
        {
            $numero = $numero / 1000;
            $cont++;
        }


        // Verifica se o numero não é inteiro
        if(is_int($numero) == false)
        {
            // Deixa com duas casas decimais
            $numero = number_format($numero,2,".");
        }

        // Retorna o numero com a letra
        return $numero . $array[$cont];
    }


    /**
     * Método responsável por configurar a imagem padrão
     * de um produto ou de uma categoria.
     * --------------------------------------------------------------
     * @param $id [Id do produto]
     * @return array|string
     */
    public function getImagem($id)
    {
        // Objeto
        $objModelImagem = new Imagem();

        // Busca o imagem padrao
        $imagem = $objModelImagem
            ->get(["id_produto" => $id, "principal" => true])
            ->fetch(\PDO::FETCH_OBJ);

        // Imagem padrão
        $retorno = [
            "full" => BASE_URL . "assets/custom/img/padrao/produto-img.jpg",
            "thumb" => BASE_URL . "assets/custom/img/padrao/produto-thumb.jpg"
        ];

        // Verifica se tem imagem
        if(!empty($imagem->imagem))
        {
            // Configura a imagem
            $retorno = [
                "full" => BASE_STORAGE . "produto/" . $id . "/full/" . $imagem->imagem,
                "thumb" => BASE_STORAGE . "produto/" . $id . "/thumb/" . $imagem->imagem
            ];
        }

        // Retorna
        return $retorno;

    } // End >> fun::getImagem()


    /**
     * Método responsável por transformar uma string em uma url sem acentos e
     * espaços para url amigavel.
     * ------------------------------------------------------------------------
     * @author thiagomorello
     * @copyright http://thiagomorello.com/blog/2013/01/como-gerar-urls-amigaveis-perfeitamente-com-php/
     * ------------------------------------------------------------------------
     * @param $str
     * @param array $replace
     * @param string $delimiter
     * @return false|string|string[]|null
     */
    public function urlAmigavel($str, $replace = array(), $delimiter = '-')
    {
        setlocale(LC_ALL, 'en_US.UTF8');

        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        // Retorno
        return $clean;

    } // End >> fun::urlAmigavel()

} // End >> Class::Apoio()