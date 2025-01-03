<?php
require_once 'Conexion.php';

class Productos
{
   public $id;
   public $nombre;
   public $marca;
   public $anio_lanzamiento;
   public $descripcion;
   public $descripcion_larga;
   public $material;
   public $talle_disponible;
   public $color_disponible;
   public $cantidad_disponible;
   public $imagen;
   public $categoria;
   public $precio;

   public function traer_catalogo(): array
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "SELECT * FROM productos";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      $catalogo = [];

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $productos = new self();
         $productos->id = $row['id'];
         $productos->nombre = $row['nombre'];
         $productos->marca = $row['marca'];
         $productos->anio_lanzamiento = $row['anio_lanzamiento'];
         $productos->descripcion = $row['descripcion'];
         $productos->descripcion_larga = $row['descripcion_larga'];
         $productos->material = $row['material'];
         $productos->talle_disponible = $row['talle_disponible'];
         $productos->color_disponible = $row['color_disponible'];
         $productos->cantidad_disponible = $row['cantidad_disponible'];
         $productos->imagen = $row['imagen'];
         $productos->categoria = $row['categoria'];
         $productos->precio = $row['precio'];
         $catalogo[] = $productos;
      }

      return $catalogo;
   }

   //traer producto por ID

   public function traer_detalle($idProducto)
   {
      $catalogo = $this->traer_catalogo();
      foreach ($catalogo as $productos) {
         if ($productos->id == $idProducto) {
            return $productos;
         }
      }
      return null;
   }

   public function traer_ofertas(): array
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "SELECT * FROM productos WHERE precio < 200";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      $ofertas = [];

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $oferta = new self();
         $oferta->id = $row['id'];
         $oferta->nombre = $row['nombre'];
         $oferta->marca = $row['marca'];
         $oferta->anio_lanzamiento = $row['anio_lanzamiento'];
         $oferta->descripcion = $row['descripcion'];
         $oferta->descripcion_larga = $row['descripcion_larga'];
         $oferta->material = $row['material'];
         $oferta->talle_disponible = $row['talle_disponible'];
         $oferta->color_disponible = $row['color_disponible'];
         $oferta->cantidad_disponible = $row['cantidad_disponible'];
         $oferta->imagen = $row['imagen'];
         $oferta->categoria = $row['categoria'];
         $oferta->precio = $row['precio'];
         $ofertas[] = $oferta;
      }

      return $ofertas;
   }

   public function traer_categoria($categoria): array
   {
      $resultado = [];
      $catalogo = $this->traer_catalogo();
      foreach ($catalogo as $producto) {
         if ($producto->categoria == $categoria) {
            $resultado[] = $producto;
         }
      }
      return $resultado;
   }

   public function traer_nombre_categoria(): array
   {
      $resultado = [];
      $catalogo = $this->traer_catalogo();
      foreach ($catalogo as $producto) {
         if ($producto->categoria) {
            $resultado[] = $producto->categoria;
         }
      }
      return array_unique($resultado);
   }

   public function traer_productos_por_material($material): array
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "SELECT * FROM productos WHERE material = :material";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':material', $material);
      $stmt->execute();

      $productos = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         $producto = new self();
         $producto->id = $row['id'];
         $producto->nombre = $row['nombre'];
         $producto->marca = $row['marca'];
         $producto->anio_lanzamiento = $row['anio_lanzamiento'];
         $producto->descripcion = $row['descripcion'];
         $producto->descripcion_larga = $row['descripcion_larga'];
         $producto->material = $row['material'];
         $producto->talle_disponible = $row['talle_disponible'];
         $producto->color_disponible = $row['color_disponible'];
         $producto->cantidad_disponible = $row['cantidad_disponible'];
         $producto->imagen = $row['imagen'];
         $producto->categoria = $row['categoria'];
         $producto->precio = $row['precio'];
         $productos[] = $producto;
      }

      return $productos;
   }

   public function guardarProducto($id, $nombre, $marca, $anio_lanzamiento, $descripcion, $descripcion_larga, $material, $talle_disponible, $color_disponible, $cantidad_disponible, $imagen, $categoria, $precio): bool
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "UPDATE productos SET nombre = :nombre, marca = :marca, anio_lanzamiento = :anio_lanzamiento, descripcion = :descripcion, descripcion_larga = :descripcion_larga, material = :material, talle_disponible = :talle_disponible, color_disponible = :color_disponible, cantidad_disponible = :cantidad_disponible, imagen = :imagen, categoria = :categoria, precio = :precio WHERE id = :id";

      $stmt = $db->prepare($sql);

      $stmt->bindValue(':nombre', $nombre);
      $stmt->bindValue(':marca', $marca);
      $stmt->bindValue(':anio_lanzamiento', $anio_lanzamiento);
      $stmt->bindValue(':descripcion', $descripcion);
      $stmt->bindValue(':descripcion_larga', $descripcion_larga);
      $stmt->bindValue(':material', $material);
      $stmt->bindValue(':talle_disponible', $talle_disponible);
      $stmt->bindValue(':color_disponible', $color_disponible);
      $stmt->bindValue(':cantidad_disponible', $cantidad_disponible);
      $stmt->bindValue(':imagen', $imagen);
      $stmt->bindValue(':categoria', $categoria);
      $stmt->bindValue(':precio', $precio);
      $stmt->bindValue(':id', $id);

      return $stmt->execute();
   }

   public function actualizar_producto($id, $nombre, $marca, $anio_lanzamiento, $descripcion, $descripcion_larga, $material, $talle_disponible, $color_disponible, $cantidad_disponible, $imagen, $categoria, $precio): bool
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "UPDATE productos SET nombre = :nombre, marca = :marca, anio_lanzamiento = :anio_lanzamiento, descripcion = :descripcion, descripcion_larga = :descripcion_larga, material = :material, talle_disponible = :talle_disponible, color_disponible = :color_disponible, cantidad_disponible = :cantidad_disponible, imagen = :imagen, categoria = :categoria, precio = :precio WHERE id = :id";

      $stmt = $db->prepare($sql);

      $stmt->bindValue(':nombre', $nombre);
      $stmt->bindValue(':marca', $marca);
      $stmt->bindValue(':anio_lanzamiento', $anio_lanzamiento);
      $stmt->bindValue(':descripcion', $descripcion);
      $stmt->bindValue(':descripcion_larga', $descripcion_larga);
      $stmt->bindValue(':material', $material);
      $stmt->bindValue(':talle_disponible', $talle_disponible);
      $stmt->bindValue(':color_disponible', $color_disponible);
      $stmt->bindValue(':cantidad_disponible', $cantidad_disponible);
      $stmt->bindValue(':imagen', $imagen);
      $stmt->bindValue(':categoria', $categoria);
      $stmt->bindValue(':precio', $precio);
      $stmt->bindValue(':id', $id);

      return $stmt->execute();
   }

   public function eliminarProducto($id): bool
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "DELETE FROM productos WHERE id = :id";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':id', $id);

      return $stmt->execute();
   }

   public function agregarProducto($nombre, $marca, $anio_lanzamiento, $descripcion, $descripcion_larga, $material, $talle_disponible, $color_disponible, $cantidad_disponible, $imagen, $categoria, $precio): bool
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "INSERT INTO `productos` (`nombre`, `marca`, `anio_lanzamiento`, `descripcion`, `descripcion_larga`, `material`, `talle_disponible`, `color_disponible`, `cantidad_disponible`, `imagen`, `categoria`, `precio`) VALUES (:nombre, :marca, :anio_lanzamiento, :descripcion, :descripcion_larga, :material, :talle_disponible, :color_disponible, :cantidad_disponible, :imagen, :categoria, :precio)";
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':nombre', $nombre);
      $stmt->bindValue(':marca', $marca);
      $stmt->bindValue(':anio_lanzamiento', $anio_lanzamiento);
      $stmt->bindValue(':descripcion', $descripcion);
      $stmt->bindValue(':descripcion_larga', $descripcion_larga);
      $stmt->bindValue(':material', $material);
      $stmt->bindValue(':talle_disponible', $talle_disponible);
      $stmt->bindValue(':color_disponible', $color_disponible);
      $stmt->bindValue(':cantidad_disponible', $cantidad_disponible);
      $stmt->bindValue(':imagen', $imagen);
      $stmt->bindValue(':categoria', $categoria);
      $stmt->bindValue(':precio', $precio);

      return $stmt->execute();
   }


   public function guardarEnCarrito($id, $cantidad, $usuario_id)
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "INSERT INTO `carrito_producto` (`usuario_id`, `producto_id`, `cantidad`) VALUES (:usuario_id, :producto_id, :cantidad)";
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':usuario_id', $usuario_id);
      $stmt->bindValue(':producto_id', $id);
      $stmt->bindValue(':cantidad', $cantidad);

      return $stmt->execute();
   }

   public function traer_carrito($usuario_id)
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();

      $sql = "SELECT p.*, cp.cantidad FROM `productos` AS p JOIN carrito_producto AS cp ON p.id = cp.producto_id WHERE cp.usuario_id = :usuario_id";
      $stmt = $db->prepare($sql);
      
      $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
      $stmt->execute();
      $productos = $stmt->fetchAll(PDO::FETCH_CLASS, 'Productos');
      return $productos;
   }

   public function eliminar_del_carrito($usuario_id, $producto_id)
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();
      // Verificar si el producto ya está en el carrito
      $stmt = $db->prepare("SELECT * FROM `carrito_producto` WHERE `usuario_id` = :usuario_id AND `producto_id` = :producto_id");
      $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
      $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
      $stmt->execute();
      $producto_en_carrito = $stmt->fetch(PDO::FETCH_ASSOC);

      // Si el producto está en el carrito y tiene más de una unidad, reducir la cantidad en 1
      if ($producto_en_carrito && $producto_en_carrito['cantidad'] > 1) {
         $stmt = $db->prepare("UPDATE `carrito_producto` SET `cantidad` = `cantidad` - 1 WHERE `usuario_id` = :usuario_id AND `producto_id` = :producto_id");
         $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
         $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
         return $stmt->execute();
      } else {
         // Si el producto está en el carrito y tiene solo una unidad, eliminarlo completamente
         $stmt = $db->prepare("DELETE FROM `carrito_producto` WHERE `usuario_id` = :usuario_id AND `producto_id` = :producto_id");
         $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
         $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
         return $stmt->execute();
      }
   }

   // Método para buscar un producto en el carrito
   public function buscarProductoEnCarrito($producto_id, $usuario_id)
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();
      $stmt = $db->prepare("SELECT * FROM `carrito_producto` WHERE `usuario_id` = :usuario_id AND `producto_id` = :producto_id");
      $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
      $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   // Método para actualizar la cantidad de un producto en el carrito
   public function actualizarCantidadEnCarrito($producto_id, $nueva_cantidad, $usuario_id)
   {
      $conexion = new Conexion();
      $db = $conexion->getConexion();
      $stmt = $db->prepare("UPDATE `carrito_producto` SET `cantidad` = :nueva_cantidad WHERE `usuario_id` = :usuario_id AND `producto_id` = :producto_id");
      $stmt->bindParam(':nueva_cantidad', $nueva_cantidad, PDO::PARAM_INT);
      $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
      $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
      return $stmt->execute();
   }
}
