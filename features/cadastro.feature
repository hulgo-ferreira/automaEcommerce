#language: pt 
#encoding: utf-8

Funcionalidade: Cadastro de Usuários
    Sendo um visitante do site E-commerce
    Quero fazer o meu cadastro
    Para que eu possa comprar os meus produtos favoritos

    #contexto fixo
    Contexto: pagina de cadastro
    Dado que acesso a página de cadastro
    
    #@happy
    Cenario: Cadastro
        Quando submeto o meu cadastro com:
            #massa de teste fixa
            |nome      |Hulgo Rafael Ferreira    |
            |cpf       |123.243.451-08           |
            |email|hulgo.ferreira@fatec.sp.gov.br| 
            |senha     |teste123                 |
            |sexo      |masculino                |
            |nascimento|30/03/1992               |
            |celular   |1499766-4250             |
            |cep       |17470-000                |
            |endereco  |Rua José Valentim Fávaro |
            |cidade    |Duartina                 |
            |uf        |SP                       |
            |bairro    |Vila                     |
            |numero    |174                      |
            |complemento|casa                    |
        Então devo ser redirecionado para a área logada

#cenário outline
#quando eu crio um esquema de cenário, o cucumber espera que eu tenha uma matriz de exemplos
    Esquema do Cenário: Tentativa de Cadastro

        #<>placeholder representado pela minha matriz
        Quando submeto o meu cadastro com:
            |nome       |<nome>       | 
            |cpf        |<cpf>        |
            |email      |<email>      | 
            |senha      |<senha>      |
            |sexo       |<sexo>       |
            |nascimento |<nascimento> |
            |celular    |<celular>    |
            |cep        |<cep>        |
            |endereco   |<endereco>   |
            |cidade     |<cidade>     |
            |uf         |<uf>         |
            |bairro     |<bairro>     |
            |numero     |<numero>     |
            |complemento|<complemento>|
        Então devo ver a mensagem: "<mensagem_saida>"

#matriz de exemplos com os 4 cenários representando a massa de teste
#a primeira linha da matriz é a coluna para montar os placeholders
    Exemplos:
    |nome|cpf           |email                         |senha   |sexo|nascimento|celular     |cep      |endereco         |cidade  |uf|bairro       |numero|complemento|mensagem_saida     |
    |Hulgo |123.243.451-08|                              |teste123|M   |30/03/1992|1499766-4250|17470-000|Rua José valentim|Duartina|SP|Vila Duartina|174   |casa       |Preencha este campo| 
    |Hulgo |123.243.451-08|hulgo.ferreira@fatec.sp.gov.br|        |M   |30/03/1992|1499766-4250|17470-000|Rua José valentim|Duartina|SP|Vila Duartina|174   |casa       |Preencha este campo|
    |      |              |                              |        |    |          |            |         |                 |        |  |             |      |           |Preencha este campo|

