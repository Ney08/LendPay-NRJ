<div class="card shadow mb-4" style="max-width: 900px; margin: 0 auto;">
    <div class="card-header py-3 border-bottom-success">Crear prestamo </div>
    <div class="card-body">
        <?php if(validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo validation_errors('<li>', '</li>'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <?php echo form_open('admin/loans/edit', 'id="loan_form"'); ?>

            <div class="form-row">
                <div class="form-group col-12 col-md-8">
                    <label class="small mb-1" for="exampleFormControlSelect2">Buscar cliente por su cédula</label>
                    <div class="input-group">
                        <input type="text" id="dni" class="form-control">
                        <input type="hidden" name="client_id" id="client">
                        <div class="input-group-append">
                            <button type="button" id="btn_buscar" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="inputUsername">Cédula</label>
                    <input class="form-control" id="dni_cst" type="text" disabled>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="inputUsername">Nombre completo</label>
                    <input class="form-control" id="name_cst" type="text" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="inputUsername">Monto del prestamo</label>
                    <input class="form-control" id="cr_amount" type="number" name="credit_amount">
                </div>
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="inputUsername">Interes %</label>
                    <input class="form-control" id="in_amount" type="number" step="0.01" name="interest_amount">
                </div>
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="exampleFormControlTextarea1">N° de Cuotas</label>
                    <input class="form-control" id="fee" type="number" name="num_fee">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="exampleFormControlSelect2">Forma de pago</label>
                    <select class="form-control" name="payment_m">

                        <option value="diario">diario</option>
                        <option value="semanal">semanal</option>
                        <option value="quincenal">quincenal</option>
                        <option value="mensual">mensual</option>
                        
                    </select>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="exampleFormControlSelect2">Tipo de moneda</label>
                    <select class="form-control" id="exampleFormControlSelect2" name="coin_id">

                        <?php foreach ($coins as $coin): ?>
                            <option value="<?php echo $coin->id ?>"><?php echo $coin->short_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="inputUsername">Fecha de emision</label>
                    <input class="form-control" id="date" type="date" name="date">
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-sm" type="button" id="calcular">Calcular</button>
            </div>

            <div class="form-row">
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="inputUsername">Valor por cuota</label>
                    <input class="form-control" id="valor_cuota" type="text" name="fee_amount" readonly>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="inputUsername">Valor Interes</label>
                    <input class="form-control" id="valor_interes" type="text" name="" step="0.01" disabled>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label class="small mb-1" for="exampleFormControlTextarea1">Monto total</label>
                    <input class="form-control" id="monto_total" type="text" name="" disabled>
                </div>
            </div>

            <button class="btn btn-success btn-sm " id="register_loan" type="submit" disabled>Registrar Préstamo</button>
            
            <a href="<?php echo site_url('admin/loans/'); ?>" class="btn btn-danger btn-sm">Cancelar</a>

            <?php echo form_close() ?>
            
        </div>
    </div>