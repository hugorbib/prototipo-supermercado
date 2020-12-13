<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    {{-- <link  href="{{ asset('css/pdfs/userspdf.css')}}" rel="stylesheet"> --}}
    <style>
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 370px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  width: 90%;
  background: url(https://previews.123rf.com/images/oxtravel/oxtravel1506/oxtravel150600023/40916083-elegante-seda-o-sat%C3%A9n-textura-lisa-puede-utilizar-como-fondo-de-boda.jpg);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: center;
  text-align: right;
  margin-right: 80px;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 90%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="http://www.whitemountainfarm.com/images/images/wmf.gif">
      </div>
      <h1>LISTA DE DENUNCIAS</h1>
      <div id="company" class="clearfix">
        <div>Sistema de Gestión de colectores pluviales</div>
        <div>1855 Héroes del Acre esq. Landaeta,<br /> LA PAZ, BO</div>
        <div>(+591) 60668602</div>
        <div><a href="mailto:company@example.com">hugo.birbuet@gestion.com</a></div>
      </div>
      <div id="project">
        <div><span>USUARIO</span> Hugo Birbuet</div>
        <div><span>CARGO</span> ADMINISTRADOR </div>
        <div><span>DIRECCION</span> 1855 Héroes del Acre esq. Landaeta, LA PAZ - BO</div>
        <div><span>EMAIL</span> hugo.birbuet@gestion.com</div>
        <div><span>FECHA</span> Junio 06, 2019</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">NOMBRES</th>
            <th class="desc">APELLIDOS</th>
            <th>TELF.</th>
            <th>DIRECCIÓN</th>
            <th>DESCRIPCIÓN</th>
            <th>FECHA DE RECEPCIÓN</th>
          </tr>
        </thead>
        <tbody>
          
            @foreach ($complaints as $complaint)
        <tr>
          <td class="service">{{$complaint->name}}</td>
          <td class="service">{{$complaint->lastname}}</td>
          <td class="service">{{$complaint->phone}}</td>
          <td class="service">{{$complaint->ref}}</td>
          <td class="service">{{$complaint->description}}</td>
          @php $newtime = strtotime($complaint->created_at); @endphp
          <td class="service">{{ $complaint->time = date('M d, Y', $newtime)}}</td>
        </tr>
            @endforeach
          <tr>
            <td colspan="4">TOTAL DENUNCIAS DEL MES</td>
            <td class="total">1</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">TOTAL DENUNCIAS</td>
            <td class="grand total">6</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>AVISO:</div>
        <div class="notice">El presente reportes, es el resultado de los últimos 30 días.</div>
      </div>
    </main>
    <footer>
      Gestión de Colectores Pluviales, I-2019.
    </footer>
  </body>
</html>