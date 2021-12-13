#importar o capybara dentro do cucumber
require "capybara"
require "capybara/cucumber"

#chamando o arquivo
require_relative "helpers"

#carrega o módulo onde todos os módulos que estão dentro do Helpers se tornem execuções nativas
World(Helpers)

# configurando o capybara
Capybara.configure do |config|
    config.default_driver = :selenium_chrome
end