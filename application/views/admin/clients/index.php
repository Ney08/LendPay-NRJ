<div class="card shadow mb-4">
  <div class="card-header border-bottom-danger border-left-danger d-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-secondary">Clientes</h6>
    <a class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="<?php echo site_url('admin/clients/edit'); ?>"><i class="fas fa-plus-circle fa-sm"></i> Nuevo cliente</a>
  </div>
  <div class="card-body">
    <?php if ($this->session->flashdata('msg')): ?>
      <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <?= $this->session->flashdata('msg') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif ?>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Celular</th>
            <th>Empresa</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($clients)): foreach($clients as $ct): ?>
            <tr>
              <td><?php echo $ct->dni ?></td>
              <td><?php echo $ct->first_name ?></td>
              <td><?php echo $ct->last_name ?></td>
              <td><?php echo $ct->address?></td>
              <td><?php echo $ct->mobile ?></td>
              <td><?php echo $ct->company ?></td>
              <td>
                <button type="button" class="btn btn-sm <?php echo $ct->loan_status ? 'btn-danger': 'btn-success' ?> status-check"><?php echo $ct->loan_status ? 'Con Crédito': 'Sin Crédito' ?></button>
              </td>
              <td>
                <a href="<?php echo site_url('admin/clients/edit/'.$ct->id); ?>" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-sm"></i> Editar</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">Clientes no encontrados, debes agregar un nuevo cliente.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>