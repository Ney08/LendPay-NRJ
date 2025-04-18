<div class="card shadow mb-4">
  <div class="card-header d-flex align-items-center border-bottom-info border-left-info justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-secondary">Cobranzas</h6>
    <a class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="<?php echo site_url('admin/payments/edit'); ?>"><i class="fas fa-plus-circle fa-sm"></i> Realizar Pago</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Cédula</th>
            <th>Cliente</th>
            <th>N° Prestamo</th>
            <th>N° Cuota</th>
            <th>M. Cancelado</th>
            <th>Fecha de pago</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($payments)): foreach($payments as $py): ?>
            <tr>
              <td><?php echo $py->dni ?></td>
              <td><?php echo $py->name_cst ?></td>
              <td><?php echo $py->loan_id ?></td>
              <td><?php echo $py->num_quota ?></td>
              <td><?php echo $py->fee_amount ?></td>
              <td><?php echo $py->pay_date ?></td>
            </tr>
          <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">Aun no existen pagos realizados.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>