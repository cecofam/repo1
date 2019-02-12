<?php 
$url_solici=base_url("index.php/solicitud/Solicitud");
$url_salir=base_url("index.php/ingresar");
//$Arreglo = $this->Menu->modulos();
$Arreglo = $this->Menu->modulos($this->session->idUser);
$aux = ' ';
$count  = 1;


echo "<ul id='menu' class='bg-blue dker'>"; //inicia lista
echo "<li class='nav-header'>Menu</li>";
echo "<li class='nav-divider'></li>";
echo "<li class=''>";
echo "<a href='dashboard.html'>";
echo "<i class='fa fa-dashboard'></i><span class='link-title'>&nbsp;Dashboard</span>";
echo "</a>";
echo "</li>";


while (($row = oci_fetch_array($Arreglo, OCI_ASSOC))) {
                $rc = $row['MFRC'];
                oci_execute($rc);
            while (($data = oci_fetch_array($rc, OCI_ASSOC))) {
               if($data['CMODULO']=='Oficios'){
                    $imag="fa fa-file-text";
                }else if($data['CMODULO']=='Agenda'){
                    $imag="fa fa-calendar";
                }else if($data['CMODULO']=='Registros'){
                    $imag="fa fa-pencil";
                }else if($data['CMODULO']=='Inasistencia'){
                    $imag="fa fa-file-text";
                }else if($data['CMODULO']=='Documentos'){
                    $imag="fa fa-folder-open-o";
                }else if($data['CMODULO']=='Usuarios'){
                    $imag="fa fa-user";
                }else{
                    $imag="fa fa-table";
                }
                echo "<li class=''>";
                echo "<a href='javascript:;'>";
                echo "<i class='".$imag."'></i>";
                echo "<span class='link-title'>".$data['CMODULO']."</span>";
                echo "<span class='fa arrow'></span>";
                echo "</a>";
               $Arreglo2 = $this->Menu->submodulos($data['IIDMODULO'],$this->session->idUser);
                //$Arreglo2 = $this->Menu->submodulos($data['IIDMODULO']);
                //echo "-->>>".$data['IIDMODULO']."";//imprime los id de los modulos            
                while (($row2 = oci_fetch_array($Arreglo2, OCI_ASSOC))) 
                {
                    $rc2 = $row2['MFRC'];
                    oci_execute($rc2);
                    
                    echo "<ul class='collapse'>";
                    while(($data2 = oci_fetch_array($rc2, OCI_ASSOC)))
                    {   
                        echo "<li>"; 
                        echo "<a href='".base_url("index.php/".$data2['CPAGINA'])."'><i class='fa fa-angle-right'></i>".$data2['CSUBMODULO']."</a>";   //  cambiar a base   index.php/carpeta/controlador/funcion/
                        echo "<li>";
                    } 
                    echo "</ul>";
                } 
                
                
               
            }//ciera segundo while
        }//cierra el primer while    
        //
        //
        
        
       
        
    echo "</ul>"; 

?>
