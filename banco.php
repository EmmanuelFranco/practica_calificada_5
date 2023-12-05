<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica Calificada 5</title>
    <style>
        h2 {
            border: 1px solid black;
            margin: 0;
            border-radius: 5px;
            padding: 10px;
        }

        .contenedor {
            max-width: 26rem;                      
        }

        h4{
            color: blue;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <?php

        class TarjetaCredito
        {
            private $numeroTarjeta;
            private $contrasena;


            public function __construct($numeroTarjeta, $contrasena)
            {
                $this->numeroTarjeta = $numeroTarjeta;
                $this->contrasena = $contrasena;
            }

            public function verificarContrasena($contrasenaIngresada)
            {
                if ($contrasenaIngresada === $this->contrasena) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        class CuentaBancaria
        {
            private $numeroCuenta;
            private $saldo;
            private $tarjetaCredito;


            public function __construct($numeroCuenta, $saldo, $tarjetaCredito)
            {
                $this->numeroCuenta = $numeroCuenta;
                $this->saldo = $saldo;
                $this->tarjetaCredito = $tarjetaCredito;
            }

            public function depositar($contrasena, $monto)
            {
                if ($this->tarjetaCredito->verificarContrasena($contrasena)) {

                    $this->saldo += $monto;

                    return '<h2>' . 'Deposito exitoso. Nuevo saldo: $' . $this->saldo . '</h2>';
                } else {
                    return 'Error: Contraseña Incorrecta. Deposito no realizado';
                }
            }

            public function getNumeroCuenta()
            {
                return  $this->numeroCuenta;
            }
            public function getSaldo()
            {
                return  $this->saldo;
            }


            public function obtenerInformacion()
            {
                return 'Número de Cuenta: ' . '<h4>' .$this->numeroCuenta .'</h4>'. ' Saldo anterior: ' .'<h4>'.'$' .$this->saldo.'</h4>';
            }
        }

        class Banco
        {
            private $cuentas = [];

            public function __construct()
            {
            }

            public function agregarCuenta($cuenta)
            {
                $this->cuentas[] = $cuenta;
            }

            public function realizarDepositoCuentaBancaria($numeroCuenta, $contrasena, $monto)
            {
                foreach ($this->cuentas as $cuenta) {
                    if ($cuenta->getNumeroCuenta() === $numeroCuenta) {
                        return $cuenta->depositar($contrasena, $monto);
                    }
                }
                return "Error: La cuenta no existe.";
            }
        }

        $tarjeta1 = new TarjetaCredito("1234-5678-9101-1121", "contrasena123");
        $cuenta1 = new CuentaBancaria("C001", 500, $tarjeta1);

        $tarjeta2 = new TarjetaCredito("9876-5432-1011-1121", "otraContrasena");
        $cuenta2 = new CuentaBancaria("C002", 1000, $tarjeta2);


        $banco = new Banco();
        $banco->agregarCuenta($cuenta1);
        $banco->agregarCuenta($cuenta2);

        echo $cuenta1->obtenerInformacion() . "<br>";
        echo $banco->realizarDepositoCuentaBancaria("C001", "contrasena123", 150) . "<br>" . "<br>";

        echo $cuenta2->obtenerInformacion() . "<br>";
        echo $banco->realizarDepositoCuentaBancaria("C002", "otraContrasena", 300) . "<br>";

        echo $banco->realizarDepositoCuentaBancaria("003", "contrasena3", 100)."<br>";
        echo $banco->realizarDepositoCuentaBancaria("001","contrasenaERRONEA", 200)."<br>"."<br>";
        
        echo $cuenta1->obtenerInformacion() . "<br>";
        echo $banco->realizarDepositoCuentaBancaria("C001", "contrasena123", 300) . "<br>" . "<br>";
        ?>

    </div>
</body>

</html>