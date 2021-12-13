#language: pt
#encoding: utf-8

Funcionalidade: Logar no sistema
    Sendo um usuário já cadastrado no sistema
    Quero logar no sistema com meu email e senha
    Para realizar as minhas compras

    Cenario: Fazer login
        Dado que acesso a página de login
        Quando submeto o minhas credenciais com: "hulgo.ferreira@fatec.sp.gov.br" e "teste123"
         Então devo ser redirecionado para a área logada
  