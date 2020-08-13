(function(){
	// variables

var lista= document.getElementById("lista"),
	tabla=document.getElementById("tabla"),
	tareaInput=document.getElementById("tareaInput"),
	codigo=document.getElementById("codigo"),
	nombre_p=document.getElementById("nombre_p"),
	valor_venta=document.getElementById("v_ventas"),
	cantidad=document.getElementById("cant"),
	boton= document.getElementById("btn-agregar");
	

	// funciones
var agregarTarea= function(){
	var tarea = codigo.value,
	nuevaTarea = document.createElement("input");
	nuevaTarea.setAttribute("type", "text");
	nuevaTarea.setAttribute("class", "input_venta");
	nuevaTarea.setAttribute("name", "codigo_producto");
	nuevaTarea.setAttribute("value", tarea);
	lista.appendChild(nuevaTarea);	

	var nombre= nombre_p.value,
	nuevaTarea2 = document.createElement("input");
	nuevaTarea2.setAttribute("type", "text");
	nuevaTarea2.setAttribute("class", "input_venta");
	nuevaTarea2.setAttribute("name", "nombre");
	nuevaTarea2.setAttribute("value", nombre);
	lista.appendChild(nuevaTarea2);

	var venta= valor_venta.value,
	nuevaTarea3 = document.createElement("input");
	nuevaTarea3.setAttribute("type", "text");
	nuevaTarea3.setAttribute("class", "input_venta");
	nuevaTarea3.setAttribute("name", "venta");
	nuevaTarea3.setAttribute("value", venta);

	lista.appendChild(nuevaTarea3);

	var cant_ingresada= cantidad.value,
	nuevaTarea4 = document.createElement("input");
	nuevaTarea4.setAttribute("type", "text");
	nuevaTarea4.setAttribute("class", "input_venta");
	nuevaTarea4.setAttribute("name", "cant");
	nuevaTarea4.setAttribute("value", cant_ingresada);

	
	lista.appendChild(nuevaTarea4);




	//document.body.appendChild(nuevaTarea);
	// agregamos el contenido al enlace
	//establecemos un atributo href
	//agregamos el enlace a a la nueva tarea li
	//agregamos nueva tarea a la lista
	 // vuelve el input a estar limpio
for(var i=0; i<lista.children.length;i++){

		lista.children[i].addEventListener("click", eliminarTarea);

	}


};
var comprobarInput= function(){


};
var eliminarTarea= function(){
	
this.parentNode.removeChild(this);

};

	// eventos
	// agregar tarea



	boton.addEventListener("click", agregarTarea);
	//comprobar input
	tareaInput.addEventListener("click", comprobarInput);
	//Borrando elementos de la lista
	for(var i=0; i<lista.children.length-1;i++){

		lista.children[i].addEventListener("click", eliminarTarea);

	}

}());