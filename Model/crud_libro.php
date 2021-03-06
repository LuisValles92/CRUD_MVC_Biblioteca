<?php
// incluye la clase Db
require_once('Conexion.php');

class CrudLibro
{
	// constructor de la clase
	public function __construct()
	{
	}

	// método para insertar, recibe como parámetro un objeto de tipo libro
	public function insertar($libro)
	{

		$conexion = Conexion::getInstance();
		$insert = $conexion->prepare('INSERT INTO libros values(NULL,?,?,?)');
		$insert->execute(array($libro->getNombre(), $libro->getAutor(), $libro->getAnio_edicion()));
	}

	// método para mostrar todos los libros
	public function mostrar()
	{
		$conexion = Conexion::getInstance();
		$listaLibros = [];
		$select = $conexion->prepare('SELECT * FROM libros');
		$select->execute();
		foreach ($select->fetchAll() as $libro) {
			$myLibro = new Libro();
			$myLibro->setId($libro['id']);
			$myLibro->setNombre($libro['nombre']);
			$myLibro->setAutor($libro['autor']);
			$myLibro->setAnio_edicion($libro['anio_edicion']);
			$listaLibros[] = $myLibro;
		}
		return $listaLibros;
	}

	// método para eliminar un libro, recibe como parámetro el id del libro
	public function eliminar($id)
	{
		$conexion = Conexion::getInstance();
		$eliminar = $conexion->prepare('DELETE FROM libros WHERE ID=?');
		$eliminar->execute(array($id));
	}

	// método para buscar un libro, recibe como parámetro el id del libro
	public function obtenerLibro($id)
	{
		$conexion = Conexion::getInstance();
		$select = $conexion->prepare('SELECT * FROM libros WHERE ID=?');
		$select->execute(array($id));
		$libro = $select->fetch();
		$myLibro = new Libro();
		$myLibro->setId($libro['id']);
		$myLibro->setNombre($libro['nombre']);
		$myLibro->setAutor($libro['autor']);
		$myLibro->setAnio_edicion($libro['anio_edicion']);
		return $myLibro;
	}

	// método para actualizar un libro, recibe como parámetro el libro
	public function actualizar($libro)
	{
		$conexion = Conexion::getInstance();
		$actualizar = $conexion->prepare('UPDATE libros SET NOMBRE=?, AUTOR=?, ANIO_EDICION=?  WHERE ID=?');
		$actualizar->execute(array($libro->getNombre(), $libro->getAutor(), $libro->getAnio_edicion(), $libro->getId()));
	}
}
