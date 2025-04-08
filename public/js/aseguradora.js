const provincias = {
  andalucia: ["Sevilla", "Granada", "Málaga"],
  cataluna: ["Barcelona", "Tarragona", "Girona"],
  galicia: ["A Coruña", "Lugo", "Pontevedra"],
};

const modelos = {
  toyota: ["Corolla", "Camry", "RAV4"],
  ford: ["Focus", "Mustang", "Explorer"],
  bmw: ["Serie 3", "Serie 5", "X5"],
};

const hoy = new Date();

// Función para actualizar las provincias en función de la región seleccionada
function actualizarProvincias() {
  const region = document.getElementById("region").value;
  const provinciaSelect = document.getElementById("provincia");
  provinciaSelect.innerHTML = "";

  provincias[region].forEach((provincia) => {
    const opcion = document.createElement("option");
    opcion.value = provincia.toLowerCase();
    opcion.textContent = provincia;
    provinciaSelect.appendChild(opcion);
  });
}

// Función para actualizar los modelos en función de la marca seleccionada
function actualizarModelos() {
  const marca = document.getElementById("marca").value;
  const modeloSelect = document.getElementById("modelo");
  modeloSelect.innerHTML = "";

  modelos[marca].forEach((modelo) => {
    const opcion = document.createElement("option");
    opcion.value = modelo.toLowerCase();
    opcion.textContent = modelo;
    modeloSelect.appendChild(opcion);
  });
}

// Evento para actualizar las provincias y el modelo y que aparezaca al cargar la página
document.addEventListener("DOMContentLoaded", () => {
  actualizarProvincias();
  actualizarModelos();
});

//Función para validar el formulario
function validarFormulario() {
  const nombre = document.getElementById("nombre").value;
  const apellidos = document.getElementById("apellidos").value;
  const dni = document.getElementById("dni").value;
  const correo = document.getElementById("correo").value;
  const telefono = document.getElementById("telefono").value;
  const codigoPostal = document.getElementById("codigoPostal").value;
  const fechaNacimiento = document.getElementById("fechaNacimiento").value;
  const fechaCarnet = document.getElementById("fechaCarnet").value;
  const fechaMatriculacion =
    document.getElementById("fechaMatriculacion").value;
  const matricula = document.getElementById("matricula").value;
  const fotoCarnet = document.getElementById("fotoCarnet").value;
  const terminos = document.getElementById("terminos").checked;
  const errores = document.getElementById("errores");

  const nombreRegex = /^[A-Za-záéíóúÁÉÍÓÚñÑ]{1,30}$/;
  const apellidosRegex = /^[A-Za-záéíóúÁÉÍÓÚñÑ]{1,30}$/;
  const dniRegex = /^\d{8}[A-Z]$/;
  const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const telefonoRegex = /^\d{9}$/;
  const codigoPostalRegex = /^\d{5}$/;
  const matriculaRegex = /^\d{4}-?[A-Z]{3}$/;
  const fotoCarnetRegex = /\.jpg$/i;

  const fechaNacimientoObj = new Date(fechaNacimiento);
  const fechaCarnetObj = new Date(fechaCarnet);
  const fechaMatriculacionObj = new Date(fechaMatriculacion);
  const edad = hoy.getFullYear() - fechaNacimientoObj.getFullYear();

  errores.innerHTML = "";
  let numErrores = 0;

  if (!nombreRegex.test(nombre) || !apellidosRegex.test(apellidos)) {
    const mensaje = document.createElement("li");
    mensaje.textContent =
      "Nombre y apellidos deben estar rellenados con solo letras y hasta 30 caracteres cada uno.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!dniRegex.test(dni)) {
    const mensaje = document.createElement("li");
    mensaje.textContent =
      "DNI debe tener un formato válido: ocho dígitos y una letra mayúscula.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!correoRegex.test(correo)) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "Correo electrónico no válido.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!telefonoRegex.test(telefono)) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "Teléfono debe tener 9 dígitos numéricos.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!fechaNacimiento) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "Debes introducir una fecha de nacimiento.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!fechaCarnet) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "Debes introducir una fecha de obtención del carnet.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!fechaMatriculacion) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "Debes introducir una fecha de matriculación.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (edad < 18) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "Debes ser mayor de 18 años.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (fechaCarnetObj > hoy) {
    const mensaje = document.createElement("li");
    mensaje.textContent =
      "La fecha del carnet no puede ser posterior a la fecha actual.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (fechaMatriculacionObj > hoy) {
    const mensaje = document.createElement("li");
    mensaje.textContent =
      "La fecha de matriculación no puede ser posterior a la fecha actual.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!matriculaRegex.test(matricula)) {
    const mensaje = document.createElement("li");
    mensaje.textContent =
      "La matrícula debe tener un formato válido (e.g., 1234-ABC).";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!codigoPostalRegex.test(codigoPostal)) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "El código postal debe tener 5 dígitos numéricos.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!fotoCarnetRegex.test(fotoCarnet)) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "El fichero debe ser de tipo jpg.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (!terminos) {
    const mensaje = document.createElement("li");
    mensaje.textContent = "Debes aceptar los términos y condiciones.";
    errores.appendChild(mensaje);
    numErrores++;
  }

  if (numErrores == 0) {
    document.getElementById("errores").style.backgroundColor = "";
    document.getElementById("errores").style.boxShadow = "";
    document.getElementById("errores").style.padding = "";
    calcularSeguro(edad, fechaCarnetObj, fechaMatriculacionObj);
  } else {
    document.getElementById("errores").style.backgroundColor = "#fff";
    document.getElementById("errores").style.boxShadow =
      "0 0 10px rgba(0, 0, 0, 0.1)";
    document.getElementById("errores").style.padding = "20px";
  }
}

