
function Felino() {
    this.raza = "Felino";
    this.edad = function () { return this.anios * 9 }//Metodo de instancia
}
Felino.prototype.Hablar = function () { console.log("Miau") };//Metodo de clase

let felino1 = new Felino();
let felino2 = new Felino();

function Gato() {
    this.rasgar = function () { console.log("El gato rasga") }
}

let gato1 = new Gato();

Object.setPrototypeOf(gato1, felino1); //Indica que gato1 es hermano de una instancia de tipo Felino

console.log("Instancia de Gato: " + (gato1 instanceof Felino));


//A PARTIR DE ECMA SCRIPT 6 (2015)

class nombreDeClase extends clasePadre { /* class y extends seguidos del nombre de la clase y la clase padre respectivamente*/
    propiedadPublica = valorDefecto; /* declaración de propiedad pública con valor por defecto */
    #propiedadPrivada = valorDefecto; /* declaración de propiedad privada con valor por defecto */
    static propiedadClase = valorDefecto; /* declaración de propiedad de clase con valor por defecto */
    constructor(par0, par1, par2, par3) { /* debe incluir un método llamado “constructor” el cual se invoca al realizara el “new” */
        super(par0); /* llamada al constructor de la clase padre */
        this.prop1 = par1; /* en el constructor se pueden los atributos(campos/fields) de clase y se inicializan */
        this.prop2 = par2;
        this.prop3 = par3 || valorPorDefecto; /* Todo parámetro puede ser NULL, se define valores por defecto para null */
    }
}


class Persona {
    constructor(nacionalidad) {
        this.nacionalidad = nacionalidad;
    }
    reportar() {
        console.log("Nacionalidad: "+this.nacionalidad);
    }
}

class Alumno extends Persona {
    constructor(nombre, apellido, dni, nacionalidad) {
        super(nacionalidad);
        this.nombre = nombre;
        this.apellido = apellido;
        this.dni = dni;
    }
    reportar(){
        super.reportar();
        console.log("Nombre. "+this.nombre);
    }
}

let alumuno1 = new Alumno("Max", "Payne", 515, "Argenchino");
