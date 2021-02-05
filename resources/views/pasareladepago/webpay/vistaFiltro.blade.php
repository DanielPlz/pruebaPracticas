@extends('layouts.dashboard')
@extends('layouts.app')
@section('contentSidebar')
@if (session('mensaje'))
    <div class="alert alert-success text-center">
        {{session('mensaje')}}
    </div>
@endif


    <div class="text-center mb-4">
    <h1 class="title-1">Lista de Pagos</h1>
    </div>
    
    <div class="container"> 
    <div class="d-flex justify-content-center">
    <div class="row">
    <div class="col-xs-6">
      <div>
        <form action="{{route('pasareladepago.webpay.busqueda')}}" method="POST">
          @csrf
            Orden de Compra: <input type="text" name="orden" placeholder="N°Orden de Compra">
            <input type="submit" value="Buscar">
        </form>
        <form action="{{route('pasareladepago.webpay.filtro')}}" method="GET">
          @csrf
            Fecha:
            <select name="mes">
              <option value="0" selected>MES</option>
              <option value="1">Enero</option>
              <option value="2">Febrero</option>
              <option value="3">Marzo</option>
              <option value="4">Abril</option>
              <option value="5">Mayo</option>
              <option value="6">Junio</option>
              <option value="7">Julio</option>
              <option value="8">Agosto</option>
              <option value="9">Septiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option>
            </select>
            
        <select name="ano">
          <option value="0" selected>Año</option>
          <?php
          for($i=date('o'); $i>=1910; $i--){
              if ($i == date('o'))
                  echo '<option value="'.$i.'">'.$i.'</option>';
              else
                  echo '<option value="'.$i.'">'.$i.'</option>';
          }
          ?>
        </select>
        
        <input type="submit" value="Filtrar">
        </form>
    </div>
      
      
      <br>
    
    <table class="table table-responsive">
  <thead>
    <tr>
      <th scope="col" class="title-4 text-center">N°</th>
      <th scope="col" class="title-4 text-center">Fecha</th>
      <th scope="col" class="title-4 text-center">Valor</th>
      <th scope="col" class="title-4 text-center">Orden De Compra</th>
      <th scope="col" class="title-4 text-center">Descargar</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pagos as $pago)
      <tr>
      <th scope="row" class="text-center">{{$rank++}}</th>
      <td class="text-center">{{$pago->fecha}}</td>
      <td class="text-center">{{$pago->monto}}</td>
      <td class="text-center">{{$pago->ordendecompra}}</td>
      <td class="text-center">
      <form action="{{route('pasareladepago.webpay.pagodetalle',$pago)}}">
      @csrf
      <input type="image" src="https://img.icons8.com/office/30/000000/pdf.png"></td>
      </form>
      <form action="{{route('pasareladepago.webpay.correo')}}">
      @csrf
      <input name="id" type="hidden" value="{{$pago->id}}">
      <input name="ordendecompra" type="hidden" value="{{$pago->ordendecompra}}">
      <input name="monto" type="hidden" value="{{$pago->monto}}">
      <input name="fecha" type="hidden" value="{{$pago->fecha}}">
      <input name="tipo" type="hidden" value="{{$pago->tipopago}}">
      <td><input type="image" src="https://img.icons8.com/plasticine/30/000000/new-post.png"/></td>
      </form>
      </tr>
    @endforeach
  </tbody>
  
</table>
    @if(Session::has('aviso'))
	    <div>{{Session::get('aviso')}}</div>
    @endif
</div>
</div>
</div>
</div>
<ul class="pagination justify-content-center">{{$pagos->appends(request()->query())->links()}}</ul>
@stop