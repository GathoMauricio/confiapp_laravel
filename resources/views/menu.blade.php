    <div id="sidedrawer" class="mui--no-user-select">
        <div id="sidedrawer-brand" class="mui--appbar-line-height">
            <span class="mui--text-title">Menú</span>
        </div>
        <div class="mui-divider"></div>
        <ul>
            <li>
                <strong><img src="{{ asset('/images/iconos/home.png') }}" width="19" height="14" /> <a
                        href="{{ route('/') }}">Inicio</a></strong>
            </li>
            <li>
                <strong><img src="{{ asset('/images/iconos/docs.fw.png') }}" width="19" height="14" /> <a
                        href="#">Impuesto Sobre la Renta</a></strong>
                <ul>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?impuestos=sueldos"> Sueldos y Salarios</a></li>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?otras=remuneraciones"> Otras Remuneraciones</a></li>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?impuestos=sueldos&asimilados=1"> Asimilados a Salarios</a></li>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?calculo=honorarios"> Honorarios</a></li>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?impuesto=anual"> Impuesto Anual</a></li>
                </ul>
            </li>
            <li>
                <strong><img src="{{ asset('/images/iconos/docs.fw.png') }}" width="19" height="14" /><a
                        href="#"> Impuesto Anual con Proyección a Devolución de Impuestos</a></strong>
                <ul>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?pdi=completo"> Completo</a></li>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?pdi=simulador"> Simulador</a></li>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?pdi=prestadores"> Para Prestadores de Servicios</a></li>
                </ul>
            </li>
            <li>
                <strong><img src="{{ asset('/images/iconos/docs.fw.png') }}" width="19" height="14" /><a
                        href="#"> Finiquitos</a></strong>
                <ul>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?finiquitos=a96"> Artículo 96</a></li>
                    <li><img src="{{ asset('/images/iconos/money.fw.png') }}"><a
                            href="{{ route('opcion') }}?finiquitos=a174"> Articulo 174</a></li>
                </ul>
            </li>
            <li>
                <strong><img src="{{ asset('/images/iconos/money.fw.png') }}" width="19" height="14" /><a
                        href="{{ route('opcion') }}?ver=config"> Configuración</a></strong>

            </li>
            <li>
                <strong><img src="{{ asset('/images/iconos/location.fw.png') }}" width="19" height="14" /><a
                        href="#"> Tablas de Impuesto Aplicables</a></strong>
                <ul>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2016"> Tablas 2016</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2017"> Tablas 2017</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2018"> Tablas 2018</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2019"> Tablas 2019</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2020"> Tablas 2020</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2021"> Tablas 2021</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2022"> Tablas 2022</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2023"> Tablas 2023</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2024"> Tablas 2024</a></li>
                    <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a
                            href="{{ route('opcion') }}?ver=tablas&year=2025"> Tablas 2025</a></li>
                </ul>
            </li>

            <strong><img src="{{ asset('/images/iconos/legal.fw.png') }}" width="19" height="14" /> <a
                    href="#">Fundamentos Legales</a></strong>
            <ul>
                <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a href="{{ route('opcion') }}?ver=indice">
                        Índice</a></li>
                <li><img src="{{ asset('/images/iconos/hoja.fw.png') }}"><a href="{{ route('opcion') }}?ver=buscador">
                        Buscar</a></li>
            </ul>

            <li>
                <strong><img src="{{ asset('/images/iconos/nosotros.fw.png') }}" width="19" height="14" /><a
                        href="{{ route('opcion') }}?ver=quienes"> ¿Quiénes Somos?</a></strong>

            </li>

            <li>
                <strong><img src="{{ asset('/images/iconos/terminos.fw.png') }}" width="19" height="14" /><a
                        href="{{ route('opcion') }}?ver=productos"> Productos</a></strong>

            </li>

            <li>
                <strong><img src="{{ asset('/images/iconos/faq.fw.png') }}" width="19" height="14" /><a
                        href="{{ route('opcion') }}?ver=faq"> Preguntas Frecuentes</a></strong>

            </li>

            <li>
                <strong><img src="{{ asset('/images/iconos/service.fw.png') }}" width="19" height="14" /><a
                        href="{{ route('opcion') }}?ver=tutoriales"> Tutoriales</a></strong>

            </li>

            <li>
                <strong><img src="{{ asset('/images/iconos/email.fw.png') }}" width="19" height="14" /><a
                        href="{{ route('contacto') }}"> Contacto</a></strong>

            </li>

            <li>
                <strong><img src="{{ asset('/images/iconos/think.fw.png') }}" width="19" height="14" /><a
                        href="{{ route('recomienda') }}"> Recomiéndanos</a></strong>

            </li>
        </ul>
    </div>
