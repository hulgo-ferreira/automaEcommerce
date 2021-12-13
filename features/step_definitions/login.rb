Dado('que acesso a página de login') do
    visit "http://localhost/e-commerce/" #visitando url
    find("body > div.nav-wrapper > div.navbar > div > div:nth-child(1) > div.dropdown-toggler > div > a").click
    click_on "Entrar"
end
  
Quando('submeto o minhas credenciais com: {string} e {string}') do |email, password|
    find("input[name=email]").set email
    find("input[name=senha]").set password
    find("button[class=button]").click
end