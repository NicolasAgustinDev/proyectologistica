
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; font-size: 12px; }
    .tabla { border-collapse: collapse; width: 100%; margin-top: 10px; }
    .tabla td, .tabla th { border: 1px solid #000; padding: 5px; }
    .titulo { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px; }
    .caja { border: 1px solid #000; padding: 5px; }
    .negrita { font-weight: bold; }
    .azul { background-color: #004080; color: #fff; }
  </style>
</head>
<body>
  <div class="titulo">REMITO</div>

  <table class="tabla">
    <tr>
      <td class="caja" style="width:60%">
        <span class="negrita">Razón Social:</span> Mi Empresa S.A.<br>
        <span class="negrita">CIT:</span> 123456789<br>
        <span class="negrita">Teléfono:</span> 11-4444-5555<br>
        <span class="negrita">Dirección:</span> Av. Siempre Viva 742<br>
        <span class="negrita">Cód. Postal:</span> 1846<br>
        <span class="negrita">Localidad:</span> Burzaco
      </td>
      <td class="caja" style="width:40%">
        <span class="negrita">REMITO Nº:</span> 0001<br>
        <span class="negrita">Fecha:</span> 30/08/2025
      </td>
    </tr>
  </table>

  <table class="tabla" style="margin-top:10px">
    <tr>
      <td style="width:60%">
        <span class="negrita">Nombre:</span> Cliente Demo<br>
        <span class="negrita">Domicilio:</span> Calle Falsa 123<br>
        <span class="negrita">Localidad:</span> Avellaneda<br>
        <span class="negrita">CIT:</span> 987654321
      </td>
      <td style="width:40%">
        <span class="negrita">Teléfono:</span> 11-2222-3333<br>
        <span class="negrita">Cód. Postal:</span> 1870<br>
        <span class="negrita">Provincia:</span> Buenos Aires
      </td>
    </tr>
  </table>

  <table class="tabla" style="margin-top:10px">
    <tr class="azul">
      <th style="width:30%">ARTÍCULO</th>
      <th style="width:50%">DESCRIPCIÓN</th>
      <th style="width:20%">CANTIDAD</th>
    </tr>
    <tr>
      <td>001</td>
      <td>Producto de ejemplo</td>
      <td>5</td>
    </tr>
    <tr>
      <td>002</td>
      <td>Otro producto</td>
      <td>3</td>
    </tr>
  </table>
</body>
</html>
