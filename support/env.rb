require "allure-cucumber"
require "capybara"
require "capybara/cucumber"
require "selenium-webdriver"
require "httparty"
require "rspec"

Capybara.configure do |config|
	config.default_driver = :selenium_chrome	
	config.default_max_wait_time = 10
	#config.default_driver = :selenium_headless	#Executa sem levantar o browser
	#config.app_host = "http://172.25.5.21/hcosta/index.php"
end

AllureCucumber.configure do |config|
	config.results_directory = "/logs"
	config.clean_results_directory = true #limpa os relatorios cada vez que executta os testes
	config.link_issue_pattern = "https://nevescosta.atlassian.net/browse/{}"
	config.tms_prefix      = 'HIPTEST--'
    config.issue_prefix    = 'JIRA++'
    config.severity_prefix = 'SEVERITY:'
end

