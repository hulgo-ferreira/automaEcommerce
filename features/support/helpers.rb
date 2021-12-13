#importando httparty dentro do módulo helpers
require "httparty"

module Helpers

    #informando o nome do método como deloren
    #em deloren estou passando um argumento email
    def delorean(email)
        HTTParty.get("http://localhost/e-commerce/index.php/helpers?email=#{email}")
    end

end