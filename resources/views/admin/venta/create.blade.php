@extends('admin.layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4 py-4">

        <!--Mostrar el stock-->

        <form id="form_venta" name="form_venta" class="form-horizontal" method="POST"
          action="" autocomplete="off">
          <div class="form-group">
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="row">
                  <label class="form-label">Buscar medicamento?</label>
                </div>
                <div class="input-group mb-3">
                  <input class="form-control" id="medicamento" name="medicamento" type="text"
                    placeholder="Ingrese el nombre del medicamento" autofocus>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#crearModalCondominio"><i
                      class="fas fa-list-ol"></i></button>
                </div>
              </div>
              <div class="col-12 col-sm-4  mb-3">
                <label class="form-label">Fecha:</label>
                 <input class="form-control" id="fecha" name="fecha" type="date"
                    placeholder="Ingrese el nombre del producto" value="<?php echo date('Y-m-d'); ?>">
              </div>
              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Cliente:</label>
                <div class="input-group mb-3">
                  <input class="form-control" id="cliente2" name="cliente2" type="text"
                    placeholder="Ingrese el nombre del cliente" required>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#crearModalCliente"><i
                      class="fas fa-list-ol"></i></button>
                </div>
                    
                </div>
              </div>
              <input type="hidden" name="id_producto" id="id_producto">
              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Cantidad:</label>
                  <div class="input-group mb-3">
                    <input type="number" min="1" class="form-control" id="cantidad" name="cantidad" type="text">
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Precio:</label>
                  <div class="input-group mb-3">
                    <input class="form-control" id="precio" name="precio" type="text" disabled>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Subtotal:</label>
                  <div class="input-group mb-3">
                    <input class="form-control" id="subtotal" name="subtotal" type="text" disabled>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-4">
                <div class="container-fluid px-0 py-2">
                  <button class="btn btn-primary" id="agregar_producto" name="agregar_producto" type="button">Agregar
                    producto</button>
                </div>
              </div>

            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table id="tablaProductos" class="table table-bordered table-hover">
              <thead class="table-dark ">
                <th style="color: #fff">#</th>
                <th style="color: #fff">Nombre</th>
                <th style="color: #fff">Precio</th>
                <th style="color: #fff">Cantidad</th>
                <th style="color: #fff">Subtotal</th>
                <th width="1%"></th>
              </thead>
              <tbody id="table"></tbody>
            </table>
          </div>
          <br>
          <div class="d-grid gap-3 d-md-flex justify-content-md-end  mb-3">
            <label style="font-weight: bold; font-size: 30px; text-align: center;">Total Bs.</label>
            <input type="text" id="total" name="total" size="7" readonly="true" value="0.00"
              style="font-weight: bold; font-size: 30px; text-align: center;" />
            <button class="btn btn-success" type="button" id="completa_venta">VENDER</button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!--Template carrito-->
<template id="template-carrito">
  <tr>
    <th scope="row">id</th>
    <td>Café</td>
    <td>1</td>
    <td>2$ individual</td>
    <td>$ <span>500</span></td>
    <td>
      <button class="btn btn-info btn-sm" style="background-color: #fff; border:none"><i class="fa-solid fa-trash-can" style="color:red; font-size:15px"></i></button>
    </td>
  </tr>
</template>

@endsection

@section('modals')
  @include('admin.venta.modal.customer')
  @include('admin.venta.modal.product')
@endsection