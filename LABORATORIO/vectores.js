

let vector = new Array();
vector = [];
vector[0] = "Max";
vector = ["Kali", "Gato"];

let frutas = ["banana", "manzana", "limon", "pera", "naranja"];

frutas.length;

frutas.push("mandarina");
frutas.unshift("mandarina");

frutas.pop();
frutas.shift("kiwi");

frutas.splice(3, 4, "uva");//Remueve o inserta (<desde>, <cuantos>, <item agregado>)

frutas.sort((a, b) => {
    if (a > b)
        return 1;
    else if (a < b)
        return -1
    else
        return 0;
});

let numeros = [1, 61, 3];
let numeros2 = numeros.map((elemento, indice, vector) => {
    return { "valor": elemento, "posicion": indice };
});

let numeros3 = numeros.map((e, i, v) => { return e * i });

//reduce

//filter

//VER METODOS JSON