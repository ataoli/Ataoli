<?php 
function fechador(){
$fechador="
<select name='ano' size='1'> 
";
if ($ano==''){ $fechador="<option value='' selected >A&Ntilde;O</option>";}
else{ $fechador="<option value='$ano' selected >$ano</option>";}
$fechador .="
<option value='1910'>1900</option>
<option value='1910'>1901</option>
<option value='1910'>1902</option>
<option value='1910'>1903</option>
<option value='1910'>1904</option>
<option value='1910'>1905</option>
<option value='1910'>1906</option>
<option value='1910'>1907</option>
<option value='1910'>1908</option>
<option value='1910'>1909</option>
<option value='1910'>1910</option>
<option value='1911'>1911</option>
<option value='1912'>1912</option>
<option value='1913'>1913</option>
<option value='1914'>1914</option>
<option value='1915'>1915</option>
<option value='1916'>1916</option>
<option value='1917'>1917</option>
<option value='1918'>1918</option>
<option value='1919'>1919</option>
<option value='1920'>1920</option>
<option value='1921'>1921</option>
<option value='1922'>1922</option>
<option value='1923'>1923</option>
<option value='1924'>1924</option>
<option value='1925'>1925</option>
<option value='1926'>1926</option>
<option value='1927'>1927</option>
<option value='1928'>1928</option>
<option value='1929'>1929</option>
<option value='1930'>1930</option>
<option value='1931'>1931</option>
<option value='1932'>1932</option>
<option value='1933'>1933</option>
<option value='1934'>1934</option>
<option value='1935'>1935</option>
<option value='1936'>1936</option>
<option value='1937'>1937</option>
<option value='1938'>1938</option>
<option value='1939'>1939</option>
<option value='1940'>1940</option>
<option value='1941'>1941</option>
<option value='1942'>1942</option>
<option value='1943'>1943</option>
<option value='1944'>1944</option>
<option value='1945'>1945</option>
<option value='1946'>1946</option>
<option value='1947'>1947</option>
<option value='1948'>1948</option>
<option value='1949'>1949</option>
<option value='1950'>1950</option>
<option value='1951'>1951</option>
<option value='1952'>1952</option>
<option value='1953'>1953</option>
<option value='1954'>1954</option>
<option value='1955'>1955</option>
<option value='1956'>1956</option>
<option value='1957'>1957</option>
<option value='1958'>1958</option>
<option value='1959'>1959</option>
<option value='1960'>1960</option>
<option value='1961'>1961</option>
<option value='1962'>1962</option>
<option value='1963'>1963</option>
<option value='1964'>1964</option>
<option value='1965'>1965</option>
<option value='1966'>1966</option>
<option value='1967'>1967</option>
<option value='1968'>1968</option>
<option value='1969'>1969</option>
<option value='1970'>1970</option>
<option value='1971'>1971</option>
<option value='1972'>1972</option>
<option value='1973'>1973</option>
<option value='1974'>1974</option>
<option value='1975'>1975</option>
<option value='1976'>1976</option>
<option value='1977'>1977</option>
<option value='1978'>1978</option>
<option value='1979'>1989</option>
<option value='1980'>1980</option>
<option value='1981'>1981</option>
<option value='1982'>1982</option>
<option value='1983'>1983</option>
<option value='1984'>1984</option>
<option value='1985'>1985</option>
<option value='1986'>1986</option>
<option value='1987'>1987</option>
<option value='1988'>1988</option>
<option value='1989'>1989</option>
<option value='1990'>1990</option>
<option value='1991'>1991</option>
<option value='1992'>1992</option>
<option value='1993'>1993</option>
<option value='1994'>1994</option>
<option value='1995'>1995</option>
<option value='1996'>1996</option>
<option value='1997'>1997</option>
<option value='1998'>1998</option>
<option value='1999'>1999</option>
<option value='2000'>2000</option>
<option value='2001'>2001</option>
<option value='2002'>2002</option>
<option value='2003'>2003</option>
<option value='2004'>2004</option>
<option value='2005'>2005</option>
<option value='2006'>2006</option>
<option value='2007'>2007</option>
<option value='2008'>2008</option>
<option value='2009'>2009</option>
<option value='2010'>2010</option>
</select>

<select name='mes' size='1'> 
";
if ($mes==''){ $fechador="<option value='' selected >MES</option>";}
else{ $fechador="<option value='$mes' selected >$mes_letras</option>";}
$fechador="
<option value='01'>Enero</option>
<option value='02'>Febrero</option>
<option value='03'>Marzo</option>
<option value='04'>Abril</option>
<option value='05'>Mayo</option>
<option value='06'>Junio</option>
<option value='07'>Julio</option>
<option value='08'>Agosto</option>
<option value='09'>Septiembre</option>
<option value='10'>Octubre</option>
<option value='11'>Noviembre</option>
<option value='12'>Diciembre</option>
</select>

<select name='dia' size='1'> 
";
if ($dia==''){$fechador="<option value='' selected >D&Iacute;A</option>";}
else{ $fechador="<option value='$dia' selected >$dia</option>";}
$fechador .="
<option value='1'>01</option>
<option value='2'>02</option>
<option value='3'>03</option>
<option value='4'>04</option>
<option value='5'>05</option>
<option value='6'>06</option>
<option value='7'>07</option>
<option value='8'>08</option>
<option value='9'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select></td></tr>
";
}<?php
$control_version = '0aa0b6b3207f0b3839381db1962574a2'; 
/*  ATENCION: Puede existir una versión mas reciente de este archivo en http://GaleNUx.com
    por favor compruebelo antes de modificarlo. control de versión [0aa0b6b3207f0b3839381db1962574a2]
    
    Copyright ©  13-22-2/ 17-Dic-2008 Dirección nacional de derechos de autor Colombia 
    http://GaleNUx.com Es un sistema para de información para la salud adaptado al sistema
    de salud Colombiano.
    
    Si necesita consultoría o capacitación en el manejo, instalación y/o soporte o 
    ampliación de prestaciones de GaleNUx por favor comuniquese con nosotros 
    al email praxis@galenux.com.

    Este programa es software libre: usted puede redistribuirlo y/o modificarlo 
    bajo los términos de la Licencia Pública General GNU publicada 
    por la Fundación para el Software Libre, ya sea la versión 3 
    de la Licencia, o cualquier versión posterior.

    Este programa se distribuye con la esperanza de que sea útil, pero 
    SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita 
    MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO. 
    Consulte los detalles de la Licencia Pública General GNU para obtener 
    una información más detallada. 

    Debería haber recibido una copia de la Licencia Pública General GNU 
    junto a este programa. 
    En caso contrario, consulte <http://www.gnu.org/licenses/>.
    
    POR FAVOR CONSERVE ESTA NOTA SI EDITA ESTE ARCHIVO

 */ 
?>