// Evento para validar el formulario
document.getElementById("formulario").addEventListener("submit", (event) => {
  event.preventDefault();
  validarFormulario();
});

// Función para crear la tarjeta de seguro
function crearTarjetaSeguro(tipoSeguro, precio, edad, añosCarnet, tipoVehiculo, antiguedadCoche) {
  const tarjeta = document.createElement("div");
  tarjeta.className = "targeta";
  tarjeta.innerHTML = `<strong>${tipoSeguro}</strong><br>`;
  tarjeta.innerHTML += `Edad del conductor: ${edad}<br>`;
  tarjeta.innerHTML += `Años con el carnet: ${añosCarnet}<br>`;
  tarjeta.innerHTML += `Tipo de vehículo: ${tipoVehiculo}<br>`;
  tarjeta.innerHTML += `Años del coche: ${antiguedadCoche}<br>`;
  tarjeta.innerHTML += `Precio del seguro: ${precio.toFixed(2)}€`;

  const eliminar = document.createElement("button");
  eliminar.textContent = "Eliminar";
  eliminar.classList.add("eliminar");
  tarjeta.appendChild(eliminar);

  eliminar.addEventListener("click", () => {
    tarjeta.remove();
  });

  const contratar = document.createElement("button");
  contratar.textContent = "Contratar";
  contratar.classList.add("contratar");
  tarjeta.appendChild(contratar);

  contratar.addEventListener("click", () => {
    alert("Gracias por contratar. Atentamente tu asesor de seguros");
  });

  return tarjeta;
}

// Función para calcular el seguro
function calcularSeguro(edad, fechaCarnet, fechaMatriculacion) {
  const tipoVehiculo = document.getElementById("vehiculo").value;
  const tipoSeguro = document.getElementById("seguro").value;
  const añosCarnet = hoy.getFullYear() - fechaCarnet.getFullYear();
  const antiguedadCoche = hoy.getFullYear() - fechaMatriculacion.getFullYear();

  let precioTerceros = 500;
  let precioTercerosAmpliado = 650;
  let precioConFranquicia = 750;
  let precioTodoRiesgo = 1000;

  if (edad < 25) {
    precioTerceros += precioTerceros * 0.1;
    precioTercerosAmpliado += precioTercerosAmpliado * 0.1;
    precioConFranquicia += precioConFranquicia * 0.1;
    precioTodoRiesgo += precioTodoRiesgo * 0.1;
  }

  if (añosCarnet > 5) {
    precioTerceros -= precioTerceros * 0.1;
    precioTercerosAmpliado -= precioTercerosAmpliado * 0.1;
    precioConFranquicia -= precioConFranquicia * 0.1;
    precioTodoRiesgo -= precioTodoRiesgo * 0.1;
  }

  switch (tipoVehiculo) {
    case "diesel":
      precioTerceros += precioTerceros * 0.2;
      precioTercerosAmpliado += precioTercerosAmpliado * 0.2;
      precioConFranquicia += precioConFranquicia * 0.2;
      precioTodoRiesgo += precioTodoRiesgo * 0.2;
      break;
    case "gasolina":
      precioTerceros += precioTerceros * 0.15;
      precioTercerosAmpliado += precioTercerosAmpliado * 0.15;
      precioConFranquicia += precioConFranquicia * 0.15;
      precioTodoRiesgo += precioTodoRiesgo * 0.15;
      break;
    case "hibrido":
      precioTerceros += precioTerceros * 0.05;
      precioTercerosAmpliado += precioTercerosAmpliado * 0.05;
      precioConFranquicia += precioConFranquicia * 0.05;
      precioTodoRiesgo += precioTodoRiesgo * 0.05;
      break;
  }

  if (antiguedadCoche > 10) {
    const penalizacion = (antiguedadCoche - 10) * 0.01;
    precioTerceros += precioTerceros * penalizacion;
    precioTercerosAmpliado += precioTercerosAmpliado * penalizacion;
    precioConFranquicia += precioConFranquicia * penalizacion;
    precioTodoRiesgo += precioTodoRiesgo * penalizacion;
  }

  const resultado = document.getElementById("resultado");
  resultado.innerHTML = "";

  const tarjetaTerceros = crearTarjetaSeguro("Terceros", precioTerceros, edad, añosCarnet, tipoVehiculo, antiguedadCoche);
  const tarjetaTercerosAmpliado = crearTarjetaSeguro("Terceros Ampliado", precioTercerosAmpliado, edad, añosCarnet, tipoVehiculo, antiguedadCoche);
  const tarjetaConFranquicia = crearTarjetaSeguro("Con Franquicia", precioConFranquicia, edad, añosCarnet, tipoVehiculo, antiguedadCoche);
  const tarjetaTodoRiesgo = crearTarjetaSeguro("Todo Riesgo", precioTodoRiesgo, edad, añosCarnet, tipoVehiculo, antiguedadCoche);

  if (tipoSeguro === "terceros") {
    tarjetaTerceros.classList.add("targetaSeleccionada");
  } else if (tipoSeguro === "tercerosAmpliado") {
    tarjetaTercerosAmpliado.classList.add("targetaSeleccionada");
  } else if (tipoSeguro === "conFranquicia") {
    tarjetaConFranquicia.classList.add("targetaSeleccionada");
  } else if (tipoSeguro === "todoRiesgo") {
    tarjetaTodoRiesgo.classList.add("targetaSeleccionada");
  }
  
  resultado.appendChild(tarjetaTerceros);
  resultado.appendChild(tarjetaTercerosAmpliado);
  resultado.appendChild(tarjetaConFranquicia);
  resultado.appendChild(tarjetaTodoRiesgo);
}

