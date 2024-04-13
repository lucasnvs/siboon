console.log("HOME - Olá, Mundo!");

for (let i = 0; i < 10; i++) {
    document.querySelector(".container").innerHTML += "            <div class=\"product-container\">\n" +
        "                <div class=\"image-container\">\n" +
        "                    <img src=\"assets/imgs/camisa-independent.jpeg\">\n" +
        "                </div>\n" +
        "                <div class=\"product-description\">\n" +
        "                    <p class=\"title\">CAMISA INDEPENDENT BLACK OVERSIZED - Truck Co.</p>\n" +
        "                    <p class=\"price\">R$ 199,90</p>\n" +
        "                    <p class=\"price\">ou R$180,00 no PIX</p>\n" +
        "                </div>\n" +
        "                <div class=\"sizes\">\n" +
        "                    <button class=\"size\">P</button>\n" +
        "                    <button class=\"size\">M</button>\n" +
        "                    <button class=\"size\">G</button>\n" +
        "                    <button class=\"size\">GG</button>\n" +
        "                </div>\n" +
        "                <!-- seletor de tamanho -->\n" +
        "                <!-- se não tiver selecionado aparece --> <span>SELECIONE O TAMANHO</span>\n" +
        "                <!-- se estiver, aparece o botão -->\n" +
        "                <button class=\"btn\">ADICIONAR NA SACOLA</button>\n" +
        "            </div>\n"
}