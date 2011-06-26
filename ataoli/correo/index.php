<html xmlns="http://www.w3.org/1999/xhtml"xml:lang="es" lang="es" dir="ltr">
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head><title>Mail</title></head>
<body>
<table><tr><td>
<?php

$host='{localhost:143/imap/novalidate-cert}INBOX'; //Host to connect
$user='autorizaciones+sanjuandediosarmenia.net';
$pass='HuSdA4730';
$from='autorizaciones@sanjuandediosarmenia.net'; //Mail to send from
$cadena="[[";
$mail=@imap_open($host,$user,$pass) or die("Can't connect: " . imap_last_error());
////****

// search only in the subvject for the string 'password'
$boxes = imap_search($mail, "SUBJECT $cadena ");
for ($i=0; $i<count($boxes); $i++) {
   echo "Match found in number: $boxes[$i]<BR>\n";
}

// search again but return the UID
$boxes = imap_search($mail, "SUBJECT $cadena ", SE_UID);
for ($i=0; $i<count($boxes); $i++) {
   echo "Match found in UID: $boxes[$i]<BR>\n";
}
//*****
if($_REQUEST['delete']) {
    $number=$_REQUEST['delete'];
    imap_delete($mail,$number);
    imap_expunge($mail);
}

if($_REQUEST['see']) {
    $number=$_REQUEST['see'];
 	 
    echo "<pre>";
    $chead=imap_headerinfo($mail,$number);
                $mid=ltrim($chead->Msgno);
                echo $chead->subject;
    //echo imap_headerinfo($mail,$number);
    echo imap_body($mail,$number);
    echo "</pre><p>\n\n";
       
    echo "<a href='javascript:history.back()'>Back</a>";
    echo "<br><a href='index.php?delete=$number'>Delete</a>";
       
} else {
    if($_REQUEST['create']=="new") {
        if($_POST['send_m']) {
            $to=$_POST['to'];
            $subject=$_POST['title'];
            $message=$_POST['mail'];

            imap_mail($to,$subject,$message,"From: $from");
        }
        ?>
<form method=POST>
To: <input type="text" name="to"><br>
Title:<input type="text" name="title"><p>
Mail:<br>
<textarea name='mail'>
</textarea><p>
<input type="submit" name='send_m'  value='Poąlji'>
</form>
    <?php
    } else {
        $mails=imap_num_msg($mail);
        echo "<b>" . $from . "</b> : ";
        if($mails==0) {
            echo "<i>no mails.</i>";
        } else {       
            echo "$mails mails<p>";

            for($i=1;$i<=$mails;$i++) {
                $chead=imap_headerinfo($mail,$i);
                //$chead=imap_mime_header_decode($chead);
                $mid=ltrim($chead->Msgno);
                   
                echo "<a href='index.php?see=$mid'>";

					//echo "[[".$chead->message_id."]]";
					$asunto = $chead->subject;
					
					
$elements = imap_mime_header_decode($asunto);
//for ($i=0; $i<count($elements); $i++) {
//    echo "Charset: {$elements[$i]->charset}\n";
//    echo "Text: {$elements[$i]->text}\n\n";
//}
$asunto = "{$elements[0]->text}\n\n"; 
               //echo  imap_mime_header_decode($asunto);
               //$asunto = imap_utf8($asunto);
					$asunto = utf8_decode($asunto);
					//echo utf8_decode(imap_utf8($asunto));
echo $asunto;


                echo "</a>";
                echo "<br>\n";
            }
        }
        echo "<p><a href='index.php?create=new'>New mail</a><p>";
    }
}
imap_close($mail);
?>
</tr></td></table>
</body>
</html><?php
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