<div class="card shadow mb-10 " style="max-width: 900px; margin: auto;">
    <div class="card-header py-3 border-bottom-primary"><?php echo empty($coin->name) ? 'Nueva moneda' : 'Editar moneda'; ?> </div>
    <div class="card-body">
        <?php if(validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo validation_errors('<li>', '</li>'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
            
            <?php echo form_open(); ?>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="inputUsername">Ingresar moneda</label>
                    <input class="form-control" id="inputUsername" type="text" name="name" value="<?php echo set_value('name', $this->input->post('name') ? $this->input->post('name') : $coin->name); ?>" placeholder="Ej: Pesos">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="inputUsername">Ingresar abreviatura</label>
                    <input class="form-control" style="text-transform:uppercase;" id="inputUsername" type="text" name="short_name" value="<?php echo set_value('short_name', $this->input->post('short_name') ? $this->input->post('short_name') : $coin->short_name); ?>" placeholder="Ej: DOP">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="inputUsername">Ingresar simbolo</label>
                    <input class="form-control" style="text-transform:uppercase;" id="inputUsername" type="text" name="symbol" value="<?php echo set_value('symbol', $this->input->post('symbol') ? $this->input->post('symbol') : $coin->symbol); ?>" placeholder="Ej: RD$">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="exampleFormControlTextarea1">Ingresar descripcion</label>
                    <input class="form-control" id="inputUsername" type="text" name="description" value="<?php echo set_value('description', $this->input->post('description') ? $this->input->post('description') : $coin->description); ?>" placeholder="Ej: Pesos Dominicanos">
                </div>
            </div>

            <button class="btn btn-success btn-sm" type="submit">Guardar</button>
            <a href="<?php echo site_url('admin/coins/'); ?>" class="btn btn-danger btn-sm">Cancelar</a>
            
            <?php echo form_close() ?>
        </div>
    </div>