<?php
    class basedatos{
        private $con;
		private $dbequipo='sql302.infinityfree.com';
		private $dbusuario='if0_37534988';
		private $dbclave='vcjf01TeuY8';
		private $dbnombre='if0_37534988_Alquiler_equipos';

        //constructor	
		function __construct(){
			$this->conectar();
		}//fin constructor


        //función para conectarse a la base de datos
		public function conectar(){
			$this->con = mysqli_connect($this->dbequipo, $this->dbusuario, $this->dbclave, $this->dbnombre);

			if(mysqli_connect_error()){
				die("Error: No se pudo conectar a la base de datos: " . mysqli_connect_error() . mysqli_connect_errno());
			}

		}//fin funcion conectar


		public function login($usuario,$clave){
			$sql="SELECT COUNT(*) as registros FROM usuarios WHERE nombre_usuario='$usuario' AND contrasena='$clave';";
			$resultado = mysqli_query($this->con,$sql);
			return $resultado;

		}
		
      
    
        
    }// fin clase basedatos

  
    $conn = mysqli_connect("localhost", "root", "", "alquiler");
        
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>



    
