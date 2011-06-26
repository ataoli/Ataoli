<?php     
/*autosuggest by orlando garcia don't delete this comment live on the freedom*/
    require("../../xajax/xajax.inc.php");
    $xajax = new xajax();
  //  $xajax->setCharEncoding('ISO-8859-1');
  //$xajax->decodeUTF8InputOn();

    function sugiere($valor) 
    {
    $respuesta = new xajaxResponse('ISO-8859-1');

              
                $sql = "SELECT sustancia_activa as sustancia,descripcion   FROM cat_sustancia_activa where sustancia_activa~'$valor' ORDER BY sustancia_activa ";

            $query = pg_query($sql);
            if(pg_num_rows($query)==0)
            {
           
            $respuesta->addAssign("contenedor","style.display","none");
            }
            else{
            $cont=0;
            while($result=pg_fetch_object($query))
            {
                   $cont++;
                $pinta .= "<li id='$cont'  onclick='document.getElementById(\"buscar\").value=$result->sustancia;document.getElementById(\"contenedor\").style.display=\"none\"'><label class='aum' id='e$cont'>$result->sustancia</label><label class='aum'>-></label>$result->descripcion</li>";
            }
           
            $respuesta->addAssign("contenedor", "innerHTML", "<ul  id='lista'>$pinta</ul>");
            $respuesta->addAssign("contenedor","style.display","block");
            }
          //  $respuesta->addScript("contenedor.scrollTop=0");
            return $respuesta;

    }
    $xajax->registerFunction("sugiere");
    $xajax->processRequests();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php $xajax->printJavascript("../../xajax/"); ?>
<style type="text/css">
ul{list-style:none;}
#contenedor {
    position:relative;
text-align:justify;
height:200px;
background-color: white;
z-index:1002;
overflow: auto;
overflow-x:hidden;
font-size: 8pt;
font-family: Arial, Helvetica, sans-serif;
width:230px;

}
li:hover
{
background-color: #3366cc;
color:#ffffff;
}
.sel
{
  background-color: #3366cc;
  color:#ffffff;
  position:relative;
}
.nosel
{
background-color:#ffffff;
color:#000000;
  }
li {
border-left:1px solid;
border-right:1px solid;
border-top:1px dotted;
border-bottom:1px dotted;
text-decoration:none;
padding:5px;
margin: 0px;
  /*display: inline; For IE* menu horizontal*/

    }
.aum{
font-weight:bold;
  }
ul
  {
    margin: 0px;
    padding :0 5px;
  }
  .nselect
{
margin-left:3px;
width:218px;
font-size:6.5pt;
font-family: Arial, Helvetica, sans-serif;
}
</style>

<script type="text/javascript">
val=0;

function numeros(e)
{
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
if(key!=40 && key!=38){if(key==13 && val!=0){dat='e'+val;document.getElementById('buscar').value=document.getElementById(dat).innerHTML;document.getElementById('contenedor').innerHTML='';document.getElementById('contenedor').style.display='none';
}else{val=0;document.getElementById('contenedor').scrollTop =0;OnKeyRequestBuffer.modified('buscar');}}
                else{if (key==40){node = document.getElementById('lista');
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
document.getElementById('contenedor').scrollTop =alto;
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
                 document.getElementById('contenedor').scrollTop =alto;
                 document.getElementById(val).className='sel';
         }
         catch(e)
          {
          }
          }
}
}
}
</script>

<script>
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
            xajax_sugiere(xajax.$(strId).value);
        }
    }
    function pulsar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}
function limpia()
{
document.getElementById('contenedor').innerHTML='';
document.getElementById('contenedor').style.display='none';

}
function revisa()
{
if(document.getElementById('buscar').value!='')
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
    </script>
</head>
<body>
         <form onkeypress = "return pulsar(event)">   
                <div style="margin-left:72px;">
                <input type="text" id="buscar" name="buscar" onkeyup="if(revisa()=='si'){numeros(event)}
                else{limpia()}" class='nselect'/>
                <br/>
                <div id="contenedor" onmouseover="sobre()"></div>
                </div>
            </form>
</body>
</html>