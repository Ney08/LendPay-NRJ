<div class="container" style="max-width: 1100px; margin: 0 auto;"> <!-- Added container with max-width -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center border-bottom-warning justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-secondary">Reporte global por clientes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre completo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($clients)): foreach($clients as $ct): ?>
                            <tr>
                                <td><?php echo $ct->dni ?></td>
                                <td><?php echo $ct->client ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/reports/client_pdf/'.$ct->id); ?>" target="_blank" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-eye fa-sm"></i> Ver prestamos</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No existen Clientes con prestamos</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>