After do    
   shot = page.save_screenshot("logs/shot_temp.png")          

    Allure.add_attachment(
        name: "validacao",
        type: Allure::ContentType::PNG,
        source: File.open(shot),                               
    )
end