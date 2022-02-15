<?php

class LibroModel
{

    private $conn;

    public function __construct()
    {
        $this->conn = ConnDB::creaConn();

    }

    public function getLibros()
    {
        $stmt = $this->conn->prepare("select libro.libro_id,libro.title,libro.precio,libro.isbn13,libro.image,e.editorial_name, li.idioma_name from libro
                                                inner join editorial e on libro.editorial_id = e.editorial_id
                                                inner join libro_idioma li on libro.idioma_id = li.idioma_id
                                                limit 10;"); //me devuelve all menos autores
        $stmt->execute();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $respuesta = array();

        foreach ($libros as $libro) {
            //aqui cojo los autores de cada libro
            $autores = $this->getAutoresLibro($libro['libro_id']);

            $respuesta[] = array('libroData' => array('nombre' => $libro['title'], 'precio' => $libro['precio'], 'isbn13' => $libro['isbn13'], 'image' => $libro['image'], 'libro_id' => $libro['libro_id']), 'editorial' => $libro['editorial_name'], 'idioma' => $libro['idioma_name'], 'autor' => $autores);
            //quiero enviar un array el primero sera un array de tabla libros con su titulo, isb
            //segundo enviar un array de autores
            //tercero nombre editorial y cuarto nombre del idioma
        }


        return $respuesta;
    }


    public function getLibro($libro_id)
    {
        $stmt = $this->conn->prepare("select libro.libro_id,libro.title,libro.precio,libro.isbn13,libro.image,e.editorial_name, li.idioma_name from libro
                                                inner join editorial e on libro.editorial_id = e.editorial_id
                                                inner join libro_idioma li on libro.idioma_id = li.idioma_id WHERE libro.libro_id = ?");
        $stmt->bindParam(1, $libro_id);
        $stmt->execute();
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);
        $autor = $this->getAutoresLibro($libro['libro_id']);
        // posible anyadir si es vacio anonimo
        if (empty($autor)) {
            $autor = array('autor' => 'anonimo');
        }
        $respuesta = array('libroData' => array('nombre' => $libro['title'], 'precio' => $libro['precio'], 'isbn13' => $libro['isbn13'], 'image' => $libro['image'], 'libro_id' => $libro['libro_id']), 'editorial' => $libro['editorial_name'], 'idioma' => $libro['idioma_name'], 'autor' => $autor);
        return $respuesta;
    }


    public function getMejorValorados()
    {
        $stmt = $this->conn->prepare("SELECT valoracion.libro_id, avg(valoracion.puntuacion) as valoracionMedia from valoracion group by libro_id order by avg(valoracion.puntuacion) desc limit 10;");
        $stmt->execute();
        $mejorValorados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($mejorValorados as $libro) {
            $idMejorValorados [] = $libro['libro_id'];
            $valoraciones [] = $libro['valoracionMedia'];
        }
        $stmt = $this->conn->prepare("select libro.libro_id,libro.title,libro.precio,libro.isbn13,libro.image,e.editorial_name, li.idioma_name from libro
                                                inner join editorial e on libro.editorial_id = e.editorial_id
                                                inner join libro_idioma li on libro.idioma_id = li.idioma_id WHERE libro_id IN (" . implode(",", $idMejorValorados) . ");");

        $stmt->execute();
        $infoMejorValorados = $stmt->fetchAll();


        $respuesta = array();

        foreach ($infoMejorValorados as $libro) {
            //aqui cojo los autores de cada libro
            $autores = $this->getAutoresLibro($libro['libro_id']);
            if (empty($autores)) {
                $autores = array('autor' => 'anonimo');
            }
            $valoracionMedia = $this->getValoracionLibro($libro['libro_id']);

            $respuesta[] = array('libroData' => array('nombre' => $libro['title'], 'precio' => $libro['precio'], 'isbn13' => $libro['isbn13'], 'image' => $libro['image'], 'libro_id' => $libro['libro_id']), 'editorial' => $libro['editorial_name'], 'idioma' => $libro['idioma_name'], 'autor' => $autores, 'valoracionMedia' => $valoracionMedia);
            //quiero enviar un array el primero sera un array de tabla libros con su titulo, isb
            //segundo enviar un array de autores
            //tercero nombre editorial y cuarto nombre del idioma y quinto valoracion media
        }
        $respuesta2 = SELF::array_orderby($respuesta, 'valoracionMedia', SORT_DESC);
        return $respuesta2;


    }

    public function getByFiltro($filtro, $pagina)
    {

        switch ($filtro['filtro']) {
            case 'isbn':
                $queryFiltro = 'libro.isbn13';
                break;
            case 'editorial':
                $queryFiltro = 'e.editorial_name';
                break;
            case 'title':
            default:
                $queryFiltro = 'libro.title';
                break;
        }

        $stmt = $this->conn->prepare("select libro.libro_id,libro.title,libro.precio,libro.isbn13,libro.image,e.editorial_name, li.idioma_name from libro
                                                inner join editorial e on libro.editorial_id = e.editorial_id
                                                inner join libro_idioma li on libro.idioma_id = li.idioma_id WHERE " . $queryFiltro . " like concat('%','" . $filtro['dato']."','%') limit 10");
        $stmt->execute();
        $infoBusqueda = $stmt->fetchAll();


        $respuesta = array();
        foreach ($infoBusqueda as $libro) {
            //aqui cojo los autores de cada libro
            $autores = $this->getAutoresLibro($libro['libro_id']);
            if (empty($autores)) {
                $autores = array('autor' => 'anonimo');
            }
            $valoracionMedia = $this->getValoracionLibro($libro['libro_id']);

            $respuesta[] = array('libroData' => array('nombre' => $libro['title'], 'precio' => $libro['precio'], 'isbn13' => $libro['isbn13'], 'image' => $libro['image'], 'libro_id' => $libro['libro_id']), 'editorial' => $libro['editorial_name'], 'idioma' => $libro['idioma_name'], 'autor' => $autores, 'valoracionMedia' => $valoracionMedia);
            //quiero enviar un array el primero sera un array de tabla libros con su titulo, isb
            //segundo enviar un array de autores
            //tercero nombre editorial y cuarto nombre del idioma y quinto valoracion media
        }
        $respuesta2 = SELF::array_orderby($respuesta, 'valoracionMedia', SORT_DESC);

        return $respuesta2;

    }


    public function getAutoresLibro($libro_id)
    {
        $stmt = $this->conn->prepare("select autor_name from autor inner join libro_autor la on autor.autor_id = la.autor_id inner join libro l on la.libro_id = l.libro_id where l.libro_id = ?;");
        $stmt->execute(array($libro_id));
        $autores = $stmt->fetchAll(PDO::FETCH_BOTH);
        $respuesta = array();

        foreach ($autores as $autor) {
            $respuesta[] = $autor['autor_name'];
        }
        return $respuesta;
    }


    public function getValoracionLibro($libro_id)
    {
        $stmt = $this->conn->prepare("SELECT AVG(valoracion.puntuacion) as valoracionMedia from valoracion WHERE valoracion.libro_id = $libro_id;");

        $stmt->execute();
        $valoracion = $stmt->fetch(PDO::FETCH_ASSOC);
        return $valoracion['valoracionMedia'];
    }
    public static function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }


}


?>
