{{-- {{var_dump($msg)}} --}}
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Notificación Solicitud de Servicio Técnico</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        </head>
        <body style="margin: 0; padding: 0;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">	
                <tr>
                    <td style="padding: 10px 0 30px 0;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
               
                            <tr>
                                <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                                                <b>Señor(a) {{ $msg2['nombre'] }}  </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                <p>Su compromiso con Enercer nos ayuda a ser cada día mejores, por favor atender la solicitud lo más pronto posible:</p>
                                                <strong style="font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">Nombre del Usuario: {{ $msg['nombres'] }}  {{ $msg['apellidos'] }} </strong> <br>
                                                <strong style="font-family: Arial, sans-serif; font-size: 12px; line-height: 20px;">Solicitud #: {{ $msg['id'] }}</strong>
                                                <p>Dirección: {{ $msg['direccion'] }}</p>
                                                <p>Telefono: {{ $msg['telefono'] }}</p>
                                                <p>Descripción : {{ $msg['desc'] }}</p>
                                            </td>
                                        </tr>
                                        <tr>
            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#7E7F80" style="padding: 30px 30px 30px 30px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
                                                &reg; Derechos Reservados Enercer 2019<br/>
                                                <a href="https://enercer.com/" style="color: #ffffff;"><font color="#ffffff">Enercer</font></a>  tu Fuente de Energía 
                                            </td>
                                            <td align="right" width="25%">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                            <a href="http://www.twitter.com/" style="color: #ffffff;">
                                                                <img src="img/Twiter.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
                                                            </a>
                                                        </td>
                                                        <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                        <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                            <a href="http://www.twitter.com/" style="color: #ffffff;">
                                                                <img src="img/facebook.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
</html>