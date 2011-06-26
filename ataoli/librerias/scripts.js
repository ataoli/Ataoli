// En Javascript
///sugiere



val=0;

function numeros(e,item_cie,Vtipo,Tabla,Campo,Campo_descripcion)
{
window["item_cie"] = item_cie;
window["Vinput"] = "buscar"+item_cie;
window["Vcontenedor"] = "contenedor"+item_cie;
window["Vtipo"] = Vtipo;
window["Tabla"] = Tabla;
window["Campo"] = Campo;
window["Campo_descripcion"] = Campo_descripcion;

var key;
if(window.event) // IE
{
  key = e.keyCode;
  nav='ie';
}
  else if(e.which) // Netscape/Firefox/Opera
{
  key = e.which;
  nav='otro';
}
if(key!=40 && key!=38){if(key==13 && val!=0){dat='e'+val;document.getElementById(Vinput).value=document.getElementById(dat).innerHTML;document.getElementById(Vcontenedor).innerHTML='';document.getElementById(Vcontenedor).style.display='none';
}else{val=0;document.getElementById(Vcontenedor).scrollTop =0;OnKeyRequestBuffer.modified(Vinput);}}
                else{if (key==40){node = document.getElementById('lista'+item_cie);
          if(val<node.childNodes.length)
          {
          try{
          document.getElementById(val).className='nosel';
          }
          catch(e)
          {
          }
val++;
alto=document.getElementById(val).offsetTop;
document.getElementById(Vcontenedor).scrollTop =alto;
document.getElementById(val).className='sel';
}
}
          if (key==38){
          if(val>=1)
          {
          document.getElementById(val).className='nosel';
          try{
                   val--;
                   alto=document.getElementById(val).offsetTop;
                 document.getElementById(Vcontenedor).scrollTop =alto;
                 document.getElementById(val).className='sel';
         }
         catch(e)
          {
          }
          }
}
}
}

    var OnKeyRequestBuffer =
    {
        bufferText: false,
        bufferTime: 500,
       
        modified : function(strId)
        {
                setTimeout('OnKeyRequestBuffer.compareBuffer("'+strId+'","'+xajax.$(strId).value+'");', this.bufferTime);
        },
       
        compareBuffer : function(strId, strText)
        {
            if (strText == xajax.$(strId).value && strText != this.bufferText)
            {
                this.bufferText = strText;
                OnKeyRequestBuffer.makeRequest(strId);
            }
        },
       
        makeRequest : function(strId)
        {
       
            this.bufferText = '';
            if(Vtipo == "generico"){
            xajax_sugiere_generico(xajax.$(strId).value,item_cie,Tabla,Campo,Campo_descripcion);
            }else{
            xajax_sugiere(xajax.$(strId).value,item_cie);
            }
        }
    }
    function pulsar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}
function limpia(Vcontenedor)
{
document.getElementById(Vcontenedor).innerHTML='';
document.getElementById(Vcontenedor).style.display='none';

}
function revisa(Vinput)
{
if(document.getElementById(Vinput).value!='')
{
return 'si';
}
else
{
return 'no';
}
}
function sobre()
{
try{document.getElementById(val).className='nosel';val=0;}catch(e){}

}

// finsugiere


function uno(src,color_entrada) {
    src.bgColor=color_entrada;src.style.cursor="hand";
}
function dos(src,color_default) {
    src.bgColor=color_default;src.style.cursor="default";
}


   function SoloCerrar(){
window.close()
}

function actualizar()
{
location.reload();
}
   function amplia(){
    resizeTo(screen.width-10,screen.height-80)
    moveTo(0, 0);
   }
   
function abrir(ventana,nombre,a,b,c,d,v,r)
{
e='width='+a+','
f='height='+b+','
g='screenx='+c+','
h='screeny='+d+','
s='scrollbars='+v+','
j='alwaysRaised='+r+','
hola=window.open(ventana,nombre,e+f+g+h+s+j);
hola.focus()
}

function toggleDiv(id,flagit) {

if (flagit=="1"){
if (document.layers) document.layers[''+id+''].visibility = "show"
else if (document.all) document.all[''+id+''].style.visibility = "visible"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"
}
else
if (flagit=="0"){
if (document.layers) document.layers[''+id+''].visibility = "visible"
else if (document.all) document.all[''+id+''].style.visibility = "hidden"
else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"
}
}


