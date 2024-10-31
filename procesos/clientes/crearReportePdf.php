<?php
	session_start();
    require_once "../../clases/Conexion.php";
	$obj= new conectar();
	$conexion= $obj->conexion();

// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once '../../librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;


if((isset($_SESSION['consulta1']))&&(isset($_SESSION['consulta']))&&(isset($_SESSION['desde']))&&(isset($_SESSION['hasta'])))
{
    $c=$_SESSION['consulta'];
    $c1=$_SESSION['consulta1'];
    $desde=$_SESSION['desde'];
    $hasta=$_SESSION['hasta'];
    // Introducimos HTML de prueba
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $html=file_get_contents("http://localhost:81/proyecto/vistas/clientes/FR-rerpoteVentaPdf.php?desde=".$desde."&hasta=".$hasta."&c=".$c."&c1=".$c1);
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("letter", "portrait");
    //$pdf->set_paper(array(0,0,104,250));
    
    // Cargamos el contenido HTML.
    $pdf->load_html($html);
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('FR-reporteHistorial.pdf');
}

else if((isset($_SESSION['consulta']))&&(isset($_SESSION['desde']))&&(isset($_SESSION['hasta'])))
{
    $c=$_SESSION['consulta'];
    $desde=$_SESSION['desde'];
    $hasta=$_SESSION['hasta'];
    // Introducimos HTML de prueba
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $html=file_get_contents("http://localhost:81/proyecto/vistas/clientes/CD-rerpoteVentaPdf.php?desde=".$desde."&hasta=".$hasta."&c=".$c);
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("letter", "portrait");
    //$pdf->set_paper(array(0,0,104,250));
    
    // Cargamos el contenido HTML.
    $pdf->load_html($html);
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('CD-ReporteHistorial.pdf');
}

else if((isset($_SESSION['consulta1']))&&(isset($_SESSION['desde']))&&(isset($_SESSION['hasta'])))
{
    $c1=$_SESSION['consulta1'];
    $desde=$_SESSION['desde'];
    $hasta=$_SESSION['hasta'];
    // Introducimos HTML de prueba
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $html=file_get_contents("http://localhost:81/proyecto/vistas/clientes/CD1-rerpoteVentaPdf.php?desde=".$desde."&hasta=".$hasta."&c1=".$c1);
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("letter", "portrait");
    //$pdf->set_paper(array(0,0,104,250));
    
    // Cargamos el contenido HTML.
    $pdf->load_html($html);
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('CD1-reporteHistorial.pdf');
}

else if(isset($_SESSION['consulta'])){
    $c=$_SESSION['consulta'];
    // Introducimos HTML de prueba
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $html=file_get_contents("http://localhost:81/proyecto/vistas/clientes/C-rerpoteVentaPdf.php?c=".$c);
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("letter", "portrait");
    //$pdf->set_paper(array(0,0,104,250));
    
    // Cargamos el contenido HTML.
    $pdf->load_html($html);
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('reporteHistorial.pdf');
}

else if(isset($_SESSION['consulta1'])){
    $c1=$_SESSION['consulta1'];
    // Introducimos HTML de prueba
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $html=file_get_contents("http://localhost:81/proyecto/vistas/clientes/C2-rerpoteVentaPdf.php?c=".$c1);
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("letter", "portrait");
    //$pdf->set_paper(array(0,0,104,250));
    
    // Cargamos el contenido HTML.
    $pdf->load_html($html);
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('C2-reporteHistorial.pdf');
}

else if((isset($_SESSION['desde']))&&(isset($_SESSION['hasta']))){
    $desde=$_SESSION['desde'];
    $hasta=$_SESSION['hasta'];
    // Introducimos HTML de prueba
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $html=file_get_contents("http://localhost:81/proyecto/vistas/clientes/F-rerpoteVentaPdf.php?desde=".$desde."&hasta=".$hasta);
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("letter", "portrait");
    //$pdf->set_paper(array(0,0,104,250));
    
    // Cargamos el contenido HTML.
    $pdf->load_html($html);
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('F-reporteHistorial.pdf');
}

else
{
    // Introducimos HTML de prueba
    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    $html=file_get_contents("http://localhost:81/proyecto/vistas/clientes/V-rerpoteVentaPdf.php");
    
    // Instanciamos un objeto de la clase DOMPDF.
    $pdf = new DOMPDF();
    
    // Definimos el tamaño y orientación del papel que queremos.
    $pdf->set_paper("letter", "portrait");
    //$pdf->set_paper(array(0,0,104,250));
    
    // Cargamos el contenido HTML.
    $pdf->load_html($html);
    
    // Renderizamos el documento PDF.
    $pdf->render();
    
    // Enviamos el fichero PDF al navegador.
    $pdf->stream('V-reporteHistorial.pdf');
}