function addToCart() {
    // criar elemento de pop-up
    const popup = document.createElement("div");
    popup.className = "popup";
    popup.innerHTML = "Produto adicionado ao carrinho!";
    
    // adicionar pop-up à página
    document.body.appendChild(popup);
    
    // remover pop-up após 3 segundos
    setTimeout(function() {
      document.body.removeChild(popup);
    }, 50000);
  }
  
  // associar função ao botão "Adicionar ao carrinho"
  const addToCartBtn = document.getElementById("add-to-cart-btn");
  addToCartBtn.addEventListener("click", addToCart);
  