<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Clínica Odontológica</title>
<link rel="stylesheet" href="stylesPanel.css">
</head>

<body>

<header class="header">
        <h2>Clínica Odontologa Galileo Galilei de San Martín</h2>
</header>

<main class="container">

    <section class="card center">
        <center><h2>Panel Principal</h2>
      
        <h3>Acá vas a encontrar todas las funciones que ofrece nuestra página. 
          Dependiendo de tus permisos, vas a poder ver distintas Mini-Aplicaciones ¡Esperamos que disfrutes la página!</h3>
      
      </center>


      <section class="py-20 bg-white px-4">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-azul-ponce mb-4 uppercase tracking-tighter">Nuestras Coberturas</h2>
            <div class="w-20 h-1 bg-azul-ponce mx-auto"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="border border-gray-100 p-8 rounded-lg text-center flex flex-col h-full hover:shadow-lg transition transform hover:-translate-y-2">
                <i class="fas fa-building text-4xl text-azul-ponce mb-4"></i>
                <h3 class="font-bold text-lg mb-3 text-azul-ponce">Seguros Integrales</h3>
                <p class="text-xs text-gray-500 mb-6 flex-grow">Comercio, Consorcio e Industrias. A.R.T. y Cauciones.</p>
                <button onclick="abrirInfo('integrales')" class="btn-mas"><span class="text-2xl font-light">+</span></button>
                <p class="text-[9px] uppercase tracking-widest mt-3 text-gray-400 font-bold italic">Más Info</p>
            </div>

            <div class="border border-gray-100 p-8 rounded-lg text-center flex flex-col h-full hover:shadow-lg transition transform hover:-translate-y-2">
                <i class="fas fa-car text-4xl text-azul-ponce mb-4"></i>
                <h3 class="font-bold text-lg mb-3 text-azul-ponce">Seguros Patrimoniales</h3>
                <p class="text-xs text-gray-500 mb-6 flex-grow">Autos, Hogar, Embarcaciones y Accidentes.</p>
                <button onclick="abrirInfo('patrimoniales')" class="btn-mas"><span class="text-2xl font-light">+</span></button>
                <p class="text-[9px] uppercase tracking-widest mt-3 text-gray-400 font-bold italic">Más Info</p>
            </div>

            <div class="border border-gray-100 p-8 rounded-lg text-center flex flex-col h-full hover:shadow-lg transition transform hover:-translate-y-2">
                <i class="fas fa-heart text-4xl text-azul-ponce mb-4"></i>
                <h3 class="font-bold text-lg mb-3 text-azul-ponce">Seguros de Vida</h3>
                <p class="text-xs text-gray-500 mb-6 flex-grow">Protección familiar y societaria personalizada.</p>
                <button onclick="abrirInfo('vida')" class="btn-mas"><span class="text-2xl font-light">+</span></button>
                <p class="text-[9px] uppercase tracking-widest mt-3 text-gray-400 font-bold italic">Más Info</p>
            </div>

            <div class="border border-gray-100 p-8 rounded-lg text-center flex flex-col h-full hover:shadow-lg transition transform hover:-translate-y-2">
                <i class="fas fa-chart-line text-4xl text-azul-ponce mb-4"></i>
                <h3 class="font-bold text-lg mb-3 text-azul-ponce">Seguros de Ahorro</h3>
                <p class="text-xs text-gray-500 mb-6 flex-grow">Planificación financiera y retiro con capitalización.</p>
                <button onclick="abrirInfo('ahorro')" class="btn-mas"><span class="text-2xl font-light">+</span></button>
                <p class="text-[9px] uppercase tracking-widest mt-3 text-gray-400 font-bold italic">Más Info</p>
            </div>
        </div>
    </div>
</section>

    </section>

</main>

</body>
</html>