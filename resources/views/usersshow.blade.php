
@include('header')
<br>
<br>
<div class="row mt-3">
    <div class="col-8">
        <h1>Usuario #{{ $id }}</h1> <!-- >?= es una abreviacio de >?php echo -->

        Mostrando detalle del usuario: {{ $id }}
        
    </div>
    <div class="col-4">
        @include('sidebar')
    </div>
    
</div>

        
        
@include('footer')