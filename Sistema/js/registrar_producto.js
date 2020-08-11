var nombre= document.getElementById("nombre");
var categoria= document.getElementById("categoria");
var proveedores= document.getElementById("proveedores");
var cantidad= document.getElementById("cantidad");
var v_compra= document.getElementById("v_compra");
var v_venta= document.getElementById("v_venta");
var fecha = document.getElementById("fecha");
var descripcion = document.getElementById("descripcion");
var btn= document.getElementById("btn");
var cancelar= document.getElementById("cancelar");
var mensaje= document.getElementById("error");

var validar= function(e){

if(nombre.value=="" || categoria.value== "" || cantidad.value==""||
v_compra.value==""||v_venta.value==""|| proveedores.value=="")
{

	mensaje.innerHTML= "Complete Todos los campos Obligatorios";
	e.preventDefault(); 

	}else if(isNaN(cantidad.value)||isNaN(v_compra.value)||
		isNaN(v_venta.value)){
	mensaje.innerHTML= "Los campos cantidad,valor unitario,valor venta deben ser numeros";
	e.preventDefault();
}


}

var volver=function(){
	window.history.back();
}

btn.addEventListener("click",validar);
cancelar.addEventListener("click", volver);