<div class="container" style="max-width: 700px;"> <!-- Added container with max-width -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center border-bottom-warning  justify-content-between py-3 modal-title">
            <h6 class="m-0 font-weight-bold text-Secondary">Resumen General de Prestamos por Moneda</h6>
            
            <a class="btn btn-sm btn-success shadow-sm" href="#" id="generate_pdf"><i class="fas fa-print fa-sm"></i> Imprimir</a>
            <script>
                document.getElementById('generate_pdf').addEventListener('click', function(e) {
                    e.preventDefault();
                    const coinType = document.getElementById('coin_type').value;
                    if (coinType === "0") {
                        alert('Por favor, seleccione una moneda.');
                        return;
                    }
                    const url = "<?php echo site_url('admin/reports/general_summary_pdf'); ?>?coin_type=" + coinType;
                    window.open(url, '_blank');
                });
            </script>
            <style>
                @media print {
                    body *, footer *, .btn, .fas, .fa-print, .fa-sm {
                        visibility: hidden;
                    }
                    .card-header, .card-body, .table-responsive, .table, thead, tbody, tr, th, td {
                        visibility: hidden;
                    }
                    .container, .container * {
                        visibility: visible;
                    }
                    .container {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                    }
                }
            </style>
        </div>
        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-4">

                    <label class="small mb-1" for="exampleFormControlSelect2">Tipo de moneda</label>
                    <select class="form-control" id="coin_type" name="coin_type">
                        <option value="0"> Seleccionar moneda</option>
                        <?php foreach ($coins as $c): ?>
                            <option value="<?php echo $c->id ?>" data-symbol="<?php echo $c->short_name ?>"><?php echo $c->name.' ('.strtoupper($c->short_name).')' ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="table-responsive" id="imp1">
                <table class="table" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Descripción</th>
                            <th class="text-right">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Credito</td>
                            <td class="text-right" id="cr">0</td>
                        </tr>
                        <tr>
                            <td>Total Credito con Interes</td>
                            <td class="text-right" id="cr_interest">0</td>
                        </tr>
                        <tr>
                            <td>Total Credito cancelado con interes</td>
                            <td class="text-right" id="cr_interestPaid">0</td>
                        </tr>
                        <tr>
                            <td>Total Credito por cobrar con interes</td>
                            <td class="text-right" id="cr_interestPay">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Move this style block to the <head> section of your HTML document -->
</div>