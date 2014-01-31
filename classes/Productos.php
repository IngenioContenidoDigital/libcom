<?php	
	include('hosts.php');	
	
	class Producto{		
		public $resultado=array();
        public $titulo="";
        public $detalle="";
        
		function TipoProducto($idtipoproducto){
						
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "SELECT productos.IdProducto, productos.NombreProducto, productos.manual, marcas.IdMarca, 
            marcas.Marca, productos_categoria.IdCategoriaProducto, productos_categoria.NombreCategoria 
            FROM productos 
            INNER JOIN productos_categoria ON productos.IdCategoriaProducto = productos_categoria.IdCategoriaProducto 
            INNER JOIN marcas ON productos.IdMarca = marcas.IdMarca  
            WHERE productos_categoria.IdCategoriaProducto=".$idtipoproducto;

			$result=$cnn->query($sql);
            while($arr=$result->fetch_assoc()){
                $row['IdProducto']=$arr['IdProducto'];
                $row['NombreProducto']=$arr['NombreProducto'];
                $row['manual']=$arr['manual'];
                $row['IdMarca']=$arr['IdMarca'];
                $row['Marca']=$arr['Marca'];
                $row['IdCategoriaProducto']=$arr['IdCategoriaProducto'];
                $row['NombreCategoria']=$arr['NombreCategoria'];
                array_push($this->resultado,$row);
            }
			$cnn->close();
            return $this->resultado;
		}
        
        function MarcaProducto($idmarca){
						
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "SELECT productos.IdProducto, productos.NombreProducto, productos.manual, marcas.IdMarca, 
            marcas.Marca, productos_categoria.IdCategoriaProducto, productos_categoria.NombreCategoria 
            FROM productos 
            INNER JOIN productos_categoria ON productos.IdCategoriaProducto = productos_categoria.IdCategoriaProducto 
            INNER JOIN marcas ON productos.IdMarca = marcas.IdMarca  
            WHERE marcas.IdMarca=".$idmarca;

			$result=$cnn->query($sql);
            while($arr=$result->fetch_assoc()){
                $row['IdProducto']=$arr['IdProducto'];
                $row['NombreProducto']=$arr['NombreProducto'];
                $row['manual']=$arr['manual'];
                $row['IdMarca']=$arr['IdMarca'];
                $row['Marca']=$arr['Marca'];
                $row['IdCategoriaProducto']=$arr['IdCategoriaProducto'];
                $row['NombreCategoria']=$arr['NombreCategoria'];
                array_push($this->resultado,$row);
            }
			$cnn->close();
            return $this->resultado;
		}
        
        function BuscarProducto($criterio){
						
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "SELECT productos.IdProducto, productos.NombreProducto, productos.manual, marcas.IdMarca, 
            marcas.Marca, productos_categoria.IdCategoriaProducto, productos_categoria.NombreCategoria 
            FROM productos 
            INNER JOIN productos_categoria ON productos.IdCategoriaProducto = productos_categoria.IdCategoriaProducto 
            INNER JOIN marcas ON productos.IdMarca = marcas.IdMarca  
            WHERE productos.NombreProducto LIKE '%".$criterio."%'";

			$result=$cnn->query($sql);
            while($arr=$result->fetch_assoc()){
                $row['IdProducto']=$arr['IdProducto'];
                $row['NombreProducto']=$arr['NombreProducto'];
                $row['manual']=$arr['manual'];
                $row['IdMarca']=$arr['IdMarca'];
                $row['Marca']=$arr['Marca'];
                $row['IdCategoriaProducto']=$arr['IdCategoriaProducto'];
                $row['NombreCategoria']=$arr['NombreCategoria'];
                array_push($this->resultado,$row);
            }
			$cnn->close();
            return $this->resultado;
		}        
                
        function GrupoProducto($idgrupo){
						
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "SELECT productos.IdProducto, productos.NombreProducto, productos.manual, marcas.IdMarca, 
            marcas.Marca, productos_categoria.IdCategoriaProducto, productos_categoria.NombreCategoria, 
            grupos.IdGrupo, grupos.NombreGrupo 
            FROM productos 
            INNER JOIN productos_categoria ON productos.IdCategoriaProducto = productos_categoria.IdCategoriaProducto 
            INNER JOIN marcas ON productos.IdMarca = marcas.IdMarca 
            INNER JOIN productos_grupo ON productos.IdProducto = productos_grupo.IdProducto 
            INNER JOIN grupos ON productos_grupo.IdGrupo = grupos.IdGrupo 
            WHERE productos_grupo.IdGrupo =".$idgrupo;

			$result=$cnn->query($sql);
            while($arr=$result->fetch_assoc()){
                $row['IdProducto']=$arr['IdProducto'];
                $row['NombreProducto']=$arr['NombreProducto'];
                $row['manual']=$arr['manual'];
                $row['IdMarca']=$arr['IdMarca'];
                $row['Marca']=$arr['Marca'];
                $row['IdCategoriaProducto']=$arr['IdCategoriaProducto'];
                $row['NombreCategoria']=$arr['NombreCategoria'];
                $row['IdGrupo']=$arr['IdGrupo'];
                $row['NombreGrupo']=$arr['NombreGrupo'];
                array_push($this->resultado,$row);
            }
			$cnn->close();
            return $this->resultado;
		}
                
	};
?>