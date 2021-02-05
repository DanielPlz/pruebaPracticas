<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
		<tr>
			<td style="background-color: #ecf0f1; text-align:left; padding: 0">
				<img width="35%" style="display: block; margin: 1.5% 3%" src="https://i.postimg.cc/x8F5tyFV/logo-empresa.png">
			</td>
		</tr>
		<tr>
			<td style="background-color: #ecf0f1">
				<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify; font-weight: bold">
					<h2 style="color: #000000; margin: 0 0 7px; text-align: center">Copia De Pago</h2>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">Conexión Salud</p>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">Dirección, CL</p>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">(+569)99976406</p>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">psicologostemuco@gmail.com</p>
					<hr>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: left">Comprobante de:</p>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: left">{{$user->name}}</p>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: left">{{$user->direccion}}</p>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: left">{{$user->email}}</p>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">Orden de compra:</p>
					<p style="color: #000000; margin: 2px; font-size: 16px; text-align: right">{{$pago->ordendecompra}}</p>
					<h2></h2>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">Fecha cita:</p>
					<p style="color: #000000; margin: 2px; font-size: 16px; text-align: right">{{$cita->fecha}} ({{$cita->hora_inicio}})</p>
						<table cellpadding="0" cellspacing="0" border="1" style="color: #000000; justify-content: center">
							<thead>
								<tr>
									<th style="text-align: center">Descripción</th>
									<th style="text-align: center">Fecha Transacción</th>
									<th style="text-align: center">Tipo Pago</th>
									<th style="text-align: center">Cuotas</th>
									<th style="text-align: center">Total</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th style="text-align: center">{{$servicio->nombre}}</th>
									<th style="text-align: center">{{$pago->fecha}}</th>
									<th style="text-align: center">{{$pago->tipo_pago}}</th>
									<th style="text-align: center">{{$pago->cuotas}}</th>
									<th style="text-align: center">${{$pago->monto}}</th>
								</tr>
							</tbody>
						</table>
					<h2></h2>
					<div style="width: 150px; float: right; border-bottom-color: red">
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">SUBTOTAL: ${{$pago->monto}}</p>
					<hr>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">DCTO(x %): ${{$pago->monto}}</p>
					<hr>
					<p style="color: #000000; margin: 2px; font-size: 15px; text-align: right">TOTAL: ${{$pago->monto}}</p>
					</div>
					<br>
					<br>
					<p style="color: #000000; margin: 2px; font-size: 17px; text-align: left">Gracias por tu preferencia!</p>
					<p style="color: #000000; margin: 2px; font-size: 14px; text-align: left">Atte. Equipo Conexión Salud</p>
					<br>
					<p style="color: #000000; margin: 2px; font-size: 13px; text-align: left">Aviso:</p>
					<p style="color: #000000; margin: 2px; font-size: 13px; text-align: left">El descuento aplicado al pago sera según la previsión de Salud.</p>
					<hr>
					<p style="color: #CBCBCB; margin: 2px; font-size: 13px; text-align: center;">Conexión Salud. Copyright © Todos los derechos reservados.</p>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>