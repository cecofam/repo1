/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<!-- #EditarModal -->
            
            <div id="EditarModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <center><h2 class="modal-title">Editar Psícologos</h2></center>
                        </div>
                        <div class="modal-body">
              <?php if($_GET{IdPsicologo} == 21){ ?>              
             
              <?= form_open(base_url().'index.php/catalogos/Psicologos_c/EditarPC',array('name'=>'',
                                                                                         'id'=>'', 
                                                                             'autocomplete' => 'off') );?>
             <td><font color="red" <?= form_label('* Estos campos son obligatorios','');?></font></td>
            <table>
                <input type="hidden" name="id_sol" id="id_sol" value="<?php echo $id_sol; ?>">
                <tr>
                    <td><font color="red" <?= form_label('*','');?></font><?= form_label('Apelllido Paterno:','');?></td>
                   <td> <?= form_input('appat',$appat,'size="15" onkeypress="return numberText(event);" onKeyUp="this.value=this.value.toUpperCase();" maxlength="25"'); ?></td><br/>
                
                </tr> <br/>
                <tr>
                    <td><?= form_label('Apelllido Materno:','');?></td>
                   <td> <?= form_input('apmat',$apmat,'size="15" onkeypress="return numberText(event);" onKeyUp="this.value=this.value.toUpperCase();" maxlength="25"');?></td>
                </tr>
                <tr>
                    <td><?= form_label('Nombre(s):','');?></td>
                  <td>  <?= form_input('nombre',$nombre,'size="15" onkeypress="return numberText(event);" onKeyUp="this.value=this.value.toUpperCase();" maxlength="25"'); ?></td>
                </tr>
                <tr>
                    <td><font color="red" <?= form_label('*','');?></font><?= form_label('Cedula:','width="20" maxlength="8"');?></td>
                   <td> <?= form_input('cedula',$cedula,'size="10" '); ?></td>
                </tr>
                <tr>
                    <td><?= form_label('Iniciales:','');?></td>
                    <td><?= form_input('iniciales',$iniciales,'size="4" onkeypress="return numberText(event);" onKeyUp="this.value=this.value.toUpperCase();" maxlength="3"'); ?></td>
                </tr> 
                <tr>
                    <td><?= form_label('Activo:','');?></td>
                     <div class="row form-group">
                                    <div class="col-lg-3">
                        <td><select class="form-control" name="activo" id="activo"  </td>
                                <option value=<?php echo $activo;?>><?php 
                                    if($activo == 'S')
                                    {
                                        $activo1 = "ACTIVO";

                                    }else{ 
                                    if($activo == 'N')    
                                        $activo1 = "INACTIVO";
                                    }
                                        echo $activo1;?>
                                </option>
                                
                                <?php 
                                        if($activo == 'S')
                                        {
                                            echo "<option value='N'>INACTIVO</option>";
                                        }else{ 
                                        if($activo == 'N')    
                                            echo "<option value='S'>ACTIVO</option>";
                                         } ?>
<!--                                          <option value="S">ACTIVO</option>
                                          <option value="N">INACTIVO</option>-->
                            </select>
                                    </div>
                     </div>
                </tr> 
                
                <tr>    
                    <td><input type="submit" class="btn btn-primary" id="UpdPs" name="UpdPs" value="Guardar"/> </td>
             
                </tr>
                
            </table> 
                            
            <?= form_close(); ?>    
            <?php } ?>
                        </div>

    <div id="error-background" class="modal-background"></div>
 
	             
			
				
	</div>
      </div>
    </div>
                            
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
                </div>
            <!-- /.modal -->
            <!-- /#EditarModal -->