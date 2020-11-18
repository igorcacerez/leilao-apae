<?php

// Erro 404
$Rotas->onError("404", function (){
   echo "Erro - 404";
});

/**
 * ========================================================
 *                      ROTAS DA API
 * ========================================================
 */


// Usuário
$Rotas->group("api-usuario","api/usuario","Api\Usuario");
$Rotas->onGroup("api-usuario","POST","login","login");
$Rotas->onGroup("api-usuario","POST","insert","insert");
$Rotas->onGroup("api-usuario","PUT","update/{p}","update");
$Rotas->onGroup("api-usuario","DELETE","delete/{p}","delete");


// Produto
$Rotas->group("api-produto","api/produto","Api\Produto");
$Rotas->onGroup("api-produto","POST","insert","insert");
$Rotas->onGroup("api-produto","POST","update/{p}","update");
$Rotas->onGroup("api-produto","DELETE","delete/{p}","delete");


// Imagem
$Rotas->group("api-imagem","api/imagem","Api\Imagem");
$Rotas->onGroup("api-imagem","POST","insert/{p}","insert");
$Rotas->onGroup("api-imagem","PUT","principal/{p}","principal");
$Rotas->onGroup("api-imagem","DELETE","delete/{p}","delete");



/**
 * ========================================================
 *                      ROTAS DO SITE
 * ========================================================
 */


// -- Rotas sem grupo
$Rotas->on("GET","","Site::index");