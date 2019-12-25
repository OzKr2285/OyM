@extends('principal')
@section('contenido')

    @if(Auth::check())
            @if (Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <h1>Escritorio</h1>
            </template>
            <template v-if="menu==37">
                <persona></persona>
            </template>
            <template v-if="menu==36">
                <proveedor></proveedor>
            </template>
          
            <template v-if="menu==1">
                <tpestacion></tpestacion>
            </template>
            <template v-if="menu==31">
                <insumo></insumo>
            </template>
            <template v-if="menu==32">
                <insumoe></insumoe>
            </template>

            <template v-if="menu==2">
                <estacion></estacion>
            </template>

            <template v-if="menu==3">
                <equipo></equipo>
            </template>

            <template v-if="menu==4">
                <accesorio></accesorio>
            </template>

            <template v-if="menu==5">
                <fichaes></fichaes>
            </template>

            <template v-if="menu==6">
                <fichaveh></fichaveh>
            </template>

            <template v-if="menu==64">
                <user></user>
            </template>

            <template v-if="menu==8">
                <rol></rol>
            </template>

            <template v-if="menu==9">
                <ficharedes></ficharedes>
            </template>

            <template v-if="menu==10">
            <red></red>
            </template>
            
            <template v-if="menu==11">
            <fichapasose></fichapasose>
            </template>

            <template v-if="menu==12">
            <etapa></etapa>
            </template>
            <template v-if="menu==13">
            <tpequipo></tpequipo>
            </template>
            <template v-if="menu==33">
            <refequipo></refequipo>
            </template>
            <template v-if="menu==34">
            <actividad></actividad>
            </template>
            <template v-if="menu==35">
            <actividade></actividade>
            </template>
            <template v-if="menu==41">
            <ecomputo></ecomputo>
            </template>
            <template v-if="menu==42">
            <marca></marca>
            </template>
            <template v-if="menu==43">
            <modelo></modelo>
            </template>
            <!-- Gestion de PQRS     -->
            <template v-if="menu==38">
                <categoria></categoria>
            </template>
            <template v-if="menu==39">
                <objpqrs></objpqrs>
            </template>
            <template v-if="menu==40">
                <ticketserv></ticketserv>
            </template>
            <template v-if="menu==44">
                <catserv></catserv>
            </template>
            <template v-if="menu==45">
                <servicio></servicio>
            </template>
            <template v-if="menu==47">
                <dispo></dispo>
            </template>
            <template v-if="menu==48">
                <tpmaterial></tpmaterial>
            </template>
            <template v-if="menu==49">
                <refmaterial></refmaterial>
            </template>
            <template v-if="menu==50">
                <insta></insta>
            </template>
            <template v-if="menu==52">
                <ciclo></ciclo>
            </template>
            <template v-if="menu==53">
                <mercado></mercado>
            </template>
            <template v-if="menu==54">
                <mtoEC></mtoEC>
            </template>

            <template v-if="menu==55">
                <oficina></oficina>
            </template>

            <template v-if="menu==56">
                <mtoEC></mtoEC>
            </template>

            <template v-if="menu==57">
                <tecnico></tecnico>
            </template>

            <template v-if="menu==58">
                <diametro></diametro>
            </template>

            <template v-if="menu==59">
                <marcaveh></marcaveh>
            </template>

            <template v-if="menu==60">
                <linea></linea>
            </template>

            <template v-if="menu==61">
                <areas></areas>
            </template>

            <template v-if="menu==62">
                <cargo></cargo>
            </template>

            <template v-if="menu==63">
                <horario></horario>
            </template>
   
            <template v-if="menu==65">
                <ticketasignar></ticketasignar>
            </template>

            <template v-if="menu==66">
                <tptramite></tptramite>
            </template>
   
            <template v-if="menu==67">
                <detcausal></detcausal>
            </template>
   
            <template v-if="menu==68">
                <novedad></novedad>
            </template>
   
            <template v-if="menu==69">
                <mtoveh></mtoveh>
            </template>
   
            <template v-if="menu==70">
                <mtored></mtored>
            </template>
   
            <template v-if="menu==71">
                <mtope></mtope>
            </template>
            <template v-if="menu==72">
                <ticketservtec></ticketservtec>
            </template>
   

            <!-- Programacion  de Mantenimientos -->
            <template v-if="menu==20">
            <mtoes></mtoes>
            </template>



            @elseif (Auth::user()->idrol == 2)
            <template v-if="menu==5">
                <venta></venta>
            </template>

            <template v-if="menu==6">
                <cliente></cliente>
            </template>
            <template v-if="menu==10">
                <h1>Reporte de ventas</h1>
            </template>

            <template v-if="menu==11">
                <h1>Ayuda</h1>
            </template>

            <template v-if="menu==12">
                <h1>Acerca de</h1>
            </template>
            <template v-if="menu==72">
                <ticketservtec></ticketservtec>
            </template>
            @elseif (Auth::user()->idrol == 3)

            <template v-if="menu==1">
                <categoria></categoria>
            </template>

            <template v-if="menu==2">
                <articulo></articulo>
            </template>

            <template v-if="menu==3">
                <equipo></equipo>
            </template>
            <template v-if="menu==36">
                <proveedor></proveedor>
            </template>
          
            <!-- <template v-if="menu==9">
                <tabdemo></tabdemo>
            </template> -->
            <template v-if="menu==11">
                <h1>Ayuda</h1>
            </template>

            <template v-if="menu==12">
                <h1>Acerca de</h1>
            </template>

            <template v-if="menu==72">
                <ticketservtec></ticketservtec>
            </template>
   
            @else

            @endif

    @endif
       
        
    @endsection