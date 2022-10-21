function abrir_menu(){
    // const menu = document.getElementsByClassName("login");
    const container = document.getElementById("container");
     const abridor = document.getElementById("login");
     const header = document.getElementById("header");
     const footer = document.getElementById("footer");
     const navegador = document.getElementById("navegador");
     const abrirmobil = document.getElementById("cont-abridor-mobil");
     
 if(!abierto){
     abridor.style.transform = "translateX(0vw)";
     navegador.style.display = "block";
     navegador.style.transform = "translateX(-100vw)";
     container.style.transform = "translateX(-100vw)";
     header.style.transform = "translateX(-100vw)";
     footer.style.transform = "translateX(-100vw)";
     abrirmobil.style.left = "-6vw";
     abierto = true;
     
     container.addEventListener("click",abrir_menu);
 
 }
 else{
    abierto = false;
    container.removeEventListener("click", abrir_menu);
    abridor.style.transform = "translateX(100vw)";
    navegador.style.transform = "translateX(100vw)";
    navegador.style.display = "none";
    container.style.transform = "translateX(0vw)";
    header.style.transform = "translateX(0vw)";
    footer.style.transform = "translateX(0vw)";
    abrirmobil.style.left = "3vw";
    
     
}
}



function abririnput(){

    const container = document.getElementById("container");
    const inputmobil = document.getElementById("buscador");
    if(!abierto){
        inputmobil.style.display = "block";
        abierto = true;
        container.addEventListener("click",abririnput);
    }
    else{
       abierto = false;
       container.removeEventListener("click", abririnput);
       inputmobil.style.display = "none";
    }
}