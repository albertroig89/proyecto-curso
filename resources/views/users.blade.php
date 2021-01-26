@include('header')
<br>
<br>
<div class="row mt-3">
    <div class="col-8">
        <h1>{{ $title }}</h1> <!-- >?= es una abreviacio de >?php echo -->

        <ul>

        @forelse ($users as $user)
            <li>{{ $user }}</li> <!--e($user) el que fa es ometre la lectura si algu ens coloca codic de html o javascript aon tindria que anar el nom d'usuari-->
        @empty
            <li>No hay usuarios registrados.</li>

        @endforelse

        </ul>
    </div>
    <div class="col-4">
        @include('sidebar')
    </div>
    
</div>

        
        
@include('footer')

