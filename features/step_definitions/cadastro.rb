
# para eu acessar a página de cadastro preciso do capybara
# o cucumber não sabe subir uma página, ele apenas monta o esqueleto
Dado('que acesso a página de cadastro') do
    visit "http://localhost/e-commerce/" #visitando url
    find('[data-testid="menuconta"]').click
    click_link 'Cadastrar-se'  

end
  
Quando('submeto o meu cadastro com:') do |table|
    user = table.rows_hash #massa de teste guardada na variável user

    #irá chamar o método delorean que está no arquivo helpers que por sua vez irá chamar o método HTTParty
    delorean user[:email]

    find("input[name=nome]").set user[:nome]
    find("input[name=cpf]").set user[:cpf]
    find("input[name=email]").set user[:email]
    find("input[name=senha]").set user[:senha]
    find("input[name=sexo]").set user[:sexo]
    find("input[name=nascimento]").set user[:nascimento]
    find("input[name=celular]").set user[:celular]
    find("input[name=cep]").set user[:cep]
    find("input[name=endereco]").set user[:endereco]
    find("input[name=cidade]").set user[:cidade]
    find("input[name=uf]").set user[:uf]
    find("input[name=bairro]").set user[:bairro]
    find("input[name=numero]").set user[:numero]
    find("input[name=complemento]").set user[:complemento]

    click_on "Cadastrar-se"

end

#validação do cenário
#capybara fazer a validação acertiva
Então('devo ser redirecionado para a área logada') do
    expect(page).to have_css '.card-list'
    #expect é um recurso do rspec
    #page é um objeto do capybara
end

#massa de teste referente ao então do cenário "email não informado"
#substituo a string por expect_message (mensagem esperada)
Então('devo ver a mensagem: {string}') do |expect_message|
    alert = find(".message p")
    expect(alert.text).to eql expect_message
end

Quando('acesso a página de cadastro') do
    #aqui estou chamando a pré-condição do step Dado que acesso o cadastro
    steps %( 
        Dado que acesso a página de cadastro 
    )
end
  
Então('deve exibir o seguinte css: {string}') do |expect_css|
    expect(page).to have_css
end