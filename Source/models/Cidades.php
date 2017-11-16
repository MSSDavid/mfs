<?php
/**
 * This class retrieves and saves data of the Brazil's cities.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 16/11/2017
 * @since   0.1
 */
class Cidades extends model{

    /**
     * This function retrieves all data from citys's database using the state ID.
     *
     * @param   $id_estado  int for the state ID.
     * @return  array containing all data retrieved.
     */
    public function getCidades($id_estado){
        $sql = "SELECT * FROM cidades WHERE id_estado = ? ORDER BY nome";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id_estado));
        $sql = $sql->fetchAll();
        return $sql;
    }
}