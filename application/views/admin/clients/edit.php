<div class="card shadow mb-4" style="max-width: 900px; margin: 0 auto;">
  <div class="card-header py-3 border-bottom-danger"><?php echo empty($client->first_name) ? 'Nuevo Cliente' : 'Editar Cliente'; ?></div>
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
    <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                            <?= $this->session->flashdata('error') ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif ?>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label class="small mb-1" for="inputUsername">Ingresar Cédula</label>
        <input class="form-control dni" id="inputUsername" type="text" name="dni" value="<?php echo set_value('dni', $this->input->post('dni') ? $this->input->post('dni') : $client->dni); ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="small mb-1" for="inputUsername">Ingresar Nombre</label>
        <input class="form-control" id="inputUsername" type="text" name="first_name" value="<?php echo set_value('first_name', $this->input->post('first_name') ? $this->input->post('first_name') : $client->first_name); ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="small mb-1" for="exampleFormControlTextarea1">Ingresar Apellidos</label>
        <input class="form-control" id="inputUsername" type="text" name="last_name" value="<?php echo set_value('last_name', $this->input->post('last_name') ? $this->input->post('last_name') : $client->last_name); ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar Genero</label>
        <select class="form-control" id="exampleFormControlSelect2" name="gender">

          <?php if ($client->gender == 'none'): ?>
            <option value = "" selected>Seleccionar Genero</option>
          <?php endif ?>

          <option value="masculino" <?php if ($client->gender == 'masculino') echo "selected" ?>>
            masculino
          </option>
          <option value="femenino" <?php if ($client->gender == 'femenino') echo "selected" ?>>
            femenino
          </option>
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar Provincia</label>
        <select class="form-control" id="provincia_id" name="provincia_id">
          <?php if ($client->provincia_id == 0): ?>
            <option value = "" selected>Seleccionar Provincia</option>
          <?php endif ?>
          <?php foreach ($provincia as $prov): ?>
            <option value="<?php echo $prov->id ?>" <?php if ($prov->id == $client->provincia_id) echo "selected" ?>><?php echo $prov->name ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar Municipio</label>
        <select class="form-control" id="municipio_id" name="municipio_id">
          <?php if ($client->municipio_id == 0): ?>
            <option value = "" selected>Seleccionar Municipio</option>
          <?php else: ?>
            <?php foreach ($municipio as $mp): ?>
              <option value="<?php echo $mp->id ?>" <?php if ($mp->id == $client->municipio_id) echo "selected" ?>><?php echo $mp->name ?></option>
            <?php endforeach ?>
          <?php endif ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlSelect2">Seleccionar Sector</label>
        <select class="form-control" id="sector_id" name="sector_id">
          <?php if ($client->sector_id == 0): ?>
            <option value = "" selected>Seleccionar Sector</option>
          <?php else: ?>
            <?php foreach ($sector as $sec): ?>
              <option value="<?php echo $sec->id ?>" <?php if ($sec->id == $client->sector_id) echo "selected" ?>><?php echo $sec->name ?></option>
            <?php endforeach ?>
          <?php endif ?>
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar dirección</label>
        <input class="form-control" id="inputUsername" type="text" name="address" value="<?php echo set_value('address', $this->input->post('address') ? $this->input->post('address') : $client->address); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlTextarea1">Ingresar Celular</label>
        <input class="form-control" id="inputUsername" type="text" name="mobile" value="<?php echo set_value('mobile', $this->input->post('mobile') ? $this->input->post('mobile') : $client->mobile); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="exampleFormControlTextarea1">Ingresar Teléfono</label>
        <input class="form-control" id="inputUsername" type="text" name="phone" value="<?php echo set_value('phone', $this->input->post('phone') ? $this->input->post('phone') : $client->phone); ?>">
      </div>
    </div>

    <div class="form-row">
      <!-- <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar razon social</label>
        <input class="form-control" id="inputUsername" type="text" name="business_name" value="<?php echo set_value('business_name', $this->input->post('business_name') ? $this->input->post('business_name') : $client->business_name); ?>">
      </div> -->
      <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar Nrc</label>
        <input class="form-control" id="inputUsername" type="text" name="ruc" value="<?php echo set_value('ruc', $this->input->post('ruc') ? $this->input->post('ruc') : $client->ruc); ?>">
      </div>
      <div class="form-group col-md-4">
        <label class="small mb-1" for="inputUsername">Ingresar Empresa</label>
        <input class="form-control" id="inputUsername" type="text" name="company" value="<?php echo set_value('company', $this->input->post('company') ? $this->input->post('company') : $client->company); ?>">
      </div>
    </div>
    <button class="btn btn-success btn-sm" type="submit" id="buttonClient">Guardar</button>
    <a href="<?php echo site_url('admin/clients/'); ?>" class="btn btn-danger btn-sm">Cancelar</a>
    
    <?php echo form_close() ?>
  </div>
</div>