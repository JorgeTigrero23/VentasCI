<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte - Producto</title>
    <style>

        table th{ 
            background-color:#18BC9C; 
            color:#000;
            text-align:center; 
            font-size:14px; 
            padding: 10px 2px 10px 2px;
        } 
        table{ 
            border-collapse:collapse; 
        } 
        table td{ 
            font-size:13px; 
            padding-right:8px; 
            padding-left:8px;
            text-align:left; 
            border:#2C7AB8 1px solid; 
        } 
        table thead td { 
            font-size:10px; 
                
            } 
        table tr{ 
            border:1px solid #2C7AB8; 
        } 

    </style>
</head>
<body>
    
    <!-- HEADER -->
    <div class="header coverpage">
        
        <div style="width: 100%; height: 10px; background: green; margin-bottom: 2px;"></div>
        <div style="position:relative; height: 63px;">
            <div style="float:left; width: 25%; text-align: center;">
                {{-- <img src="{{ public_path() }}/images/company/{{ $company->logo }}" width="90px" height="60px"> --}}
            </div>
            <div style="float:left; text-align: center; width: 50%; font-size: 20px; margin-top: 17px;">
                <strong>Reporte</strong>
            </div>
            <div style="float:right; width: 25%; margin-top: 19px;">
                <div style="font-size: 12px;"> <strong>Fecha: </strong> {{ $date }} </div>
            </div>
        </div>

        <div style="width: 100%; height: 1px; background: black; margin-bottom: 10px;">

    </div>

    <div class="page-break">
        <div style="text-align: center;">
            <h2>Reporte de Productos</h2>
        </div>
        <table cellpadding="0" cellspacing="0" border="1" align="center">
            <thead>
                <tr>
                    <th>Código de Barra</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            
            <tbody>

                @foreach ($products as $product)
                    
                    <tr>
                        <td>{{ $product->barcode }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                @endforeach   
                   
            </tbody>
            
        </table>

    </div>
 
</body>
</html>
