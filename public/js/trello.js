let tablero = document.getElementById("tablero");
let tarjetaArrastrada = null;

function crearLista(titulo) {
  let lista = document.createElement("div");
  lista.className = "lista";

  let listaTitulo = document.createElement("h2");
  listaTitulo.className = "lista-titulo";
  listaTitulo.textContent = titulo;

  let contenedorTarjetas = document.createElement("div");
  contenedorTarjetas.style.padding = "5px";
  contenedorTarjetas.style.border = "1px dashed transparent";

  contenedorTarjetas.addEventListener("dragover", (e) => {
    e.preventDefault();
    contenedorTarjetas.style.border = "1px dashed #aaa";
  });

  contenedorTarjetas.addEventListener("dragleave", () => {
    contenedorTarjetas.style.border = "1px dashed transparent";
  });

  contenedorTarjetas.addEventListener("drop", (e) => {
    e.preventDefault();
    contenedorTarjetas.style.border = "1px dashed transparent";
    if (tarjetaArrastrada) {
      contenedorTarjetas.append(tarjetaArrastrada);
      tarjetaArrastrada = null;
    }
  });

  let crearTarjeta = document.createElement("button");
  crearTarjeta.className = "crear-tarjeta";
  crearTarjeta.textContent = "Añadir tarjeta";
  crearTarjeta.addEventListener("click", () =>
    agregarTarjeta(contenedorTarjetas)
  );

  let eliminarLista = document.createElement("button");
  eliminarLista.className = "eliminar-lista";
  eliminarLista.textContent = "Eliminar lista";
  eliminarLista.addEventListener("click", () => {
    lista.remove();
  });

  lista.append(listaTitulo, contenedorTarjetas, crearTarjeta, eliminarLista);
  tablero.append(lista);
}

function agregarTarjeta(contenedor) {
  let tarjeta = document.createElement("div");
  tarjeta.className = "tarjeta";
  tarjeta.style.position = "relative";
  tarjeta.style.paddingBottom = "20px";
  tarjeta.style.background = "white";
  tarjeta.style.padding = "10px";
  tarjeta.style.margin = "5px 0";
  tarjeta.style.borderRadius = "5px";
  tarjeta.style.boxShadow = "0px 2px 5px rgba(0, 0, 0, 0.2)";

  tarjeta.draggable = true;

  tarjeta.addEventListener("dragstart", (e) => {
    tarjetaArrastrada = tarjeta;
    setTimeout(() => {
      tarjeta.style.opacity = "0.5";
    }, 0);
  });

  tarjeta.addEventListener("dragend", () => {
    tarjeta.style.opacity = "1";
  });

  let texto = document.createElement("span");
  texto.textContent = "Nueva tarjeta";
  texto.style.display = "block";
  texto.style.overflowWrap = "break-word";

  texto.addEventListener("dblclick", () => editarTexto(texto));

  let eliminarTarjeta = document.createElement("button");
  eliminarTarjeta.style.border = "none";
  eliminarTarjeta.style.background = "transparent";
  eliminarTarjeta.style.cursor = "pointer";
  eliminarTarjeta.style.position = "absolute";
  eliminarTarjeta.style.bottom = "5px";
  eliminarTarjeta.style.right = "5px";

  let icono = document.createElement("i");
  icono.classList.add("fa-solid", "fa-trash-can");

  eliminarTarjeta.append(icono);

  eliminarTarjeta.addEventListener("click", () => {
    tarjeta.remove();
  });

  tarjeta.append(texto, eliminarTarjeta);
  contenedor.append(tarjeta);
}

function editarTexto(elemento) {
  let input = document.createElement("input");
  input.type = "text";
  input.value = elemento.textContent;

  input.addEventListener("blur", () => {
    elemento.textContent = input.value.trim() || "Nueva tarjeta";
    elemento.style.display = "inline";
    input.remove();
  });

  input.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      input.blur();
    }
  });

  elemento.style.display = "none";
  elemento.before(input);
  input.focus();
}

crearLista("Para hacer");
crearLista("En progreso");
crearLista("Finalizado");
