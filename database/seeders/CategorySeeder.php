<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
                'nombre' => 'Libros y revistas',
                'descripcion' => 'Ficción, No ficción, Literatura infantil, Libros de texto, Revistas especializadas, Cómics y novelas gráficas, Libros de idiomas, Guías de preparación para exámenes, Libros de referencia y enciclopedias, Diccionarios y tesauros, Atlas y mapas',
            ],
            [
                'nombre' => 'Papelería',
                'descripcion' => 'Cuadernos, Bolígrafos y lápices, Carpetas y archivadores, Papel y sobres, Pegamento y cinta adhesiva, Gomas de borrar y sacapuntas',
            ],
            [
                'nombre' => 'Material de escritorio',
                'descripcion' => 'Organizadores de escritorio, Portalápices, Soportes para libros, Calculadoras, Calendarios y planificadores',
            ],
            [
                'nombre' => 'Arte y manualidades',
                'descripcion' => 'Pinturas y acuarelas, Pinceles y paletas, Papel de dibujo y blocs de notas, Arcilla y modelado, Kits de manualidades',
            ],
            [
                'nombre' => 'Artículos de regalo',
                'descripcion' => 'Tarjetas de felicitación, Álbumes de fotos, Marcos decorativos, Detalles y recuerdos, Sets de regalo temáticos',
            ],
            [
                'nombre' => 'Material de oficina',
                'descripcion' => 'Máquinas de escribir y calculadoras, Archivadores y organizadores, Papeleras y cubos de basura, Sillas y escritorios, Equipos de presentación (proyectores, pantallas)',
            ],
            [
                'nombre' => 'Productos de papelería especializados',
                'descripcion' => 'Papelería para artistas (pinceles especiales, lienzos), Material de escritura de lujo (plumas estilográficas, bolígrafos premium), Papelería ecológica y sostenible, Material de papelería temático (personajes, películas, series)',
            ],
            [
                'nombre' => 'Suministros de escritura',
                'descripcion' => 'Marcadores y resaltadores, Rotuladores y subrayadores, Lapiceros de gel y tinta líquida, Portaminas y minas, Correctores y cintas correctoras',
            ],
            [
                'nombre' => 'Material escolar',
                'descripcion' => 'Mochilas y estuches, Reglas y transportadores, Compases y escuadras, Calculadoras científicas, Sets de geometría',
            ],
            [
                'nombre' => 'Material de arte',
                'descripcion' => 'Pinceles de diferentes tamaños y formas, Acuarelas y acrílicos, Lienzos y bastidores, Caballetes y atriles, Material para manualidades y decoración',
            ],
            [
                'nombre' => 'Tecnología y accesorios',
                'descripcion' => 'Calculadoras científicas y gráficas, Dispositivos de almacenamiento (USB, discos duros), Auriculares y altavoces, Cables y adaptadores, Fundas y protectores para dispositivos electrónicos',
            ],
            [
                'nombre' => 'Suministros de oficina',
                'descripcion' => 'Papel de impresión y fotocopia, Sobres y etiquetas, Grapas y clips, Archivadores y carpetas, Calculadoras de escritorio',
            ],
            [
                'nombre' => 'Arte y manualidades',
                'descripcion' => 'Tijeras y cúters, Pegamentos y adhesivos, Papel de colores y cartulinas, Purpurina y lentejuelas, Sellos y almohadillas de tinta',
            ],
            [
                'nombre' => 'Organización y almacenamiento',
                'descripcion' => 'Cajas y organizadores de escritorio, Bandejas y organizadores de documentos, Estanterías y muebles de almacenamiento, Cajas de almacenamiento y organización',
            ],
            [
                'nombre' => 'Papelería personalizada',
                'descripcion' => 'Tarjetas de felicitación y postales, Invitaciones y tarjetas de agradecimiento, Sellos personalizados y etiquetas, Papel de carta y sobres decorativos',
            ],
            [
                'nombre' => 'Productos de cotillón',
                'descripcion' => 'Gorros de fiesta y sombreros divertidos, Máscaras y antifaces, Accesorios para photocall, Confeti y serpentinas, Piñatas y artículos para fiestas temáticas',
            ],
            [
                'nombre' => 'cuadernos',
                'descripcion' => 'cuadernos bon, a cuadros y lineales en todos los tamanos y marcas',
            ],
        ];


        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

    }
}
