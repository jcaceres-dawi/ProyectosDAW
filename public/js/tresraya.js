let turno = 0;

//Creación del tablero

for (i = 0; i < 9; i++) {
    document.getElementById("tablero").innerHTML += `<img src='../images/tablero.jpg' class='casillas' id='${i}' onclick='desvelar(${i})'>`
    if (i == 2 || i == 5) {
        document.getElementById("tablero").innerHTML += `<br>`
    }
}

//Función que pinta una x o una o según el turno

function desvelar(id) {
    if (turno % 2 == 0) {
        document.getElementById(id).src = "../images/x.jpg";
        turno++;
        comprobarGanador();
    } else {
        document.getElementById(id).src = "../images/o.jpg";
        turno++;
        comprobarGanador();
    }
}

//Función que comprueba si hay ganador

function comprobarGanador() {
    let imagenes = document.getElementsByTagName("img");

    //Comprobar ganador horizontalmente

    for (i = 0; i < 9; i+=3) {
        if ((imagenes[i].src.includes("images/x.jpg")) && (imagenes[i + 1].src.includes("images/x.jpg")) && (imagenes[i + 2].src.includes("images/x.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 1 ha ganado</h2>`;
        }
        if ((imagenes[i].src.includes("images/o.jpg")) && (imagenes[i + 1].src.includes("images/o.jpg")) && (imagenes[i + 2].src.includes("images/o.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 2 ha ganado</h2>`;
        }
    }

    //Comprobar ganador verticalmente

    for (i = 0; i < 3; i++) {
        if ((imagenes[i].src.includes("images/x.jpg")) && (imagenes[i + 3].src.includes("images/x.jpg")) && (imagenes[i + 6].src.includes("images/x.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 1 ha ganado</h2>`;
        }
        if ((imagenes[i].src.includes("images/o.jpg")) && (imagenes[i + 3].src.includes("images/o.jpg")) && (imagenes[i + 6].src.includes("images/o.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 2 ha ganado</h2>`;
        }
    }

    //Comprobar ganador diagonalmente

    for (i = 0; i < 2; i++) {
        if ((imagenes[i].src.includes("images/x.jpg")) && (imagenes[i + 4].src.includes("images/x.jpg")) && (imagenes[i + 8].src.includes("images/x.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 1 ha ganado</h2>`;
        }
        if ((imagenes[i].src.includes("images/o.jpg")) && (imagenes[i + 4].src.includes("images/o.jpg")) && (imagenes[i + 8].src.includes("images/o.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 2 ha ganado</h2>`;
        }
    }

    for (i = 0; i < 2; i++) {
        if ((imagenes[i + 2].src.includes("images/x.jpg")) && (imagenes[i + 4].src.includes("images/x.jpg")) && (imagenes[i + 6].src.includes("images/x.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 1 ha ganado</h2>`;
        }
        if ((imagenes[i + 2].src.includes("images/o.jpg")) && (imagenes[i + 4].src.includes("images/o.jpg")) && (imagenes[i + 6].src.includes("images/o.jpg"))) {
            document.getElementById("ganador").innerHTML = `<h2>Jugador 2 ha ganado</h2>`;
        }
    }

}