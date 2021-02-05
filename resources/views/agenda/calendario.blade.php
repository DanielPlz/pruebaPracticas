@extends('layouts.dashboard')

<link href="{{asset('assets/fullcalendar/main.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/agenda.css')}}" rel="stylesheet">
<link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg">


@section('contentSidebar')

<!--script de la funcionalidad del fullcalendar-->

<div id="contenedor">

<h1 class="tituloCalendario responsive">Calendario</h1>

  <div class="row responsive">
    
    
    <div class="col-2 responsive">
    </div>

  <div class="col-8 responsive">
    <div id='calendar'></div>
  </div>

  <div class="col responsive">
    <img src="{{asset('assets/img/leyenda.png')}}" class="leyenda_agenda responsive">
  </div>

  </div>


  <!-- Modal de informacion de cita -->
  <div class="modal fade" id="modal_agenda" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Encabezado del modal -->
      <div class="modal-header">
        <h4 class="modal-title text-center">Datos Cita</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Cuerpo del modal -->
      <div class="modal-body">
      <div >
      <!--fila 1-->
      <div class="row">
          <!--columna 1.1-->
          <div class="col">
            <div class="form-group">
              <label for="">Nombre</label>
              <input type="text" class="form-control responsive" id="txt_nombre" readonly>
            </div>
          </div>
          <!--columna 1.2-->
          <div class="col">
            <div class="form-group">
              <label for="">Teléfono</label>
              <input type="text" class="form-control responsive" id="txt_telefono" readonly>
            </div>
          </div>
          <!--columna 1.3-->
          <div class="col">
            <div class="form-group">
              <label for="">Servicio</label>
              <input type="text" class="form-control responsive" id="txt_servicio" readonly>
            </div>
          </div>
      </div>
      <!--fila 2-->
      <div class="row">
          <!--columna 2.1-->
          <div class="col">
            <div class="form-group">
              <label for="">Modalidad</label>
              <input type="text" class="form-control responsive" id="txt_modalidad" readonly>
            </div>
          </div>
          <!--columna 2.2-->
          <div class="col">
            <div class="form-group">
              <label for="">Previsión</label>
              <input type="text" class="form-control responsive" id="txt_prevision" readonly>
            </div>
          </div>
          <!--columna 2.3-->
          <div class="col">
            <div class="form-group">
              <label for="">Precio</label>
              <input type="text" class="form-control responsive" id="txt_precio" readonly>
            </div>
          </div>
        </div>
        <br/>
        <!--fila 3-->
        <div class="row">
          <!--columna 3.1-->
          <div class="col-3">
            <div class="form-group ">
              <label for="">Fecha</label>
              <input type="text" class="form-control responsive" name="txt_fecha_cita" id="txt_fecha_cita" readonly>
            </div>
          </div>
          <!--columna 3.2-->
          <div class="col-3">
            <div class="form-group">
              <label for="">Hora de inicio</label>
              <input type="time" class="form-control responsive" id="txt_hora_inicio" readonly>
            </div>
          </div>
          <!--columna 3.3-->
          <div class="col-3">
            <div class="form-group">
              <label for="">Hora de termino</label>
              <input type="time" class="form-control responsive" id="txt_hora_termino" readonly>
            </div>
          </div>
          <!--columna 3.4-->
          <div class="col-3">
            <div class="form-group">
              <label for="">Estado del Pago</label>
              <input type="text" class="form-control responsive" id="txt_estado_pago" readonly>
            </div>
          </div>          
        </div>
        </div>
      </div>
      

      <!-- footer del Modal -->
      <div class="modal-footer">
        <a href="/pasareladepago/webpay/listaProfesional" type="button" id="btn_detalle_cita" class="btn btn-info"  >Detalles</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
  </div>
</div>


<script type="module">
window.onload = () => {
  $(function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        
        eventClick: function(info){
          
          $('#txt_telefono').val(info.event.extendedProps.telefono);
          $('#txt_prevision').val(info.event.extendedProps.prevision);
          $('#txt_precio').val(info.event.extendedProps.precio);
          $('#txt_modalidad').val(info.event.extendedProps.modalidad);
          $('#txt_hora_inicio').val(info.event.extendedProps.hora_inicio);
          $('#txt_fecha_cita').val(info.event.extendedProps.fecha);
          $('#txt_hora_termino').val(info.event.extendedProps.hora_termino);
          $('#txt_estado_pago').val(info.event.extendedProps.estado_pago);
          $('#txt_nombre').val(info.event.extendedProps.nombre);
          $('#txt_servicio').val(info.event.extendedProps.servicio);

          //Desplegamos el modal con la informacion
          $('#modal_agenda').modal()  
        },
          
          //funcionalidad para cambiar la zona horaria de fullcalendar
        timeZone: 'America/Santiago',
          //funcionalidad para cambiar el idioma de fullcalendar 
        locale: 'es',
          //funcionalidad para reemplazar el primer dia en la vista
        firstDay: 1,
          //Carga de botones en el encabezado del calendario
        headerToolbar: {
              
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        
        navLinks: true,

        //Carga del array de citas y los dias feriados nacionales a través de google
        eventSources: 
          [
            {
              url:'/agenda/calendario/listar',
            },
            {
              googleCalendarId: 'es.cl#holiday@group.v.calendar.google.com',
              
            }
           ],
              googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',

        });
        //Renderizado del calendario
      calendar.render();
  });
}

</script>



<script src="{{asset('assets/fullcalendar/main.js')}}"></script>
<script src="{{asset('assets/fullcalendar/locales/es.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@include('partials.scripts')

@endsection
