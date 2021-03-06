<?php

require_once "conexion.php";

class ModeloUsuarios
{
    /*=================================================
    MOSTRAR USUARIOS
    =================================================*/

    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);//PARAM_STR: recibir solo strings
        $stmt->execute();

        return $stmt->fetch(); //fetch: retorna solo un item
    }

    static public function mdlIngresarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil) VALUES (:nombre, :usuario,:password,:perfil)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        //Cierro la conexion, aunque el return no le permita ejecutar este codigo, con dudas
        $stmt-close();

        $stmt= null;
    }
}